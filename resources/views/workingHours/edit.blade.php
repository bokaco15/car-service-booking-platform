<h1>Working edit time for {{$service->name}}</h1>

<form action="{{route('workingHours.update', $service->id)}}" method="POST">
    @csrf
    @foreach($days as $day)
        <input type="hidden" name="working_hours[{{$day}}][service_id]" value="{{$service->id}}">
        <input name="working_hours[{{$day}}][day_of_week]" type="text"  value="{{$day}}" placeholder="{{$day}}"> <br>
        <input type="number" name="working_hours[{{$day}}][opens_at]" placeholder="opens_at"> <br>
        <input type="number" name="working_hours[{{$day}}][closes_at]" placeholder="closes_at"> <br>
        <hr>
    @endforeach
    <button>Klik</button>
</form>
