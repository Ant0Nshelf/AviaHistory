<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        // Приховуємо секретного адміна (id = -1)
        $users = User::where('id', '!=', -1)
            ->withCount('events')
            ->paginate(10);
        return view('users.manage.index_new', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('users.manage.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->route('users.manage.create')
                ->withErrors($validator)
                ->withInput();
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.manage.index')
            ->with('success', 'Користувача успішно створено.');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        // Заборонити редагування секретного адміна
        if ($user->isSuperAdmin()) {
            abort(404);
        }

        return view('users.manage.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        // Заборонити оновлення секретного адміна
        if ($user->isSuperAdmin()) {
            abort(404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->route('users.manage.edit', $user->id)
                ->withErrors($validator)
                ->withInput();
        }

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        return redirect()->route('users.manage.edit', $user->id)
            ->with('success', 'Користувача успішно оновлено.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        // Заборонити видалення секретного адміна
        if ($user->isSuperAdmin()) {
            abort(404);
        }

        // Перевіряємо, чи є події, пов'язані з цим користувачем
        $eventsCount = $user->events()->count();

        if ($eventsCount > 0) {
            return redirect()->route('users.manage.index')
                ->with('error', "Неможливо видалити користувача, оскільки з ним пов'язано {$eventsCount} подій.");
        }

        // Перевіряємо, чи це не останній адміністратор
        $adminCount = User::count();
        if ($adminCount <= 1) {
            return redirect()->route('users.manage.index')
                ->with('error', 'Неможливо видалити останнього користувача.');
        }

        $user->delete();

        return redirect()->route('users.manage.index')
            ->with('success', 'Користувача успішно видалено.');
    }
}
