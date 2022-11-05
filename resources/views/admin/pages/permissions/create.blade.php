@extends('adminlte::page')

@section('title', 'Cadastro Permissão')

@section('content_header')
    <h1>Cadastro Permissão <a class="btn btn-dark" href="{{route('permissions.index')}}"> <i class="fa fa-arrow-left"></i> Voltar</a></h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            Cadastrar Permissão
        </div>
        <div class="card-body">
            <form action="{{route('permissions.store')}}" method="POST">
                @csrf
                @include('admin.pages.permissions._partials.form')
            </form>
        </div>
    </div>
@endsection
