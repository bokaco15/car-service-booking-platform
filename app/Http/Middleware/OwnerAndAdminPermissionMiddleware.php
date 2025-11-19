<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OwnerAndAdminPermissionMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->check()) {
            abort(404);
        }

        if (! auth()->user()->hasRole(UserRole::ADMIN) && ! auth()->user()->hasRole(UserRole::SERVICE_OWNER)) {
            abort(404);
        }

        return $next($request);
    }
}
