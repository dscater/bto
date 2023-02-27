<li class="{{ request()->is('asistencias*') ? 'active' : '' }}">
    <a href="{{ route('asistencias.asistencias_empleado',Auth::user()->empleado->id) }}"><i class="fa fa-user-check"></i><span>Asistencias</span></a>
</li>

<li class="{{ request()->is('proyectos*') ? 'active' : '' }}">
    <a href="{{ route('proyectos.index') }}"><i class="la la-rocket"></i><span>Proyectos</span></a>
</li>

<li class="{{ request()->is('horarios*') ? 'active' : '' }}">
    <a href="{{ route('horarios.horarios_empleado',Auth::user()->empleado->id) }}"><i class="far fa-list-alt"></i><span>Horarios</span></a>
</li>

<li class="{{ request()->is('vacacions*') ? 'active' : '' }}">
    <a href="{{ route('vacacions.vacacions_empleado',Auth::user()->empleado->id) }}"><i class="far fa-calendar-alt"></i><span>Vacaciones</span></a>
</li>

<li class="{{ request()->is('examen_empleados*') ? 'active' : '' }}">
    <a href="{{ route('examen_empleados.index',Auth::user()->empleado->id) }}"><i class="la la-files-o"></i><span>Exámenes</span></a>
</li>