<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PendingRegistration;
use Illuminate\Support\Facades\Mail;

class SendVerificationToEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send {target_email} {--registration_email=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send verification link to specified email address';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $targetEmail = $this->argument('target_email');
        $registrationEmail = $this->option('registration_email');

        $this->info("Looking for pending registrations...");

        // Якщо вказано email реєстрації, шукаємо по ньому
        if ($registrationEmail) {
            $pendingRegistration = PendingRegistration::where('email', $registrationEmail)
                ->where('expires_at', '>', now())
                ->first();
        } else {
            // Інакше беремо останню активну реєстрацію
            $pendingRegistration = PendingRegistration::where('expires_at', '>', now())
                ->latest()
                ->first();
        }

        if (!$pendingRegistration) {
            $this->error('No active pending registrations found!');
            $this->info('Please register first at: http://127.0.0.1:8000/register');
            return;
        }

        $this->info("Found pending registration for: {$pendingRegistration->email}");
        $this->info("Name: {$pendingRegistration->name}");

        // Створюємо посилання для підтвердження
        $verificationUrl = $pendingRegistration->getVerificationUrl();

        $this->info("Verification URL: {$verificationUrl}");

        // Створюємо простий email з посиланням
        $emailContent = "
        <h2>Підтвердження реєстрації</h2>
        <p>Вітаємо, {$pendingRegistration->name}!</p>
        <p>Для завершення реєстрації натисніть на посилання нижче:</p>
        <p><a href='{$verificationUrl}' style='background: #0d47a1; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Підтвердити реєстрацію</a></p>
        <p>Або скопіюйте це посилання в браузер:</p>
        <p>{$verificationUrl}</p>
        <p>Посилання дійсне до: {$pendingRegistration->expires_at->format('d.m.Y H:i')}</p>
        ";

        try {
            // Надсилаємо email
            Mail::send([], [], function ($message) use ($targetEmail, $emailContent, $pendingRegistration) {
                $message->to($targetEmail)
                    ->subject('Підтвердження реєстрації - Історія авіації на Закарпатті')
                    ->html($emailContent);
            });

            $this->info("✅ Verification email sent successfully to: {$targetEmail}");
            $this->info("Check your email and click the verification link!");

        } catch (\Exception $e) {
            $this->error("❌ Failed to send email: " . $e->getMessage());
            $this->info("You can still use this direct link:");
            $this->line($verificationUrl);
        }
    }
}
