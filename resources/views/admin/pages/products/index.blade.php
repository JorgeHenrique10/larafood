@extends('adminlte::page')

@section('title', 'Produtos')

@section('content_header')
    <div class="breadcrumb mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{route('admin.index')}}">Dasboard</a></li>
            <li class="breadcrumb-item"> <a href="{{route('products.index')}}">Produtos</a></li>
        </ol>
    </div>
    <h1>Produtos <a href="{{route('products.create')}}" class="btn btn-dark"><i class="fas fa-plus"></i>  Add </a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form class="form form-inline" action="{{route('products.search')}}" method="POST">
                @csrf
                <div class="flex form-group">
                    <input class="form-control" type="text" name="filter" value="{{ isset($filters) ? $filters['filter'] : '' }}">
                    <button class="btn btn-dark" type="submit"><i class="fa fa-search"></i> Filtrar</button>
                </div>
            </form>
        </div>
        <div class=" card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Imagem</th>
                        <th>Titulo</th>
                        <th>Preço</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td> <img src="{{ asset("storage/$product->image")   }}" alt="imagem" style="max-width:90px;"></td>
                            <td>{{$product->title}}</td>
                            <td>{{ number_format($product->price, 2, ',', '.') }}</td>
                            <td style="width: 450px;">
                                <a class="btn btn-lg btn-warning" href="{{route('products.show', $product->id)}}"><i class="far fa-eye"></i> Ver</a>
                                <a class="btn btn-lg btn-info" href="{{route('products.edit', $product->id)}}"><i class="far fa-eye"></i> Edit</a>
                                <a class="btn btn-lg btn-primary" href="{{route('products.categories.index', $product->id)}}"><i class="fa fa-layer-group"></i> Categorias</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $products->appends($filters)->links() !!}
            @else
                {!! $products->links() !!}
            @endif
        </div>
    </div>
@stop
