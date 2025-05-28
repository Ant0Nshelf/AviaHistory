<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PendingRegistration;
use App\Mail\RegistrationVerificationMail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Validation\Rules;
use Carbon\Carbon;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        \Log::info('Registration attempt started for email: ' . $request->email);

        // Спочатку видаляємо старі записи для цього email
        PendingRegistration::where('email', $request->email)->delete();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class.',email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        \Log::info('Validation passed, creating pending registration');

        // Створюємо тимчасову реєстрацію
        $pendingRegistration = PendingRegistration::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'verification_token' => PendingRegistration::generateToken(),
            'expires_at' => Carbon::now()->addHours(24),
        ]);

        \Log::info('Pending registration created with ID: ' . $pendingRegistration->id);

        // Надсилаємо лист підтвердження на реальну пошту користувача
        try {
            \Log::info('Sending verification email to: ' . $request->email);

            Mail::to($request->email)->send(new RegistrationVerificationMail($pendingRegistration));

            \Log::info('✅ Verification email sent successfully to: ' . $request->email);
        } catch (\Exception $e) {
            \Log::error('❌ Failed to send verification email: ' . $e->getMessage());
        }

        \Log::info('Redirecting to registration pending page');

        // Створюємо посилання для підтвердження
        $verificationUrl = $pendingRegistration->getVerificationUrl();

        return redirect()->route('registration.pending')
            ->with('email', $request->email)
            ->with('verification_url', $verificationUrl);
    }

    /**
     * Show the registration pending page
     */
    public function pending()
    {
        return view('auth.registration-pending');
    }

    /**
     * Verify the registration
     */
    public function verify(Request $request)
    {
        $token = $request->get('token');
        $email = $request->get('email');

        \Log::info('Registration verification attempt for email: ' . $email);

        $pendingRegistration = PendingRegistration::where('email', $email)
            ->where('verification_token', $token)
            ->first();

        if (!$pendingRegistration) {
            \Log::error('Invalid verification token for email: ' . $email);
            return redirect()->route('register')->with('error', 'Недійсне посилання для підтвердження. Спробуйте зареєструватися знову.');
        }

        if ($pendingRegistration->isExpired()) {
            \Log::error('Expired verification token for email: ' . $email);
            $pendingRegistration->delete();
            return redirect()->route('register')->with('error', 'Посилання для підтвердження застаріло. Спробуйте зареєструватися знову.');
        }

        // Створюємо користувача
        $user = User::create([
            'name' => $pendingRegistration->name,
            'email' => $pendingRegistration->email,
            'password' => $pendingRegistration->password,
            'email_verified_at' => now(),
        ]);

        \Log::info('User created successfully with ID: ' . $user->id);

        // Видаляємо тимчасову реєстрацію
        $pendingRegistration->delete();

        // Входимо в систему
        Auth::login($user);

        return redirect()->route('home')->with('success', 'Реєстрацію успішно завершено! Ласкаво просимо на сайт!');
    }
}
