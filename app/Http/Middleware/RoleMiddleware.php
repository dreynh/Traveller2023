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
        // Periksa apakah user sudah login
        if (!Auth::check()) {
            return redirect('/login'); // Jika belum login, redirect ke login
        }

        // Cek role user
        $user = Auth::user();
        if ($user->role !== $role) {
            return abort(403, 'Unauthorized access'); // Tampilkan error 403 jika role tidak cocok
        }

        return $next($request); // Lanjutkan ke rute berikutnya jika role cocok
    }
}
