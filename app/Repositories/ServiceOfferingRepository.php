<?php

namespace App\Repositories;

use App\Models\ServiceOffering;

class ServiceOfferingRepository
{
    private $serviceOfferingModel;
    public function __construct()
    {
        $this->serviceOfferingModel = new ServiceOffering();
    }

    public function insert($request, $offer): ServiceOffering
    {
        return $this->serviceOfferingModel->create([
            'service_id' => $offer->id,
            'name' => $request->name,
            'duration_minutes' => $request->duration_minutes,
            'price' => $request->price
        ]);
    }
}
