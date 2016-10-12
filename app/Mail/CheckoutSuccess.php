<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Order;

use PDF;

class CheckoutSuccess extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The user instance.
     *
     * @var User
     */
    protected $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $pdf = PDF::loadView('pdfs.invoice', ['order' => $this->order])->setPaper('a4');

        return $this->view('emails.send')
            ->from('support@gethype.co.id', 'Gethype')
            ->subject('Checkout Success')
            ->attachData($pdf->output(), 'invoice.pdf');
    }
}
