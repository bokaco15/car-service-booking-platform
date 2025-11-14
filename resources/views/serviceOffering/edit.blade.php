@extends('layouts.app')
@section('content')
    <h3 class="h5 mb-4">
        Uredi ponudu: <strong>{{ $offer->name }}</strong>
        <span class="text-muted">– {{ $offer->service->name }}</span>
    </h3>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Zatvori"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $errors->first() }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Zatvori"></button>
        </div>
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('serviceOffering.update', $offer->id) }}" method="POST" class="row g-3">
                @csrf
                <input type="hidden" name="service_id" value="{{ $offer->service->id }}">

                <div class="col-md-4">
                    <label for="name" class="form-label">Naziv ponude</label>
                    <input type="text"
                           id="name"
                           name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           placeholder="Naziv ponude"
                           value="{{ old('name', $offer->name) }}">
                </div>

                <div class="col-md-4">
                    <label for="duration_minutes" class="form-label">Trajanje (min)</label>
                    <input type="number"
                           id="duration_minutes"
                           name="duration_minutes"
                           class="form-control @error('duration_minutes') is-invalid @enderror"
                           placeholder="npr. 60"
                           value="{{ old('duration_minutes', $offer->duration_minutes) }}">
                </div>

                <div class="col-md-3">
                    <label for="price" class="form-label">Cijena (KM)</label>
                    <input type="number"
                           id="price"
                           name="price"
                           step="0.01"
                           class="form-control @error('price') is-invalid @enderror"
                           placeholder="npr. 50.00"
                           value="{{ old('price', $offer->price) }}">
                </div>

                <div class="col-md-1 d-flex align-items-end">
                    <button type="submit" class="btn btn-warning w-100">💾</button>
                </div>
            </form>
        </div>
    </div>

@endsection
