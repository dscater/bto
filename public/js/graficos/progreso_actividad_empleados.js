var chat_progreso_actividades = Morris.Bar({
    element: "chat_progreso_actividades",
    data: [
        {
            y: "Cantidad de progreso de actividades de empleados",
            a: 0,
        },
    ],
    xkey: "y",
    ykeys: ["a"],
    labels: ["% Progreso"],
    barColors: ["#ffbc34"],
    lineWidth: "3px",
    resize: true,
    redraw: true,
});

$(document).ready(function () {
    f_progreso_actividades();
});

function f_progreso_actividades() {
    getProgresoActividades();
    var fecha_ini = $("#f_progreso_actividades")
        .find(".fecha_ini")
        .parents(".cont_filtro");
    var fecha_fin = $("#f_progreso_actividades")
        .find(".fecha_fin")
        .parents(".cont_filtro");
    var empresa = $("#f_progreso_actividades")
        .find(".empresa")
        .parents(".cont_filtro");
    var departamento = $("#f_progreso_actividades")
        .find(".departamento")
        .parents(".cont_filtro");
    var designacion = $("#f_progreso_actividades")
        .find(".designacion")
        .parents(".cont_filtro");
    var empleado = $("#f_progreso_actividades")
        .find(".empleado")
        .parents(".cont_filtro");

    fecha_ini.hide();
    empresa.hide();
    departamento.hide();
    designacion.hide();
    empleado.hide();
    $("#f_progreso_actividades").on("change", ".filtro", function () {
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
        getProgresoActividades();
    });

    $("#f_progreso_actividades").on("change blur", ".fecha_ini", function () {
        getProgresoActividades();
    });
    $("#f_progreso_actividades").on("change blur", ".fecha_fin", function () {
        getProgresoActividades();
    });
    $("#f_progreso_actividades").on("change", ".empresa", function () {
        getProgresoActividades();
    });
    $("#f_progreso_actividades").on("change", ".departamento", function () {
        getProgresoActividades();
    });
    $("#f_progreso_actividades").on("change", ".designacion", function () {
        getProgresoActividades();
    });
    $("#f_progreso_actividades").on("change", ".empleado", function () {
        getProgresoActividades();
    });
}

function getProgresoActividades() {
    var filtro = $("#f_progreso_actividades").find(".filtro").val();
    var fecha_ini = $("#f_progreso_actividades").find(".fecha_ini").val();
    var fecha_fin = $("#f_progreso_actividades").find(".fecha_fin").val();
    var empresa = $("#f_progreso_actividades").find(".empresa").val();
    var departamento = $("#f_progreso_actividades").find(".departamento").val();
    var designacion = $("#f_progreso_actividades").find(".designacion").val();
    var empleado = $("#f_progreso_actividades").find(".empleado").val();
    $.ajax({
        type: "GET",
        url: $("#urlProgresoActividades").val(),
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
            let data = [
                {
                    y: "Progreso Total",
                    a: parseFloat(response.total_progreso),
                },
            ];
            chat_progreso_actividades.setData(data);
        },
    });
}
