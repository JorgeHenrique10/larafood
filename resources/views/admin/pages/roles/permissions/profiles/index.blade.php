@extends('adminlte::page')

@section('title', 'Permissões com Cargos')

@section('content_header')
    <div class="breadcrumb mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{route('admin.index')}}">Dasboard</a></li>
            <li class="breadcrumb-item"> <a href="{{route('permissions.index')}}">Permissão</a></li>
            <li class="breadcrumb-item active"> <a href="{{route('roles.permissions.roles.index', $permission->id)}}">Permission - {{$permission->name}}</a></li>
        </ol>
    </div>
    <h1>Permissões com Cargos - <strong>{{$permission->name}}</strong> </h1>
@stop

@section('content')
    <div class="card">
        @include('admin.includes.alerts')
        <div class="card-header">
            {{-- <form class="form form-inline" action="{{route('roles.permissions.roles.index')}}" method="POST">
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
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{$role->name}}</td>
                            <td style="width: 350px;">
                                <form action="{{route('roles.permissions.detach', [$role->id, $permission->id])}}" method="POST">
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
                {!! $roles->appends($filters)->links() !!}
            @else
                {!! $roles->links() !!}
            @endif
        </div>
    </div>
@stop
