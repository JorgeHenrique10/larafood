@include('admin.includes.alerts')

<div class="form-group">
    <label for="identity">Identificador</label>
    <input type="text" name="identity" class="form-control" placeholder="Identificador" value="{{$table->identity ?? old('identity')}}">
</div>
<div class="form-group">
    <label for="description">Descrição</label>
    <textarea type="text" cols="30" rows="5" name="description" class="form-control" placeholder="Descrição" value="{{$table->description ?? old('description')}}">{{$table->description ?? old('description')}}</textarea>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-dark"><i class="far fa-save"></i> Enviar</button>
</div>
