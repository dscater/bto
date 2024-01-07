var chart_cantidad_empleados = Morris.Bar({
    element: "bar_charts_cantidad_empleados",
    data: [
        {
            y: "Empleados",
            a: 0,
        },
    ],
    xkey: "y",
    ykeys: ["a"],
    labels: ["Total Empleados"],
    lineColors: ["#667eea"],
    lineWidth: "3px",
    barColors: ["#667eea"],
    resize: true,
    redraw: true,
});

$(document).ready(function () {
    cantidad_empleados();
});

function cantidad_empleados() {
    getCantidadEmpleados();
    var fecha_ini = $("#f_cantidad_empleados")
        .find(".fecha_ini")
        .parents(".cont_filtro");
    var fecha_fin = $("#f_cantidad_empleados")
        .find(".fecha_fin")
        .parents(".cont_filtro");
    var estado = $("#f_cantidad_empleados")
        .find(".estado")
        .parents(".cont_filtro");

    fecha_ini.hide();
    estado.hide();
    $("#f_cantidad_empleados").on("change", ".filtro", function () {
        let filtro = $(this).val();
        switch (filtro) {
            case "todos":
                fecha_ini.hide();
                estado.hide();
                break;
            case "pronostico":
                fecha_ini.hide();
                estado.hide();
                break;
            case "fecha":
                fecha_ini.show();
                estado.hide();
                break;
            case "estado":
                fecha_ini.hide();
                estado.show();
                break;
        }
        getCantidadEmpleados();
    });
    $("#f_cantidad_empleados").on(
        "change blur",
        ".cont_filtro .row .col-md-6 .fecha_ini",
        function () {
            getCantidadEmpleados();
        }
    );
    $("#f_cantidad_empleados").on("change blur", ".fecha_fin", function () {
        getCantidadEmpleados();
    });
    $("#f_cantidad_empleados").on("change", ".estado", function () {
        getCantidadEmpleados();
    });
}

function getCantidadEmpleados() {
    var filtro = $("#f_cantidad_empleados").find(".filtro").val();
    var fecha_ini = $("#f_cantidad_empleados").find(".fecha_ini").val();
    var fecha_fin = $("#f_cantidad_empleados").find(".fecha_fin").val();
    var estado = $("#f_cantidad_empleados").find(".estado").val();
    $.ajax({
        type: "GET",
        url: $("#urlCantidadEmpleados").val(),
        data: {
            filtro: filtro,
            fecha_ini: fecha_ini,
            fecha_fin: fecha_fin,
            estado: estado,
        },
        dataType: "json",
        success: function (response) {
            let data = [
                {
                    y: "Empleados",
                    a: response.cantidad_empleados,
                },
            ];
            chart_cantidad_empleados.setData(data);
        },
    });
}
