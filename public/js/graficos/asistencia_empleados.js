var chart_asistencia_empleados = Morris.Bar({
    element: "chart_asistencia_empleados",
    data: [
        {
            y: "Asistencias",
            a: 0,
        },
    ],
    xkey: "y",
    ykeys: ["a"],
    labels: ["Asistencia de empleados"],
    barColors: ["#ef5350"],
    lineWidth: "3px",
    resize: true,
    redraw: true,
});

$(document).ready(function () {
    f_asistencia_empleados();
});

function f_asistencia_empleados() {
    getAsistenciaEmpleados();
    var fecha_ini = $("#f_asistencia_empleados")
        .find(".fecha_ini")
        .parents(".cont_filtro");
    var fecha_fin = $("#f_asistencia_empleados")
        .find(".fecha_fin")
        .parents(".cont_filtro");
    var empresa = $("#f_asistencia_empleados")
        .find(".empresa")
        .parents(".cont_filtro");
    var departamento = $("#f_asistencia_empleados")
        .find(".departamento")
        .parents(".cont_filtro");
    var designacion = $("#f_asistencia_empleados")
        .find(".designacion")
        .parents(".cont_filtro");
    var empleado = $("#f_asistencia_empleados")
        .find(".empleado")
        .parents(".cont_filtro");

    fecha_ini.hide();
    empresa.hide();
    departamento.hide();
    designacion.hide();
    empleado.hide();
    $("#f_asistencia_empleados").on("change", ".filtro", function () {
        let filtro = $(this).val();
        switch (filtro) {
            case "todos":
                fecha_ini.hide();
                empresa.hide();
                departamento.hide();
                designacion.hide();
                empleado.hide();
                break;
            case "pronostico":
                fecha_ini.hide();
                empresa.hide();
                departamento.hide();
                designacion.hide();
                empleado.hide();
                break;
            case "fecha":
                fecha_ini.show();
                empresa.hide();
                departamento.hide();
                designacion.hide();
                empleado.hide();
                break;
            case "empresa":
                fecha_ini.hide();
                empresa.show();
                departamento.hide();
                designacion.hide();
                empleado.hide();
                break;
            case "departamento":
                fecha_ini.hide();
                empresa.hide();
                departamento.show();
                designacion.hide();
                empleado.hide();
                break;
            case "designacion":
                fecha_ini.hide();
                empresa.hide();
                departamento.hide();
                designacion.show();
                empleado.hide();
                break;
            case "empleado":
                fecha_ini.hide();
                empresa.hide();
                departamento.hide();
                designacion.hide();
                empleado.show();
                break;
        }
        getAsistenciaEmpleados();
    });

    $("#f_asistencia_empleados").on("change blur", ".fecha_ini", function () {
        getAsistenciaEmpleados();
    });
    $("#f_asistencia_empleados").on("change blur", ".fecha_fin", function () {
        getAsistenciaEmpleados();
    });
    $("#f_asistencia_empleados").on("change", ".empresa", function () {
        getAsistenciaEmpleados();
    });
    $("#f_asistencia_empleados").on("change", ".departamento", function () {
        getAsistenciaEmpleados();
    });
    $("#f_asistencia_empleados").on("change", ".designacion", function () {
        getAsistenciaEmpleados();
    });
    $("#f_asistencia_empleados").on("change", ".empleado", function () {
        getAsistenciaEmpleados();
    });
}

function getAsistenciaEmpleados() {
    var filtro = $("#f_asistencia_empleados").find(".filtro").val();
    var fecha_ini = $("#f_asistencia_empleados").find(".fecha_ini").val();
    var fecha_fin = $("#f_asistencia_empleados").find(".fecha_fin").val();
    var empresa = $("#f_asistencia_empleados").find(".empresa").val();
    var departamento = $("#f_asistencia_empleados").find(".departamento").val();
    var designacion = $("#f_asistencia_empleados").find(".designacion").val();
    var empleado = $("#f_asistencia_empleados").find(".empleado").val();
    $.ajax({
        type: "GET",
        url: $("#urlAsistenciaEmpleados").val(),
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
            let data = [
                {
                    y: "Total asistencias",
                    a: response.total_asistencias,
                },
            ];
            chart_asistencia_empleados.setData(data);
        },
    });
}
