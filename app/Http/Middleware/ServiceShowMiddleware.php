<?php

namespace App\Http\Middleware;

use App\Enums\ServiceStatus;
use App\Enums\UserRole;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ServiceShowMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (auth()->user()->hasRole(UserRole::ADMIN)) {
                return $next($request);
            }
        }
        if ($request->route('service')) {
            $service = $request->route('service');
            if ($service->status == ServiceStatus::PENDING) abort(404, 'Error');
        }

        return $next($request);
    }
}
