@extends('adminlte::page')

@section('title', 'Cadastro Usuário')

@section('content_header')
    <h1>Cadastro Usuário <a class="btn btn-dark" href="{{route('users.index')}}"><i class="fa fa-arrow-left"></i> Voltar</a> </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Cadastro Usuário
        </div>
        <div class=" card-body">
            <form class="form" action="{{route('users.store')}}" method="POST">
                @csrf
                @include('admin.pages.users._partials.form')
            </form>
        </div>
    </div>
@stop
