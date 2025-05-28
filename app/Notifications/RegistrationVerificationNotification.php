<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\PendingRegistration;

class RegistrationVerificationNotification extends Notification
{
    use Queueable;

    protected $pendingRegistration;

    /**
     * Create a new notification instance.
     */
    public function __construct(PendingRegistration $pendingRegistration)
    {
        $this->pendingRegistration = $pendingRegistration;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $verificationUrl = $this->pendingRegistration->getVerificationUrl();

        \Log::info('Creating registration verification message for: ' . $this->pendingRegistration->email);
        \Log::info('Verification URL: ' . $verificationUrl);

        return (new MailMessage)
            ->subject('Підтвердження реєстрації - Історія авіації на Закарпатті')
            ->view('emails.registration-verification', [
                'pendingRegistration' => $this->pendingRegistration,
                'verificationUrl' => $verificationUrl,
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
