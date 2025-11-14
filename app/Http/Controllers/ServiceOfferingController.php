<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceOfferingAddRequest;
use App\Models\Service;
use App\Models\ServiceOffering;
use App\Repositories\ServiceOfferingRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceOfferingController extends Controller
{
    public function __construct(private ServiceOfferingRepository $serviceOfferingRepo){}

    public function add(Service $offer): View
    {
        return view('serviceOffering.add', compact('offer'));
    }

    public function insert(ServiceOfferingAddRequest $request, Service $offer): RedirectResponse
    {
        $this->serviceOfferingRepo->insert($request, $offer);
        return redirect()->route('service.show', $offer->id)->with('success', 'You have been successfully added an offer');
    }

    public function delete(ServiceOffering $offer): RedirectResponse
    {
        $offer->delete();
        return redirect()->back();
    }

    public function edit(ServiceOffering $offer): View
    {
        return view('serviceOffering.edit', compact('offer'));
    }

    public function update(Request $request, ServiceOffering $offer): RedirectResponse
    {
        $offer->name = $request->name;
        $offer->duration_minutes = $request->duration_minutes;
        $offer->price = $request->price;

        $offer->save();

        return redirect()->back()->with('success', 'you have been sucessfully updated an offer');
    }

}
