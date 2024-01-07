var chart_progreso_proyectos = Morris.Bar({
    element: "chart_progreso_proyectos",
    data: [
        {
            y: "Progreso de proyectos",
            a: 0,
        },
    ],
    xkey: "y",
    ykeys: ["a"],
    labels: ["% desarrollo"],
    barColors: ["#667eea"],
    lineWidth: "3px",
    resize: true,
    redraw: true,
});

$(document).ready(function () {
    f_desarrollo_proyectos();
});

function f_desarrollo_proyectos() {
    getDesarrolloProyectos();
    var empresa = $("#f_desarrollo_proyectos")
        .find(".empresa")
        .parents(".cont_filtro");
    var departamento = $("#f_desarrollo_proyectos")
        .find(".departamento")
        .parents(".cont_filtro");
    var designacion = $("#f_desarrollo_proyectos")
        .find(".designacion")
        .parents(".cont_filtro");
    var proyecto = $("#f_desarrollo_proyectos")
        .find(".proyecto")
        .parents(".cont_filtro");

    empresa.hide();
    departamento.hide();
    designacion.hide();
    proyecto.hide();
    $("#f_desarrollo_proyectos").on("change", ".filtro", function () {
        let filtro = $(this).val();
        switch (filtro) {
            case "todos":
                empresa.hide();
                departamento.hide();
                designacion.hide();
                proyecto.hide();
                break;
            case "empresa":
                empresa.show();
                departamento.hide();
                designacion.hide();
                proyecto.hide();
                break;
            case "departamento":
                empresa.hide();
                departamento.show();
                designacion.hide();
                proyecto.hide();
                break;
            case "designacion":
                empresa.hide();
                departamento.hide();
                designacion.show();
                proyecto.hide();
                break;
            case "proyecto":
                empresa.hide();
                departamento.hide();
                designacion.hide();
                proyecto.show();
                break;
        }
        getDesarrolloProyectos();
    });

    $("#f_desarrollo_proyectos").on("change", ".empresa", function () {
        getDesarrolloProyectos();
    });
    $("#f_desarrollo_proyectos").on("change", ".departamento", function () {
        getDesarrolloProyectos();
    });
    $("#f_desarrollo_proyectos").on("change", ".designacion", function () {
        getDesarrolloProyectos();
    });
    $("#f_desarrollo_proyectos").on("change", ".proyecto", function () {
        getDesarrolloProyectos();
    });
}

function getDesarrolloProyectos() {
    var filtro = $("#f_desarrollo_proyectos").find(".filtro").val();
    var empresa = $("#f_desarrollo_proyectos").find(".empresa").val();
    var departamento = $("#f_desarrollo_proyectos").find(".departamento").val();
    var designacion = $("#f_desarrollo_proyectos").find(".designacion").val();
    var proyecto = $("#f_desarrollo_proyectos").find(".proyecto").val();
    $.ajax({
        type: "GET",
        url: $("#urlProgresoProyectos").val(),
        data: {
            filtro: filtro,
            empresa: empresa,
            departamento: departamento,
            designacion: designacion,
            proyecto: proyecto,
        },
        dataType: "json",
        success: function (response) {
            let data = [
                {
                    y: "Desarrollo de progreso de proyectos",
                    a: response.total_progreso,
                },
            ];
            chart_progreso_proyectos.setData(data);
        },
    });
}
