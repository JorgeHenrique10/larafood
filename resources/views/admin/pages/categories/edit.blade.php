@extends('adminlte::page')

@section('title', 'Cadastro Categoria')

@section('content_header')
<h1>Editar Categoria <a class="btn btn-dark" href="{{route('categories.index')}}"><i class="fa fa-arrow-left"></i> Voltar</a> </h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        Editar Categoria
    </div>
    <div class=" card-body">
        <form class="form" action="{{route('categories.update', $category->id)}}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.pages.categories._partials.form')
        </form>
    </div>
</div>
@stop
