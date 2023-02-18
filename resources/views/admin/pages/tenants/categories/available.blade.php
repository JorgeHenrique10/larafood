@extends('adminlte::page')

@section('title', 'Categorias para o produto')

@section('content_header')
    <div class="breadcrumb mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{route('admin.index')}}">Dasboard</a></li>
            <li class="breadcrumb-item"> <a href="{{route('products.index')}}">Produtos</a></li>
            <li class="breadcrumb-item"> <a href="{{route('products.categories.index', $product->id)}}">Produto - {{$product->title}}</a></li>
            <li class="breadcrumb-item active"> <a href="{{route('products.categories.available', $product->id)}}">Adicionar Categoria ao Produto - {{$product->title}}</a></li>
        </ol>
    </div>

    <h1>Perfis disponíveis para adição</h1>
@stop

@section('content')
    <div class="card">
        @include('admin.includes.alerts')
        <div class="card-header">
            <form class="form form-inline" action="{{route('products.categories.available', $product->id)}}" method="POST">
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
                        <th>#</th>
                        <th>Nome</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="{{route('products.categories.attach', $product->id)}}" method="POST">
                        @csrf
                        @foreach ($categories as $category)
                            <tr>
                                <td style="width: 10px;">
                                    <input type="checkbox" name="categories[]" value="{{$category->id}}">
                                </td>
                                <td class="d-flex align-items-center" >{{$category->name}}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="2">
                                <button type="submit" class="btn btn-dark"> Vincular</button>
                            </td>
                        </tr>
                    </form>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $categories->appends($filters)->links() !!}
            @else
                {!! $categories->links() !!}
            @endif
        </div>
    </div>
@stop
