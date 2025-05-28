<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PendingRegistration;
use App\Mail\RegistrationVerificationMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class TestEmailSending extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:email {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test email sending functionality';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');

        $this->info("Testing email sending to: {$email}");

        // Створюємо тестовий pending registration
        $pendingRegistration = new PendingRegistration([
            'name' => 'Test User',
            'email' => $email,
            'verification_token' => 'test-token-123',
            'expires_at' => Carbon::now()->addHours(24),
        ]);

        try {
            Mail::to($email)->send(new RegistrationVerificationMail($pendingRegistration));
            $this->info("✅ Email sent successfully!");
        } catch (\Exception $e) {
            $this->error("❌ Failed to send email: " . $e->getMessage());
            $this->error("Stack trace: " . $e->getTraceAsString());
        }
    }
}
