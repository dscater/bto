@extends('layouts.maindesign')
@section('css')
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
@endsection

@section('content')
@php
        $nombre_usuario = Auth::user()->email;
        if (Auth::user()->datosUsuario) {
            $nombre_usuario = Auth::user()->datosUsuario->nombre.' '.Auth::user()->datosUsuario->paterno.' '.Auth::user()->datosUsuario->materno;
        }elseif(Auth::user()->empleado){
            $nombre_usuario = Auth::user()->empleado->nombre.' '.Auth::user()->empleado->paterno.' '.Auth::user()->empleado->materno;
		}
    @endphp
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="page-title">Bienvenido {{ $nombre_usuario }}</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item active">Inicio</li>
            </ul>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card dash-widget">
            <div class="card-body">
                <div id="contenedorFecha">
                    <span id="txtFecha"></span>
                    <span id="txtHora"></span>
                    @if(Auth::user()->tipo == 'EMPLEADO')
                    <button type="button" id="btnMarcaHora" class="btn btn-primary"><i class="fa fa-clock"></i><span></span></button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


@if(Auth::user()->tipo == 'ADMINISTRADOR')
@include('includes.home.home_admin')
@endif

@if(Auth::user()->tipo == 'AUXILIAR')
@include('includes.home.home_auxiliar')
@endif

@if(Auth::user()->tipo == 'EMPLEADO')
@include('includes.home.home_empleado')
@endif

<input type="hidden" id="urlCantidadEmpleados" value="{{route('kpis.cantidad_empleados')}}">
<input type="hidden" id="urlHorasTrabajadasEmpleados" value="{{route('kpis.horas_trabajadas_empleados')}}">
<input type="hidden" id="urlIngresosEconomicos" value="{{route('kpis.ingresos_economicos')}}">
<input type="hidden" id="urlExamenCapacitacion" value="{{route('kpis.capacitacion_examen')}}">
<input type="hidden" id="urlAsistenciaEmpleados" value="{{route('kpis.asistencia_empleados')}}">
<input type="hidden" id="urlProgresoProyectos" value="{{route('kpis.progreso_proyectos')}}">
<input type="hidden" id="urlGananciaEmpleados" value="{{route('kpis.ganancia_empleados')}}">
<input type="hidden" id="urlProgresoActividades" value="{{route('kpis.progreso_actividades')}}">

@endsection

@section('js')
    <script src="{{asset('js/dashboard.js')}}"></script>
    <script src="{{asset('js/reloj.js')}}"></script>
    @if(Auth::user()->tipo == 'EMPLEADO')
    <script src="{{asset('js/asistencias/asistencia.js')}}"></script>
    @endif
@endsection
