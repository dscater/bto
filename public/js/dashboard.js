let txt_horas_hoy = $('#txt_horas_hoy');
let p_horas_hoy = $('#p_horas_hoy');
let txt_horas_semana = $('#txt_horas_semana');
let p_horas_semana = $('#p_horas_semana');
let txt_horas_mes = $('#txt_horas_mes');
let p_horas_mes = $('#p_horas_mes');

// var chart_cantidad_empleados = Morris.Bar({
//     element: 'bar_charts_cantidad_empleados',
//     data: [{
//         y: 'Empleados',
//         a: 0
//     }, ],
//     xkey: 'y',
//     ykeys: ['a'],
//     labels: ['Total Empleados'],
//     lineColors: ['#667eea'],
//     lineWidth: '3px',
//     barColors: ['#667eea'],
//     resize: true,
//     redraw: true
// });

// var chart_horas_trabajo_empleados = Morris.Bar({
//     element: 'chart_horas_trabajo_empleados',
//     data: [{
//         y: 'Tiempo de productividad laboral',
//         a: 0,
//     }, ],
//     xkey: 'y',
//     ykeys: ['a'],
//     labels: ['Total'],
//     barColors: ['#009efb '],
//     lineWidth: '3px',
//     resize: true,
//     redraw: true
// });

var chart_ingresos_economicos = Morris.Bar({
    element: 'chart_total_ingresos',
    data: [{
        y: 'Total',
        a: 0,
    }, ],
    xkey: 'y',
    ykeys: ['a'],
    labels: ['Ingresos económicos'],
    barColors: ['#ffbc34'],
    lineWidth: '3px',
    resize: true,
    redraw: true
});

// var chart_examen_capacitacion = Morris.Bar({
//     element: 'chart_examen_capacitacion',
//     data: [{
//         y: 'Capacitación',
//         a: 0,
//     }, ],
//     xkey: 'y',
//     ykeys: ['a'],
//     labels: ['% total'],
//     barColors: ['#55ce63'],
//     lineWidth: '3px',
//     resize: true,
//     redraw: true
// });

// var chart_asistencia_empleados = Morris.Bar({
//     element: 'chart_asistencia_empleados',
//     data: [{
//         y: 'Asistencias',
//         a: 0,
//     }, ],
//     xkey: 'y',
//     ykeys: ['a'],
//     labels: ['Asistencia de empleados'],
//     barColors: ['#ef5350'],
//     lineWidth: '3px',
//     resize: true,
//     redraw: true
// });

var chart_progreso_proyectos = Morris.Bar({
    element: 'chart_progreso_proyectos',
    data: [{
        y: 'Progreso de proyectos',
        a: 0,
    }, ],
    xkey: 'y',
    ykeys: ['a'],
    labels: ['% desarrollo'],
    barColors: ['#667eea'],
    lineWidth: '3px',
    resize: true,
    redraw: true
});

// chart_ganancia_empleados = Morris.Bar({
//     element: 'chart_ganancia_empleados',
//     data: [{
//         y: 'Ganancia de Empleados',
//         a: 0,
//     }, ],
//     xkey: 'y',
//     ykeys: ['a'],
//     labels: ['Total Ganancia'],
//     barColors: ['#009efb'],
//     lineWidth: '3px',
//     resize: true,
//     redraw: true
// });

// var chat_progreso_actividades = Morris.Bar({
//     element: 'chat_progreso_actividades',
//     data: [{
//         y: 'Cantidad de progreso de actividades de empleados',
//         a: 0,
//     }, ],
//     xkey: 'y',
//     ykeys: ['a'],
//     labels: ['% Progreso'],
//     barColors: ['#ffbc34'],
//     lineWidth: '3px',
//     resize: true,
//     redraw: true
// });

$(document).ready(function () {
    // cantidad_empleados();
    // horas_trabajo_empleados();
    f_ingresos_economicos();
    // f_asistencia_empleados();
    f_desarrollo_proyectos();
    // f_ganancia_empleados();
    // f_progreso_actividades();
    // f_examen_capacitacion();
});

