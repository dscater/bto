let calendario = $('#calendario');
var accion = 'SAVE';
var evento = {
    accion: null,
    id: null,
    fecha: null,
    ie: $('#_i_d_e').val(),
    elimina: null,
};

let btnConfirmaDia = $('#btnConfirmaDia');
let btnConfirmaEliminarDia = $('#btnConfirmaEliminarDia');

var d = new Date();
var fecha_actual = d.getFullYear() + ' ' + (d.getMonth() + 1) + ' ' + d.getDate();
var d2 = sumarDias(d, 1);
var fecha_actual2 = d2.getFullYear() + ' ' + (d2.getMonth() + 1) + ' ' + d2.getDate();
// con la funcion sumarDias puedo sumar o restar dias y te da la fecha
// console.log(sumarDias(d, -15));
// console.log(d.getFullYear()+' '+(d.getMonth()+1)+' '+d.getDate());

$(document).ready(function () {

    btnConfirmaDia.click(function () {
        $.ajax({
            headers: {
                'x-csrf-token': $('#token').val()
            },
            type: "post",
            url: $('#urlStoreVacacion').val(),
            data: evento,
            dataType: "json",
            success: function (response) {
                calendario.fullCalendar('refetchEvents');

                $('.mensaje_error').removeClass('escondido');
                $('.mensaje_error').html(`<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button>
                <strong>Día asignado correctamente</strong></div>`);
                $('#modal_confirma_dia').modal('hide');
            }
        });
    });
    btnConfirmaEliminarDia.click(function () {
        $.ajax({
            headers: {
                'x-csrf-token': $('#token').val()
            },
            type: "DELETE",
            url: evento.elimina,
            dataType: "json",
            success: function (response) {
                $('#modal_elimina_dia').modal('hide');
                calendario.fullCalendar('refetchEvents');
                $('.mensaje_error').removeClass('escondido');
                $('.mensaje_error').html(`<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button>
                <strong>Día eliminado exitosamente</strong></div>`);
                $('#modal_confirma_dia').modal('hide');
            }
        });
    });

    calendario.fullCalendar({
        height: $(window).height() - 200,
        header: {
            // left:'Eliminar, Limpiar',
            center: 'title',
            right: 'today,prev,next'
        },
        dayClick: function (date, jsEvent, view) {
            console.log(date);
            accion = 'SAVE';
            let array_fecha = date.format().split('-');
            let dia = new Date(array_fecha[0], parseInt(array_fecha[1]) - 1, array_fecha[2]);
            console.log(date.format());

            // comrobar que no sea sábado o domingo
            if (dia.getDay() != 0) {
                $('#modal_confirma_dia').modal('show');
                evento.accion = accion;
                evento.fecha = date.format();
                $('#txtFechaVacacion').text(date.format());
            } else {
                $('.mensaje_error').removeClass('escondido');
                $('.mensaje_error').html(`<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button>
                <strong>No puedes marcar los días domingo</strong></div>`);
            }
        },
        events: $('#urlFechas').val(),
        // events: [{
        //     title: 'Vacación',
        //     start: '2021-03-24',
        //     color: '#667eea',
        //     textColor: '#ffffff'
        // }],
        eventClick: function (calEvent, jsEvent, view) {
            accion = 'MODIFICAR';
            evento.accion = accion;
            evento.id = calEvent.id;
            evento.elimina = calEvent.elimina;
            // LLENAR LOS DATOS DEL FORMULARIO
            $('#txtFechaVacacionEliminar').text(calEvent.start.format());
            $('#modal_elimina_dia').modal('show');
        },

    });

});


function sumarDias(fecha, dias) {
    fecha.setDate(fecha.getDate() + dias);
    return fecha;
}
