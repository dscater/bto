let txtMesAsistencia = $('#txtMesAsistencia');
let txtAnioAsistencia = $('#txtAnioAsistencia');
let contenedorAsistencias = $('#contenedorAsistencias');
let header_asistencias = $('#header_asistencias');

$(document).ready(function () {
    obtieneAsistencias();

    txtMesAsistencia.change(obtieneAsistencias);
    txtAnioAsistencia.change(obtieneAsistencias);
});

function obtieneAsistencias() {
    $.ajax({
        type: "GET",
        url: $('#urlAsistenciasEmpleado').val(),
        data: {
            mes : txtMesAsistencia.val(),
            anio : txtAnioAsistencia.val()
        },
        dataType: "json",
        success: function (response) {
            header_asistencias.html(response.header);
            contenedorAsistencias.html(response.dias);
        }
    });
}