function cantidad_empleados() {
    getCantidadEmpleados();
    var fecha_ini = $('#f_cantidad_empleados').find('.fecha_ini').parents('.cont_filtro');
    var fecha_fin = $('#f_cantidad_empleados').find('.fecha_fin').parents('.cont_filtro');
    var estado = $('#f_cantidad_empleados').find('.estado').parents('.cont_filtro');

    fecha_ini.hide();
    estado.hide();
    $('#f_cantidad_empleados').on('change', '.filtro', function () {
        let filtro = $(this).val();
        switch (filtro) {
            case 'todos':
                fecha_ini.hide();
                estado.hide();
                break;
            case 'fecha':
                fecha_ini.show();
                estado.hide();
                break;
            case 'estado':
                fecha_ini.hide();
                estado.show();
                break;
        }
        getCantidadEmpleados();
    });
    $('#f_cantidad_empleados').on('change blur', '.cont_filtro .row .col-md-6 .fecha_ini', function () {
        getCantidadEmpleados();
    });
    $('#f_cantidad_empleados').on('change blur', '.fecha_fin', function () {
        getCantidadEmpleados();
    });
    $('#f_cantidad_empleados').on('change', '.estado', function () {
        getCantidadEmpleados();
    });
}

function getCantidadEmpleados() {
    var filtro = $('#f_cantidad_empleados').find('.filtro').val();
    var fecha_ini = $('#f_cantidad_empleados').find('.fecha_ini').val();
    var fecha_fin = $('#f_cantidad_empleados').find('.fecha_fin').val();
    var estado = $('#f_cantidad_empleados').find('.estado').val();
    $.ajax({
        type: "GET",
        url: $('#urlCantidadEmpleados').val(),
        data: {
            filtro: filtro,
            fecha_ini: fecha_ini,
            fecha_fin: fecha_fin,
            estado: estado,
        },
        dataType: "json",
        success: function (response) {
            let data = [{
                y: 'Empleados',
                a: response.cantidad_empleados
            }];
            chart_cantidad_empleados.setData(data);
        }
    });
}

function horas_trabajo_empleados() {
    getHorasTrabajoEmpleados();
    var fecha_ini = $('#f_horas_trabajo_empleados').find('.fecha_ini').parents('.cont_filtro');
    var fecha_fin = $('#f_horas_trabajo_empleados').find('.fecha_fin').parents('.cont_filtro');
    var empresa = $('#f_horas_trabajo_empleados').find('.empresa').parents('.cont_filtro');
    var departamento = $('#f_horas_trabajo_empleados').find('.departamento').parents('.cont_filtro');
    var designacion = $('#f_horas_trabajo_empleados').find('.designacion').parents('.cont_filtro');
    var empleado = $('#f_horas_trabajo_empleados').find('.empleado').parents('.cont_filtro');

    fecha_ini.hide();
    empresa.hide();
    departamento.hide();
    designacion.hide();
    empleado.hide();
    $('#f_horas_trabajo_empleados').on('change', '.filtro', function () {
        let filtro = $(this).val();
        switch (filtro) {
            case 'todos':
                fecha_ini.hide();
                empresa.hide();
                departamento.hide();
                designacion.hide();
                empleado.hide();
                break;
            case 'fecha':
                fecha_ini.show();
                empresa.hide();
                departamento.hide();
                designacion.hide();
                empleado.hide();
                break;
            case 'empresa':
                fecha_ini.hide();
                empresa.show();
                departamento.hide();
                designacion.hide();
                empleado.hide();
                break;
            case 'departamento':
                fecha_ini.hide();
                empresa.hide();
                departamento.show();
                designacion.hide();
                empleado.hide();
                break;
            case 'designacion':
                fecha_ini.hide();
                empresa.hide();
                departamento.hide();
                designacion.show();
                empleado.hide();
                break;
            case 'empleado':
                fecha_ini.hide();
                empresa.hide();
                departamento.hide();
                designacion.hide();
                empleado.show();
                break;
        }
        getHorasTrabajoEmpleados();
    });

    $('#f_horas_trabajo_empleados').on('change blur', '.fecha_ini', function () {
        getHorasTrabajoEmpleados();
    });
    $('#f_horas_trabajo_empleados').on('change blur', '.fecha_fin', function () {
        getHorasTrabajoEmpleados();
    });
    $('#f_horas_trabajo_empleados').on('change', '.empresa', function () {
        getHorasTrabajoEmpleados();
    });
    $('#f_horas_trabajo_empleados').on('change', '.departamento', function () {
        getHorasTrabajoEmpleados();
    });
    $('#f_horas_trabajo_empleados').on('change', '.designacion', function () {
        getHorasTrabajoEmpleados();
    });
    $('#f_horas_trabajo_empleados').on('change', '.empleado', function () {
        getHorasTrabajoEmpleados();
    });
}

