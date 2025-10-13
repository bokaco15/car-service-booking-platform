pocetna stilizacija

@foreach($services as $service)
    <h3>{{$service['name']}}</h3>
    <p>{{$service['description']}}</p>
    <p>{{$service['city']}}</p>
    <p>
        Usluge:
        @foreach($service->offers as $offer)
            {{$offer->name}}{{$loop->last ? '.' : ', '}}
        @endforeach
    </p>
    <a href="{{route('service.show', $service->id)}}">Prikazi servis</a>
    <hr>

@endforeach
