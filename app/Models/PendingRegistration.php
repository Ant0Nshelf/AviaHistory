<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PendingRegistration extends Model
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'verification_token',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    /**
     * Generate a verification token
     */
    public static function generateToken(): string
    {
        return Str::random(64);
    }

    /**
     * Check if the token is expired
     */
    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }

    /**
     * Get the verification URL
     */
    public function getVerificationUrl(): string
    {
        return route('registration.verify', [
            'token' => $this->verification_token,
            'email' => $this->email,
        ]);
    }
}
