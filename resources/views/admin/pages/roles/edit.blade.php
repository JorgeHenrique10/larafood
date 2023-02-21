@extends('adminlte::page')

@section('title', 'Editar Cargo')

@section('content_header')
    <h1>Editar Cargo <a class="btn btn-dark" href="{{route('roles.index')}}"> <i class="fa fa-arrow-left"></i> Voltar</a></h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            Editar Cargo
        </div>
        <div class="card-body">
            <form action="{{route('roles.update', $role->id)}}" method="POST">
                @csrf
                @method('PUT')
                @include('admin.pages.roles._partials.form')
            </form>
        </div>
    </div>
@endsection
