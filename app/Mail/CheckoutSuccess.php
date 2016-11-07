<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;
use App\Order;
use App\Ticket;

use PDF;

class CheckoutSuccess extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The user instance.
     *
     * @var User
     */
    protected $user;

    /**
     * The order instance.
     *
     * @var Order
     */
    protected $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Order $order)
    {
        $this->user = $user;
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $invoice_pdf = PDF::loadView('pdfs.invoice', [
            'order' => $this->order
        ])->setPaper('a4')->output();

        $tickets = Ticket::where('order_id', $this->order->id)->get();

        $tickets_pdf = PDF::loadView('pdfs.ticket', [
            'order' => $this->order,
            'tickets' => $tickets
        ])->setPaper('a4')->output();

        $quantity = array_sum($this->order->order_details->pluck('quantity')->toArray());

        return $this->view('emails.checkout_success')
            ->with([
                'user'   => $this->user,
                'order'  => $this->order,
                'quantity' => $quantity
            ])
            ->from('support@gethype.co.id', 'Gethype')
            ->subject('Checkout Success')
            ->attachData($tickets_pdf, 'tickets.pdf')
            ->attachData($invoice_pdf, 'invoice.pdf');
    }
}
