<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationManagementController;
use App\Http\Controllers\UserManagementController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/filter', [HomeController::class, 'filterByLocation'])->name('filter.location');
Route::get('/events/{event}', [HomeController::class, 'show'])->name('events.show');



// Маршрути для управління подіями, локаціями та користувачами (доступні тільки для адміністраторів)
Route::middleware(['auth', 'admin'])->group(function () {
    // Управління подіями (старий контролер)
    Route::get('/manage/events', [App\Http\Controllers\EventManagementController::class, 'index'])->name('events.manage.index');
    Route::get('/manage/events/create', [App\Http\Controllers\EventManagementController::class, 'create'])->name('events.manage.create');
    Route::post('/manage/events', [App\Http\Controllers\EventManagementController::class, 'store'])->name('events.manage.store');
    Route::get('/manage/events/{event}/edit', [App\Http\Controllers\EventManagementController::class, 'edit'])->name('events.manage.edit');
    Route::put('/manage/events/{event}', [App\Http\Controllers\EventManagementController::class, 'update'])->name('events.manage.update');
    Route::delete('/manage/events/{event}', [App\Http\Controllers\EventManagementController::class, 'destroy'])->name('events.manage.destroy');



    // Управління локаціями
    Route::get('/manage/locations', [App\Http\Controllers\LocationManagementController::class, 'index'])->name('locations.manage.index');
    Route::get('/manage/locations/create', [App\Http\Controllers\LocationManagementController::class, 'create'])->name('locations.manage.create');
    Route::post('/manage/locations', [App\Http\Controllers\LocationManagementController::class, 'store'])->name('locations.manage.store');
    Route::get('/manage/locations/{location}/edit', [App\Http\Controllers\LocationManagementController::class, 'edit'])->name('locations.manage.edit');
    Route::put('/manage/locations/{location}', [App\Http\Controllers\LocationManagementController::class, 'update'])->name('locations.manage.update');
    Route::delete('/manage/locations/{location}', [App\Http\Controllers\LocationManagementController::class, 'destroy'])->name('locations.manage.destroy');

    // Управління користувачами
    Route::get('/manage/users', [App\Http\Controllers\UserManagementController::class, 'index'])->name('users.manage.index');
    Route::get('/manage/users/create', [App\Http\Controllers\UserManagementController::class, 'create'])->name('users.manage.create');
    Route::post('/manage/users', [App\Http\Controllers\UserManagementController::class, 'store'])->name('users.manage.store');
    Route::get('/manage/users/{user}/edit', [App\Http\Controllers\UserManagementController::class, 'edit'])->name('users.manage.edit');
    Route::put('/manage/users/{user}', [App\Http\Controllers\UserManagementController::class, 'update'])->name('users.manage.update');
    Route::delete('/manage/users/{user}', [App\Http\Controllers\UserManagementController::class, 'destroy'])->name('users.manage.destroy');

    // Зміна ролей користувачів (тільки для адміністраторів)
    Route::post('/users/{user}/make-admin', [App\Http\Controllers\UserRoleController::class, 'makeAdmin'])->name('users.make-admin');
    Route::post('/users/{user}/make-user', [App\Http\Controllers\UserRoleController::class, 'makeUser'])->name('users.make-user');
});

Route::redirect('dashboard', '/')
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    // Профіль користувача (доступний всім авторизованим користувачам)
    Route::get('/profile/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
