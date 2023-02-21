@extends('adminlte::page')

@section('title', 'Cargos do Usuário')

@section('content_header')
    <div class="breadcrumb mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{route('admin.index')}}">Dasboard</a></li>
            <li class="breadcrumb-item"> <a href="{{route('roles.index')}}">Cargo</a></li>
            <li class="breadcrumb-item"> <a href="{{route('roles.users.index', $user->id)}}">Cargo {{$user->name}}</a></li>
            <li class="breadcrumb-item actived"> <a href="{{route('roles.users.available', $user->id)}}">Adicionar Cargo ao Usuário {{$user->name}}</a></li>
        </ol>
    </div>

    <h1>Cargos disponíveis para adição</h1>
@stop

@section('content')
    <div class="card">
        @include('admin.includes.alerts')
        <div class="card-header">
            <form class="form form-inline" action="{{route('roles.users.available', $user->id)}}" method="POST">
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
                    <form action="{{route('roles.users.attach', $user->id)}}" method="POST">
                        @csrf
                        @foreach ($roles as $role)
                            <tr>
                                <td style="width: 10px;">
                                    <input type="checkbox" name="roles[]" value="{{$role->id}}">
                                </td>
                                <td class="d-flex align-items-center" >{{$role->name}}</td>
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
                {!! $roles->appends($filters)->links() !!}
            @else
                {!! $roles->links() !!}
            @endif
        </div>
    </div>
@stop
