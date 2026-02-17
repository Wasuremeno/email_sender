<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
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
            subject: 'Резюме',
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

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        $resumePath = base_path('resume.pdf');
        
        if (!file_exists($resumePath)) {
            // Log warning if file doesn't exist
            logger()->warning('Resume PDF not found at: ' . $resumePath);
            return [];
        }

        return [
            Attachment::fromPath($resumePath)
                ->as('Дмитрий_Власкин_Резюме.pdf')
                ->withMime('application/pdf'),
        ];
    }
}