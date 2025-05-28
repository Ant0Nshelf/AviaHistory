<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SetupGmailSMTP extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:setup-gmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup Gmail SMTP for sending real emails';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Setting up Gmail SMTP for real email sending...');
        $this->line('');

        $email = $this->ask('Enter your Gmail address');
        $password = $this->secret('Enter your Gmail App Password (not regular password)');

        if (!$email || !$password) {
            $this->error('Email and password are required!');
            return;
        }

        // Читаємо .env файл
        $envPath = base_path('.env');
        $envContent = file_get_contents($envPath);

        // Замінюємо налаштування пошти
        $envContent = preg_replace('/MAIL_MAILER=.*/', 'MAIL_MAILER=smtp', $envContent);
        $envContent = preg_replace('/MAIL_HOST=.*/', 'MAIL_HOST=smtp.gmail.com', $envContent);
        $envContent = preg_replace('/MAIL_PORT=.*/', 'MAIL_PORT=587', $envContent);
        $envContent = preg_replace('/MAIL_USERNAME=.*/', 'MAIL_USERNAME=' . $email, $envContent);
        $envContent = preg_replace('/MAIL_PASSWORD=.*/', 'MAIL_PASSWORD=' . $password, $envContent);
        $envContent = preg_replace('/MAIL_FROM_ADDRESS=.*/', 'MAIL_FROM_ADDRESS="' . $email . '"', $envContent);

        // Записуємо назад
        file_put_contents($envPath, $envContent);

        $this->info('✅ Gmail SMTP configured successfully!');
        $this->line('');
        $this->warn('Important notes:');
        $this->line('1. Make sure you have enabled 2-factor authentication on your Gmail account');
        $this->line('2. Use an App Password, not your regular Gmail password');
        $this->line('3. You can generate an App Password at: https://myaccount.google.com/apppasswords');
        $this->line('');
        $this->info('Now restart the server: php artisan serve');
        $this->info('Then try registering - emails will be sent to real email addresses!');
    }
}
