<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DeveloperApplicationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $companyName;
    public $vacancyTitle;

    /**
     * Create a new message instance.
     */
    public function __construct($companyName, $vacancyTitle = 'вакансию')
    {
        $this->companyName = $companyName;
        $this->vacancyTitle = $vacancyTitle;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Отклик на {$this->vacancyTitle} — Дмитрий Власкин",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.developer-application',
        );
    }
}