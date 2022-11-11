@extends('adminlte::page')

@section('title', 'Planos para o perfil')

@section('content_header')
    <div class="breadcrumb mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{route('admin.index')}}">Dasboard</a></li>
            <li class="breadcrumb-item"> <a href="{{route('profiles.index')}}">Perfil</a></li>
            <li class="breadcrumb-item "> <a href="{{route('profiles.plans.index', $profile->id)}}">Perfil - {{$profile->name}}</a></li>
            <li class="breadcrumb-item active"> <a href="{{route('profiles.plans.available', $profile->id)}}">Adicionar Permissão Perfil {{$profile->name}}</a></li>
        </ol>
    </div>

    <h1>Planos disponíveis para adição</h1>
@stop

@section('content')
    <div class="card">
        @include('admin.includes.alerts')
        <div class="card-header">
            <form class="form form-inline" action="{{route('profiles.plans.available', $profile->id)}}" method="POST">
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
                    <form action="{{route('profiles.plans.attach', $profile->id)}}" method="POST">
                        @csrf
                        @foreach ($plans as $plan)
                            <tr>
                                <td style="width: 10px;">
                                    <input type="checkbox" name="plans[]" value="{{$plan->id}}">
                                </td>
                                <td class="d-flex align-items-center" >{{$plan->name}}</td>
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
                {!! $plans->appends($filters)->links() !!}
            @else
                {!! $plans->links() !!}
            @endif
        </div>
    </div>
@stop
