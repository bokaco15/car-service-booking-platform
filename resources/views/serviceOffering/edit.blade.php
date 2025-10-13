<h3>Edit offer: {{$offer->name}} - {{$offer->service->name}}</h3>

{{--@dd($offer->service->id);--}}

<form action="{{route('serviceOffering.update', $offer->id)}}" method="post">
    @csrf
    <input type="hidden" name="service_id" value="{{$offer->service->id}}">
    <input type="text" name="name" placeholder="Name:" value="{{$offer->name}}">
    <input type="number" name="duration_minutes" placeholder="Duration minutes" value="{{$offer->duration_minutes}}">
    <input type="number" name="price" placeholder="Price" value="{{$offer->price}}">
    <button>Edit offer for {{$offer->name}}</button>
</form>

@if(session('success'))
    <p>{{session('success')}}</p>
@endif
