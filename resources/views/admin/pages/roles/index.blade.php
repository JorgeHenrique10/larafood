@extends('adminlte::page')

@section('title', 'Cargos')

@section('content_header')
    <div class="breadcrumb mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{route('admin.index')}}">Dasboard</a></li>
            <li class="breadcrumb-item"> <a href="{{route('roles.index')}}">Cargos</a></li>
        </ol>
    </div>
    <h1>Cargos <a href="{{route('roles.create')}}" class="btn btn-dark"><i class="fas fa-plus"></i>  Add </a></h1>
@stop

@section('content')
    <div class="card">
        @include('admin.includes.alerts')
        <div class="card-header">
            <form class="form form-inline" action="{{route('roles.search')}}" method="POST">
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
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{$role->name}}</td>
                            <td>{{$role->description}}</td>
                            <td style="width: 350px;">
                                <a class="btn btn-lg btn-warning" href="{{route('roles.show', $role->id)}}"><i class="far fa-eye"></i> Ver</a>
                                <a class="btn btn-lg btn-info" href="{{route('roles.edit', $role->id)}}"><i class="far fa-eye"></i> Edit</a>
                                <a class="btn btn-lg btn-primary" href="{{route('roles.permissions.index', $role->id)}}"><i class="fa fa-lock"></i> </a>
                                {{-- <a class="btn btn-lg btn-dark" href="{{route('roles.plans.index', $role->id)}}"><i class="fas fa-list-alt"></i> </a> --}}
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
