<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\PendingRegistration;

class RegistrationVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pendingRegistration;

    /**
     * Create a new message instance.
     */
    public function __construct(PendingRegistration $pendingRegistration)
    {
        $this->pendingRegistration = $pendingRegistration;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Підтвердження реєстрації - Історія авіації на Закарпатті',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.registration-verification',
            with: [
                'pendingRegistration' => $this->pendingRegistration,
                'verificationUrl' => $this->pendingRegistration->getVerificationUrl(),
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
        return [];
    }
}
