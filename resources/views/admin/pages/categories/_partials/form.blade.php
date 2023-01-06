@include('admin.includes.alerts')

<div class="form-group">
    <label for="name">Nome</label>
    <input type="text" name="name" class="form-control" placeholder="Nome" value="{{$user->name ?? old('name')}}">
</div>
<div class="form-group">
    <label for="description">Descrição</label>
    <textarea type="text" cols="30" rows="5" name="description" class="form-control" placeholder="Descrição" value="{{$user->description ?? old('description')}}"></textarea></div>
<div class="form-group">
    <button type="submit" class="btn btn-dark"><i class="far fa-save"></i> Enviar</button>
</div>
