@extends('adminlte::page')

@section('title', 'Cadastro Cargo')

@section('content_header')
    <h1>Cadastro Cargo <a class="btn btn-dark" href="{{route('roles.index')}}"> <i class="fa fa-arrow-left"></i> Voltar</a></h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            Cadastrar Cargo
        </div>
        <div class="card-body">
            <form action="{{route('roles.store')}}" method="POST">
                @csrf
                @include('admin.pages.roles._partials.form')
            </form>
        </div>
    </div>
@endsection
