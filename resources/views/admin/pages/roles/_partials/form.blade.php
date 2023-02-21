@include('admin.includes.alerts')
<div class="form-group">
    <label for="name">Nome</label>
    <input class="form-control" type="text" name='name' id='name' value="{{$role->name ?? old('name')}}">
</div>
<div class="form-group">
    <label for="name">Descrição</label>
    <input class="form-control" type="text" name='description' id='description' value="{{$role->description ?? old('description')}}">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-dark">Enviar</button>
</div>

