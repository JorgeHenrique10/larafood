@extends('adminlte::page')

@section('title', 'Detalhes Categoria')

@section('content_header')
    <h1>Detalhes Categoria <a class="btn btn-dark" href="{{route('categories.index')}}"><i class="fas fa-arrow-left"></i> Voltar</a> </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Detalhes Categoria <b>{{$category->name}}</b>
        </div>
        <div class=" card-body">
            <ul>
                <li>
                    <strong> Nome: </strong>{{$category->name}}
                </li>
                <li>
                    <strong> Descrição: </strong>{{$category->description}}
                </li>
            </ul>
            @include('admin.includes.alerts')
        </div>
        <div class="card-footer">
            <form action="{{route('categories.destroy', $category->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Deletar {{$category->name}} </button>
            </form>
        </div>
    </div>
@stop
