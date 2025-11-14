@extends('layouts.app')
@section('content')
    <h1 class="h4 mb-4 text-center fw-bold text-primary">
        Working time for {{ $service->name }}
    </h1>

    <form action="{{ route('workingHours.insert') }}" method="POST" class="row g-4">
        @csrf
        <input name="service_id" type="hidden" value="{{$service->id}}">
        @foreach($days as $day)
            <div class="col-12 p-3 rounded shadow-sm border mb-3 bg-light">
                <input type="hidden" name="working_hours[{{ $day }}][service_id]" value="{{ $service->id }}">

                <div class="mb-3">
                    <input
                        name="working_hours[{{ $day }}][day_of_week]"
                        type="text"
                        value="{{ $day }}"
                        placeholder="{{ $day }}"
                        class="form-control text-center fw-semibold border-primary"
                        readonly
                    >
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <input
                            type="number"
                            name="working_hours[{{ $day }}][opens_at]"
                            placeholder="Opens at"
                            class="form-control border-success"
                        >
                    </div>
                    <div class="col-md-6">
                        <input
                            type="number"
                            name="working_hours[{{ $day }}][closes_at]"
                            placeholder="Closes at"
                            class="form-control border-danger"
                        >
                    </div>
                </div>
            </div>
        @endforeach

        <div class="col-12">
            <button class="btn btn-lg btn-primary w-100 shadow-sm">
                💾 Sačuvaj radno vrijeme
            </button>
        </div>
    </form>


@endsection
