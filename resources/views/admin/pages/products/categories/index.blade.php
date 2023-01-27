@extends('adminlte::page')

@section('title', 'Categorias do Produto')

@section('content_header')
    <div class="breadcrumb mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{route('admin.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item"> <a href="{{route('products.index')}}">Produtos</a></li>
            <li class="breadcrumb-item active"> <a href="{{route('products.categories.index', $product->id)}}">Produto - {{$product->title}}</a></li>
        </ol>
    </div>
    <h1>Categorias do Produto - <strong>{{$product->title}}</strong> <a class="btn btn-dark" href="{{route('products.categories.available', $product->id)}}"> Add</a> </h1>
@stop

@section('content')
    <div class="card">
        @include('admin.includes.alerts')
        <div class="card-header">
            {{-- <form class="form form-inline" action="{{route('categories.permissions.categories.index')}}" method="POST">
                @csrf
                <div class="flex form-group">
                    <input class="form-control" type="text" name="filter" value="{{ isset($filters) ? $filters['filter'] : '' }}">
                    <button class="btn btn-dark" type="submit"><i class="fa fa-search"></i> Filtrar</button>
                </div>
            </form> --}}
        </div>
        <div class=" card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{$category->name}}</td>
                            <td style="width: 350px;">
                                <form action="{{route('products.categories.detach', [$product->id, $category->id])}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-lg btn-danger"><i class="fa fa-trash"></i> Remover</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
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
