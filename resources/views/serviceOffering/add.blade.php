<h3>Adding offer for: {{$offer->name}}</h3>

<form action="{{route('serviceOffering.insert', $offer->id)}}" method="post">
    @csrf
    <input type="hidden" name="service_id" value="{{$offer->id}}">
    <input type="text" name="name" placeholder="Name:">
    <input type="number" name="duration_minutes" placeholder="Duration minutes">
    <input type="number" name="price" placeholder="Price">
    <button>Add offer for {{$offer->name}}</button>
</form>