function getHorasTrabajoEmpleados() {
    var filtro = $('#f_horas_trabajo_empleados').find('.filtro').val();
    var fecha_ini = $('#f_horas_trabajo_empleados').find('.fecha_ini').val();
    var fecha_fin = $('#f_horas_trabajo_empleados').find('.fecha_fin').val();
    var empresa = $('#f_horas_trabajo_empleados').find('.empresa').val();
    var departamento = $('#f_horas_trabajo_empleados').find('.departamento').val();
    var designacion = $('#f_horas_trabajo_empleados').find('.designacion').val();
    var empleado = $('#f_horas_trabajo_empleados').find('.empleado').val();
    $.ajax({
        type: "GET",
        url: $('#urlHorasTrabajadasEmpleados').val(),
        data: {
            filtro: filtro,
            fecha_ini: fecha_ini,
            fecha_fin: fecha_fin,
            empresa: empresa,
            empresa: empresa,
            departamento: departamento,
            designacion: designacion,
            empleado: empleado,
        },
        dataType: "json",
        success: function (response) {
            let data = [{
                y: 'Total Horas Trabajo',
                a: response.cantidad_horas + ' Hrs.'
            }];
            chart_horas_trabajo_empleados.setData(data);
        }
    });
}

function f_ingresos_economicos() {
    getfIngresosEconomicos();
    var fecha_ini = $('#f_ingresos_economicos').find('.fecha_ini').parents('.cont_filtro');
    var fecha_fin = $('#f_ingresos_economicos').find('.fecha_fin').parents('.cont_filtro');
    var empresa = $('#f_ingresos_economicos').find('.empresa').parents('.cont_filtro');
    var departamento = $('#f_ingresos_economicos').find('.departamento').parents('.cont_filtro');
    var designacion = $('#f_ingresos_economicos').find('.designacion').parents('.cont_filtro');
    var empleado = $('#f_ingresos_economicos').find('.empleado').parents('.cont_filtro');

    fecha_ini.hide();
    empresa.hide();
    departamento.hide();
    designacion.hide();
    empleado.hide();
    $('#f_ingresos_economicos').on('change', '.filtro', function () {
        let filtro = $(this).val();
        switch (filtro) {
            case 'todos':
                fecha_ini.hide();
                empresa.hide();
                departamento.hide();
                designacion.hide();
                empleado.hide();
                break;
            case 'fecha':
                fecha_ini.show();
                empresa.hide();
                departamento.hide();
                designacion.hide();
                empleado.hide();
                break;
            case 'empresa':
                fecha_ini.hide();
                empresa.show();
                departamento.hide();
                designacion.hide();
                empleado.hide();
                break;
            case 'departamento':
                fecha_ini.hide();
                empresa.hide();
                departamento.show();
                designacion.hide();
                empleado.hide();
                break;
            case 'designacion':
                fecha_ini.hide();
                empresa.hide();
                departamento.hide();
                designacion.show();
                empleado.hide();
                break;
            case 'empleado':
                fecha_ini.hide();
                empresa.hide();
                departamento.hide();
                designacion.hide();
                empleado.show();
                break;
        }
        getfIngresosEconomicos();
    });

    $('#f_ingresos_economicos').on('change blur', '.fecha_ini', function () {
        getfIngresosEconomicos();
    });
    $('#f_ingresos_economicos').on('change blur', '.fecha_fin', function () {
        getfIngresosEconomicos();
    });
    $('#f_ingresos_economicos').on('change', '.empresa', function () {
        getfIngresosEconomicos();
    });
    $('#f_ingresos_economicos').on('change', '.departamento', function () {
        getfIngresosEconomicos();
    });
    $('#f_ingresos_economicos').on('change', '.designacion', function () {
        getfIngresosEconomicos();
    });
    $('#f_ingresos_economicos').on('change', '.empleado', function () {
        getfIngresosEconomicos();
    });
}

