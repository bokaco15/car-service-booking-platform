<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function insert(Request $request)
    {
        $request->validate([
           'service_offering_id' => 'required|integer',
            'start_at' => 'required',
            'end_at' => 'required'
        ]);

        Booking::create([
            'service_id' => $request->service_id,
            'client_id' => Auth::user()->id,
            'service_offering_id' => $request->service_offering_id,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at
        ]);

        return redirect()->back()->with('booking_success', 'You have been successfully made reservation');
    }

    public function show(Service $service)
    {
        $bookings = Booking::with('service', 'serviceOffering', 'client')->where('service_id', $service->id)->get();
        $service_name=$service->name;
        $counter = 0;
        if ($bookings->isEmpty()) {
            return abort(403, 'you dont have bookings');
        }
        return view('booking.show', compact('bookings', 'service_name', 'counter'));
    }

    public function edit(Booking $booking)
    {
        //if uslovi ako je vlasnik ili admin!
        $statuses = [
            'pending',
            'confirmed',
            'rejected',
            'cancelled',
            'done'
        ];
        return view('booking.edit', compact('booking', 'statuses'));
    }

    public function update(Request $request, Booking $booking)
    {
        $booking->status = $request->status;
        $booking->save();

        return redirect()->route('booking.show', $booking->service->id)->with('update-success', 'You have been successfuly update status');
    }

    public function delete(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('booking.show', $booking->service->id)->with('delete-success', 'You have been successfuly delete booking');
    }

}
