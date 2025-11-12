<?php

namespace App\Http\Controllers;

use App\Enums\BookingStatus;
use App\Http\Requests\BookingInsertRequest;
use App\Http\Requests\BookingStatusUpdate;
use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function insert(BookingInsertRequest $request): RedirectResponse
    {
        //new syntax array unpacking instead of array_merge();

        Booking::create([
            ...$request->validated(),
            'client_id'=>Auth::id()
        ]);


//        Booking::create(array_merge(
//            $request->validated(),
//            ['client_id'=>Auth::id()]
//            ));
        return redirect()->back()->with('booking_success', 'You have been successfully made reservation');
    }

    public function show(Service $service): View
    {
        $bookings = Booking::with('service', 'serviceOffering', 'client')->where('service_id', $service->id)->get();
        $service_name=$service->name;
        $counter = 0;
        return view('booking.show', compact('bookings', 'service_name', 'counter'));
    }

    public function edit(Booking $booking): View
    {
        $statuses = BookingStatus::cases();
        return view('booking.edit', compact('booking', 'statuses'));
    }

    public function update(BookingStatusUpdate $request, Booking $booking): RedirectResponse
    {
        $booking->status = $request->status;
        $booking->save();

        return redirect()->route('booking.show', $booking->service->id)->with('update-success', 'You have been successfuly update status');
    }

    public function delete(Booking $booking): RedirectResponse
    {
        $booking->delete();
        return redirect()->route('booking.show', $booking->service->id)->with('delete-success', 'You have been successfuly delete booking');
    }

}
