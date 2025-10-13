<h1>Update Service {{$service->name}}</h1> <hr> <br>

<form action="{{route('service.update', $service->id)}}" method="POST">
    @csrf
    <input type="text" name="name" value="{{$service->name}}"> <br><br>
    <input type="text" name="city" value="{{$service->city}}"> <br><br>
    <textarea name="description" cols="30" rows="10">{{$service->description}}</textarea> <br><br>
    <button>Add Service</button>
</form>

@if($errors->any())
    <p>{{$errors->first()}}</p>
@endif

@if(session('success'))
    <p>{{session('success')}}</p>
@endif
