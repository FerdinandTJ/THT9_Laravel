<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Pastikan pengguna sudah login
        if (!Auth::check()) {
            abort(403, 'Unauthorized action. You are not logged in.');
        }

        // Periksa apakah role pengguna sesuai
        $user = Auth::user(); // Ambil data pengguna yang sedang login
        if ($user->role !== $role) {
            abort(403, 'Unauthorized action. Role mismatch.');
        }

        return $next($request);
    }
}
