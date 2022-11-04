@extends('adminlte::page')

@section('title', 'Detalhes do Plano')

@section('content_header')
    <div class="breadcrumb mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{route('admin.index')}}">Dasboard</a></li>
            <li class="breadcrumb-item"> <a href="{{route('plans.index')}}">Planos</a></li>
            <li class="breadcrumb-item"> <a href="{{route('plans.show', $plan->id)}}">{{$plan->name}}</a></li>
            <li class="breadcrumb-item active"> <a href="{{route('detail.plans.index', $plan->id)}}">Detalhes do Plano</a></li>
        </ol>
    </div>
    <h1>Detalhes do Plano - {{$plan->name}} <a href="{{route('detail.plans.create', $plan->id)}}" class="btn btn-dark"><i class="fas fa-plus"></i>  Add </a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            #
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
                    @foreach ($details as $detail)
                        <tr>
                            <td>{{$detail->name}}</td>
                            <td style="width: 220px;">
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
                {!! $details->appends($filters)->links() !!}
            @else
                {!! $details->links() !!}
            @endif
        </div>
    </div>
@stop
