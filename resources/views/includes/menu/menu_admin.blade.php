<li class="{{ request()->is('users*') ? 'active' : '' }}">
    <a href="{{ route('users.index') }}"><i class="la la-user"></i><span>Usuarios</span></a>
</li>

<li class="submenu @if(request()->is('empleados*') || request()->is('empresas*') || request()->is('departamentos*') || request()->is('designacions*')|| request()->is('horarios*')|| request()->is('asistencias*')|| request()->is('vacacions*'))active @endif">
    <a href="#" class=""><i class="la la-users"></i> <span> Empleados</span> <span class="menu-arrow"></span></a>
    <ul>
        <li><a href="{{route('empleados.index')}}" class="{{request()->is('empleados*')?'active':''}}">Empleados</a></li>
        <li><a href="{{route('horarios.index')}}" class="{{request()->is('horarios*')?'active':''}}">Horarios</a></li>
        <li><a href="{{route('asistencias.index')}}" class="{{request()->is('asistencias*')?'active':''}}">Asistencias</a></li>
        <li><a href="{{route('vacacions.index')}}" class="{{request()->is('vacacions*')?'active':''}}">Vacaciones</a></li>
        <li><a href="{{route('empresas.index')}}" class="{{request()->is('empresas*')?'active':''}}">Empresas</a></li>
        <li><a href="{{route('departamentos.index')}}" class="{{request()->is('departamentos*')?'active':''}}">Departamentos</a></li>
        <li><a href="{{route('designacions.index')}}" class="{{request()->is('designacions*')?'active':''}}">Designaciones</a></li>
        <li><a href="{{route('sueldos.index')}}" class="{{request()->is('sueldos*')?'active':''}}">Sueldos</a></li>
    </ul>
</li>

<li class="{{request()->is('clientes*')?'active':''}}">
    <a href="{{route('clientes.index')}}"><i class="la la-users"></i> <span>Clientes</span></a>
</li>

<li class="submenu @if(request()->is('proyectos*') || request()->is('tareas*'))active @endif">
    <a href="#" class=""><i class="la la-rocket"></i> <span> 
        Proyectos</span> <span class="menu-arrow"></span></a>
    <ul>
        <li><a href="{{route('proyectos.index')}}" class="{{request()->is('proyectos*')?'active':''}}">
            Proyectos</a></li>
        <li><a href="{{route('actividads.index')}}" class="{{request()->is('actividads*')?'active':''}}">Tareas</a></li>
    </ul>
</li>

<li class="{{ request()->is('examens*') ? 'active' : '' }}">
    <a href="{{ route('examens.index') }}"><i class="la la-files-o"></i><span>Exámenes</span></a>
</li>

<li class="{{ request()->is('reportes*') ? 'active' : '' }}">
    <a href="{{route('reportes.index')}}"><i class="la la-pie-chart"></i> <span>Reportes</span></a>
</li>
