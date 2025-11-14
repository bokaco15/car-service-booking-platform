<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceOfferingAddRequest;
use App\Models\Service;
use App\Models\ServiceOffering;
use App\Repositories\ServiceOfferingRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ServiceOfferingController extends Controller
{
    public function __construct(private ServiceOfferingRepository $serviceOfferingRepo){}

    public function add(Service $service): View
    {
        return view('serviceOffering.add', compact('service'));
    }

    public function insert(ServiceOfferingAddRequest $request, Service $service): RedirectResponse
    {
        $this->serviceOfferingRepo->insert($request, $service);
        return redirect()->route('service.show', $service->id)->with('success', 'You have been successfully added an offer');
    }

    public function delete(ServiceOffering $service): RedirectResponse
    {
        $service->delete();
        return redirect()->back();
    }

    public function edit(ServiceOffering $service): View
    {
        return view('serviceOffering.edit', compact('service'));
    }

    public function update(Request $request, ServiceOffering $service): RedirectResponse
    {
        $service->name = $request->name;
        $service->duration_minutes = $request->duration_minutes;
        $service->price = $request->price;

        $service->save();

        return redirect()->back()->with('success', 'you have been sucessfully updated an offer');
    }

}