function getfIngresosEconomicos() {
    var filtro = $('#f_ingresos_economicos').find('.filtro').val();
    var fecha_ini = $('#f_ingresos_economicos').find('.fecha_ini').val();
    var fecha_fin = $('#f_ingresos_economicos').find('.fecha_fin').val();
    var empresa = $('#f_ingresos_economicos').find('.empresa').val();
    var departamento = $('#f_ingresos_economicos').find('.departamento').val();
    var designacion = $('#f_ingresos_economicos').find('.designacion').val();
    var empleado = $('#f_ingresos_economicos').find('.empleado').val();
    $.ajax({
        type: "GET",
        url: $('#urlIngresosEconomicos').val(),
        data: {
            filtro: filtro,
            fecha_ini: fecha_ini,
            fecha_fin: fecha_fin,
            empresa: empresa,
            empresa: empresa,
            departamento: departamento,
            designacion: designacion,
            empleado: empleado,
        },
        dataType: "json",
        success: function (response) {
            let data = [{
                y: 'Ingresos económicos',
                a: response.total_ingresos
            }];
            chart_ingresos_economicos.setData(data);
        }
    });
}

function f_examen_capacitacion() {
    getExamenCapacitacion();
    var fecha_ini = $('#f_examen_capacitacion').find('.fecha_ini').parents('.cont_filtro');
    var fecha_fin = $('#f_examen_capacitacion').find('.fecha_fin').parents('.cont_filtro');
    var empresa = $('#f_examen_capacitacion').find('.empresa').parents('.cont_filtro');
    var departamento = $('#f_examen_capacitacion').find('.departamento').parents('.cont_filtro');
    var designacion = $('#f_examen_capacitacion').find('.designacion').parents('.cont_filtro');
    var empleado = $('#f_examen_capacitacion').find('.empleado').parents('.cont_filtro');

    fecha_ini.hide();
    empresa.hide();
    departamento.hide();
    designacion.hide();
    empleado.hide();
    $('#f_examen_capacitacion').on('change', '.filtro', function () {
        let filtro = $(this).val();
        switch (filtro) {
            case 'todos':
                fecha_ini.hide();
                empresa.hide();
                departamento.hide();
                designacion.hide();
                empleado.hide();
                break;
            case 'fecha':
                fecha_ini.show();
                empresa.hide();
                departamento.hide();
                designacion.hide();
                empleado.hide();
                break;
            case 'empresa':
                fecha_ini.hide();
                empresa.show();
                departamento.hide();
                designacion.hide();
                empleado.hide();
                break;
            case 'departamento':
                fecha_ini.hide();
                empresa.hide();
                departamento.show();
                designacion.hide();
                empleado.hide();
                break;
            case 'designacion':
                fecha_ini.hide();
                empresa.hide();
                departamento.hide();
                designacion.show();
                empleado.hide();
                break;
            case 'empleado':
                fecha_ini.hide();
                empresa.hide();
                departamento.hide();
                designacion.hide();
                empleado.show();
                break;
        }
        getExamenCapacitacion();
    });

    $('#f_examen_capacitacion').on('change blur', '.fecha_ini', function () {
        getExamenCapacitacion();
    });
    $('#f_examen_capacitacion').on('change blur', '.fecha_fin', function () {
        getExamenCapacitacion();
    });
    $('#f_examen_capacitacion').on('change', '.empresa', function () {
        getExamenCapacitacion();
    });
    $('#f_examen_capacitacion').on('change', '.departamento', function () {
        getExamenCapacitacion();
    });
    $('#f_examen_capacitacion').on('change', '.designacion', function () {
        getExamenCapacitacion();
    });
    $('#f_examen_capacitacion').on('change', '.empleado', function () {
        getExamenCapacitacion();
    });
}

function getExamenCapacitacion() {
    var filtro = $('#f_examen_capacitacion').find('.filtro').val();
    var fecha_ini = $('#f_examen_capacitacion').find('.fecha_ini').val();
    var fecha_fin = $('#f_examen_capacitacion').find('.fecha_fin').val();
    var empresa = $('#f_examen_capacitacion').find('.empresa').val();
    var departamento = $('#f_examen_capacitacion').find('.departamento').val();
    var designacion = $('#f_examen_capacitacion').find('.designacion').val();
    var empleado = $('#f_examen_capacitacion').find('.empleado').val();
    $.ajax({
        type: "GET",
        url: $('#urlExamenCapacitacion').val(),
        data: {
            filtro: filtro,
            fecha_ini: fecha_ini,
            fecha_fin: fecha_fin,
            empresa: empresa,
            empresa: empresa,
            departamento: departamento,
            designacion: designacion,
            empleado: empleado,
        },
        dataType: "json",
        success: function (response) {
            let data = [{
                y: 'Total capacitacion',
                a: response.total_capacitacion
            }];
            chart_examen_capacitacion.setData(data);
        }
    });
}

