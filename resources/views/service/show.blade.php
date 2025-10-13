<h1>{{ucfirst($service->name)}}, {{ucfirst($service->city)}}</h1>
<p>{{$service->description}}</p>
<p>
    Usluge:
    @foreach($service->offers as $offer)
        {{$offer->name}}{{$loop->last ? '.':','}}
    @endforeach
</p>

