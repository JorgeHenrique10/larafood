@extends('adminlte::page')

@section('title', 'Cadastro Empresa')

@section('content_header')
<h1>Editar Empresa <a class="btn btn-dark" href="{{route('tenants.index')}}"><i class="fa fa-arrow-left"></i> Voltar</a> </h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        Editar Empresa
    </div>
    <div class=" card-body">
        <form class="form" action="{{route('tenants.update', $tenant->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.pages.tenants._partials.form')
        </form>
    </div>
</div>
@stop
