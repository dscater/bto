@extends('layouts.maindesign')

@section('css')
    <style>
        .fc-event{
            cursor: pointer;
        }
    </style>
@endsection
@section('content')

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Vacaciones</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('vacacions.index')}}">Vacaciones</a></li>
                    <li class="breadcrumb-item active">Vacaciones Empleado</li>
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

    <div class="mensaje_error"></div>

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
            
                            <div id="calendario" class="fc fc-unthemed fc-ltr"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="urlFechas" value="{{route('vacacions.fechas_vacacions',$empleado->id)}}">
    <input type="hidden" id="_i_d_e" value="{{$empleado->id}}">
    <input type="hidden" id="urlStoreVacacion" value="{{route('vacacions.store')}}">

    @include('vacacions.modal.confirmar_dia')
    @include('vacacions.modal.eliminar_dia')
@endsection
@section('js')
    <script src="{{asset('js/vacacions/vacacions_empleado.js')}}"></script>
@endsection
