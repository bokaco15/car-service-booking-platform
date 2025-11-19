<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if(!auth()->user()) {
            abort(404);
        }
        if (!auth()->user()->hasRole(UserRole::ADMIN)) {
            abort(404);
        }
        return $next($request);
    }
}
