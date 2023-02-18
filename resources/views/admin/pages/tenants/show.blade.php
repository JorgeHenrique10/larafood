@extends('adminlte::page')

@section('title', 'Detalhes Empresa')

@section('content_header')
    <h1>Detalhes Empresa <a class="btn btn-dark" href="{{route('tenants.index')}}"><i class="fas fa-arrow-left"></i> Voltar</a> </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Detalhes Empresa <b>{{$tenant->name}}</b>
        </div>
        <div class=" card-body">
            <ul>
                <li style="list-style-type: none;">
                    <img src="{{  $tenant->logo ? asset("storage/$tenant->logo") : 'data:image/png;base64,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'  }}" alt="imagem" style="max-width:90px;"/>

                </li>
                <li>
                    <strong> Plano: </strong>{{$tenant->plan->name}}
                </li>
                <li>
                    <strong> Nome: </strong>{{$tenant->name}}
                </li>
                <li>
                    <strong> Url: </strong>{{$tenant->url}}
                </li>
                <li>
                    <strong> Email: </strong>{{ $tenant->email}}
                </li>
                <li>
                    <strong> CNPJ: </strong>{{ $tenant->cnpj}}
                </li>
                <li>
                    <strong> Ativo: </strong>{{ $tenant->active == 'Y' ? 'SIM' : 'NÃO'}}
                </li>

                <hr/>
                <h3>Assinatura</h3>
                <li>
                    <strong> Data Assinatura: </strong>{{ $tenant->subscription}}
                </li>
                <li>
                    <strong> Data Expiração: </strong>{{ $tenant->expires_at}}
                </li>
                <li>
                    <strong> Identificador: </strong>{{ $tenant->subscription_id}}
                </li>
                <li>
                    <strong> Ativo?: </strong>{{ $tenant->subscription_active == 'Y' ? 'SIM' : 'NÃO'}}
                </li>
                <li>
                    <strong> Cancelou?: </strong>{{ $tenant->subscription_suspended ? 'SIM' : 'NÃO'}}
                </li>




            </ul>
            @include('admin.includes.alerts')
        </div>
        <div class="card-footer">
            <form action="{{route('tenants.destroy', $tenant->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Deletar {{$tenant->name}} </button>
            </form>
        </div>
    </div>
@stop
