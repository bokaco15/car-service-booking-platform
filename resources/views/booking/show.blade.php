{{--@dd($bookings)--}}
<h1>Rezervacije za {{$service_name}}</h1>


@foreach($bookings as $booking)
    {{$counter+=1}}: <br>
    {{$booking->serviceOffering->name}} <br>
    {{$booking->start_at}} <br>
    {{$booking->end_at}} <br>
    {{$booking->status}}  <br>
    <a href="{{route('booking.edit', $booking->id)}}">Azuriraj status</a>
    <a href="{{route('booking.delete', $booking->id)}}">Obrisi poruzdbinu</a>
    <hr>
@endforeach

@if(session('update-success'))
    <p>{{session('update-success')}}</p>
@endif
@if(session('delete-success'))
    <p>{{session('delete-success')}}</p>
@endif
