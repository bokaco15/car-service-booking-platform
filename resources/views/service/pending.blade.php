@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h3 class="h3 mb-4 fw-bold">Servisi na čekanju</h3>
        <p class="mb-2">Ukupan broj servisa na čekanju: {{ $pendingServicesCount }}</p>

        @if($pendingServices->isEmpty())
            <div class="alert alert-info">Trenutno nema servisa na čekanju za odobrenje.</div>
        @else
            <div class="row g-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <b>{{ session('success') }}</b>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @foreach($pendingServices as $pendingService)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm border-0 rounded-3">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title mb-2 fw-bold">{{ $pendingService->name }}</h5>
                                <h6 class="text-muted mb-2">{{ $pendingService->city }}</h6>
                                <p class="card-text mb-3">{{ Str::limit($pendingService->description, 80, '...') }}</p>

                                <span class="badge
                                    {{ $pendingService->status === 'pending' ? 'text-bg-warning' : 'text-bg-success' }}">
                                    {{ ucfirst($pendingService->status) }}
                                </span>

                                <div class="mt-auto pt-3 d-flex justify-content-between gap-2">
                                    <a href="{{ route('service.show', $pendingService->id) }}"
                                       class="btn btn-outline-primary btn-sm flex-fill">
                                        Prikaži
                                    </a>

                                    <form action="/admin/service/status/update/{{ $pendingService->id }}"
                                          method="POST"
                                          onsubmit="return confirm('Da li želite da potvrdite status?')"
                                          class="flex-fill">
                                        @csrf
                                        <input type="hidden" name="status" value="approved">
                                        <button type="submit" class="btn btn-success btn-sm w-100">
                                            Odobri
                                        </button>
                                    </form>

                                    <form method="get" action="{{ route('service.delete', $pendingService->id) }}"
                                          onsubmit="return confirm('Da li želite da obrišete ovaj servis?')"
                                          class="flex-fill">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm w-100">
                                            Obriši
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Paginacija --}}
            <div class="mt-4 d-flex justify-content-center">
                {{ $pendingServices->links() }}
            </div>
        @endif
    </div>
@endsection
