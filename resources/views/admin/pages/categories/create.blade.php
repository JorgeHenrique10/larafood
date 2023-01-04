@extends('adminlte::page')

@section('title', 'Cadastro Categoria')

@section('content_header')
    <h1>Cadastro Categoria <a class="btn btn-dark" href="{{route('categories.index')}}"><i class="fa fa-arrow-left"></i> Voltar</a> </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Cadastro Categoria
        </div>
        <div class=" card-body">
            <form class="form" action="{{route('categories.store')}}" method="POST">
                @csrf
                @include('admin.pages.categories._partials.form')
            </form>
        </div>
    </div>
@stop