function f_asistencia_empleados() {
    getAsistenciaEmpleados();
    var fecha_ini = $('#f_asistencia_empleados').find('.fecha_ini').parents('.cont_filtro');
    var fecha_fin = $('#f_asistencia_empleados').find('.fecha_fin').parents('.cont_filtro');
    var empresa = $('#f_asistencia_empleados').find('.empresa').parents('.cont_filtro');
    var departamento = $('#f_asistencia_empleados').find('.departamento').parents('.cont_filtro');
    var designacion = $('#f_asistencia_empleados').find('.designacion').parents('.cont_filtro');
    var empleado = $('#f_asistencia_empleados').find('.empleado').parents('.cont_filtro');

    fecha_ini.hide();
    empresa.hide();
    departamento.hide();
    designacion.hide();
    empleado.hide();
    $('#f_asistencia_empleados').on('change', '.filtro', function () {
        let filtro = $(this).val();
        switch (filtro) {
            case 'todos':
                fecha_ini.hide();
                empresa.hide();
                departamento.hide();
                designacion.hide();
                empleado.hide();
                break;
            case 'fecha':
                fecha_ini.show();
                empresa.hide();
                departamento.hide();
                designacion.hide();
                empleado.hide();
                break;
            case 'empresa':
                fecha_ini.hide();
                empresa.show();
                departamento.hide();
                designacion.hide();
                empleado.hide();
                break;
            case 'departamento':
                fecha_ini.hide();
                empresa.hide();
                departamento.show();
                designacion.hide();
                empleado.hide();
                break;
            case 'designacion':
                fecha_ini.hide();
                empresa.hide();
                departamento.hide();
                designacion.show();
                empleado.hide();
                break;
            case 'empleado':
                fecha_ini.hide();
                empresa.hide();
                departamento.hide();
                designacion.hide();
                empleado.show();
                break;
        }
        getAsistenciaEmpleados();
    });

    $('#f_asistencia_empleados').on('change blur', '.fecha_ini', function () {
        getAsistenciaEmpleados();
    });
    $('#f_asistencia_empleados').on('change blur', '.fecha_fin', function () {
        getAsistenciaEmpleados();
    });
    $('#f_asistencia_empleados').on('change', '.empresa', function () {
        getAsistenciaEmpleados();
    });
    $('#f_asistencia_empleados').on('change', '.departamento', function () {
        getAsistenciaEmpleados();
    });
    $('#f_asistencia_empleados').on('change', '.designacion', function () {
        getAsistenciaEmpleados();
    });
    $('#f_asistencia_empleados').on('change', '.empleado', function () {
        getAsistenciaEmpleados();
    });
}

function getAsistenciaEmpleados() {
    var filtro = $('#f_asistencia_empleados').find('.filtro').val();
    var fecha_ini = $('#f_asistencia_empleados').find('.fecha_ini').val();
    var fecha_fin = $('#f_asistencia_empleados').find('.fecha_fin').val();
    var empresa = $('#f_asistencia_empleados').find('.empresa').val();
    var departamento = $('#f_asistencia_empleados').find('.departamento').val();
    var designacion = $('#f_asistencia_empleados').find('.designacion').val();
    var empleado = $('#f_asistencia_empleados').find('.empleado').val();
    $.ajax({
        type: "GET",
        url: $('#urlAsistenciaEmpleados').val(),
        data: {
            filtro: filtro,
            fecha_ini: fecha_ini,
            fecha_fin: fecha_fin,
            empresa: empresa,
            empresa: empresa,
            departamento: departamento,
            designacion: designacion,
            empleado: empleado,
        },
        dataType: "json",
        success: function (response) {
            let data = [{
                y: 'Total asistencias',
                a: response.total_asistencias
            }];
            chart_asistencia_empleados.setData(data);
        }
    });
}

