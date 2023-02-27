@extends('layouts.maindesign')

@section('css')
<link rel="stylesheet" href="{{asset('css/horarios/horarios_empleado.css')}}">
@endsection
@section('content')

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Horarios</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('horarios.index')}}">Horarios</a></li>
                    <li class="breadcrumb-item active">Horarios Empleado</li>
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

    <!-- /Search Filter -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>
                                Empleado: 
                                <span> {{ $empleado->nombre }}<span>{{ $empleado->paterno }} {{ $empleado->materno }}</span>
                                </span>
                                <span class="avatar"><img src="{{asset('imgs/users/'.$empleado->user->foto)}}" alt=""></span>
                            </h4>
                            <h4 class="texto_total_horas">Total horas trabajo: <span id="totalHoras" data-valor="{{$horario->horas_trabajo}}">{{$horario->horas_trabajo}} Hrs.</span></h4>
                            <table class="table table-bordered">
                                <thead>
                                    <th></th>
                                    <th>Lunes</th>
                                    <th>Martes</th>
                                    <th>Miercoles</th>
                                    <th>Jueves</th>
                                    <th>Viernes</th>
                                    <th>Sábado</th>
                                    <th>Domingo</th>
                                </thead>
                                <tbody id="contenedor_dias">
                                    <tr>
                                        <td><b>Hora Inicio</b></td>
                                        <td class="dia" data-dia="hi_lu">
                                            <div class="contenedor_dia" data-valor="{{$horario->hi_lu? :'S/A'}}">
                                            {{$horario->hi_lu? :'S/A'}}        
                                            </div>
                                        </td>
                                        <td class="dia" data-dia="hi_mar">
                                            <div class="contenedor_dia" data-valor="{{$horario->hi_mar? :'S/A'}}">
                                            {{$horario->hi_mar? :'S/A'}}        
                                            </div>
                                        </td>
                                        <td class="dia" data-dia="hi_mier">
                                            <div class="contenedor_dia" data-valor="{{$horario->hi_mier? :'S/A'}}">
                                            {{$horario->hi_mier? :'S/A'}}        
                                            </div>
                                        </td>
                                        <td class="dia" data-dia="hi_jue">
                                            <div class="contenedor_dia" data-valor="{{$horario->hi_jue? :'S/A'}}">
                                            {{$horario->hi_jue? :'S/A'}}        
                                            </div>
                                        </td>
                                        <td class="dia" data-dia="hi_vier">
                                            <div class="contenedor_dia" data-valor="{{$horario->hi_vier? :'S/A'}}">
                                            {{$horario->hi_vier? :'S/A'}}        
                                            </div>
                                        </td>
                                        <td class="dia" data-dia="hi_sa">
                                            <div class="contenedor_dia" data-valor="{{$horario->hi_sa? :'S/A'}}">
                                            {{$horario->hi_sa? :'S/A'}}        
                                            </div>
                                        </td>
                                        <td class="dia" data-dia="hi_do">
                                            <div class="contenedor_dia" data-valor="{{$horario->hi_do? :'S/A'}}">
                                            {{$horario->hi_do? :'S/A'}}        
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Hora Salida</b></td>
                                        <td class="dia" data-dia="hf_lu">
                                            <div class="contenedor_dia" data-valor="{{$horario->hf_lu? :'S/A'}}">
                                            {{$horario->hf_lu? :'S/A'}}        
                                            </div>
                                        </td>
                                        <td class="dia" data-dia="hf_mar">
                                            <div class="contenedor_dia" data-valor="{{$horario->hf_mar? :'S/A'}}">
                                            {{$horario->hf_mar? :'S/A'}}        
                                            </div>
                                        </td>
                                        <td class="dia" data-dia="hf_mier">
                                            <div class="contenedor_dia" data-valor="{{$horario->hf_mier? :'S/A'}}">
                                            {{$horario->hf_mier? :'S/A'}}        
                                            </div>
                                        </td>
                                        <td class="dia" data-dia="hf_jue">
                                            <div class="contenedor_dia" data-valor="{{$horario->hf_jue? :'S/A'}}">
                                            {{$horario->hf_jue? :'S/A'}}        
                                            </div>
                                        </td>
                                        <td class="dia" data-dia="hf_vier">
                                            <div class="contenedor_dia" data-valor="{{$horario->hf_vier? :'S/A'}}">
                                            {{$horario->hf_vier? :'S/A'}}        
                                            </div>
                                        </td>
                                        <td class="dia" data-dia="hf_sa">
                                            <div class="contenedor_dia" data-valor="{{$horario->hf_sa? :'S/A'}}">
                                            {{$horario->hf_sa? :'S/A'}}        
                                            </div>
                                        </td>
                                        <td class="dia" data-dia="hf_do">
                                            <div class="contenedor_dia" data-valor="{{$horario->hf_do? :'S/A'}}">
                                            {{$horario->hf_do? :'S/A'}}        
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="urlActualizaHorario" value="{{route('horarios.update',$empleado->horario->id)}}">

@endsection
@section('js')
    @if(Auth::user()->tipo != 'EMPLEADO')
    <script src="{{asset('js/horarios/horarios_empleado.js')}}"></script>
    @endif
@endsection
