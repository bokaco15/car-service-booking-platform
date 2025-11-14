@extends('layouts.app')
@section('content')
    <h1 class="h3 mb-4">Ažuriraj servis: {{ $service->name }}</h1>

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
            <form action="{{ route('service.update', $service->id) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Naziv servisa</label>
                    <input type="text"
                           id="name"
                           name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ $service->name }}">
                </div>

                <div class="mb-3">
                    <label for="city" class="form-label">Grad</label>
                    <input type="text"
                           id="city"
                           name="city"
                           class="form-control @error('city') is-invalid @enderror"
                           value="{{ $service->city }}">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Opis servisa</label>
                    <textarea id="description"
                              name="description"
                              class="form-control @error('description') is-invalid @enderror"
                              rows="5">{{ $service->description }}</textarea>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Sačuvaj izmjene</button>
                </div>
            </form>
        </div>
    </div>

@endsection
