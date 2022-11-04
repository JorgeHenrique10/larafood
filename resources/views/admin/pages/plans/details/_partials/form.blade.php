@include('admin.includes.alerts')

<div class="form-group">
    <label for="name">Name</label>
    <input class="form-control" type="text" name="name" value="{{$detail->name ?? old('name')}}">
</div>
<div class="form-group">
    <button class="btn btn-dark" type="submit">Enviar</button>
</div>

