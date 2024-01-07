var chart_ingresos_economicos = Morris.Bar({
    element: "chart_total_ingresos",
    data: [
        {
            y: "Total",
            a: 0,
        },
    ],
    xkey: "y",
    ykeys: ["a"],
    labels: ["Ingresos económicos"],
    barColors: ["#ffbc34"],
    lineWidth: "3px",
    resize: true,
    redraw: true,
});

$(document).ready(function () {
    f_ingresos_economicos();
});

function f_ingresos_economicos() {
    getfIngresosEconomicos();
    var fecha_ini = $("#f_ingresos_economicos")
        .find(".fecha_ini")
        .parents(".cont_filtro");
    var fecha_fin = $("#f_ingresos_economicos")
        .find(".fecha_fin")
        .parents(".cont_filtro");
    var empresa = $("#f_ingresos_economicos")
        .find(".empresa")
        .parents(".cont_filtro");
    var departamento = $("#f_ingresos_economicos")
        .find(".departamento")
        .parents(".cont_filtro");
    var designacion = $("#f_ingresos_economicos")
        .find(".designacion")
        .parents(".cont_filtro");
    var empleado = $("#f_ingresos_economicos")
        .find(".empleado")
        .parents(".cont_filtro");

    fecha_ini.hide();
    empresa.hide();
    departamento.hide();
    designacion.hide();
    empleado.hide();
    $("#f_ingresos_economicos").on("change", ".filtro", function () {
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
        getfIngresosEconomicos();
    });

    $("#f_ingresos_economicos").on("change blur", ".fecha_ini", function () {
        getfIngresosEconomicos();
    });
    $("#f_ingresos_economicos").on("change blur", ".fecha_fin", function () {
        getfIngresosEconomicos();
    });
    $("#f_ingresos_economicos").on("change", ".empresa", function () {
        getfIngresosEconomicos();
    });
    $("#f_ingresos_economicos").on("change", ".departamento", function () {
        getfIngresosEconomicos();
    });
    $("#f_ingresos_economicos").on("change", ".designacion", function () {
        getfIngresosEconomicos();
    });
    $("#f_ingresos_economicos").on("change", ".empleado", function () {
        getfIngresosEconomicos();
    });
}

function getfIngresosEconomicos() {
    var filtro = $("#f_ingresos_economicos").find(".filtro").val();
    var fecha_ini = $("#f_ingresos_economicos").find(".fecha_ini").val();
    var fecha_fin = $("#f_ingresos_economicos").find(".fecha_fin").val();
    var empresa = $("#f_ingresos_economicos").find(".empresa").val();
    var departamento = $("#f_ingresos_economicos").find(".departamento").val();
    var designacion = $("#f_ingresos_economicos").find(".designacion").val();
    var empleado = $("#f_ingresos_economicos").find(".empleado").val();
    $.ajax({
        type: "GET",
        url: $("#urlIngresosEconomicos").val(),
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
                    y: "Ingresos económicos",
                    a: response.total_ingresos,
                },
            ];
            chart_ingresos_economicos.setData(data);
        },
    });
}
