@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="form-group">
    <label for="name">Name</label>
    <input class="form-control" type="text" name="name" value="{{$detail->name ?? old('name')}}">
</div>
<div class="form-group">
    <button class="btn btn-dark" type="submit">Enviar</button>
</div>