function f_desarrollo_proyectos() {
    getDesarrolloProyectos();
    var empresa = $('#f_desarrollo_proyectos').find('.empresa').parents('.cont_filtro');
    var departamento = $('#f_desarrollo_proyectos').find('.departamento').parents('.cont_filtro');
    var designacion = $('#f_desarrollo_proyectos').find('.designacion').parents('.cont_filtro');
    var proyecto = $('#f_desarrollo_proyectos').find('.proyecto').parents('.cont_filtro');

    empresa.hide();
    departamento.hide();
    designacion.hide();
    proyecto.hide();
    $('#f_desarrollo_proyectos').on('change', '.filtro', function () {
        let filtro = $(this).val();
        switch (filtro) {
            case 'todos':
                empresa.hide();
                departamento.hide();
                designacion.hide();
                proyecto.hide();
                break;
            case 'empresa':
                empresa.show();
                departamento.hide();
                designacion.hide();
                proyecto.hide();
                break;
            case 'departamento':
                empresa.hide();
                departamento.show();
                designacion.hide();
                proyecto.hide();
                break;
            case 'designacion':
                empresa.hide();
                departamento.hide();
                designacion.show();
                proyecto.hide();
                break;
            case 'proyecto':
                empresa.hide();
                departamento.hide();
                designacion.hide();
                proyecto.show();
                break;
        }
        getDesarrolloProyectos();
    });

    $('#f_desarrollo_proyectos').on('change', '.empresa', function () {
        getDesarrolloProyectos();
    });
    $('#f_desarrollo_proyectos').on('change', '.departamento', function () {
        getDesarrolloProyectos();
    });
    $('#f_desarrollo_proyectos').on('change', '.designacion', function () {
        getDesarrolloProyectos();
    });
    $('#f_desarrollo_proyectos').on('change', '.proyecto', function () {
        getDesarrolloProyectos();
    });
}

function getDesarrolloProyectos() {
    var filtro = $('#f_desarrollo_proyectos').find('.filtro').val();
    var empresa = $('#f_desarrollo_proyectos').find('.empresa').val();
    var departamento = $('#f_desarrollo_proyectos').find('.departamento').val();
    var designacion = $('#f_desarrollo_proyectos').find('.designacion').val();
    var proyecto = $('#f_desarrollo_proyectos').find('.proyecto').val();
    $.ajax({
        type: "GET",
        url: $('#urlProgresoProyectos').val(),
        data: {
            filtro: filtro,
            empresa: empresa,
            departamento: departamento,
            designacion: designacion,
            proyecto: proyecto,
        },
        dataType: "json",
        success: function (response) {
            let data = [{
                y: 'Desarrollo de progreso de proyectos',
                a: response.total_progreso
            }];
            chart_progreso_proyectos.setData(data);
        }
    });
}

function f_ganancia_empleados() {
    getGananciaEmpleados();
    var fecha_ini = $('#f_ganancia_empleados').find('.fecha_ini').parents('.cont_filtro');
    var fecha_fin = $('#f_ganancia_empleados').find('.fecha_fin').parents('.cont_filtro');
    var proyecto = $('#f_ganancia_empleados').find('.proyecto').parents('.cont_filtro');
    var empleado = $('#f_ganancia_empleados').find('.empleado').parents('.cont_filtro');

    fecha_ini.hide();
    proyecto.hide();
    empleado.hide();
    $('#f_ganancia_empleados').on('change', '.filtro', function () {
        let filtro = $(this).val();
        switch (filtro) {
            case 'todos':
                fecha_ini.hide();
                proyecto.hide();
                empleado.hide();
                break;
            case 'fecha':
                fecha_ini.show();
                proyecto.hide();
                empleado.hide();
                break;
            case 'proyecto':
                proyecto.show();
                fecha_ini.hide();
                empleado.hide();
                break;
            case 'empleado':
                fecha_ini.hide();
                empleado.show();
                proyecto.hide();
                break;
        }
        getGananciaEmpleados();
    });

    $('#f_ganancia_empleados').on('change blur', '.fecha_ini', function () {
        getGananciaEmpleados();
    });
    $('#f_ganancia_empleados').on('change blur', '.fecha_fin', function () {
        getGananciaEmpleados();
    });
    $('#f_ganancia_empleados').on('change', '.proyecto', function () {
        getGananciaEmpleados();
    });
    $('#f_ganancia_empleados').on('change', '.empleado', function () {
        getGananciaEmpleados();
    });
}

