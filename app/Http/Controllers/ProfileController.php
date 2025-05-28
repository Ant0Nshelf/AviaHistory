<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    /**
     * Показати форму редагування профілю
     */
    public function edit()
    {
        // Заборонити доступ секретному адміну
        if (auth()->user()->isSuperAdmin()) {
            return redirect()->route('home')->with('error', 'Секретний адміністратор не може редагувати свій профіль.');
        }

        return view('profile.edit', [
            'user' => auth()->user()
        ]);
    }

    /**
     * Оновити профіль користувача
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        // Заборонити оновлення секретному адміну
        if ($user->isSuperAdmin()) {
            return redirect()->route('home')->with('error', 'Секретний адміністратор не може редагувати свій профіль.');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'current_password' => ['nullable', 'string'],
            'password' => ['nullable', 'confirmed', 'min:8'],
        ]);

        // Оновлюємо ім'я та email
        $user->name = $request->name;
        $user->email = $request->email;

        // Якщо користувач хоче змінити пароль
        if ($request->filled('password')) {
            // Перевіряємо поточний пароль
            if (!$request->filled('current_password')) {
                return back()->withErrors(['current_password' => 'Поточний пароль обов\'язковий для зміни пароля.']);
            }

            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Поточний пароль невірний.']);
            }

            // Хешуємо та встановлюємо новий пароль
            $user->password = Hash::make($request->password);
        }

        // Зберігаємо зміни
        $user->save();

        $message = 'Профіль успішно оновлено!';
        if ($request->filled('password')) {
            $message = 'Профіль та пароль успішно оновлено!';
        }

        return redirect()->route('profile.edit')->with('success', $message);
    }

    /**
     * Видалити акаунт користувача
     */
    public function destroy(Request $request)
    {
        $user = auth()->user();

        // Заборонити видалення секретного адміна
        if ($user->isSuperAdmin()) {
            return back()->withErrors(['password' => 'Секретний адміністратор не може бути видалений.']);
        }

        $request->validate([
            'password' => ['required', 'string'],
        ]);

        // Перевіряємо поточний пароль
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Пароль невірний.']);
        }

        // Перевіряємо, чи є події, пов'язані з цим користувачем
        $eventsCount = $user->events()->count();
        if ($eventsCount > 0) {
            return back()->withErrors(['password' => "Неможливо видалити акаунт, оскільки з ним пов'язано {$eventsCount} подій. Спочатку видаліть або передайте події іншому користувачу."]);
        }

        // Вихід з системи та видалення користувача
        auth()->logout();
        $user->delete();

        // Очищуємо сесію
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Ваш акаунт було успішно видалено.');
    }
}
