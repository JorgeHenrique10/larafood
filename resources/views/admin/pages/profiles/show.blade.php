@extends('adminlte::page')

@section('title', 'Detalhes do Perfil')

@section('content_header')
    <h1>Detalhes do Perfil <a class="btn btn-dark" href="{{route('profiles.index')}}"><i class="fas fa-arrow-left"></i> Voltar</a> </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Detalhes do Perfil <b>{{$profile->name}}</b>
        </div>
        <div class=" card-body">
            <ul>
                <li>
                    <strong> Nome: </strong>{{$profile->name}}
                </li>
                <li>
                    <strong> Descrição: </strong>{{$profile->description}}
                </li>
            </ul>
            @include('admin.includes.alerts')
        </div>
        <div class="card-footer">
            <form action="{{route('profiles.destroy', $profile->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Deletar {{$profile->name}} </button>
            </form>
        </div>
    </div>
@stop
