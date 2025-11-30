<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        \Log::info('=== ADMIN MIDDLEWARE DEBUG ===');
        \Log::info('URL: ' . $request->fullUrl());
        \Log::info('User ID: ' . (auth()->id() ?? 'null'));
        \Log::info('User Role: ' . (auth()->user()->role ?? 'null'));
        
        if (Auth::check() && Auth::user()->role === 'admin') {
            \Log::info('✅ Accès autorisé');
            return $next($request);
        }

        \Log::warning('❌ Accès refusé - Redirection vers login');
        return redirect()->route('login')->with('error', 'Accès administrateur requis.');
    }
}