<h1>Azuriraj status narudzbe za: {{$booking->serviceOffering->name}}</h1>

<form action="{{route('booking.update', $booking->id)}}" method="POST">
    @csrf
    <select name="status">
        @foreach($statuses as $status)
            <option value="{{$status}}">{{$status}}</option>
        @endforeach
    </select>
    <button>Azuriraj status</button>
</form>
