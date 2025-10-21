<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServicePendingController extends Controller
{
    public function index()
    {
        $pendingServices = Service::where('status', 'pending')->paginate(10);
        $pendingServicesCount = $pendingServices->total();
        return view('service.pending',  compact('pendingServices', 'pendingServicesCount'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
           'status' => 'required|in:approved'
        ]);
        $service->status = $request->status;
        $service->save();

        return redirect()->route('service.pending')->with('success', 'You have been updated status successfully');
    }
}
