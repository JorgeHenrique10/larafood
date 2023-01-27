@extends('adminlte::page')

@section('title', 'Cadastro Produto')

@section('content_header')
<h1>Editar Produto <a class="btn btn-dark" href="{{route('products.index')}}"><i class="fa fa-arrow-left"></i> Voltar</a> </h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        Editar Produto
    </div>
    <div class=" card-body">
        <form class="form" action="{{route('products.update', $product->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.pages.products._partials.form')
        </form>
    </div>
</div>
@stop
