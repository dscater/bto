@extends('layouts.maindesign')

@section('css')
<style>
    .boton_reporte{
        width: 100%!important;
        margin-left: auto;
        margin-top: 10px;
        margin-bottom: 10px;
    }
    .boton_reporte a{
        width: 100%;
    }
</style>
@endsection

@section('content')

<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Reportes</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('reportes.index')}}">Reportes</a></li>
                <li class="breadcrumb-item active">Lista</li>
            </ul>
        </div>
    </div>
</div>

<div class="content" id="contenedorReportes">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3>Reportes</h3>
                    <div class="row">
                        @if(Auth::user()->tipo == 'ADMINISTRADOR')
                        @include('includes.reportes.reporte_admin')
                        @endif
                        @if(Auth::user()->tipo == 'AUXILIAR')
                        @include('includes.reportes.reporte_auxiliar')
                        @endif
                        @if(Auth::user()->tipo == 'EMPLEADO')
                        @include('includes.reportes.reporte_empleado')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('reportes.modal.m_usuarios')
@include('reportes.modal.m_empleados')
@endsection

@section('js')
<script src="{{asset('js/reportes/filtro.js')}}"></script>
@endsection
