<?php

namespace App\Repositories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;

class SearchServiceRepository
{
    private $serviceModel;
    public function __construct()
    {
        $this->serviceModel = new Service();
    }

    public function searchService($request): Collection
    {
        return $this->serviceModel->with('offers')
            ->where('city', 'LIKE', '%'.$request->city.'%')
            ->WhereHas('offers', function ($query) use ($request) {
                $query->where('name', 'LIKE', '%'.$request->service_type.'%');
            })->get();
    }

}
