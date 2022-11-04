@extends('adminlte::page')

@section('title', 'Detalhes do Plano')

@section('content_header')
    <h1>Detalhes do Plano <a class="btn btn-dark" href="{{route('detail.plans.index', [$plan->id, $detail->id])}}"><i class="fas fa-arrow-left"></i> Voltar</a> </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Detalhes do Plano <b>{{$plan->name}}</b>
        </div>
        <div class=" card-body">
            <ul>
                <li>
                    <strong> Nome: </strong>{{$detail->name}}
                </li>
            </ul>
        </div>
        <div class="card-footer">
            <form action="{{route('detail.plans.destroy', [$plan->id, $detail->id])}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Deletar </button>
            </form>
        </div>
    </div>
@stop
