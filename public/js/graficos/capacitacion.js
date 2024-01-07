var chart_examen_capacitacion = Morris.Bar({
    element: "chart_examen_capacitacion",
    data: [
        {
            y: "Capacitación",
            a: 0,
        },
    ],
    xkey: "y",
    ykeys: ["a"],
    labels: ["% total"],
    barColors: ["#55ce63"],
    lineWidth: "3px",
    resize: true,
    redraw: true,
});
$(document).ready(function () {
    f_examen_capacitacion();
});

function f_examen_capacitacion() {
    getExamenCapacitacion();
    var fecha_ini = $("#f_examen_capacitacion")
        .find(".fecha_ini")
        .parents(".cont_filtro");
    var fecha_fin = $("#f_examen_capacitacion")
        .find(".fecha_fin")
        .parents(".cont_filtro");
    var empresa = $("#f_examen_capacitacion")
        .find(".empresa")
        .parents(".cont_filtro");
    var departamento = $("#f_examen_capacitacion")
        .find(".departamento")
        .parents(".cont_filtro");
    var designacion = $("#f_examen_capacitacion")
        .find(".designacion")
        .parents(".cont_filtro");
    var empleado = $("#f_examen_capacitacion")
        .find(".empleado")
        .parents(".cont_filtro");

    fecha_ini.hide();
    empresa.hide();
    departamento.hide();
    designacion.hide();
    empleado.hide();
    $("#f_examen_capacitacion").on("change", ".filtro", function () {
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
        getExamenCapacitacion();
    });

    $("#f_examen_capacitacion").on("change blur", ".fecha_ini", function () {
        getExamenCapacitacion();
    });
    $("#f_examen_capacitacion").on("change blur", ".fecha_fin", function () {
        getExamenCapacitacion();
    });
    $("#f_examen_capacitacion").on("change", ".empresa", function () {
        getExamenCapacitacion();
    });
    $("#f_examen_capacitacion").on("change", ".departamento", function () {
        getExamenCapacitacion();
    });
    $("#f_examen_capacitacion").on("change", ".designacion", function () {
        getExamenCapacitacion();
    });
    $("#f_examen_capacitacion").on("change", ".empleado", function () {
        getExamenCapacitacion();
    });
}

function getExamenCapacitacion() {
    var filtro = $("#f_examen_capacitacion").find(".filtro").val();
    var fecha_ini = $("#f_examen_capacitacion").find(".fecha_ini").val();
    var fecha_fin = $("#f_examen_capacitacion").find(".fecha_fin").val();
    var empresa = $("#f_examen_capacitacion").find(".empresa").val();
    var departamento = $("#f_examen_capacitacion").find(".departamento").val();
    var designacion = $("#f_examen_capacitacion").find(".designacion").val();
    var empleado = $("#f_examen_capacitacion").find(".empleado").val();
    $.ajax({
        type: "GET",
        url: $("#urlExamenCapacitacion").val(),
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
                    y: "Total capacitacion",
                    a: response.total_capacitacion,
                },
            ];
            chart_examen_capacitacion.setData(data);
        },
    });
}
