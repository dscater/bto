let txtNombreEmpleado = $('#txtNombreEmpleado');
let txtMesAsistencia = $('#txtMesAsistencia');
let txtAnioAsistencia = $('#txtAnioAsistencia');
let contenedorAsistencias = $('#contenedorAsistencias');
let header_asistencias = $('#header_asistencias');

$(document).ready(function () {
    obtieneAsistencias();

    txtMesAsistencia.change(obtieneAsistencias);
    txtAnioAsistencia.change(obtieneAsistencias);
    txtNombreEmpleado.keyup(obtieneAsistencias);
});

function obtieneAsistencias() {
    $.ajax({
        type: "GET",
        url: $('#urlAsistenciasEmpleados').val(),
        data: {
            nom_empleado: txtNombreEmpleado.val(),
            mes: txtMesAsistencia.val(),
            anio: txtAnioAsistencia.val()
        },
        dataType: "json",
        success: function (response) {
            header_asistencias.html(response.header);
            contenedorAsistencias.html(response.filas);
        }
    });
}
