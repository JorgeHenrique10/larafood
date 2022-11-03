@extends('adminlte::page')

@section('title', 'Cadastro Plano')

@section('content_header')
    <h1>Cadastro Plano <a class="btn btn-dark" href="{{route('plans.index')}}"><i class="fa fa-arrow-left"></i> Voltar</a> </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Cadastro Plano
        </div>
        <div class=" card-body">
            <form class="form" action="{{route('plans.store')}}" method="POST">
                @csrf
                @include('admin.pages.plans._partials.form')
            </form>
        </div>
    </div>
@stop
