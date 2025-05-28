<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PendingRegistration;
use Carbon\Carbon;

class CleanupExpiredRegistrations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'registrations:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up expired pending registrations';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiredCount = PendingRegistration::where('expires_at', '<', Carbon::now())->count();

        if ($expiredCount > 0) {
            PendingRegistration::where('expires_at', '<', Carbon::now())->delete();
            $this->info("Cleaned up {$expiredCount} expired registration(s).");
        } else {
            $this->info("No expired registrations found.");
        }
    }
}
