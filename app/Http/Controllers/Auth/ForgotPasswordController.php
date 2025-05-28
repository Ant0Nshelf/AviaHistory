<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    /**
     * Показати форму для запиту скидання пароля
     */
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    /**
     * Надіслати посилання для скидання пароля
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Перевіряємо, чи існує користувач з таким email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Користувача з таким email не знайдено.']);
        }

        // Надсилаємо посилання для скидання пароля
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => 'Посилання для скидання пароля надіслано на ваш email!'])
                    : back()->withErrors(['email' => 'Помилка при надсиланні листа. Спробуйте пізніше.']);
    }

    /**
     * Показати форму скидання пароля
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    /**
     * Скинути пароль користувача
     */
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        // Логування для діагностики
        \Log::info('Password reset attempt', [
            'email' => $request->email,
            'token' => $request->token,
            'has_password' => !empty($request->password),
            'has_confirmation' => !empty($request->password_confirmation)
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                \Log::info('Resetting password for user: ' . $user->email);

                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                \Log::info('Password reset successful for user: ' . $user->email);
            }
        );

        \Log::info('Password reset status: ' . $status);

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', 'Пароль успішно змінено! Тепер ви можете увійти з новим паролем.');
        }

        // Детальніші повідомлення про помилки
        $errorMessage = match($status) {
            Password::INVALID_TOKEN => 'Недійсний або застарілий токен скидання пароля.',
            Password::INVALID_USER => 'Користувача з таким email не знайдено.',
            Password::THROTTLED => 'Забагато спроб скидання пароля. Спробуйте пізніше.',
            default => 'Помилка при скиданні пароля. Спробуйте ще раз.'
        };

        return back()->withErrors(['email' => $errorMessage])->withInput($request->only('email'));
    }
}
