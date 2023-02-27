@extends('layouts.maindesign')

@section('css')
@endsection
@section('content')

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Asistencias</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('asistencias.index')}}">Asistencias</a></li>
                    <li class="breadcrumb-item active">Asistencias Empleado</li>
                </ul>
            </div>
            {{-- <div class="col-auto float-right ml-auto">
                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_horario"><i class="fa fa-plus"></i>Agregar Horario</a>
            </div> --}}
        </div>
    </div>

    @if(session('bien'))
        <div class="alert alert-success">
            <button class="close" data-dismiss="alert">&times;</button>
            {{ session('bien') }}
        </div>
    @endif

    @if(session('info'))
        <div class="alert alert-success">
            <button class="close" data-dismiss="alert">&times;</button>
            {{ session('info') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-success">
            <button class="close" data-dismiss="alert">&times;</button>
            {{ session('error') }}
        </div>
    @endif

    <div class="row filter-row">
        <div class="col-sm-6 col-md-3">  
            <div class="form-group form-focus">
                <input type="text" id="txtNombreEmpleado" class="form-control floating">
                <label class="focus-label">Nombre Empleado</label>
            </div>
        </div>
        <div class="col-sm-6 col-md-3"> 
            <div class="form-group form-focus select-focus focused">
                {{Form::select('mes_asistencia',[
                    '01' => 'Enero',
                    '02' => 'Febrero',
                    '03' => 'Marzo',
                    '04' => 'Abril',
                    '05' => 'Mayo',
                    '06' => 'Junio',
                    '07' => 'Julio',
                    '08' => 'Agosto',
                    '09' => 'Septiembre',
                    '10' => 'Octubre',
                    '11' => 'Noviembre',
                    '12' => 'Diciembre',
                ],date('m'),['class'=>'select','id'=>'txtMesAsistencia'])}}
            </div>
        </div>
        <div class="col-sm-6 col-md-3"> 
            <div class="form-group form-focus select-focus focused">
                {{Form::select('anios_asistencia',$array_anios,date('Y'),['class'=>'select','id'=>'txtAnioAsistencia'])}}
            </div>
        </div>
        <div class="col-sm-6 col-md-3">  
            <a href="#" class="btn btn-success btn-block"> Buscar </a>  
        </div>     
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-striped custom-table table-nowrap mb-0">
                    <thead>
                        <tr id="header_asistencias">
                            
                        </tr>
                    </thead>
                    <tbody id="contenedorAsistencias">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <input type="hidden" id="urlAsistenciasEmpleados" value="{{route('asistencias.index')}}">
@endsection
@section('js')
<script src="{{asset('js/asistencias/index.js')}}"></script>
@endsection
