<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAndEditWorkingHoursRequest;
use App\Models\Service;
use App\Models\WorkingHours;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Nette\Utils\Paginator;
use function PHPUnit\Framework\isEmpty;

class WorkingHoursController extends Controller
{
    public function add(Service $service): View
    {
        if ($service->working_hours->isEmpty()) {
            $days = ['Ponedeljak', 'Utorak', 'Srijeda', 'Cetvrtak', 'Petak', 'Subota', 'Nedelja'];
            return view('workingHours.add', compact('service', 'days'));
        } else {
            abort(403, 'greska, imas vec dodate dane!');
        }
    }

    public function insert(AddAndEditWorkingHoursRequest $request): void
    {
        foreach($request->working_hours as $days) {
            WorkingHours::create([
                'service_id' => $days['service_id'],
                'day_of_week' => $days['day_of_week'],
                'opens_at' => $days['opens_at'],
                'closes_at' => $days['closes_at']
            ]);
        }
        return redirect(route('service.show', $request->service_id))->with('success', 'You have been successfully added working hours');
    }

    public function edit(Service $service): View
    {
        if ($service->working_hours->isNotEmpty()) {
            $days = ['Ponedeljak', 'Utorak', 'Srijeda', 'Cetvrtak', 'Petak', 'Subota', 'Nedelja'];
            $workingHoursMap = $service->working_hours->keyBy('day_of_week');
            return view('workingHours.edit', compact('service', 'days', 'workingHoursMap'));
        } else {
            abort(403, 'Greska, moras prvo dodati termine!');
        }
    }

    public function update(AddAndEditWorkingHoursRequest $request, Service $service): RedirectResponse
    {
        foreach ($request->working_hours as $days => $value) {
           $wh = WorkingHours::where('service_id', $service->id)->where('day_of_week', $days)->first();
           $wh->day_of_week = $value['day_of_week'];
           $wh->opens_at = $value['opens_at'];
           $wh->closes_at = $value['closes_at'];

           $wh->save();
        }
        return redirect()->route('service.show', $service->id)->with('success', 'You have been successfully updated Working hours');
    }

}
