<?php

namespace App\Http\Controllers;

use App\Enums\ServiceStatus;
use App\Http\Requests\ServiceStatusUpdateRequest;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ServicePendingController extends Controller
{
    public function index() : View
    {
        $pendingServices = Service::where('status', 'pending')->paginate(10);
        $pendingServicesCount = $pendingServices->total();
        return view('service.pending',  compact('pendingServices', 'pendingServicesCount'));
    }

    public function update(ServiceStatusUpdateRequest $request, Service $service): RedirectResponse
    {
        $service->update([
           'status' => $request->validated('status')
        ]);

        return redirect()->route('service.pending')->with('success', 'You have been updated status successfully');
    }
}
