@extends('layouts.maindesign')

@section('css')
    <link rel="stylesheet" href="{{asset('css/proyectos/index.css')}}">
@endsection
@section('content')

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Proyectos</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('proyectos.index')}}">Proyectos</a></li>
                    <li class="breadcrumb-item active">Lista</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_user"><i class="fa fa-plus"></i>Crear Proyecto</a>
            </div>
        </div>
    </div>

    @if (session()->has('info'))
        <div class="alert alert-success">
            <button class="close" data-dismiss="alert">&times;</button>
            {{ session('info') }}
        </div>
    @endif

    @if ($errors->has('ci'))
    <div class="alert alert-danger">
        <button class="close" data-dismiss="alert">&times;</button>
        {{ $errors->first('ci') }}
    </div>
    @endif

    @if ($errors->has('email'))
    <div class="alert alert-danger">
        <button class="close" data-dismiss="alert">&times;</button>
        {{ $errors->first('email') }}
    </div>
    @endif

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
                <input type="text" class="form-control floating" id="txt_buscar">
                <label class="focus-label">Nombre Proyecto</label>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">  
            <button type="button" id="btnBuscar" class="btn btn-success btn-block"> Buscar </button>  
        </div>     
    </div>

   
    <div class="row staff-grid-row" id="lista_proyectos">
        @foreach($proyectos as $proyecto)
        @php
            $total_actividades = count($proyecto->actividads);
            $pendientes = count(App\Actividad::where('proyecto_id',$proyecto->id)->where('estado','PENDIENTE')->get());
            $completos = count(App\Actividad::where('proyecto_id',$proyecto->id)->where('estado','COMPLETO')->get());
        @endphp

        <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
            <div class="card contenedor_tarjeta">
                <div class="card-body">
                    @if(Auth::user()->tipo != 'EMPLEADO')
                    <div class="dropdown dropdown-action profile-action">
                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item editar_proyecto" target="_blank" href="{{route('proyectos.download',$proyecto->id)}}"><i class="fa fa-file-pdf m-r-5"></i> Archivo</a>
                            <a class="dropdown-item editar_proyecto" href="#" data-toggle="modal" data-target="#edit_proyecto{{$proyecto->id}}"><i class="fa fa-edit m-r-5"></i> Editar</a>
                            @if(Auth::user()->tipo == 'ADMINISTRADOR')
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_proyecto{{$proyecto->id}}"><i class="fa fa-trash m-r-5"></i> Eliminar</a>
                            @endif
                        </div>
                    </div>
                    @endif
                    <h4 class="project-title"><a href="{{route('proyectos.show',$proyecto->id)}}">{{$proyecto->nombre}}</a></h4>
                    <small class="block text-ellipsis m-b-15">
                        <span class="text-xs">{{$pendientes}}</span> <span class="text-muted">tareas pendientes, </span>
                        <span class="text-xs">{{$completos}}</span> <span class="text-muted">tareas completadas</span>
                    </small>
                    <p class="text-muted">{!!$proyecto->descripcion!!}</p>
                    <div class="pro-deadline m-b-15">
                        <div class="sub-title">
                            Fecha Finalización:
                        </div>
                        <div class="text-muted">
                            {{date('d/m/Y',strtotime($proyecto->fecha_fin))}}
                        </div>
                    </div>
                    <div class="project-members m-b-15">
                        <div>Lider del Proyecto :</div>
                        <ul class="team-members">
                            <li>
                                <a href="{{route('empleados.show', $proyecto->lider_proyecto)}}" data-toggle="tooltip" title="" data-original-title="{{$proyecto->lider->nombre}} {{$proyecto->lider->paterno}} {{$proyecto->lider->materno}}"><img alt="" src="{{asset('imgs/users/'.$proyecto->lider->user->foto)}}"></a>
                            </li>
                        </ul>
                    </div>
                    <div class="project-members m-b-15">
                        <div>Equipo :</div>
                        <ul class="team-members">
                            @foreach($proyecto->equipo  as $equipo)
                            <li>
                                <a href="{{route('empleados.show',$equipo->empleado->id)}}" data-toggle="tooltip" title="" data-original-title="{{$equipo->empleado->nombre}} {{$equipo->empleado->paterno}} {{$equipo->empleado->materno}}"><img alt="" src="{{asset('imgs/users/'.$equipo->empleado->user->foto)}}"></a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @php
                        $progreso = 0;
                        if($total_actividades > 0)
                        {
                            $progreso = ($completos * 100) / $total_actividades;
                            $progreso = number_format($progreso,0);
                        }
                    @endphp
                    <p class="m-b-5">Progreso <span class="text-success float-right">{{$progreso}}%</span></p>
                    <div class="progress progress-xs mb-0">
                        <div class="progress-bar bg-success" role="progressbar" data-toggle="tooltip" title="" style="width: {{$progreso}}%" data-original-title="{{$progreso}}%"></div>
                    </div>
                </div>
            </div>
            @include('proyectos.edit')
            @include('proyectos.delete')
        </div>
        @endforeach
    </div>

    @include('proyectos.create')
    <input type="hidden" id="urlListaProyectos" value="{{route('proyectos.index')}}">
    <input type="hidden" id="urlInfoEmpleado" value="{{route('empleados.empleado_info')}}">
    <input type="hidden" id="urlPubicImgs" value="{{asset('imgs/users/')}}">

@endsection
@section('js')

<script src="{{asset('js/proyectos/index.js')}}"></script>

<script>
    let lista_proyectos = $('#lista_proyectos');
    let txt_buscar = $('#txt_buscar');
    let btnBuscar = $('#btnBuscar');

    $(document).ready(function () {
        txt_buscar.on('change keyup',function(){
            listarProyectos();
        });
        
        btnBuscar.click(function(){
            listarProyectos();
        })
    });

    function listarProyectos(){
        $.ajax({
            type: "GET",
            url: $('#urlListaProyectos').val(),
            data: {
                texto : txt_buscar.val(),
            },
            dataType: "json",
            success: function (response) {
                lista_proyectos.html(response.html);
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
    }
</script> 

@endsection
