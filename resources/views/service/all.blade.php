@foreach($services as $service)
    <p>{{$service->name}}</p>
    <p>{{$service->description}}</p>
    <p>{{$service->city}}</p>
    <a href="{{route('service.update', ['service'=>$service->id])}}">Azuriraj</a>
    <a href="{{route('service.delete', ['service'=>$service->id])}}">Obrisi</a>
    <hr>
@endforeach

@if(session('success'))
    <p>{{session('success')}}</p>
@endif
