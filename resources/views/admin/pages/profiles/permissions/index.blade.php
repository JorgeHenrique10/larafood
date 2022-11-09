@extends('adminlte::page')

@section('title', 'Permissões do Perfil')

@section('content_header')
    <div class="breadcrumb mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{route('admin.index')}}">Dasboard</a></li>
            <li class="breadcrumb-item"> <a href="{{route('profiles.index')}}">Perfil</a></li>
            <li class="breadcrumb-item active"> <a href="{{route('profiles.permissions.index', $profile->id)}}">Perfil {{$profile->name}}</a></li>
        </ol>
    </div>
    <h1>Permissões do Perfil <strong>{{$profile->name}}</strong> <a href="{{route('profiles.permissions.available', $profile->id)}}" class="btn btn-dark"><i class="fas fa-plus"></i>  Add Permissão</a></h1>
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
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                        <tr>
                            <td>{{$permission->name}}</td>
                            <td style="width: 350px;">
                                <form action="{{route('profiles.permissions.detach', [$profile->id, $permission->id])}}" method="POST">
                                    @csrf
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
                {!! $permissions->appends($filters)->links() !!}
            @else
                {!! $permissions->links() !!}
            @endif
        </div>
    </div>
@stop
