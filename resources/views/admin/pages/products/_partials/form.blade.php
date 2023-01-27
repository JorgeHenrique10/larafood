@include('admin.includes.alerts')

<div class="form-group">
    <label for="title">Título</label>
    <input type="text" name="title" class="form-control" placeholder="Titulo" value="{{$product->title ?? old('title')}}">
</div>
<div class="form-group">
    <label for="description">Descrição</label>
    <textarea type="text" cols="30" rows="5" name="description" class="form-control" placeholder="Descrição" value="{{$product->description ?? old('description')}}">{{$product->description ?? old('description')}}</textarea>
</div>
<div class="form-group">
    <label for="price">Preço</label>
    <input type="text" name="price" class="form-control" placeholder="Preço" value="{{$product->price ?? old('price')}}">
</div>
<div class="form-group">
    <label for="flag">Imagem</label>
    <input type="file" name="image" class="form-control">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-dark"><i class="far fa-save"></i> Enviar</button>
</div>
