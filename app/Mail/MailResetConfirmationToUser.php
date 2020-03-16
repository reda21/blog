<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailResetConfirmationToUser extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * @var object
     */
    protected $user;
    /**
     * token
     * @var string
     */
    protected $token;
    /**
     * Completely registered URL
     * @var string
     */
    public $email;

    /**
     * Create a new message instance.
     *
     * @param object $user User model derived from `Model` class
     * @param string $token token
     * @param string $newEMail new mail address
     */
    public function __construct($user, string $token, string $newEMail)
    {
        $this->user = $user;
        $this->token = $token;
        $this->email = $newEMail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('example@example.com')
         //   ->markdown('emails.orders.shipped')
         ->with(['user'=>$this->user, 'token'=>$this->token, 'email'=>$this->email])
            ->view("emails.orders.shipped");
          //  ->with(['user'=>$this->user, 'token'=>$this->token, 'email'=>$this->email]);
    }
}
