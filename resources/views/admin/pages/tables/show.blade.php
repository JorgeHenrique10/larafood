@extends('adminlte::page')

@section('title', 'Detalhes Mesa')

@section('content_header')
    <h1>Detalhes Mesa <a class="btn btn-dark" href="{{route('tables.index')}}"><i class="fas fa-arrow-left"></i> Voltar</a> </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Detalhes Mesa <b>{{$table->identity}}</b>
        </div>
        <div class=" card-body">
            <ul>
                <li>
                    <strong> Identificador: </strong>{{$table->identity }}
                </li>
                <li>
                    <strong> Descrição: </strong>{{$table->description}}
                </li>
            </ul>
            @include('admin.includes.alerts')
        </div>
        <div class="card-footer">
            <form action="{{route('tables.destroy', $table->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Deletar {{$table->identity}} </button>
            </form>
        </div>
    </div>
@stop
