<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Перевіряємо, чи користувач авторизований
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Для доступу до цієї сторінки потрібно увійти в систему.');
        }

        // Перевіряємо, чи користувач є адміністратором
        if (!auth()->user()->isAdmin()) {
            return redirect()->route('home')->with('error', 'У вас немає прав доступу до цієї сторінки. Тільки адміністратори можуть переглядати цю сторінку.');
        }

        return $next($request);
    }
}
