@extends('adminlte::page')

@section('title', 'Editar Perfil')

@section('content_header')
    <h1>Editar Perfil <a class="btn btn-dark" href="{{route('profiles.index')}}"> <i class="fa fa-arrow-left"></i> Voltar</a></h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            Editar Perfil
        </div>
        <div class="card-body">
            <form action="{{route('profiles.update', $profile->id)}}" method="POST">
                @csrf
                @method('PUT')
                @include('admin.pages.profiles._partials.form')
            </form>
        </div>
    </div>
@endsection
