@extends('adminlte::page')

@section('title', 'Permissões com Perfis')

@section('content_header')
    <div class="breadcrumb mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{route('admin.index')}}">Dasboard</a></li>
            <li class="breadcrumb-item"> <a href="{{route('permissions.index')}}">Permissão</a></li>
            <li class="breadcrumb-item active"> <a href="{{route('profiles.permissions.profiles.index', $permission->id)}}">Permission - {{$permission->name}}</a></li>
        </ol>
    </div>
    <h1>Permissões com Perfis - <strong>{{$permission->name}}</strong> </h1>
@stop

@section('content')
    <div class="card">
        @include('admin.includes.alerts')
        <div class="card-header">
            {{-- <form class="form form-inline" action="{{route('profiles.permissions.profiles.index')}}" method="POST">
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
                    @foreach ($profiles as $profile)
                        <tr>
                            <td>{{$profile->name}}</td>
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
                {!! $profiles->appends($filters)->links() !!}
            @else
                {!! $profiles->links() !!}
            @endif
        </div>
    </div>
@stop