function getGananciaEmpleados() {
    var filtro = $('#f_ganancia_empleados').find('.filtro').val();
    var fecha_ini = $('#f_ganancia_empleados').find('.fecha_ini').val();
    var fecha_fin = $('#f_ganancia_empleados').find('.fecha_fin').val();
    var proyecto = $('#f_ganancia_empleados').find('.proyecto').val();
    var empleado = $('#f_ganancia_empleados').find('.empleado').val();
    $.ajax({
        type: "GET",
        url: $('#urlGananciaEmpleados').val(),
        data: {
            filtro: filtro,
            fecha_ini: fecha_ini,
            fecha_fin: fecha_fin,
            empleado: empleado,
            proyecto: proyecto,
        },
        dataType: "json",
        success: function (response) {
            let data = [{
                y: 'Ganancia Total',
                a: parseFloat(response.ganancia_total)
            }];
            chart_ganancia_empleados.setData(data);
        }
    });
}

function f_progreso_actividades() {
    getProgresoActividades();
    var fecha_ini = $('#f_progreso_actividades').find('.fecha_ini').parents('.cont_filtro');
    var fecha_fin = $('#f_progreso_actividades').find('.fecha_fin').parents('.cont_filtro');
    var empresa = $('#f_progreso_actividades').find('.empresa').parents('.cont_filtro');
    var departamento = $('#f_progreso_actividades').find('.departamento').parents('.cont_filtro');
    var designacion = $('#f_progreso_actividades').find('.designacion').parents('.cont_filtro');
    var empleado = $('#f_progreso_actividades').find('.empleado').parents('.cont_filtro');

    fecha_ini.hide();
    empresa.hide();
    departamento.hide();
    designacion.hide();
    empleado.hide();
    $('#f_progreso_actividades').on('change', '.filtro', function () {
        let filtro = $(this).val();
        switch (filtro) {
            case 'todos':
                fecha_ini.hide();
                empresa.hide();
                departamento.hide();
                designacion.hide();
                empleado.hide();
                break;
            case 'fecha':
                fecha_ini.show();
                empresa.hide();
                departamento.hide();
                designacion.hide();
                empleado.hide();
                break;
            case 'empresa':
                fecha_ini.hide();
                empresa.show();
                departamento.hide();
                designacion.hide();
                empleado.hide();
                break;
            case 'departamento':
                fecha_ini.hide();
                empresa.hide();
                departamento.show();
                designacion.hide();
                empleado.hide();
                break;
            case 'designacion':
                fecha_ini.hide();
                empresa.hide();
                departamento.hide();
                designacion.show();
                empleado.hide();
                break;
            case 'empleado':
                fecha_ini.hide();
                empresa.hide();
                departamento.hide();
                designacion.hide();
                empleado.show();
                break;
        }
        getProgresoActividades();
    });

    $('#f_progreso_actividades').on('change blur', '.fecha_ini', function () {
        getProgresoActividades();
    });
    $('#f_progreso_actividades').on('change blur', '.fecha_fin', function () {
        getProgresoActividades();
    });
    $('#f_progreso_actividades').on('change', '.empresa', function () {
        getProgresoActividades();
    });
    $('#f_progreso_actividades').on('change', '.departamento', function () {
        getProgresoActividades();
    });
    $('#f_progreso_actividades').on('change', '.designacion', function () {
        getProgresoActividades();
    });
    $('#f_progreso_actividades').on('change', '.empleado', function () {
        getProgresoActividades();
    });
}

function getProgresoActividades() {
    var filtro = $('#f_progreso_actividades').find('.filtro').val();
    var fecha_ini = $('#f_progreso_actividades').find('.fecha_ini').val();
    var fecha_fin = $('#f_progreso_actividades').find('.fecha_fin').val();
    var empresa = $('#f_progreso_actividades').find('.empresa').val();
    var departamento = $('#f_progreso_actividades').find('.departamento').val();
    var designacion = $('#f_progreso_actividades').find('.designacion').val();
    var empleado = $('#f_progreso_actividades').find('.empleado').val();
    $.ajax({
        type: "GET",
        url: $('#urlProgresoActividades').val(),
        data: {
            filtro: filtro,
            fecha_ini: fecha_ini,
            fecha_fin: fecha_fin,
            empresa: empresa,
            departamento: departamento,
            designacion: designacion,
            empleado: empleado,
        },
        dataType: "json",
        success: function (response) {
            let data = [{
                y: 'Progreso Total',
                a: parseFloat(response.total_progreso)
            }];
            chat_progreso_actividades.setData(data);
        }
    });
}
