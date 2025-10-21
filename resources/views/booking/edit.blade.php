@extends('layouts.app')

@section('content')
    @dd($booking->service)
    <div class="card p-4 shadow-sm">
        <h1 class="h4 mb-4">Ažuriraj status narudžbe za: <strong>{{ $booking->serviceOffering->name }}</strong></h1>

        @if(session('update-success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('update-success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Zatvori"></button>
            </div>
        @endif

        <form action="{{ route('booking.update', $booking->id) }}" method="POST" class="row g-3">
            @csrf
            <div class="col-12">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select">
                    @foreach($statuses as $status)
                        <option value="{{ $status }}" {{ $booking->status === $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-12">
                <button class="btn btn-primary w-100">Ažuriraj status</button>
            </div>
        </form>
    </div>
@endsection
