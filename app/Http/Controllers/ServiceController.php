<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceAddRequest;
use App\Models\Service;
use App\Repositories\SearchServiceRepository;
use App\Repositories\ServiceRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
//    protected $serviceRepo;

    public function __construct(private ServiceRepository $serviceRepo){}

    public function add(ServiceAddRequest $request): RedirectResponse
    {
        $this->serviceRepo->addService($request);
        return redirect()->back()->with('success', 'You have been added a service, but your status is pending. Wait for administrator to approve your request');
    }

    public function show(Service $service): View
    {
        return view('service.show', compact('service'));
    }

    public function all(): View
    {
        if (Auth::check()) {
            if (Auth::user()->hasRole('admin')) {
                $services = Service::paginate(10, '*', 'page');
                return view('service.all', compact('services'));
            }
        }
        $services = Service::where('status', 'approved')->paginate(10, '*', 'page');
        return view('service.all', compact('services'));
    }

    public function edit(Service $service): View
    {
        return view('service.update', compact('service'));
    }

    public function update(ServiceAddRequest $request, Service $service): RedirectResponse
    {
        $this->serviceRepo->update($request, $service);
        return redirect()->back()->with('success', 'you have been successfully updated service');
    }

    public function delete(Service $service): RedirectResponse
    {
        $service->delete();
        return redirect()->back()->with('success', 'you have been successfully deleted service');
    }

}
