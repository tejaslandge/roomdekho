<?php

namespace App\Http\Middleware;

use App\Models\PlatformSetting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureSiteIsNotInMaintenance
{
    /**
     * Block non-admin visitors while maintenance mode is enabled.
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $enabled = PlatformSetting::read('maintenance_mode') === '1';
        } catch (\Throwable) {
            $enabled = false;
        }

        if (! $enabled) {
            return $next($request);
        }

        // Keep authentication and health endpoints reachable so an admin can log in.
        if ($request->routeIs('login', 'logout', 'password.*', 'up')) {
            return $next($request);
        }

        $user = $request->user();

        if ($user && $user->role === 'admin') {
            return $next($request);
        }

        abort(503, 'RoomDekho is temporarily under maintenance. Please check back soon.');
    }
}
