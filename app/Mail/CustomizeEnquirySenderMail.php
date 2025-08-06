<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CustomizeEnquirySenderMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $data;
    public $attachments;

    public function __construct($data, $attachments = [])
    {
        $this->data = $data;
        $this->attachments = $attachments;
    }


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Customization Enquiry - Aleef Pro',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.customize_enquiry_sender',
            with: [
                'data' => $this->data,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return collect($this->attachments)->map(function ($attachment) {
            if (is_array($attachment) && isset($attachment['file'])) {
                return \Illuminate\Mail\Mailables\Attachment::fromPath($attachment['file'])
                    ->as($attachment['options']['as'] ?? basename($attachment['file']))
                    ->withMime($attachment['options']['mime'] ?? 'application/octet-stream');
            }

            // fallback if simple string path
            return \Illuminate\Mail\Mailables\Attachment::fromPath($attachment);
        })->toArray();
    }
}
