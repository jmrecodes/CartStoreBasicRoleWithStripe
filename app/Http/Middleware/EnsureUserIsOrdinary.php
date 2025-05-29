<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsOrdinary
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->isAdmin()) {
            // If user is authenticated AND is an admin, block them from ordinary user routes
            // You might redirect them to an admin dashboard or show a 403
            return redirect()->route('admin.users.index'); // Or abort(403, 'Admins should use the admin panel.');
        }
        return $next($request);
    }
}
