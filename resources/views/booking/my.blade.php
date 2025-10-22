@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-4">Moje rezervacije:</h1>

    <div class="row">
        @foreach($bookings as $booking)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <h5 class="card-title mb-2">{{ $booking->service->name }}</h5>
                        <p class="text-muted mb-1">
                            <i class="bi bi-person"></i> Klijent: {{ $booking->client->name }}
                        </p>
                        <p class="text-muted mb-2">
                            <i class="bi bi-clock"></i> Termin: {{ \Carbon\Carbon::parse($booking->start_at)->format('d.m.Y H:i') }}
                        </p>

                        @php
                            $statusClasses = [
                                'pending'   => 'bg-warning text-dark',
                                'confirmed' => 'bg-success',
                                'rejected'  => 'bg-danger',
                                'cancelled' => 'bg-danger',
                                'done'      => 'bg-success',
                            ];
                        @endphp

                        <span class="badge {{ $statusClasses[$booking->status] ?? 'bg-light text-dark' }} px-3 py-2 rounded-pill text-capitalize">
                            {{ $booking->status }}
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
