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
<a href="{{route('serviceOffering.add', $service->id)}}">Dodaj usluge</a>


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
