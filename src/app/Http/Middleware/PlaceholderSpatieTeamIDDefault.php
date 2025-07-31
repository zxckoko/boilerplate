<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PlaceholderSpatieTeamIDDefault
{
    // MD5:da7df3456f4911e5e6fffc614f82aa7e
    private int $defaultTeamID = 69;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        setPermissionsTeamId($this->defaultTeamID);

        return $next($request);
    }
}
