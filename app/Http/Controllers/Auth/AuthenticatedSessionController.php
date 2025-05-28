<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        // Кастомна валідація для секретного адміна
        $request->validate([
            'email' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    // Дозволяємо "Admin" для секретного адміна
                    if ($value !== 'Admin' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        $fail('Поле email повинно бути дійсною email адресою або "Admin".');
                    }
                },
            ],
            'password' => ['required', 'string'],
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
