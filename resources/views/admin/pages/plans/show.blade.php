@extends('adminlte::page')

@section('title', 'Detalhes do Plano')

@section('content_header')
    <h1>Detalhes do Plano <a class="btn btn-dark" href="{{route('plans.index')}}"><i class="fas fa-arrow-left"></i> Voltar</a> </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Detalhes do Plano <b>{{$plan->name}}</b>
        </div>
        <div class=" card-body">
            <ul>
                <li>
                    <strong> Nome: </strong>{{$plan->name}}
                </li>
                <li>
                    <strong> Descrição: </strong>{{$plan->description}}
                </li>
                <li>
                    <strong> Url: </strong>{{$plan->url}}
                </li>
                <li>
                    <strong> Preço: </strong>R$ {{ number_format( $plan->price, 2, ',', '.' )}}
                </li>
            </ul>
            @include('admin.includes.alerts')
        </div>
        <div class="card-footer">
            <form action="{{route('plans.destroy', $plan->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Deletar {{$plan->name}} </button>
            </form>
        </div>
    </div>
@stop
