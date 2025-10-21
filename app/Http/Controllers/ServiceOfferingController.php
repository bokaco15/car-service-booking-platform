<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceOfferingAddRequest;
use App\Models\Service;
use App\Models\ServiceOffering;
use App\Repositories\ServiceOfferingRepository;
use Illuminate\Http\Request;

class ServiceOfferingController extends Controller
{
    private $serviceOfferingRepo;

    public function __construct()
    {
        $this->serviceOfferingRepo = new ServiceOfferingRepository();
    }

    public function add(Service $service)
    {
        return view('serviceOffering.add', compact('service'));
    }

    public function insert(ServiceOfferingAddRequest $request, Service $service)
    {
        $this->serviceOfferingRepo->insert($request, $service);
        return redirect()->route('service.show', $service->id)->with('success', 'You have been successfully added an offer');
    }

    public function delete(ServiceOffering $offer)
    {
        $offer->delete();
        return redirect()->back();
    }

    public function edit(ServiceOffering $offer){
        return view('serviceOffering.edit', compact('offer'));
    }

    public function update(Request $request, ServiceOffering $offer)
    {
        $offer->name = $request->name;
        $offer->duration_minutes = $request->duration_minutes;
        $offer->price = $request->price;

        $offer->save();

        return redirect()->back()->with('success', 'you have been sucessfully updated an offer');
    }

}
