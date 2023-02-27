let urlTipoAsistencia = $('#urlTipoAsistencia');
let btnMarcaHora = $('#btnMarcaHora');
let index_sw = null;
let fecha_marca = null;
let hora_marcado = null;
let tipo_marcado = null;
/* variables
  hora_texto
  fecha_bd
*/

let message_exito = `<div class="alert alert-success">
<button class="close" data-dismiss="alert">&times;</button>
Registro realizado con éxito</div>`;

$(document).ready(function () {
    getTipoAsistencia();
    btnMarcaHora.click(function () {
        getTipoAsistencia();
        $.ajax({
            headers: {
                'x-csrf-token': $('#token').val()
            },
            type: "POST",
            url: $('#urlStoreAsistencia').val(),
            data: {
                id: $('#_i_e').val(),
                hora: hora_marcado,
                fecha: fecha_marca,
                tipo: tipo_marcado
            },
            dataType: "json",
            success: function (response) {
                getTipoAsistencia();
                $('#contenedorFecha').before(message_exito);
            }
        });
    });
});

function getTipoAsistencia() {
    $.ajax({
        type: "GET",
        url: urlTipoAsistencia.val(),
        data: {
            hora: hora_texto,
            fecha: fecha_bd
        },
        dataType: "json",
        success: function (response) {
            if (response.horario_sw == true) {
                index_sw = response.index_sw;
                fecha_marca = response.fecha;
                tipo_marcado = response.tipo;
                if (response.tipo == 'inicio') {
                    btnMarcaHora.find('span').text('Marcar Entrada');
                    hora_marcado = response.hora;
                } else if (response.tipo == 'fin') {
                    btnMarcaHora.find('span').text('Marcar Salida');
                    hora_marcado = response.hora;
                } else {
                    btnMarcaHora.hide();
                }
            } else {
                btnMarcaHora.hide();
            }
        }
    });
}
