<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchServiceRequest;
use App\Models\Service;
use App\Repositories\SearchServiceRepository;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class SerachServiceController extends Controller
{
    private $searchSereviceRepo;
    public function __construct()
    {
        $this->searchSereviceRepo = new SearchServiceRepository();
    }
    public function search(SearchServiceRequest $request)
    {
        $services = $this->searchSereviceRepo->searchService($request);

        if($services->isEmpty()) {
            return redirect()->route('service.search.blade')->with('error', 'You cant find any service');
        }

        return view('service.search-show', compact('services'));
    }
}
