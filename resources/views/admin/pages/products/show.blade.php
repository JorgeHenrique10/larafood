@extends('adminlte::page')

@section('title', 'Detalhes Produto')

@section('content_header')
    <h1>Detalhes Produto <a class="btn btn-dark" href="{{route('products.index')}}"><i class="fas fa-arrow-left"></i> Voltar</a> </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Detalhes Produto <b>{{$product->name}}</b>
        </div>
        <div class=" card-body">
            <ul>
                <li style="list-style-type: none;">
                    <img src="{{ asset("storage/$product->image")   }}" alt="imagem" style="max-width:90px;">
                </li>
                <li>
                    <strong> Titulo: </strong>{{$product->title}}
                </li>
                <li>
                    <strong> Descrição: </strong>{{$product->description}}
                </li>
                <li>
                    <strong> Preço: </strong>{{ number_format($product->price, '2', ',', '.')}}
                </li>
            </ul>
            @include('admin.includes.alerts')
        </div>
        <div class="card-footer">
            <form action="{{route('products.destroy', $product->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Deletar {{$product->name}} </button>
            </form>
        </div>
    </div>
@stop
