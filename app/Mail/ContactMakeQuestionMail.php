<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMakeQuestionMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $message = null;
    protected $fromEmail = null;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($message, $fromEmail)
    {
        $this->message = $message;
        $this->fromEmail = $fromEmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->fromEmail)
            ->view('mail.contact.contactMail')
            ->with([
                'question' => ucwords($this->message)
            ])
            ->subject('Laravel Ecomerence Test Fire Mail');
    }
}
