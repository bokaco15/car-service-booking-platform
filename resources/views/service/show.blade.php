<h1>{{ucfirst($service->name)}}, {{ucfirst($service->city)}}</h1>
<p>{{$service->description}}</p>
<p>
    Usluge:
    @foreach($service->offers as $offer)
        {{$offer->name}}{{$loop->last ? '.':','}}
    @endforeach
</p>

@if(session('success'))
    <p>{{session('success')}}</p>
@endif

{{--Ako je Auth::user()->role('admin' / 'owner')--}}
<a href="{{route('serviceOffering.add', $service->id)}}">Dodaj usluge</a> <br>


<table border="1" cellpadding="8" cellspacing="0">
    <thead>
    <tr>
        <th>Naziv usluge</th>
        <th>Trajanje (min)</th>
        <th>Cena</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($service->offers as $offer)
        <tr>
            <td>{{ $offer->name }}</td>
            <td>{{ $offer->duration_minutes }}</td>
            <td>{{ $offer->price }} KM</td>
            <td>
                <a href="{{route('serviceOffering.edit', $offer->id)}}">Edit</a>
                <a href="{{route('serviceOffering.delete', $offer->id)}}">Delete</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{--@dd($service)--}}

@if(count($service->working_hours) == 7)
    @foreach($service->working_hours as $wh)
        @if($wh->opens_at == null)
            {{$wh->id}} {{$wh->day_of_week}}: ne radimo <br>
        @else
            {{$wh->id}} {{$wh->day_of_week}}: {{$wh->opens_at}}h - {{$wh->closes_at}}h <br>
        @endif
    @endforeach
    <a href="{{route('workingHours.edit', $service->id)}}">Izmeni termine</a>
@else
    <a href="{{route('workingHours.add', $service->id)}}">Dodaj termine radnog vremena</a>
@endif

<hr>

{{--Do ovde sam stao!!!--}}


{{--bilo ko moze rezervisat--}}
<h3>Rezervisi termin!</h3>
<form action="{{route('booking.insert')}}" method="POST">
    @csrf
    <input type="hidden" name="service_id" value="{{$service->id}}">
    <select name="service_offering_id">
        @foreach($service->offers as $offer)
            <option value="{{$offer->id}}">{{$offer->name}}</option>
        @endforeach
    </select>
    <label for="start_at">Start at:</label>
    <input type="time" name="start_at" id="">
    <label for="start_at">End at:</label>
    <input type="time" name="end_at" id="">
    <button>Rezervisi</button>
</form>

@if(session('booking_success'))
    <p>{{session('booking_success')}}</p>
@endif


{{--Prikaz rezervacija admin i owner mogu vidjeti--}}

<hr>

<a href="{{route('booking.show', $service->id)}}">Pogledaj rezervacije</a>
