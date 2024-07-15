<?php
Route::get('/clear-cache', function (){ 
    Artisan::call('config:cache');
    return "Cache is cleared";
});

Route::get('/', 'Auth\LoginController@showLoginForm')->name('inicio');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('dashboard', 'DashboardController@index')->name('dashboard');
Route::get('dashboard/{mes}', 'DashboardController@index_month');

Route::middleware(['auth'])->group(function () {
    // USUARIOS
    Route::get('users', 'UserController@index')->name('users.index');

    Route::get('users/create', 'UserController@create')->name('users.create');

    Route::post('users/store', 'UserController@store')->name('users.store');

    Route::get('users/edit/{usuario}', 'UserController@edit')->name('users.edit');

    Route::get('users/show/{usuario}', 'UserController@show')->name('users.show');

    Route::put('users/update/{usuario}', 'UserController@update')->name('users.update');

    Route::delete('users/destroy/{user}', 'UserController@destroy')->name('users.destroy');

    // Configuración de cuenta
    Route::GET('users/configurar/cuenta/{user}', 'UserController@config')->name('users.config');

    // contraseña
    Route::PUT('users/configurar/cuenta/update/{user}', 'UserController@cuenta_update')->name('users.config_update');

    // foto de perfil
    Route::POST('users/configurar/cuenta/update/foto/{user}', 'UserController@cuenta_update_foto')->name('users.config_update_foto');

    // CARRUSEL
    Route::get('carrusels', 'CarruselController@index')->name('carrusels.index');

    Route::get('carrusels/create', 'CarruselController@create')->name('carrusels.create');

    Route::post('carrusels/store', 'CarruselController@store')->name('carrusels.store');

    Route::get('carrusels/edit/{carrusel}', 'CarruselController@edit')->name('carrusels.edit');

    Route::put('carrusels/update/{carrusel}', 'CarruselController@update')->name('carrusels.update');

    Route::delete('carrusels/destroy/{carrusel}', 'CarruselController@destroy')->name('carrusels.destroy');

    // EMPLEADOS
    Route::get('empleados', 'EmpleadoController@index')->name('empleados.index');

    Route::get('empleados/create', 'EmpleadoController@create')->name('empleados.create');

    Route::post('empleados/store', 'EmpleadoController@store')->name('empleados.store');

    Route::get('empleados/edit/{empleado}', 'EmpleadoController@edit')->name('empleados.edit');

    Route::get('empleados/show/{empleado}', 'EmpleadoController@show')->name('empleados.show');

    Route::put('empleados/update/{empleado}', 'EmpleadoController@update')->name('empleados.update');

    Route::delete('empleados/destroy/{user}', 'EmpleadoController@destroy')->name('empleados.destroy');

    Route::get('empleados/empleado_info', 'EmpleadoController@empleado_info')->name('empleados.empleado_info');

    // EMPRESAS
    Route::get('empresas', 'EmpresaController@index')->name('empresas.index');

    Route::get('empresas/create', 'EmpresaController@create')->name('empresas.create');

    Route::post('empresas/store', 'EmpresaController@store')->name('empresas.store');

    Route::get('empresas/edit/{empresa}', 'EmpresaController@edit')->name('empresas.edit');

    Route::put('empresas/update/{empresa}', 'EmpresaController@update')->name('empresas.update');

    Route::delete('empresas/destroy/{empresa}', 'EmpresaController@destroy')->name('empresas.destroy');

    // DEPARTAMENTOS
    Route::get('departamentos', 'DepartamentoController@index')->name('departamentos.index');

    Route::get('departamentos/create', 'DepartamentoController@create')->name('departamentos.create');

    Route::post('departamentos/store', 'DepartamentoController@store')->name('departamentos.store');

    Route::get('departamentos/edit/{departamento}', 'DepartamentoController@edit')->name('departamentos.edit');

    Route::put('departamentos/update/{departamento}', 'DepartamentoController@update')->name('departamentos.update');

    Route::delete('departamentos/destroy/{departamento}', 'DepartamentoController@destroy')->name('departamentos.destroy');

    // DESIGNACIONES
    Route::get('designacions', 'DesignacionController@index')->name('designacions.index');

    Route::get('designacions/create', 'DesignacionController@create')->name('designacions.create');

    Route::post('designacions/store', 'DesignacionController@store')->name('designacions.store');

    Route::get('designacions/edit/{designacion}', 'DesignacionController@edit')->name('designacions.edit');

    Route::put('designacions/update/{designacion}', 'DesignacionController@update')->name('designacions.update');

    Route::delete('designacions/destroy/{designacion}', 'DesignacionController@destroy')->name('designacions.destroy');

    // SUELDOS
    Route::get('sueldos', 'SueldoController@index')->name('sueldos.index');

    Route::get('sueldos/create', 'SueldoController@create')->name('sueldos.create');

    Route::post('sueldos/store', 'SueldoController@store')->name('sueldos.store');

    Route::get('sueldos/edit/{sueldo}', 'SueldoController@edit')->name('sueldos.edit');

    Route::put('sueldos/update/{sueldo}', 'SueldoController@update')->name('sueldos.update');

    Route::delete('sueldos/destroy/{sueldo}', 'SueldoController@destroy')->name('sueldos.destroy');

    // HORARIOS
    Route::get('horarios', 'HorarioController@index')->name('horarios.index');

    Route::get('horarios/empleado/{empleado}', 'HorarioController@horarios_empleado')->name('horarios.horarios_empleado');

    Route::put('horarios/update/{horario}', 'HorarioController@update')->name('horarios.update');

    Route::delete('horarios/destroy/{horario}', 'HorarioController@destroy')->name('horarios.destroy');

    // CLIENTES
    Route::get('clientes', 'ClienteController@index')->name('clientes.index');

    Route::get('clientes/create', 'ClienteController@create')->name('clientes.create');

    Route::post('clientes/store', 'ClienteController@store')->name('clientes.store');

    Route::get('clientes/edit/{cliente}', 'ClienteController@edit')->name('clientes.edit');

    Route::get('clientes/show/{cliente}', 'ClienteController@show')->name('clientes.show');

    Route::put('clientes/update/{cliente}', 'ClienteController@update')->name('clientes.update');

    Route::delete('clientes/destroy/{cliente}', 'ClienteController@destroy')->name('clientes.destroy');

    // PROYECTOS
    Route::get('proyectos', 'ProyectoController@index')->name('proyectos.index');

    Route::get('proyectos/create', 'ProyectoController@create')->name('proyectos.create');

    Route::post('proyectos/store', 'ProyectoController@store')->name('proyectos.store');

    Route::get('proyectos/edit/{proyecto}', 'ProyectoController@edit')->name('proyectos.edit');

    Route::get('proyectos/show/{proyecto}', 'ProyectoController@show')->name('proyectos.show');

    Route::put('proyectos/update/{proyecto}', 'ProyectoController@update')->name('proyectos.update');

    Route::delete('proyectos/destroy/{proyecto}', 'ProyectoController@destroy')->name('proyectos.destroy');

    Route::get('proyectos/info_proyecto', 'ProyectoController@info_proyecto')->name('proyectos.info_proyecto');

    Route::get('proyectos/archivo/download/{proyecto}', 'ProyectoController@download')->name('proyectos.download');

    // PROYECTOS EQUIPOS
    Route::delete('proyectos_equipos/destroy/{proyectoEquipo}', 'ProyectoEquipoController@destroy')->name('proyectos_equipos.destroy');

    // ACTIVIDADES
    Route::get('actividads', 'ActividadController@index')->name('actividads.index');

    Route::get('actividads/create', 'ActividadController@create')->name('actividads.create');

    Route::post('actividads/store/{proyecto}', 'ActividadController@store')->name('actividads.store');

    Route::get('actividads/edit/{actividad}', 'ActividadController@edit')->name('actividads.edit');

    Route::put('actividads/update/{actividad}', 'ActividadController@update')->name('actividads.update');

    Route::post('actividads/update2/{actividad}', 'ActividadController@update2')->name('actividads.update2');

    Route::post('actividads/descargar/{actividad}', 'ActividadController@descargar')->name('actividads.descargar');

    Route::delete('actividads/destroy/{actividad}', 'ActividadController@destroy')->name('actividads.destroy');

    Route::get('actividads/actividadesProyecto/{proyecto}', 'ActividadController@actividadesProyecto')->name('actividads.actividadesProyecto');

    // EXAMENES
    Route::get('examens', 'ExamenController@index')->name('examens.index');

    Route::get('examens/create', 'ExamenController@create')->name('examens.create');

    Route::post('examens/store', 'ExamenController@store')->name('examens.store');

    Route::get('examens/edit/{examen}', 'ExamenController@edit')->name('examens.edit');

    Route::put('examens/update/{examen}', 'ExamenController@update')->name('examens.update');

    Route::delete('examens/destroy/{examen}', 'ExamenController@destroy')->name('examens.destroy');

    Route::get('examens/form_examen_edit', 'ExamenController@form_examen_edit')->name('examens.form_examen_edit');

    // EXAMENES EMPLEADOS
    Route::get('examen_empleados/{empleado}', 'ExamenEmpleadoController@index')->name('examen_empleados.index');

    Route::get('examen_empleados/evaluacion/{examen}', 'ExamenEmpleadoController@evaluacion')->name('examen_empleados.evaluacion');

    Route::post('examen_empleados/evaluacion_store', 'ExamenEmpleadoController@evaluacion_store')->name('examen_empleados.evaluacion_store');


    // PREGUNTAS
    Route::get('preguntas/destroy/{pregunta}', 'PreguntaController@destroy')->name('preguntas.destroy');

    Route::put('preguntas/update/{pregunta}', 'PreguntaController@update')->name('preguntas.update');

    Route::delete('preguntas/destroy/{pregunta}', 'PreguntaController@destroy')->name('preguntas.destroy');

    // ASISTENCIAS
    Route::get('asistencias', 'AsistenciaController@index')->name('asistencias.index');

    Route::get('asistencias/create', 'AsistenciaController@create')->name('asistencias.create');

    Route::post('asistencias/store', 'AsistenciaController@store')->name('asistencias.store');

    Route::get('asistencias/edit/{asistencia}', 'AsistenciaController@edit')->name('asistencias.edit');

    Route::put('asistencias/update/{asistencia}', 'AsistenciaController@update')->name('asistencias.update');

    Route::delete('asistencias/destroy/{asistencia}', 'AsistenciaController@destroy')->name('asistencias.destroy');

    Route::get('asistencias/empleado/{empleado}', 'AsistenciaController@asistencias_empleado')->name('asistencias.asistencias_empleado');

    Route::get('asistencias/getAsistenciasEmpleado/{empleado}', 'AsistenciaController@getAsistenciasEmpleado')->name('asistencias.getAsistenciasEmpleado');

    Route::get('asistencias/getHoraTipoEmpleado/{empleado}', 'AsistenciaController@getHoraTipoEmpleado')->name('asistencias.getHoraTipoEmpleado');

    // VACACIONES
    Route::get('vacacions', 'VacacionController@index')->name('vacacions.index');

    Route::get('vacacions/create', 'VacacionController@create')->name('vacacions.create');

    Route::post('vacacions/store', 'VacacionController@store')->name('vacacions.store');

    Route::get('vacacions/edit/{vacacion}', 'VacacionController@edit')->name('vacacions.edit');

    Route::put('vacacions/update/{vacacion}', 'VacacionController@update')->name('vacacions.update');

    Route::delete('vacacions/destroy/{vacacion}', 'VacacionController@destroy')->name('vacacions.destroy');

    Route::get('vacacions/empleado/{empleado}', 'VacacionController@vacacions_empleado')->name('vacacions.vacacions_empleado');

    Route::get('vacacions/fechas_vacacions/{empleado}', 'VacacionController@fechas_vacacions')->name('vacacions.fechas_vacacions');

    // KPI'S
    Route::get('kpis/cantidad_empleados', 'MachineLearningController@cantidad_empleados')->name('kpis.cantidad_empleados');

    Route::get('kpis/horas_trabajadas_empleados', 'MachineLearningController@horas_trabajadas_empleados')->name('kpis.horas_trabajadas_empleados');

    Route::get('kpis/ingresos_economicos', 'MachineLearningController@ingresos_economicos')->name('kpis.ingresos_economicos');

    Route::get('kpis/capacitacion_examen', 'MachineLearningController@capacitacion_examen')->name('kpis.capacitacion_examen');

    Route::get('kpis/asistencia_empleados', 'MachineLearningController@asistencia_empleados')->name('kpis.asistencia_empleados');

    Route::get('kpis/progreso_proyectos', 'MachineLearningController@progreso_proyectos')->name('kpis.progreso_proyectos');

    Route::get('kpis/ganancia_empleados', 'MachineLearningController@ganancia_empleados')->name('kpis.ganancia_empleados');

    Route::get('kpis/progreso_actividades', 'MachineLearningController@progreso_actividades')->name('kpis.progreso_actividades');

    // REPORTES
    Route::get('reportes', 'ReporteController@index')->name('reportes.index');

    Route::get('reportes/usuarios', 'ReporteController@usuarios')->name('reportes.usuarios');

    Route::get('reportes/empleados', 'ReporteController@empleados')->name('reportes.empleados');
});
