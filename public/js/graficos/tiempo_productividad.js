var chart_horas_trabajo_empleados = Morris.Bar({
    element: "chart_horas_trabajo_empleados",
    data: [
        {
            y: "Tiempo de productividad laboral",
            a: 0,
        },
    ],
    xkey: "y",
    ykeys: ["a"],
    labels: ["Total"],
    barColors: ["#009efb "],
    lineWidth: "3px",
    resize: true,
    redraw: true,
});

$(document).ready(function () {
    horas_trabajo_empleados();
});

function horas_trabajo_empleados() {
    getHorasTrabajoEmpleados();
    var fecha_ini = $("#f_horas_trabajo_empleados")
        .find(".fecha_ini")
        .parents(".cont_filtro");
    var fecha_fin = $("#f_horas_trabajo_empleados")
        .find(".fecha_fin")
        .parents(".cont_filtro");
    var empresa = $("#f_horas_trabajo_empleados")
        .find(".empresa")
        .parents(".cont_filtro");
    var departamento = $("#f_horas_trabajo_empleados")
        .find(".departamento")
        .parents(".cont_filtro");
    var designacion = $("#f_horas_trabajo_empleados")
        .find(".designacion")
        .parents(".cont_filtro");
    var empleado = $("#f_horas_trabajo_empleados")
        .find(".empleado")
        .parents(".cont_filtro");

    fecha_ini.hide();
    empresa.hide();
    departamento.hide();
    designacion.hide();
    empleado.hide();
    $("#f_horas_trabajo_empleados").on("change", ".filtro", function () {
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
        getHorasTrabajoEmpleados();
    });

    $("#f_horas_trabajo_empleados").on(
        "change blur",
        ".fecha_ini",
        function () {
            getHorasTrabajoEmpleados();
        }
    );
    $("#f_horas_trabajo_empleados").on(
        "change blur",
        ".fecha_fin",
        function () {
            getHorasTrabajoEmpleados();
        }
    );
    $("#f_horas_trabajo_empleados").on("change", ".empresa", function () {
        getHorasTrabajoEmpleados();
    });
    $("#f_horas_trabajo_empleados").on("change", ".departamento", function () {
        getHorasTrabajoEmpleados();
    });
    $("#f_horas_trabajo_empleados").on("change", ".designacion", function () {
        getHorasTrabajoEmpleados();
    });
    $("#f_horas_trabajo_empleados").on("change", ".empleado", function () {
        getHorasTrabajoEmpleados();
    });
}

function getHorasTrabajoEmpleados() {
    var filtro = $("#f_horas_trabajo_empleados").find(".filtro").val();
    var fecha_ini = $("#f_horas_trabajo_empleados").find(".fecha_ini").val();
    var fecha_fin = $("#f_horas_trabajo_empleados").find(".fecha_fin").val();
    var empresa = $("#f_horas_trabajo_empleados").find(".empresa").val();
    var departamento = $("#f_horas_trabajo_empleados")
        .find(".departamento")
        .val();
    var designacion = $("#f_horas_trabajo_empleados")
        .find(".designacion")
        .val();
    var empleado = $("#f_horas_trabajo_empleados").find(".empleado").val();
    $.ajax({
        type: "GET",
        url: $("#urlHorasTrabajadasEmpleados").val(),
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
                    y: "Total Horas Trabajo",
                    a: response.cantidad_horas + " Hrs.",
                },
            ];
            chart_horas_trabajo_empleados.setData(data);
        },
    });
}
1;
