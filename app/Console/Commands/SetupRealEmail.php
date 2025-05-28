<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SetupRealEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup real email sending with Gmail';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚀 Налаштування реальної відправки email');
        $this->line('');

        $this->warn('Для відправки листів на реальну пошту потрібно налаштувати Gmail SMTP.');
        $this->line('');

        $this->info('📋 Інструкції:');
        $this->line('1. Перейдіть на https://myaccount.google.com/apppasswords');
        $this->line('2. Увійдіть в свій Gmail акаунт (antonsemion2206@gmail.com)');
        $this->line('3. Увімкніть 2-факторну автентифікацію (якщо не увімкнена)');
        $this->line('4. Створіть App Password для "Mail"');
        $this->line('5. Скопіюйте згенерований 16-символьний пароль');
        $this->line('');

        if ($this->confirm('Чи маєте ви App Password?')) {
            $appPassword = $this->secret('Введіть ваш Gmail App Password (16 символів)');

            if (strlen($appPassword) !== 16) {
                $this->error('App Password повинен містити рівно 16 символів!');
                return;
            }

            // Оновлюємо .env файл
            $envPath = base_path('.env');
            $envContent = file_get_contents($envPath);

            $envContent = preg_replace('/MAIL_PASSWORD=.*/', 'MAIL_PASSWORD="' . $appPassword . '"', $envContent);

            file_put_contents($envPath, $envContent);

            $this->info('✅ Gmail SMTP налаштовано успішно!');
            $this->line('');
            $this->info('🧪 Тестуємо відправку...');

            try {
                \Artisan::call('test:email', ['email' => 'antonsemion2206@gmail.com']);
                $this->info('✅ Тестовий лист надіслано успішно!');
                $this->info('Перевірте свою пошту antonsemion2206@gmail.com');
            } catch (\Exception $e) {
                $this->error('❌ Помилка при відправці: ' . $e->getMessage());
            }

        } else {
            $this->line('');
            $this->info('🔗 Посилання для створення App Password:');
            $this->line('https://myaccount.google.com/apppasswords');
            $this->line('');
            $this->info('Після створення App Password запустіть команду знову:');
            $this->line('php artisan email:setup');
        }
    }
}
