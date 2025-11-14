<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceOwnerController extends Controller
{
    public function myServices(): View
    {
        $servicesOfOwner = Service::where(['user_id'=>auth()->user()->id])->paginate(10, '*', 'page');
        return view('serviceowner.all', compact('servicesOfOwner'));
    }
}
