@extends('adminlte::page')

@section('title', 'Cadastro Mesa')

@section('content_header')
    <h1>Cadastro Mesa <a class="btn btn-dark" href="{{route('tables.index')}}"><i class="fa fa-arrow-left"></i> Voltar</a> </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Cadastro Mesa
        </div>
        <div class=" card-body">
            <form class="form" action="{{route('tables.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('admin.pages.tables._partials.form')
            </form>
        </div>
    </div>
@stop
