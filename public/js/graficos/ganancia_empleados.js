var chart_ganancia_empleados = Morris.Bar({
    element: "chart_ganancia_empleados",
    data: [
        {
            y: "Ganancia de Empleados",
            a: 0,
        },
    ],
    xkey: "y",
    ykeys: ["a"],
    labels: ["Total Ganancia"],
    barColors: ["#009efb"],
    lineWidth: "3px",
    resize: true,
    redraw: true,
});

$(document).ready(function () {
    f_ganancia_empleados();
});

function f_ganancia_empleados() {
    getGananciaEmpleados();
    var fecha_ini = $("#f_ganancia_empleados")
        .find(".fecha_ini")
        .parents(".cont_filtro");
    var fecha_fin = $("#f_ganancia_empleados")
        .find(".fecha_fin")
        .parents(".cont_filtro");
    var proyecto = $("#f_ganancia_empleados")
        .find(".proyecto")
        .parents(".cont_filtro");
    var empleado = $("#f_ganancia_empleados")
        .find(".empleado")
        .parents(".cont_filtro");

    fecha_ini.hide();
    proyecto.hide();
    empleado.hide();
    $("#f_ganancia_empleados").on("change", ".filtro", function () {
        let filtro = $(this).val();
        switch (filtro) {
            case "todos":
                fecha_ini.hide();
                proyecto.hide();
                empleado.hide();
                break;
            case "pronostico":
                fecha_ini.hide();
                proyecto.hide();
                empleado.hide();
                break;
            case "fecha":
                fecha_ini.show();
                proyecto.hide();
                empleado.hide();
                break;
            case "proyecto":
                proyecto.show();
                fecha_ini.hide();
                empleado.hide();
                break;
            case "empleado":
                fecha_ini.hide();
                empleado.show();
                proyecto.hide();
                break;
        }
        getGananciaEmpleados();
    });

    $("#f_ganancia_empleados").on("change blur", ".fecha_ini", function () {
        getGananciaEmpleados();
    });
    $("#f_ganancia_empleados").on("change blur", ".fecha_fin", function () {
        getGananciaEmpleados();
    });
    $("#f_ganancia_empleados").on("change", ".proyecto", function () {
        getGananciaEmpleados();
    });
    $("#f_ganancia_empleados").on("change", ".empleado", function () {
        getGananciaEmpleados();
    });
}

function getGananciaEmpleados() {
    var filtro = $("#f_ganancia_empleados").find(".filtro").val();
    var fecha_ini = $("#f_ganancia_empleados").find(".fecha_ini").val();
    var fecha_fin = $("#f_ganancia_empleados").find(".fecha_fin").val();
    var proyecto = $("#f_ganancia_empleados").find(".proyecto").val();
    var empleado = $("#f_ganancia_empleados").find(".empleado").val();
    $.ajax({
        type: "GET",
        url: $("#urlGananciaEmpleados").val(),
        data: {
            filtro: filtro,
            fecha_ini: fecha_ini,
            fecha_fin: fecha_fin,
            empleado: empleado,
            proyecto: proyecto,
        },
        dataType: "json",
        success: function (response) {
            let data = [
                {
                    y: "Ganancia Total",
                    a: parseFloat(response.ganancia_total),
                },
            ];
            chart_ganancia_empleados.setData(data);
        },
    });
}
