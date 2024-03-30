<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    //public $email;
    public $subject;
    public $email;
    public $body;
    public function __construct($subject,$body,$email)
    {
        //
        $this->email = $email;
        $this->subject = $subject;
        $this->body = $body;
    }

    public function build()
    {
        return $this->replyTo($this->email)->markdown('pages.emails.contact');
    }
}
