@extends('adminlte::page')

@section('title', 'Perfis')

@section('content_header')
    <div class="breadcrumb mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{route('admin.index')}}">Dasboard</a></li>
            <li class="breadcrumb-item"> <a href="{{route('profiles.index')}}">Perfis</a></li>
        </ol>
    </div>
    <h1>Perfis <a href="{{route('profiles.create')}}" class="btn btn-dark"><i class="fas fa-plus"></i>  Add </a></h1>
@stop

@section('content')
    <div class="card">
        @include('admin.includes.alerts')
        <div class="card-header">
            <form class="form form-inline" action="{{route('profiles.search')}}" method="POST">
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
                    @foreach ($profiles as $profile)
                        <tr>
                            <td>{{$profile->name}}</td>
                            <td>{{$profile->description}}</td>
                            <td style="width: 350px;">
                                <a class="btn btn-lg btn-warning" href="{{route('profiles.show', $profile->id)}}"><i class="far fa-eye"></i> Ver</a>
                                <a class="btn btn-lg btn-info" href="{{route('profiles.edit', $profile->id)}}"><i class="far fa-eye"></i> Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $profiles->appends($filters)->links() !!}
            @else
                {!! $profiles->links() !!}
            @endif
        </div>
    </div>
@stop
