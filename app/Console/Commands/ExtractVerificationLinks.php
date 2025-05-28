<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ExtractVerificationLinks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:links';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Extract verification links from email logs';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $logFile = storage_path('logs/laravel.log');

        if (!file_exists($logFile)) {
            $this->error('Log file not found!');
            return;
        }

        $content = file_get_contents($logFile);

        // Шукаємо посилання для підтвердження
        preg_match_all('/http:\/\/127\.0\.0\.1:8000\/registration\/verify\?token=[^&]+&amp;email=[^"]+/', $content, $matches);

        if (empty($matches[0])) {
            $this->info('No verification links found in logs.');
            return;
        }

        $this->info('Found verification links:');
        $this->line('');

        foreach (array_unique($matches[0]) as $index => $link) {
            // Декодуємо HTML entities
            $cleanLink = html_entity_decode($link);
            $this->line(($index + 1) . '. ' . $cleanLink);
        }

        $this->line('');
        $this->info('Copy any of these links and open in your browser to verify registration.');
    }
}
