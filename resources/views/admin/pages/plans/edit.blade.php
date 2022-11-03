@extends('adminlte::page')

@section('title', 'Cadastro Plano')

@section('content_header')
<h1>Editar Plano <a class="btn btn-dark" href="{{route('plans.index')}}"><i class="fa fa-arrow-left"></i> Voltar</a> </h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        Editar Plano
    </div>
    <div class=" card-body">
        <form class="form" action="{{route('plans.update', $plan->id)}}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.pages.plans._partials.form')
        </form>
    </div>
</div>
@stop
