@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@endsection

@section('content')
    <div class="d-flex flex-wrap">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Usuários</span>
                    <span class="info-box-number">
                        {{ $userTotal }}
                        <small></small>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-table"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Mesas</span>
                    <span class="info-box-number">
                        {{ $tablesTotal }}
                        <small></small>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-layer-group"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Categorias</span>
                    <span class="info-box-number">
                        {{ $categoriesTotal }}
                        <small></small>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-hamburger"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Produtos</span>
                    <span class="info-box-number">
                        {{ $productsTotal }}
                        <small></small>
                    </span>
                </div>
            </div>
        </div>
        @admin()
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-building"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Empresas</span>
                        <span class="info-box-number">
                            1
                            <small></small>
                        </span>
                    </div>
                </div>
            </div>
        @endadmin
        @admin()
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-list-alt"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Planos</span>
                        <span class="info-box-number">
                            {{ $planTotal }}
                            <small></small>
                        </span>
                    </div>
                </div>
            </div>
        @endadmin
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-address-card"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Cargos</span>
                    <span class="info-box-number">
                        10
                        <small></small>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-address-book"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Perfis</span>
                    <span class="info-box-number">
                        {{ $rolesTotal }}
                        <small></small>
                    </span>
                </div>
            </div>
        </div>
        @admin()
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-lock"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Permissões</span>
                        <span class="info-box-number">
                            {{ $permissionsTotal }}
                            <small></small>
                        </span>
                    </div>
                </div>
            </div>
        @endadmin
    </div>

@endsection
