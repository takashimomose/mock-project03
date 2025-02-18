<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CheckRole
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
        if (Auth::check()) {
            $userRole = Auth::user()->role_id;
    
            if ($role === 'admin' && $userRole !== User::ROLE_ADMIN) {
                abort(403, '閲覧権限がありません');
            } elseif ($role === 'owner' && $userRole !== User::ROLE_OWNER) {
                abort(403, '閲覧権限がありません');
            } elseif ($role === 'general' && $userRole !== User::ROLE_GENERAL) {
                abort(403, '閲覧権限がありません');
            }
        }

        return $next($request);
    }
}
