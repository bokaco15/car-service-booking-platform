<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class SerachServiceController extends Controller
{
    public function search(Request $request)
    {
        //URADITI VALIDACIJU PREKO REQUEST-A ZA SEARCHSERVICE!!!


        $services = Service::with('offers')
            ->where('city', 'LIKE', '%'.$request->city.'%')
            ->whereHas('offers', function ($query) use ($request) {
                $query->where('name', 'LIKE', '%'.$request->service_type.'%');
            })->get();


        if($services->isEmpty()) {
            return redirect()->route('service.search.blade')->with('error', 'You cant find any service');
        }

        return view('service.search-show', compact('services'));



    }
}
