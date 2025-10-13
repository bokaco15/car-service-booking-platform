<h1>Add Service</h1> <hr> <br>

<form action="{{route('service.add')}}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Name:" value="{{old('name')}}"> <br><br>
    <input type="text" name="city" placeholder="City:" value="{{old('city')}}"> <br><br>
    <textarea name="description" placeholder="Description:" cols="30" rows="10">{{old('description')}}</textarea> <br><br>
    <button>Add Service</button>
</form>

@if($errors->any())
    <p>{{$errors->first()}}</p>
@endif

@if(session('success'))
    <p>{{session('success')}}</p>
@endif
