@extends('layouts.app')
@section('content')
    <div class="card-body">
        <h1 class="text-center mb-4">Working edit time for {{$service->name}}</h1>

        <form action="{{route('workingHours.update', $service->id)}}" method="POST">
            @csrf
            @foreach($days as $day)
                @php
                    $wh = $service->working_hours->firstWhere('day_of_week', $day);
                @endphp

                <div class="mb-4 border-bottom pb-3">
                    <input type="hidden" name="working_hours[{{$day}}][service_id]" value="{{$service->id}}">

                    <div class="mb-3">
                        <label class="form-label">Day of week</label>
                        <input readonly name="working_hours[{{$day}}][day_of_week]" type="text" class="form-control" value="{{$day}}" placeholder="{{$day}}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Opens at</label>
                        <input type="number" name="working_hours[{{$day}}][opens_at]" class="form-control" placeholder="opens_at" value="{{$wh->opens_at}}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Closes at</label>
                        <input type="number" name="working_hours[{{$day}}][closes_at]" class="form-control" placeholder="closes_at" value="{{$wh->closes_at}}">
                    </div>
                </div>
            @endforeach

            <button class="btn btn-primary w-100">Klik</button>
        </form>
    </div>
@endsection
