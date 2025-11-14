@extends('layouts.app')

@section('content')
    {{-- Header --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
        <div>
            <h1 class="h3 mb-1">{{ Str::title($service->name) }}, {{ Str::title($service->city) }}</h1>
            <p class="text-muted mb-0">{{ $service->description }}</p>
        </div>

        @auth
            @can('view', $service)
                <div class="mt-3 mt-md-0">
                    <a href="{{ route('serviceOffering.add', $service->id) }}" class="btn btn-primary btn-sm">Dodaj usluge</a>
                    <a href="{{ route('service.edit', $service->id) }}" class="btn btn-secondary btn-sm">Izmeni podatke o servisu</a>
                </div>
            @endcan
        @endauth
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Zatvori"></button>
        </div>
    @endif

    {{-- Usluge lista (kratko) --}}
    <div class="mb-4">
        <strong>Usluge:</strong>
        @forelse($service->offers as $offer)
            {{ $offer->name }}{{ $loop->last ? '.' : ', ' }}
        @empty
            <span class="text-muted">Nema definisanih usluga.</span>
        @endforelse
    </div>

    {{-- Tabela usluga --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white">
            <h2 class="h5 mb-0">Ponude usluga</h2>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                    <tr>
                        <th>Naziv usluge</th>
                        <th>Trajanje (min)</th>
                        <th>Cijena</th>
                        @auth
                            @can('view', $service)
                                <th class="text-end">Akcije</th>
                            @endcan
                        @endauth
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($service->offers as $offer)
                        <tr>
                            <td>{{ $offer->name }}</td>
                            <td>{{ $offer->duration_minutes }}</td>
                            <td>{{ number_format($offer->price, 2) }} KM</td>

                            @auth
                                @can('view', $service)
                                    <td class="text-end">
                                        <a href="{{ route('serviceOffering.edit', $offer->id) }}" class="btn btn-outline-secondary btn-sm">Uredi</a>
                                        <a href="{{ route('serviceOffering.delete', $offer->id) }}" class="btn btn-outline-danger btn-sm" onclick="return confirm('Obrisati ovu uslugu?')">Obriši</a>
                                    </td>
                                @endcan
                            @endauth
                        </tr>
                    @empty
                        <tr>
                            @php
                                $colspan = auth()->check() && auth()->user()->can('view', $service) ? 4 : 3;
                            @endphp
                            <td colspan="{{ $colspan }}" class="text-center text-muted py-4">Nema definisanih usluga.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Radno vrijeme --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h2 class="h5 mb-0">Radno vrijeme</h2>

            @auth
                @can('view', $service)
                    @if(count($service->working_hours ?? []) === 7)
                        <a href="{{ route('workingHours.edit', $service->id) }}" class="btn btn-sm btn-outline-primary">Izmijeni termine</a>
                    @else
                        <a href="{{ route('workingHours.add', $service->id) }}" class="btn btn-sm btn-primary">Dodaj termine</a>
                    @endif
                @endif
            @endcan
        </div>

        <div class="card-body">
            @if(count($service->working_hours ?? []) === 7)
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-2">
                    @foreach($service->working_hours->sortBy('id') as $wh)
                        <div class="col">
                            <div class="border rounded p-2 h-100">
                                <strong>{{ $wh->day_of_week }}:</strong>
                                @if(is_null($wh->opens_at))
                                    <span class="text-muted">ne radimo</span>
                                @else
                                    {{ $wh->opens_at }}h – {{ $wh->closes_at }}h
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-muted">Radno vrijeme nije kompletno definisano.</div>
            @endif
        </div>
    </div>

    {{-- Rezervacija termina --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white">
            <h2 class="h5 mb-0">Rezerviši termin</h2>
        </div>
        <div class="card-body">
            @if(session('booking_success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('booking_success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Zatvori"></button>
                </div>
            @endif

            @guest
                <div class="mb-3">
                    <a href="{{ route('login') }}" class="btn btn-primary">Uloguj se da rezervišeš termin</a>
                </div>
            @endguest

            @auth
                <form action="{{ route('booking.insert') }}" method="POST" class="row g-3">
                    @csrf
                    <input type="hidden" name="service_id" value="{{ $service->id }}">

                    <div class="col-md-6">
                        <label for="service_offering_id" class="form-label">Usluga</label>
                        <select name="service_offering_id" id="service_offering_id" class="form-select" required>
                            @foreach($service->offers as $offer)
                                <option value="{{ $offer->id }}">{{ $offer->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="start_at" class="form-label">Početak</label>
                        <input type="time" name="start_at" id="start_at" class="form-control" required>
                    </div>

                    <div class="col-md-3">
                        <label for="end_at" class="form-label">Kraj</label>
                        <input type="time" name="end_at" id="end_at" class="form-control" required>
                    </div>

                    <div class="col-12">
                        <button class="btn btn-primary">Rezerviši</button>
                    </div>
                </form>
            @endauth
        </div>
    </div>

    @auth
        @can('view', $service)
            <div class="d-flex justify-content-end mb-4">
                <a href="{{ route('booking.show', $service->id) }}" class="btn btn-outline-secondary">Pogledaj rezervacije</a>
            </div>
        @endcan
    @endauth

@endsection
