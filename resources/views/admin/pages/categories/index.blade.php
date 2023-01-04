@extends('adminlte::page')

@section('title', 'Categorias')

@section('content_header')
    <div class="breadcrumb mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{route('admin.index')}}">Dasboard</a></li>
            <li class="breadcrumb-item"> <a href="{{route('categories.index')}}">Categorias</a></li>
        </ol>
    </div>
    <h1>Categorias <a href="{{route('categories.create')}}" class="btn btn-dark"><i class="fas fa-plus"></i>  Add </a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form class="form form-inline" action="{{route('categories.search')}}" method="POST">
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
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{$category->name}}</td>
                            <td>{{$category->description}}</td>
                            <td style="width: 450px;">
                                <a class="btn btn-lg btn-warning" href="{{route('categories.show', $category->id)}}"><i class="far fa-eye"></i> Ver</a>
                                <a class="btn btn-lg btn-info" href="{{route('categories.edit', $category->id)}}"><i class="far fa-eye"></i> Edit</a>
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
