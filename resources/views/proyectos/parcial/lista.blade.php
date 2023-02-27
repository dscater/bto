@foreach ($proyectos as $proyecto)
    @php
        $total_actividades = count($proyecto->actividads);
        $pendientes = count(
            App\Actividad::where('proyecto_id', $proyecto->id)
                ->where('estado', 'PENDIENTE')
                ->get());
        $completos = count(App\Actividad::where('proyecto_id', $proyecto->id)
                ->where('estado', 'COMPLETO')
                ->get());
    @endphp

    <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
        <div class="card contenedor_tarjeta">
            <div class="card-body">
                <div class="dropdown dropdown-action profile-action">
                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                            class="material-icons">more_vert</i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item editar_proyecto" href="#" data-toggle="modal"
                            data-target="#edit_proyecto{{ $proyecto->id }}"><i class="fa fa-edit m-r-5"></i> Editar</a>
                        <a class="dropdown-item" href="#" data-toggle="modal"
                            data-target="#delete_proyecto{{ $proyecto->id }}"><i class="fa fa-trash m-r-5"></i>
                            Eliminar</a>
                    </div>
                </div>
                <h4 class="project-title"><a href="project-view.html">{{ $proyecto->nombre }}</a></h4>
                <small class="block text-ellipsis m-b-15">
                    <span class="text-xs">{{ $pendientes }}</span> <span class="text-muted">tareas pendientes, </span>
                    <span class="text-xs">{{ $completos }}</span> <span class="text-muted">tareas completadas</span>
                </small>
                <p class="text-muted">{!! $proyecto->descripcion !!}</p>
                <div class="pro-deadline m-b-15">
                    <div class="sub-title">
                        Fecha Finalización:
                    </div>
                    <div class="text-muted">
                        {{ date('d/m/Y', strtotime($proyecto->fecha_fin)) }}
                    </div>
                </div>
                <div class="project-members m-b-15">
                    <div>Lider del Proyecto :</div>
                    <ul class="team-members">
                        <li>
                            <a href="{{ route('empleados.show', $proyecto->lider_proyecto) }}" data-toggle="tooltip"
                                title=""
                                data-original-title="{{ $proyecto->lider->nombre }} {{ $proyecto->lider->paterno }} {{ $proyecto->lider->materno }}"><img
                                    alt="" src="{{ asset('imgs/users/' . $proyecto->lider->user->foto) }}"></a>
                        </li>
                    </ul>
                </div>
                <div class="project-members m-b-15">
                    <div>Equipo :</div>
                    <ul class="team-members">
                        @foreach ($proyecto->equipo as $equipo)
                            <li>
                                <a href="{{ route('empleados.show', $equipo->empleado->id) }}" data-toggle="tooltip"
                                    title=""
                                    data-original-title="{{ $equipo->empleado->nombre }} {{ $equipo->empleado->paterno }} {{ $equipo->empleado->materno }}"><img
                                        alt="" src="{{ asset('imgs/users/' . $equipo->empleado->user->foto) }}"></a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @php
                    $progreso = 0;
                    if ($total_actividades > 0) {
                        $progreso = ($completos * 100) / $total_actividades;
                        $progreso = number_format($progreso, 0);
                    }
                @endphp
                <p class="m-b-5">Progreso <span class="text-success float-right">{{ $progreso }}%</span></p>
                <div class="progress progress-xs mb-0">
                    <div class="progress-bar bg-success" role="progressbar" data-toggle="tooltip" title=""
                        style="width: {{ $progreso }}%" data-original-title="{{ $progreso }}%"></div>
                </div>
            </div>
        </div>
        @include('proyectos.edit')
        @include('proyectos.delete')
    </div>
@endforeach
