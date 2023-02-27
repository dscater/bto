let contenedor_dias = $('#contenedor_dias');

let elementos = `<input type="time" class="form-control"/> 
            <span class="guardar"><i class="fa fa-check" title="Guardar"></i></span>
            <span class="cancelar"><i class="fa fa-times" title="Cancelar"></i></span>`;

let elementos_horas = `<input type="number" step="1" class="form-control"/> 
            <span class="guardar"><i class="fa fa-check" title="Guardar"></i></span>
            <span class="cancelar"><i class="fa fa-times" title="Cancelar"></i></span>`;

let totalHoras = $('#totalHoras');

$(document).ready(function () {

    totalHoras.click(function () {
        let existe_input = totalHoras.children('input');
        let existe_span_guardar = totalHoras.children('span.guardar');
        let existe_span_cancelar = totalHoras.children('span.cancelar');
        if (existe_input.length == 0 || existe_span_guardar.length == 0 || existe_span_cancelar.length == 0) {
            totalHoras.html(elementos_horas)
            let input = totalHoras.children('input');
            input.val(totalHoras.attr('data-valor'));
        }
    });

    totalHoras.on('click', 'span.cancelar', function (e) {
        e.stopPropagation();
        let valor = totalHoras.attr('data-valor');
        totalHoras.html(`${valor} Hrs.`);
    });

    totalHoras.on('click', 'span.guardar', function (e) {
        e.stopPropagation();
        let input = totalHoras.children('input');
        if (input.val() != '' && input.val() > 0) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('#token').val()
                },
                type: "PUT",
                url: $('#urlActualizaHorario').val(),
                data: {
                    index: 'horas_trabajo',
                    valor: input.val()
                },
                dataType: "json",
                success: function (response) {
                    totalHoras.addClass('bien');
                    totalHoras.attr('data-valor', response.valor);
                    totalHoras.html(`${response.valor} Hrs.`);
                    setTimeout(function () {
                        totalHoras.removeClass('bien');
                    }, 1500);
                }
            });
        } else {
            input.addClass('error');
        }
    });

    // CLICK TD
    contenedor_dias.on('click', 'tr td.dia', function (e) {
        let td = $(this);
        let contenedor_dia = td.children('.contenedor_dia');
        let existe_input = contenedor_dia.children('input');
        let existe_span_guardar = contenedor_dia.children('span.guardar');
        let existe_span_cancelar = contenedor_dia.children('span.cancelar');
        if (existe_input.length == 0 || existe_span_guardar.length == 0 || existe_span_cancelar.length == 0) {
            cargaElementosTd(td);
        }
    });

    // CANCELAR
    contenedor_dias.on('click', 'tr td.dia .contenedor_dia span.cancelar', function (e) {
        e.stopPropagation();
        let span_cancelar = $(this);
        let contenedor_dia = span_cancelar.parents('.contenedor_dia');
        let valor = contenedor_dia.attr('data-valor');
        contenedor_dia.html(valor)
    });

    // GUARDAR
    contenedor_dias.on('click', 'tr td.dia .contenedor_dia span.guardar', function (e) {
        e.stopPropagation();
        let span_guardar = $(this);
        let contenedor_dia = span_guardar.parents('.contenedor_dia');
        let td = span_guardar.parents('td');
        let input = contenedor_dia.children('input');
        if (input.val() != '') {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('#token').val()
                },
                type: "PUT",
                url: $('#urlActualizaHorario').val(),
                data: {
                    index: td.attr('data-dia'),
                    valor: input.val()
                },
                dataType: "json",
                success: function (response) {
                    td.removeClass('dia');
                    td.addClass('bien');
                    contenedor_dia.attr('data-valor', response.valor);
                    contenedor_dia.html(response.valor);
                    setTimeout(function () {
                        td.removeClass('bien');
                        td.addClass('dia');
                    }, 1500);
                }
            });
        } else {
            input.addClass('error');
        }
    });
});


function cargaElementosTd(td) {
    if (td.hasClass('dia')) {
        let contenedor_dia = td.children('.contenedor_dia');
        contenedor_dia.html(elementos);

        let input = contenedor_dia.children('input');
        input.focus();
        input.val(contenedor_dia.attr('data-valor'));
    }
}
