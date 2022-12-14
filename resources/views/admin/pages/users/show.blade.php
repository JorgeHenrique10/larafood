@extends('adminlte::page')

@section('title', 'Detalhes do Usuário')

@section('content_header')
    <h1>Detalhes do Usuário <a class="btn btn-dark" href="{{route('users.index')}}"><i class="fas fa-arrow-left"></i> Voltar</a> </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Detalhes do Usuário <b>{{$user->name}}</b>
        </div>
        <div class=" card-body">
            <ul>
                <li>
                    <strong> Nome: </strong>{{$user->name}}
                </li>
                <li>
                    <strong> Email: </strong>{{$user->email}}
                </li>
                <li>
                    <strong> Empresa: </strong>{{$user->tenant->name}}
                </li>
            </ul>
            @include('admin.includes.alerts')
        </div>
        <div class="card-footer">
            <form action="{{route('users.destroy', $user->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Deletar {{$user->name}} </button>
            </form>
        </div>
    </div>
@stop
