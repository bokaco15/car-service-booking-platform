<?php

namespace App\Repositories;

use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class ServiceRepository
{
    private $serviceModel;

    public function __construct()
    {
        $this->serviceModel = new Service();
    }


    public function addService($request)
    {
        return $this->serviceModel->create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'city' => $request->city,
            'description' => $request->description,
            'status' => 'pending'
        ]);
    }

    public function update($request, $service)
    {
        $service->name = $request->name;
        $service->city = $request->city;
        $service->description = $request->description;
        return $service->save();
    }

}
