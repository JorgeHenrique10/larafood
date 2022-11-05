@extends('adminlte::page')

@section('title', 'Detalhes da Permissão')

@section('content_header')
    <h1>Detalhes da Permissão <a class="btn btn-dark" href="{{route('permissions.index')}}"><i class="fas fa-arrow-left"></i> Voltar</a> </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Detalhes da Permissão <b>{{$permission->name}}</b>
        </div>
        <div class=" card-body">
            <ul>
                <li>
                    <strong> Nome: </strong>{{$permission->name}}
                </li>
                <li>
                    <strong> Descrição: </strong>{{$permission->description}}
                </li>
            </ul>
            @include('admin.includes.alerts')
        </div>
        <div class="card-footer">
            <form action="{{route('permissions.destroy', $permission->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Deletar {{$permission->name}} </button>
            </form>
        </div>
    </div>
@stop
