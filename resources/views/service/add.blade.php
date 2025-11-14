@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $errors->first() }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title h4 mb-4 text-center">Dodaj novi servis</h2>

                        <form action="{{ route('service.add') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Naziv servisa</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="name" name="name" placeholder="Unesi naziv servisa"
                                       value="{{ old('name') }}">
                            </div>

                            <div class="mb-3">
                                <label for="city" class="form-label">Grad</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror"
                                       id="city" name="city" placeholder="Unesi grad"
                                       value="{{ old('city') }}">
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Opis servisa</label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                          id="description" name="description" rows="5"
                                          placeholder="Unesi opis servisa">{{ old('description') }}</textarea>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">Dodaj servis</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
