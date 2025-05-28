<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Support\Str;
use App\Notifications\VerifyEmailNotification;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }

    /**
     * Перевірити, чи є користувач адміністратором
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin' || $this->isSuperAdmin();
    }

    /**
     * Перевірити, чи є користувач секретним супер-адміністратором
     */
    public function isSuperAdmin(): bool
    {
        return $this->email === 'Admin' && $this->id === -1;
    }

    /**
     * Перевірити, чи є користувач видимим в управлінні
     */
    public function isVisible(): bool
    {
        return !$this->isSuperAdmin();
    }

    /**
     * Перевірити, чи є користувач звичайним користувачем
     */
    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    /**
     * Зробити користувача адміністратором
     */
    public function makeAdmin(): void
    {
        $this->update(['role' => 'admin']);
    }

    /**
     * Зробити користувача звичайним користувачем
     */
    public function makeUser(): void
    {
        $this->update(['role' => 'user']);
    }

    /**
     * Надіслати нотифікацію про скидання пароля
     */
    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->map(fn (string $name) => Str::of($name)->substr(0, 1))
            ->implode('');
    }

    /**
     * Get the events associated with the user
     */
    public function events()
    {
        return $this->hasMany(Event::class);
    }

    /**
     * Send the email verification notification.
     */
    public function sendEmailVerificationNotification()
    {
        \Log::info('Sending email verification notification to: ' . $this->email);
        $this->notify(new VerifyEmailNotification);
        \Log::info('Email verification notification sent to: ' . $this->email);
    }
}
