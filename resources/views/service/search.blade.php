@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-6">

            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="h4 mb-4 text-center">Pretraga servisa</h2>

                    <form action="{{ route('service.search') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="city" class="form-label">Grad</label>
                            <input type="text"
                                   name="city"
                                   id="city"
                                   class="form-control"
                                   placeholder="Unesite grad">
                        </div>

                        <div class="mb-3">
                            <label for="service_type" class="form-label">Tip usluge</label>
                            <input type="text"
                                   name="service_type"
                                   id="service_type"
                                   class="form-control"
                                   placeholder="Npr. zamjena ulja">
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Pretraži</button>
                        </div>
                    </form>

                    @if(session('error'))
                        <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection
