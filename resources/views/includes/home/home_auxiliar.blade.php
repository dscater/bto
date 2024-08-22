<div class="row">
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon"><i class="fa fa-cubes"></i></span>
                <div class="dash-widget-info">
                    <h3>{{ $c_proyectos }}</h3>
                    <span>Proyectos</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                <div class="dash-widget-info">
                    <h3>{{ $c_clientes }}</h3>
                    <span>Clientes</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                <div class="dash-widget-info">
                    <h3>{{ $c_empleados }}</h3>
                    <span>Empleados</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-purple text-white text-center">
                <span class="card-title text-white">Cantidad de Empleados</span>
            </div>
            <div class="card-body">
                <div class="row" id="f_cantidad_empleados">
                    <div class="col-md-12">
                        <select name="filtro" class="select filtro">
                            <option value="todos">Todos</option>
                            <option value="fecha">Fecha</option>
                            <option value="estado">Estado</option>
                            <option value="fechasp">Pronóstico</option>
                        </select>
                    </div>
                    <div class="col-md-12 cont_filtro">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" value="{{ date('d/m/Y') }}"
                                    class="fecha_ini form-control datetimepicker">
                            </div>
                            <div class="col-md-6">
                                <input type="text" value="{{ date('d/m/Y') }}"
                                    class="fecha_fin form-control datetimepicker">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 cont_filtro">
                        <select name="estado" id="" class="select form-control estado">
                            <option value="todos">TODOS</option>
                            <option value="activo">ACTIVO</option>
                            <option value="inactivo">INACTIVO</option>
                        </select>
                    </div>
                </div><br>
                <div id="bar_charts_cantidad_empleados"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-info text-white text-center">
                <span class="card-title text-white">Tiempo de productividad laboral</span>
            </div>
            <div class="card-body">
                <div class="row" id="f_horas_trabajo_empleados">
                    <div class="col-md-12">
                        <select name="filtro" class="filtro select">
                            <option value="todos">Todos</option>
                            <option value="fecha">Fecha</option>
                            <option value="empresa">Empresa</option>
                            <option value="departamento">Departamento</option>
                            <option value="designacion">Designación</option>
                            <option value="empleado">Empleado</option>
                            <option value="fechasp">Pronóstico</option>
                        </select>
                    </div>
                    <div class="col-md-12 cont_filtro">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" value="{{ date('d/m/Y') }}"
                                    class="form-control fecha_ini datetimepicker">
                            </div>
                            <div class="col-md-6">
                                <input type="text" value="{{ date('d/m/Y') }}"
                                    class="form-control fecha_fin datetimepicker">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 cont_filtro">
                        {{ Form::select('empresa', $array_empresas, null, ['class' => 'select empresa']) }}
                    </div>
                    <div class="col-md-12 cont_filtro">
                        {{ Form::select('departamento', $array_departamentos, null, ['class' => 'select departamento']) }}
                    </div>
                    <div class="col-md-12 cont_filtro">
                        {{ Form::select('designacion', $array_designacions, null, ['class' => 'select designacion']) }}
                    </div>
                    <div class="col-md-12 cont_filtro">
                        {{ Form::select('empleado', $array_empleados, null, ['class' => 'select empleado']) }}
                    </div>
                </div><br>
                <div id="chart_horas_trabajo_empleados"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-warning text-white text-center">
                <span class="card-title text-white">Ingresos económicos</span>
            </div>
            <div class="card-body">
                <div class="row" id="f_ingresos_economicos">
                    <div class="col-md-12">
                        <select name="filtro" class="filtro select">
                            <option value="todos">Todos</option>
                            <option value="fecha">Fecha</option>
                            <option value="empresa">Empresa</option>
                            <option value="departamento">Departamento</option>
                            <option value="designacion">Designación</option>
                            <option value="empleado">Empleado</option>
                            <option value="fechasp">Pronóstico</option>
                        </select>
                    </div>
                    <div class="col-md-12 cont_filtro">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" value="{{ date('d/m/Y') }}"
                                    class="form-control fecha_ini datetimepicker">
                            </div>
                            <div class="col-md-6">
                                <input type="text" value="{{ date('d/m/Y') }}"
                                    class="form-control fecha_fin datetimepicker">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 cont_filtro">
                        {{ Form::select('empresa', $array_empresas, null, ['class' => 'select empresa']) }}
                    </div>
                    <div class="col-md-12 cont_filtro">
                        {{ Form::select('departamento', $array_departamentos, null, ['class' => 'select departamento']) }}
                    </div>
                    <div class="col-md-12 cont_filtro">
                        {{ Form::select('designacion', $array_designacions, null, ['class' => 'select designacion']) }}
                    </div>
                    <div class="col-md-12 cont_filtro">
                        {{ Form::select('empleado', $array_empleados, null, ['class' => 'select empleado']) }}
                    </div>
                </div><br>
                <div id="chart_total_ingresos"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-success text-white text-center">
                <span class="card-title text-white">Capacitación</span>
            </div>
            <div class="card-body">
                <div class="row" id="f_examen_capacitacion">
                    <div class="col-md-12">
                        <select name="filtro" class="filtro select">
                            <option value="todos">Todos</option>
                            <option value="fecha">Fecha</option>
                            <option value="empresa">Empresa</option>
                            <option value="departamento">Departamento</option>
                            <option value="designacion">Designación</option>
                            <option value="empleado">Empleado</option>
                            <option value="fechasp">Pronóstico</option>
                        </select>
                    </div>
                    <div class="col-md-12 cont_filtro">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" value="{{ date('d/m/Y') }}"
                                    class="form-control fecha_ini datetimepicker">
                            </div>
                            <div class="col-md-6">
                                <input type="text" value="{{ date('d/m/Y') }}"
                                    class="form-control fecha_fin datetimepicker">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 cont_filtro">
                        {{ Form::select('empresa', $array_empresas, null, ['class' => 'select empresa']) }}
                    </div>
                    <div class="col-md-12 cont_filtro">
                        {{ Form::select('departamento', $array_departamentos, null, ['class' => 'select departamento']) }}
                    </div>
                    <div class="col-md-12 cont_filtro">
                        {{ Form::select('designacion', $array_designacions, null, ['class' => 'select designacion']) }}
                    </div>
                    <div class="col-md-12 cont_filtro">
                        {{ Form::select('empleado', $array_empleados, null, ['class' => 'select empleado']) }}
                    </div>
                </div><br>
                <div id="chart_examen_capacitacion"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-danger text-white text-center">
                <span class="card-title text-white">Asistencia de empleados</span>
            </div>
            <div class="card-body">
                <div class="row" id="f_asistencia_empleados">
                    <div class="col-md-12">
                        <select name="filtro" class="filtro select">
                            <option value="todos">Todos</option>
                            <option value="fecha">Fecha</option>
                            <option value="empresa">Empresa</option>
                            <option value="departamento">Departamento</option>
                            <option value="designacion">Designación</option>
                            <option value="empleado">Empleado</option>
                            <option value="fechasp">Pronóstico</option>
                        </select>
                    </div>
                    <div class="col-md-12 cont_filtro">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" value="{{ date('d/m/Y') }}"
                                    class="form-control fecha_ini datetimepicker">
                            </div>
                            <div class="col-md-6">
                                <input type="text" value="{{ date('d/m/Y') }}"
                                    class="form-control fecha_fin datetimepicker">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 cont_filtro">
                        {{ Form::select('empresa', $array_empresas, null, ['class' => 'select empresa']) }}
                    </div>
                    <div class="col-md-12 cont_filtro">
                        {{ Form::select('departamento', $array_departamentos, null, ['class' => 'select departamento']) }}
                    </div>
                    <div class="col-md-12 cont_filtro">
                        {{ Form::select('designacion', $array_designacions, null, ['class' => 'select designacion']) }}
                    </div>
                    <div class="col-md-12 cont_filtro">
                        {{ Form::select('empleado', $array_empleados, null, ['class' => 'select empleado']) }}
                    </div>
                </div><br>
                <div id="chart_asistencia_empleados"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-purple text-white text-center">
                <span class="card-title text-white">Desarrollo de progreso de proyectos</span>
            </div>
            <div class="card-body">
                <div class="row" id="f_desarrollo_proyectos">
                    <div class="col-md-12">
                        <select name="filtro" class="filtro select">
                            <option value="todos">Todos</option>
                            <option value="empresa">Empresa</option>
                            <option value="departamento">Departamento</option>
                            <option value="designacion">Designación</option>
                            <option value="proyecto">Proyecto</option>
                        </select>
                    </div>
                    <div class="col-md-12 cont_filtro">
                        {{ Form::select('empresa', $array_empresas, null, ['class' => 'select empresa']) }}
                    </div>
                    <div class="col-md-12 cont_filtro">
                        {{ Form::select('departamento', $array_departamentos, null, ['class' => 'select departamento']) }}
                    </div>
                    <div class="col-md-12 cont_filtro">
                        {{ Form::select('designacion', $array_designacions, null, ['class' => 'select designacion']) }}
                    </div>
                    <div class="col-md-12 cont_filtro">
                        {{ Form::select('proyecto', $array_proyectos, null, ['class' => 'select proyecto']) }}
                    </div>
                </div><br>
                <div id="chart_progreso_proyectos"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-info text-white text-center">
                <span class="card-title text-white">Ganancia de Empleados</span>
            </div>
            <div class="card-body">
                <div class="row" id="f_ganancia_empleados">
                    <div class="col-md-12">
                        <select name="filtro" class="filtro select">
                            <option value="todos">Todos</option>
                            <option value="fecha">Fecha</option>
                            <option value="proyecto">Proyecto</option>
                            <option value="empleado">Empleado</option>
                            <option value="fechasp">Pronóstico</option>
                        </select>
                    </div>
                    <div class="col-md-12 cont_filtro">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" value="{{ date('d/m/Y') }}"
                                    class="form-control fecha_ini datetimepicker">
                            </div>
                            <div class="col-md-6">
                                <input type="text" value="{{ date('d/m/Y') }}"
                                    class="form-control fecha_fin datetimepicker">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 cont_filtro">
                        {{ Form::select('proyecto', $array_proyectos, null, ['class' => 'select proyecto']) }}
                    </div>
                    <div class="col-md-12 cont_filtro">
                        {{ Form::select('empleado', $array_empleados, null, ['class' => 'select empleado']) }}
                    </div>
                </div><br>
                <div id="chart_ganancia_empleados"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-warning text-white text-center">
                <span class="card-title text-white">Cantidad de progreso de actividades de empleados</span>
            </div>
            <div class="card-body">
                <div class="row" id="f_progreso_actividades">
                    <div class="col-md-12">
                        <select name="filtro" class="filtro select">
                            <option value="todos">Todos</option>
                            <option value="fecha">Fecha</option>
                            <option value="empresa">Empresa</option>
                            <option value="departamento">Departamento</option>
                            <option value="designacion">Designación</option>
                            <option value="empleado">Empleado</option>
                            <option value="fechasp">Pronóstico</option>
                        </select>
                    </div>
                    <div class="col-md-12 cont_filtro">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" value="{{ date('d/m/Y') }}"
                                    class="form-control fecha_ini datetimepicker">
                            </div>
                            <div class="col-md-6">
                                <input type="text" value="{{ date('d/m/Y') }}"
                                    class="form-control fecha_fin datetimepicker">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 cont_filtro">
                        {{ Form::select('empresa', $array_empresas, null, ['class' => 'select empresa']) }}
                    </div>
                    <div class="col-md-12 cont_filtro">
                        {{ Form::select('departamento', $array_departamentos, null, ['class' => 'select departamento']) }}
                    </div>
                    <div class="col-md-12 cont_filtro">
                        {{ Form::select('designacion', $array_designacions, null, ['class' => 'select designacion']) }}
                    </div>
                    <div class="col-md-12 cont_filtro">
                        {{ Form::select('empleado', $array_empleados, null, ['class' => 'select empleado']) }}
                    </div>
                </div><br>
                <div id="chat_progreso_actividades"></div>
            </div>
        </div>
    </div>
</div>
