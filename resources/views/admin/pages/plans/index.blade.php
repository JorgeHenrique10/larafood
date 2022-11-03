@extends('adminlte::page')

@section('title', 'Planos')

@section('content_header')
    <div class="breadcrumb mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{route('admin.index')}}">Dasboard</a></li>
            <li class="breadcrumb-item"> <a href="{{route('plans.index')}}">Planos</a></li>
        </ol>
    </div>
    <h1>Planos <a href="{{route('plans.create')}}" class="btn btn-dark"><i class="fas fa-plus"></i>  Add </a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form class="form form-inline" action="{{route('plans.search')}}" method="POST">
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
                        <th>Preço</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($plans as $plan)
                        <tr>
                            <td>{{$plan->name}}</td>
                            <td>R$ {{ number_format($plan->price, 2, ',', '.') }}</td>
                            <td style="width: 210px;">
                                <a class="btn btn-lg btn-warning" href="{{route('plans.show', $plan->id)}}"><i class="far fa-eye"></i> Ver</a>
                                <a class="btn btn-lg btn-info" href="{{route('plans.edit', $plan->id)}}"><i class="far fa-eye"></i> Edit</a>
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
