@extends('adminlte::page')

@section('title', 'Cadastro Perfil')

@section('content_header')
    <h1>Cadastro Perfil <a class="btn btn-dark" href="{{route('profiles.index')}}"> <i class="fa fa-arrow-left"></i> Voltar</a></h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            Cadastrar Perfil
        </div>
        <div class="card-body">
            <form action="{{route('profiles.store')}}" method="POST">
                @csrf
                @include('admin.pages.profiles._partials.form')
            </form>
        </div>
    </div>
@endsection
