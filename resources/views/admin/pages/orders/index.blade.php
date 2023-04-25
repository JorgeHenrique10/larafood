@extends('adminlte::page')

@section('title', 'Pedidos')

@section('content_header')
    <h1>Pedidos <a class="btn btn-dark" href="{{ route('permissions.index') }}"> <i class="fa fa-arrow-left"></i> Voltar</a>
    </h1>
@endsection

@section('content')
    <x-orders-ordersTenant></x-orders-ordersTenant>
@endsection
