<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<h1>Svi servisi: </h1> <br> <hr>
@foreach($services as $service)
    <p>{{$service->name}}</p>
    <p>{{$service->description}}</p>
    <p>{{$service->city}}</p>
    <a href="{{route('service.update', ['service'=>$service->id])}}">Azuriraj</a>
    <a href="{{route('service.delete', ['service'=>$service->id])}}">Obrisi</a>
    <a href="{{route('service.show', $service->id)}}">Prikazi servis</a>
    <hr>
@endforeach
{{$services->links()}}
@if(session('success'))
    <p>{{session('success')}}</p>
@endif
