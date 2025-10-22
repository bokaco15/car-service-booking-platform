<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceOwnerController extends Controller
{
    public function myServices()
    {
        $servicesOfOwner = Service::where(['user_id'=>auth()->user()->id])->paginate(10, '*', 'page');
        return view('serviceowner.all', compact('servicesOfOwner'));
    }
}
