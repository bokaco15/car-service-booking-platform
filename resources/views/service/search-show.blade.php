@extends('layouts.app')

@section('content')
        <h1 class="mb-4 text-center">Svi servisi</h1>

        @forelse($services as $service)
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h4 class="card-title mb-2">{{ $service->name }}</h4>
                    <p class="card-text text-muted mb-2">{{ $service->city }}</p>
                    <p class="card-text mb-3">{{ $service->description }}</p>

                    <p class="mb-3">
                        <strong>Usluge:</strong>
                        @foreach($service->offers as $offer)
                            {{ $offer->name }}{{ $loop->last ? '.' : ', ' }}
                        @endforeach
                    </p>

                    <div class="d-flex gap-2">
                        <a href="{{ route('service.show', $service->id) }}" class="btn btn-primary btn-sm">
                            Prikaži servis
                        </a>
                        {{-- Ako želiš dodatne akcije, možeš ih dodati ovde --}}
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-info text-center">
                Trenutno nema dostupnih servisa.
            </div>
        @endforelse

        {{-- Ako imaš paginaciju --}}
        @if(method_exists($services, 'links'))
            <div class="mt-4 d-flex justify-content-center">
                {!! $services->onEachSide(1)->links('pagination::bootstrap-5') !!}
            </div>
        @endif
@endsection
