@extends('adminlte::page')

@section('title', 'Planos do Perfil {{$profile->name}}')

@section('content_header')
    <div class="breadcrumb mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{route('admin.index')}}">Dasboard</a></li>
            <li class="breadcrumb-item"> <a href="{{route('profiles.index')}}">Perfil</a></li>
            <li class="breadcrumb-item active"> <a href="{{route('profiles.plans.index', $profile->id)}}">Perfil - {{$profile->name}}</a></li>
        </ol>
    </div>
    <h1>Perfil- <strong>{{$profile->name}}</strong> <a class="btn btn-dark" href="{{route('profiles.plans.available', $profile->id)}}"> Add</a> </h1>
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
                    @foreach ($plans as $plan)
                        <tr>
                            <td>{{$plan->name}}</td>
                            <td style="width: 350px;">
                                <form action="{{route('profiles.plans.detach', [$profile->id, $plan->id])}}" method="POST">
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
                {!! $plans->appends($filters)->links() !!}
            @else
                {!! $plans->links() !!}
            @endif
        </div>
    </div>
@stop
