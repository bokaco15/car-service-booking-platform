<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use function auth as authAlias;

class ServiceRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(authAlias()->user()) {
            if(authAlias()->user()->hasRole('admin')) {
                return $next($request);
            }

//        dd($request->route('service'));
            if($request->route('offer') != null) {
                $offer_service = $request->route('offer');
                $service = $offer_service->service;
            }

            if($request->route('service') != null) {
                $service = $request->route('service');
            }

            if ($request->route('booking') != null) {
                $booking = $request->route('booking');
                $service = $booking->service;
            }

            if($service->ownerAndAdminCanView(authAlias()->user()->id)) {
                return $next($request);
            }
        }


        abort(403, 'Nemate pristup nasoj stranici!');
    }
}
