<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and has the 'admin' role
        if (Auth::check() && (Auth::user()->role === 'admin')|| Auth::user()->role === 'super admin') {
            return $next($request);
        }

        // Redirect to the dashboard with an error message if not authorized
        return redirect('dashboard')->with('error', 'Accès non autorisé.');
    }
}
