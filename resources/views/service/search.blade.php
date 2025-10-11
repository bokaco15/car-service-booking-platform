Ovo je testna stilizacija

<form action="{{route('service.search')}}" method="POST">
    @csrf
    <input type="text" name="city" id="" placeholder="city">
    <input type="text" name="service_type" id="" placeholder="service type">
    <button>Pretrazi</button>
</form>

@if(session('error'))
    <h3>{{session('error')}}</h3>
@endif
