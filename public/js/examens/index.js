let fila = `<tr class="pregunta">
                <td>1</td>
                <td class="descripcion">
                    <input type="text" name="descripcion[]" value="" class="form-control" required>
                </td>
                <td class="oA">
                    <input type="text" name="opcionA[]" value="" class="form-control" required>
                </td>
                <td class="oB">
                    <input type="text" name="opcionB[]" value="" class="form-control" required>
                </td>
                <td class="oC">
                    <input type="text" name="opcionC[]" value="" class="form-control" required>
                </td>
                <td class="oD">
                    <input type="text" name="opcionD[]" value="" class="form-control" required>
                </td>
                <td class="valor">
                    <input type="number" name="valor[]" value="" class="form-control" required>
                </td>
                <td class="resp">
                    <select name="respuesta[]" class="select form-control">
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                    </select>
                </td>
                <td class="opcion">
                    <span class="eliminar" title="Eliminar Fila"><i class="fa fa-trash"></i></span>
                </td>
            </tr>`;

let lista_examenes = $('#lista_examenes');

/* CREATE */
let bodyCreate = $('#bodyCreate');
let btnAgregarCreate = $('#btnAgregarCreate');
let btnGuardarCreate = $('#btnGuardarCreate');
/* FIN CREATE */

/* EDIT */
form_editar_examen = $('#form_editar_examen');
/* FIN EDIT */

$(document).ready(function () {
    validaFilasCreate();

    /* CREATE */
    btnAgregarCreate.click(function () {
        let nueva_fila = $(fila).clone();
        bodyCreate.append(nueva_fila);
        let descripcion = bodyCreate.find('td.descripcion').children('input');
        descripcion.focus();

        btnGuardarCreate.prop('disabled', false);
        validaFilasCreate();
    });

    bodyCreate.on('click', 'tr.pregunta td.opcion span.eliminar', function () {
        let fila = $(this).closest('tr.pregunta');
        fila.remove();
        validaFilasCreate();
    });
    /* FIN CREATE */

    /* EDIT */
    lista_examenes.on('click', 'tr td.text-right .dropdown .dropdown-menu a.edit', function () {
        let id = $(this).attr('data-id');
        let url = $(this).attr('data-url');
        let url_form = $(this).attr('data-urlEU');
        $.ajax({
            type: "GET",
            url: url,
            data: {
                id: id,
            },
            dataType: "json",
            success: function (response) {
                form_editar_examen.prop('action', url_form);
                form_editar_examen.html(response.html);
                let bodyCreate = form_editar_examen.find('.bodyCreate');
                validaFilasEdit(bodyCreate);
            }
        });
    });

    $('#form_editar_examen').on('click', '.cont_preguntas_row .col-md-12 .btnAgregarEdit', function () {
        let nueva_fila = $(fila).clone();

        let bodyCreate = $(this).closest('.cont_preguntas_row').find('.bodyCreate');
        console.log(bodyCreate.html());
        bodyCreate.append(nueva_fila);
        let descripcion = bodyCreate.find('td.descripcion').children('input');
        descripcion.focus();

        btnGuardarCreate.prop('disabled', false);
        validaFilasEdit(bodyCreate);
    });

    $('#form_editar_examen').on('click', '.bodyCreate tr.pregunta td.opcion span.eliminar', function () {
        let fila = $(this).closest('tr.pregunta');
        let bodyCreate = $(this).closest('form').find('.bodyCreate');
        if (fila.hasClass('existe')) {
            let url = $(this).attr('data-urlD');
            $.ajax({
                headers: {
                    'x-csrf-token': $('#token').val()
                },
                type: "DELETE",
                url: url,
                dataType: "json",
                success: function (response) {
                    fila.remove();
                }
            });
        } else {
            fila.remove();
            validaFilasEdit(bodyCreate);
        }
    });


    $('#form_editar_examen').on('change', '.bodyCreate tr.pregunta td.editable input', function () {
        let input = $(this);
        let valor = input.val();
        let url = input.attr('data-urlU');
        let index = input.attr('data-col');
        let request = {};
        request[index] = valor;
        request['index'] = index;
        $.ajax({
            headers: {
                'x-csrf-token': $('#token').val()
            },
            type: "PUT",
            url: url,
            data: request,
            dataType: "json",
            success: function (response) {
                input.val(response.valor);
            }
        });
    });

    $('#form_editar_examen').on('change', '.bodyCreate tr.pregunta td.editable select', function () {
        let input = $(this);
        let valor = input.val();
        let url = input.attr('data-urlU');
        let index = input.attr('data-col');
        let request = {};
        request[index] = valor;
        request['index'] = index;
        $.ajax({
            headers: {
                'x-csrf-token': $('#token').val()
            },
            type: "PUT",
            url: url,
            data: request,
            dataType: "json",
            success: function (response) {
                input.val(response.valor);
            }
        });
    });
    /* FIN EDIT */

});

/* CREATE */
//validar y numerar filas
function validaFilasCreate() {
    let preguntas = bodyCreate.children('tr.pregunta');
    if (preguntas.length == 0) {
        btnGuardarCreate.prop('disabled', true);
    } else {
        btnGuardarCreate.prop('disabled', false);
        let cont = 1;
        preguntas.each(function () {
            let td_num = $(this).children('td').eq(0);
            td_num.text(cont);
            cont++;
        });
    }
}
/* FIN CREATE */

/* EDIT */
//validar y numerar filas
function validaFilasEdit(contenedor) {
    let btnGuardarEdit = contenedor.closest('form').find('.btnGuardarEdit');
    let preguntas = contenedor.children('tr.pregunta');
    if (preguntas.length == 0) {
        btnGuardarEdit.prop('disabled', true);
    } else {
        btnGuardarEdit.prop('disabled', false);
        let cont = 1;
        preguntas.each(function () {
            let td_num = $(this).children('td').eq(0);
            td_num.text(cont);
            cont++;
        });
    }
}
/* FIN EDIT */
