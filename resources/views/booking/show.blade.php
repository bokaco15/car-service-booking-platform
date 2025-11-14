@php use App\Enums\BookingStatus; @endphp
@extends('layouts.app')

@section('content')
    <h1 class="h4 mb-4">Rezervacije za {{ $service_name }}</h1>

    @if(session('update-success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('update-success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Zatvori"></button>
        </div>
    @endif
    @if(session('delete-success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('delete-success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Zatvori"></button>
        </div>
    @endif
{{--@dd($bookings)--}}
    @if($bookings->isEmpty())
        <div class="alert alert-info">Nema rezervacija za prikaz.</div>
    @else
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Klijent</th>
                    <th>Usluga</th>
                    <th>Početak</th>
                    <th>Kraj</th>
                    <th>Status</th>
                    <th class="text-end">Akcije</th>
                </tr>
                </thead>
                <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>({{$booking->client->id}}) - {{$booking->client->name}}</td>
                        <td>{{ $booking->serviceOffering->name }}</td>
                        <td>{{ $booking->start_at }}</td>
                        <td>{{ $booking->end_at }}</td>
                        <td>
                            <span class="badge
                                {{ $booking->status === BookingStatus::PENDING ? ' text-bg-warning' : '' }}
                                {{ $booking->status === BookingStatus::DONE ? ' text-bg-success' : '' }}
                                {{ in_array($booking->status, [BookingStatus::CANCELLED, BookingStatus::REJECTED]) ? ' text-bg-danger' : '' }}
                            ">
                                {{$booking->status}}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('booking.edit', $booking->id) }}" class="btn btn-outline-secondary btn-sm">
                                Ažuriraj status
                            </a>
                            <a href="{{ route('booking.delete', $booking->id) }}"
                               class="btn btn-outline-danger btn-sm"
                               onclick="return confirm('Obrisati ovu rezervaciju?')">
                                Obriši porudžbinu
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        {{-- Ako je $bookings paginator --}}
        @if(method_exists($bookings, 'links'))
            <div class="mt-3 d-flex justify-content-center">
                {!! $bookings->onEachSide(1)->links('pagination::bootstrap-5') !!}
            </div>
        @endif
    @endif
@endsection
