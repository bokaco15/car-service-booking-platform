@extends('layouts.app')

@section('content')
    <div class="container py-4">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex align-items-center justify-content-between mb-3">
            <h1 class="h3 mb-0">Svi servisi</h1>
            {{-- mesto za filter ili dugme “Dodaj servis” po želji --}}
            {{-- <a href="{{ route('service.create') }}" class="btn btn-primary">+ Novi servis</a> --}}
        </div>

        @forelse ($services as $service)
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <div class="d-flex flex-column flex-md-row gap-2 justify-content-between align-items-start">
                        <div>
                            <h5 class="card-title mb-1">{{ $service->name }}</h5>
                            <p class="text-muted mb-2">{{ $service->city }}</p>
                            @auth
                                @if(auth()->user()->hasRole('admin'))
                                    <span class="badge {{ $service->status === 'pending' ? 'text-bg-warning' : 'text-bg-success' }}">
                                        {{ ucfirst($service->status) }}
                                    </span>

                                @endif
                            @endauth
                            <p class="card-text mb-0">
                                {{ Str::limit($service->description, 160) }}
                            </p>
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('service.show', $service->id) }}" class="btn btn-outline-secondary btn-sm">
                                Prikaži
                            </a>
                            @auth
                            @if($service->ownerAndAdminCanView(auth()->user()->id))
                            <a href="{{ route('service.edit', ['service' => $service->id]) }}" class="btn btn-warning btn-sm">
                                Ažuriraj
                            </a>
                            <a href="{{ route('service.delete', ['service' => $service->id]) }}"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Da li sigurno želiš da obrišeš ovaj servis?')">
                                Obriši
                            </a>
                            @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-info">Nema servisa za prikaz.</div>
        @endforelse

        {{-- Paginacija --}}
        <div class="mt-4">
            {!! $services->onEachSide(1)->links('pagination::bootstrap-5') !!}
        </div>
    </div>
@endsection
