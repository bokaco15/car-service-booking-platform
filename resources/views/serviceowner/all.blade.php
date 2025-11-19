@php use App\Enums\ServiceStatus; @endphp
@extends('layouts.app')
@section('content')

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0">Svi servisi</h1>
        <a href="{{ route('service.add') }}" class="btn btn-primary">+ Novi servis</a>
    </div>

    @forelse ($servicesOfOwner as $service)
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <div class="d-flex flex-column flex-md-row gap-2 justify-content-between align-items-start">
                    <div>
                        <h5 class="card-title mb-1">{{ $service->name }}</h5>
                        <p class="text-muted mb-2">{{ $service->city }}</p>
                        <span class="badge {{ $service->status === ServiceStatus::PENDING ? 'text-bg-warning' : 'text-bg-success' }}">
                            {{ $service->status }}
                        </span>
                        <p class="card-text mb-0">
                            {{ Str::limit($service->description, 160) }}
                        </p>
                    </div>
                    @if($service->status == ServiceStatus::APPROVED)
                        <div class="d-flex gap-2">
                            <a href="{{ route('service.show', $service->id) }}" class="btn btn-outline-secondary btn-sm">
                                Prikaži
                            </a>
                            <a href="{{ route('service.edit', ['service' => $service->id]) }}" class="btn btn-warning btn-sm">
                                Ažuriraj
                            </a>
                            <a href="{{ route('service.delete', ['service' => $service->id]) }}"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Da li sigurno želiš da obrišeš ovaj servis?')">
                                Obriši
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info">Nema servisa za prikaz.</div>
    @endforelse

    <div class="mt-4">
        {{$servicesOfOwner->links()}}
    </div>

@endsection
