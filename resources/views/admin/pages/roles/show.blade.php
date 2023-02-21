@extends('adminlte::page')

@section('title', 'Detalhes do Cargo')

@section('content_header')
    <h1>Detalhes do Cargo <a class="btn btn-dark" href="{{route('roles.index')}}"><i class="fas fa-arrow-left"></i> Voltar</a> </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Detalhes do Cargo <b>{{$role->name}}</b>
        </div>
        <div class=" card-body">
            <ul>
                <li>
                    <strong> Nome: </strong>{{$role->name}}
                </li>
                <li>
                    <strong> Descrição: </strong>{{$role->description}}
                </li>
            </ul>
            @include('admin.includes.alerts')
        </div>
        <div class="card-footer">
            <form action="{{route('roles.destroy', $role->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Deletar {{$role->name}} </button>
            </form>
        </div>
    </div>
@stop
