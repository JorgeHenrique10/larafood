@extends('adminlte::page')

@section('title', 'Cadastro Plano')

@section('content_header')
<div class="breadcrumb mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{route('admin.index')}}">Dasboard</a></li>
        <li class="breadcrumb-item"> <a href="{{route('plans.index')}}">Planos</a></li>
        <li class="breadcrumb-item"> <a href="{{route('plans.show', $plan->id)}}">{{$plan->name}}</a></li>
        <li class="breadcrumb-item active"> <a href="{{route('detail.plans.index', $plan->id)}}">Detalhes do Plano</a></li>
    </ol>
</div>
    <h1>Cadastro Detalhes do Plano - <b>{{$plan->name}}</b> <a class="btn btn-dark" href="{{route('detail.plans.create', $plan->id)}}"><i class="fa fa-arrow-left"></i> Voltar</a> </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Cadastro Detalhes do Plano - <b>{{$plan->name}}</b>
        </div>
        <div class=" card-body">
            <form class="form" action="{{route('detail.plans.store', $plan->id)}}" method="POST">
                @csrf
                @include('admin.pages.plans.details._partials.form')
            </form>
        </div>
    </div>
@stop
