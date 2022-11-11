@extends('adminlte::page')

@section('title', 'Perfis para o plano')

@section('content_header')
    <div class="breadcrumb mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{route('admin.index')}}">Dasboard</a></li>
            <li class="breadcrumb-item"> <a href="{{route('plans.index')}}">Planos</a></li>
            <li class="breadcrumb-item"> <a href="{{route('plans.profiles.index', $plan->id)}}">Plano - {{$plan->name}}</a></li>
            <li class="breadcrumb-item active"> <a href="{{route('plans.profiles.available', $plan->id)}}">Adicionar Perfil ao Plano - {{$plan->name}}</a></li>
        </ol>
    </div>

    <h1>Perfis disponíveis para adição</h1>
@stop

@section('content')
    <div class="card">
        @include('admin.includes.alerts')
        <div class="card-header">
            <form class="form form-inline" action="{{route('plans.profiles.available', $plan->id)}}" method="POST">
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
                    <form action="{{route('plans.profiles.attach', $plan->id)}}" method="POST">
                        @csrf
                        @foreach ($profiles as $profile)
                            <tr>
                                <td style="width: 10px;">
                                    <input type="checkbox" name="profiles[]" value="{{$profile->id}}">
                                </td>
                                <td class="d-flex align-items-center" >{{$profile->name}}</td>
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
                {!! $profiles->appends($filters)->links() !!}
            @else
                {!! $profiles->links() !!}
            @endif
        </div>
    </div>
@stop
