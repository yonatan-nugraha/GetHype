<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;

class ActivateAccount extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The user instance.
     *
     * @var User
     */
    protected $user;

    /**
     * The key for activating account.
     *
     * @var key
     */
    protected $key;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->key = sha1('gethype:'.$user->email);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.activate_account')
            ->with([
                'user'  => $this->user,
                'key'   => $this->key,
            ])
            ->from('support@gethype.co.id', 'Gethype')
            ->subject('Activate your Gethype Account');
    }
}
