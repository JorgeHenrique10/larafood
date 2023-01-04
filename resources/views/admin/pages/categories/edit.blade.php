@extends('adminlte::page')

@section('title', 'Cadastro Usuário')

@section('content_header')
<h1>Editar Usuário <a class="btn btn-dark" href="{{route('users.index')}}"><i class="fa fa-arrow-left"></i> Voltar</a> </h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        Editar Usuário
    </div>
    <div class=" card-body">
        <form class="form" action="{{route('users.update', $user->id)}}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.pages.users._partials.form')
        </form>
    </div>
</div>
@stop
