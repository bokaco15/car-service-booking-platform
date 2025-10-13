<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceAddRequest;
use App\Models\Service;
use App\Repositories\ServiceRepository;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    protected $serviceRepo;

    public function __construct()
    {
        $this->serviceRepo = new ServiceRepository();
    }

    public function add(ServiceAddRequest $request)
    {
        $this->serviceRepo->addService($request);
        return redirect()->back()->with('success', 'You have been added a service');
    }

    public function show(Service $service)
    {
        return view('service.show', compact('service'));
    }

    public function all()
    {
        $services = Service::all();
        return view('service.all', compact('services'));
    }

    public function edit(Service $service)
    {
        return view('service.update', compact('service'));
    }

    public function update(ServiceAddRequest $request, Service $service)
    {
        $this->serviceRepo->update($request, $service);
        return redirect()->back()->with('success', 'you have been successfully updated service');
    }

    public function delete(Service $service)
    {
        $service->delete();
        return redirect()->back()->with('success', 'you have been successfully deleted service');
    }

}
