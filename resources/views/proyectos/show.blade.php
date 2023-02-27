@extends('layouts.maindesign')

@section('css')
    <link rel="stylesheet" href="{{asset('css/proyectos/index.css')}}">
    <link rel="stylesheet" href="{{ asset('css/proyectos/show.css') }}">
@endsection
@section('content')

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Proyectos</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('proyectos.index') }}">Proyectos</a></li>
                    <li class="breadcrumb-item active">Proyecto</li>
                </ul>
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

    @if (session('bien'))
        <div class="alert alert-success">
            <button class="close" data-dismiss="alert">&times;</button>
            {{ session('bien') }}
        </div>
    @endif

    @if (session('info'))
        <div class="alert alert-success">
            <button class="close" data-dismiss="alert">&times;</button>
            {{ session('info') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-success">
            <button class="close" data-dismiss="alert">&times;</button>
            {{ session('error') }}
        </div>
    @endif

    <div class="chat-main-wrapper">

        <div class="col-lg-7 message-view task-view task-left-sidebar">
            <div class="chat-window">
                <div class="fixed-header">
                    <div class="navbar">
                        <div class="float-left mr-auto">
                            <div class="add-task-btn-wrapper">
                                <span class="add-task-btn btn btn-white btn-sm visible">
                                    Añadir Tarea
                                </span>
                            </div>
                        </div>
                        <a class="task-chat profile-rightbar float-right" id="task_chat" href="#task_window"><i
                                class="fa fa fa-comment"></i></a>
                        <ul class="nav float-right custom-menu">
                            <li class="nav-item dropdown dropdown-action">
                                <span id="txtFiltro">Todoas las tareas</span>
                                <a href="" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-cog"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#" id="filtro_pendientes">Tareas Pendientes</a>
                                    <a class="dropdown-item" href="#" id="filtro_completos">Tareas Completas</a>
                                    <a class="dropdown-item" href="#" id="filtro_todos">Todas las tareas</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="chat-contents">
                    <div class="chat-content-wrap">
                        <div class="chat-wrap-inner">
                            <div class="chat-box">
                                <div class="task-wrapper">
                                    <div class="task-list-container">
                                        <div class="task-list-body">
                                            <ul id="task-list">
                                                @foreach ($proyecto->actividads as $actividad)
                                                    @php
                                                        $completo = '';
                                                        // PENDIENTE, COMPLETO
                                                        if ($actividad->estado == 'COMPLETO') {
                                                            $completo = 'completed';
                                                        }
                                                    @endphp
                                                    <li class="{{ $completo }} task">
                                                        <div class="task-container">
                                                            <span class="task-action-btn task-check">
                                                                <span class="action-circle large complete-btn" title="Completar tarea" data-url="{{route('actividads.update',$actividad->id)}}">
                                                                    <i class="material-icons">check</i>
                                                                </span>
                                                            </span>
                                                            <span class="task-label" contenteditable="true" data-url="{{route('actividads.update',$actividad->id)}}">{{ $actividad->nombre }}</span>
                                                            <span class="task-action-btn task-btn-right">
                                                                <span class="action-circle large delete-btn" title="Eliminar tarea" data-url="{{route('actividads.destroy',$actividad->id)}}">
                                                                    <i class="material-icons">delete</i>
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="task-list-footer">
                                            <div class="new-task-wrapper">
                                                <textarea id="new-task" placeholder="Ingresa la tarea aqui"></textarea>
                                                <span class="error-message hidden">Ingresa el nombre de la tarea</span>
                                                <span class="add-new-task-btn btn" id="add-task">Añadir tarea</span>
                                                <span class="btn" id="close-task-panel">Cerrar</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="notification-popup hide">
                                    <p>
                                        <span class="task"></span>
                                        <span class="notification-text"></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @php
            $total_actividades = count($proyecto->actividads);
            $pendientes = count(App\Actividad::where('proyecto_id',$proyecto->id)->where('estado','PENDIENTE')->get());
            $completos = count(App\Actividad::where('proyecto_id',$proyecto->id)->where('estado','COMPLETO')->get());
        @endphp
        <div class="col-lg-5 message-view task-chat-view task-right-sidebar" id="task_window">
            <div class="chat-window">
                <div class="chat-contents task-chat-contents">
                    <div class="chat-content-wrap">
                        <div class="chat-wrap-inner">
                            <div class="chat-box">
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
                                            <span class="text-xs" id="txtTareasPendientes">{{$pendientes}}</span> <span class="text-muted">tareas pendientes, </span>
                                            <span class="text-xs" id="txtTareasCompletas">{{$completos}}</span> <span class="text-muted">tareas completadas</span>
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
                                        <p class="m-b-5">Progreso <span class="text-success float-right" id="txtPorcentaje">{{$progreso}}%</span></p>
                                        <div class="progress progress-xs mb-0">
                                            <div class="progress-bar bg-success" role="progressbar" data-toggle="tooltip" title="" id="baraProgreso" style="width: {{$progreso}}%" data-original-title="{{$progreso}}%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('proyectos.edit')
        @include('proyectos.delete')
        
    </div>
    <input type="hidden" id="urlStoreActividad" value="{{ route('actividads.store', $proyecto->id) }}">
    <input type="hidden" id="_i_p" value="{{$proyecto->id}}">
    <input type="hidden" id="urlInfoProyecto" value="{{route('proyectos.info_proyecto')}}">
    <input type="hidden" id="urlActividadsProyecto" value="{{route('actividads.actividadesProyecto',$proyecto->id)}}">
@endsection
@section('js')
    <script src="{{ asset('js/proyectos/show.js') }}"></script>
    <script src="{{asset('js/proyectos/index.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#filtro_pendientes').click(function(e){
                e.preventDefault();
                $('#txtFiltro').text('Tareas Pendientes');
                actividadsProyecto('pendientes');
            });
            $('#filtro_completos').click(function(e){
                e.preventDefault();
                $('#txtFiltro').text('Tareas Completas');
                actividadsProyecto('completos');

            });
            $('#filtro_todos').click(function(e){
                e.preventDefault();
                $('#txtFiltro').text('Todas las tareas');
                actividadsProyecto('todos');
            });
        });

        function actividadsProyecto(filtro)
        {
            $.ajax({
                type: "GET",
                url: $('#urlActividadsProyecto').val(),
                data: {
                    filtro: filtro
                },
                dataType: "json",
                success: function (response) {
                    $('#task-list').html(response.html);
                }
            });
        }
    </script>
@endsection
