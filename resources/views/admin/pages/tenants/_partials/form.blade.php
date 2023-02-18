@include('admin.includes.alerts')

<div class="form-group">
    <label for="name">Nome</label>
    <input type="text" name="name" class="form-control" placeholder="Nome" value="{{$tenant->name ?? old('name')}}">
</div>
<div class="form-group">
    <label for="email">Email</label>
    <input type="text" name="email" class="form-control" placeholder="Email" value="{{$tenant->email ?? old('email')}}">
</div>
<div class="form-group">
    <label for="cnpj">CNPJ</label>
    <input type="text" name="cnpj" class="form-control" placeholder="CNPJ" value="{{$tenant->cnpj ?? old('cnpj')}}">
</div>
<div class="form-group">
    <label for="active">Ativo</label>
    <select name="active" class="form-control" value="{{$tenant->active ?? old('active')}}"">
        <option value="Y" {{$tenant->active == 'Y' ? 'selected' : ''}}>SIM</option>
        <option value="N" {{$tenant->active == 'N' ? 'selected' : ''}}>NÃO</option>
    </select>
</div>
<div class="form-group">
    <label for="flag">Logo</label>
    <input type="file" name="logo" class="form-control">
</div>

<hr>

<h3>Assinatura</h3>
<div class="form-group">
    <label for="subscription">Data Assinatura (início)</label>
    <input type="date" name="subscription" class="form-control" placeholder="subscription" value="{{$tenant->subscription ?? old('subscription')}}">
</div>
<div class="form-group">
    <label for="expires_at">Data Expiração</label>
    <input type="date" name="expires_at" class="form-control" placeholder="expires_at" value="{{$tenant->expires_at ?? old('expires_at')}}">
</div>
<div class="form-group">
    <label for="subscription_id">Identificador</label>
    <input type="text" name="subscription_id" class="form-control" placeholder="Identificador" value="{{$tenant->subscription_id ?? old('subscription_id')}}">
</div>
<div class="form-group">
    <label for="subscription_active">Assinatura Ativa</label>
    <select name="subscription_active" class="form-control" value="{{$tenant->subscription_active ?? old('subscription_active')}}"">
        <option value="1" {{$tenant->subscription_active ? 'selected' : ''}}>SIM</option>
        <option value="0" {{!$tenant->subscription_active ? 'selected' : ''}}>NÃO</option>
    </select>
</div>
<div class="form-group">
    <label for="subscription_suspended">Assinatura Cancelada</label>
    <select name="subscription_suspended" class="form-control" value="{{$tenant->subscription_suspended ?? old('subscription_suspended')}}"">
        <option value="1" {{$tenant->subscription_suspended ? 'selected' : ''}}>SIM</option>
        <option value="0" {{!$tenant->subscription_suspended ? 'selected' : ''}}>NÃO</option>
    </select>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-dark"><i class="far fa-save"></i> Enviar</button>
</div>
