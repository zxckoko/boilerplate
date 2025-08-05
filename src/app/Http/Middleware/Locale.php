<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->has('locale')) {
            app()->setLocale(session()->get('locale'));
        }

        if (! (session()->has('locale')) || count(config('app._supported_locales')) <= 1) {
            app()->setLocale(config('app.fallback_locale'));
        }

        return $next($request);
    }
}
