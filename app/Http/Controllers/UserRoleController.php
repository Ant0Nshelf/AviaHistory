<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserRoleController extends Controller
{
    /**
     * Змінити роль користувача на адміністратора
     */
    public function makeAdmin(User $user)
    {
        // Заборонити зміну ролі секретного адміна
        if ($user->isSuperAdmin()) {
            abort(404);
        }

        // Перевіряємо, чи поточний користувач є адміністратором
        if (!auth()->user()->isAdmin()) {
            return redirect()->back()->with('error', 'У вас немає прав для зміни ролей користувачів.');
        }

        // Перевіряємо, чи користувач не намагається змінити свою власну роль
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'Ви не можете змінити свою власну роль.');
        }

        $user->makeAdmin();

        return redirect()->back()->with('success', "Користувач {$user->name} тепер є адміністратором.");
    }

    /**
     * Змінити роль користувача на звичайного користувача
     */
    public function makeUser(User $user)
    {
        // Заборонити зміну ролі секретного адміна
        if ($user->isSuperAdmin()) {
            abort(404);
        }

        // Перевіряємо, чи поточний користувач є адміністратором
        if (!auth()->user()->isAdmin()) {
            return redirect()->back()->with('error', 'У вас немає прав для зміни ролей користувачів.');
        }

        // Перевіряємо, чи користувач не намагається змінити свою власну роль
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'Ви не можете змінити свою власну роль.');
        }

        $user->makeUser();

        return redirect()->back()->with('success', "Користувач {$user->name} тепер є звичайним користувачем.");
    }
}
