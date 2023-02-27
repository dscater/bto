/* CREATE */
let lider_proyecto_create = $('#lider_proyecto_create');
let s_lider_proyecto_create = $('#s_lider_proyecto_create');
let equipo_proyecto_create = $('#equipo_proyecto_create');
let s_equipo_proyecto_create = $('#s_equipo_proyecto_create');

let btnGuardaProyectoCreate = $('#btnGuardaProyectoCreate');

let inputs_equipo_create = `<input type="hidden" name="equipo_create[]" readonly>`;
/* FIN CREATE */

let opciones_equipo = `<span class="eliminar"><i class="fa fa-times"></i></span>`;
let url_users = $('#urlPubicImgs').val();
let contenedor_empleado = `<a href="#" data-toggle="tooltip" title="" class="avatar empleado" data-original-title="Lider Proyecto">
<img src="${url_users}/user_default.png" alt="">
</a>`;

let vacio = `<span class="text_muted">No se seleccionó ningun empleado</span>`;

$(document).ready(function () {
    compruebaLiderCreate();
    compruebaEquipoCreate();

    /* ******************************
            PROYECTO CREATE 
    ******************************** */
    s_lider_proyecto_create.on('change', function () {
        if (s_lider_proyecto_create.val() != '') {
            $.ajax({
                type: "GET",
                url: $('#urlInfoEmpleado').val(),
                data: {
                    id: s_lider_proyecto_create.val()
                },
                dataType: "json",
                success: function (response) {
                    lider_proyecto_create.html(contenedor_empleado);
                    let cont_empleado = lider_proyecto_create.children('a.empleado');
                    let img = cont_empleado.children('img');
                    img.attr('src', `${url_users}/${response.empleado.user.foto}`);
                    cont_empleado.attr('href', `${response.urlShow}`);
                    cont_empleado.attr('data-original-title', `${response.empleado.nombre} ${response.empleado.paterno} ${response.empleado.materno}`);
                    toggleTitle();
                }
            });
        } else {
            lider_proyecto_create.html(vacio);
        }
    });

    s_equipo_proyecto_create.on('change', function () {
        if (s_equipo_proyecto_create.val() != '') {

            // COMPROBAR QUE NO SE AÑADA 2 VECES AL MISMO EMPLEADO
            let comprueba = equipo_proyecto_create.find(`[id="create_${s_equipo_proyecto_create.val()}"]`);
            if (comprueba.length == 0 && s_equipo_proyecto_create.val() != s_lider_proyecto_create.val()) {
                $.ajax({
                    type: "GET",
                    url: $('#urlInfoEmpleado').val(),
                    data: {
                        id: s_equipo_proyecto_create.val()
                    },
                    dataType: "json",
                    success: function (response) {
                        equipo_proyecto_create.children('.text_muted').remove();
                        equipo_proyecto_create.append(contenedor_empleado);
                        let cont_empleado = equipo_proyecto_create.children('a.empleado').last();
                        let img = cont_empleado.children('img');
                        cont_empleado.append(inputs_equipo_create);
                        cont_empleado.append(opciones_equipo);
                        let input = cont_empleado.children('input');
                        input.val(response.empleado.id);

                        img.attr('src', `${url_users}/${response.empleado.user.foto}`);
                        cont_empleado.attr('id', `create_${response.empleado.id}`);
                        cont_empleado.attr('href', `${response.urlShow}`);
                        cont_empleado.attr('data-original-title', `${response.empleado.nombre} ${response.empleado.paterno} ${response.empleado.materno}`);
                        toggleTitle();
                        s_equipo_proyecto_create.val('').trigger('change');
                        compruebaEquipoCreate();
                    }
                });
            }
        } else {
            compruebaEquipoCreate();
        }
    });

    equipo_proyecto_create.on('click', 'a.empleado span.eliminar', function (e) {
        e.preventDefault();
        e.stopPropagation();
        let cont_empleado = $(this).parents('a.empleado');
        let aria_tooltip = cont_empleado.attr('aria-describedby');
        cont_empleado.remove();
        s_equipo_proyecto_create.val('').trigger('change');
        $('[id="' + aria_tooltip + '"]').remove();
        compruebaEquipoCreate();
    });

    /* ******************************
            PROYECTO EDIT 
    ******************************** */
    $(document).on('change', '.form_editar_proyecto .s_lider_proyecto_edit', function () {
        let s_lider_proyecto_edit = $(this);
        let lider_proyecto_edit = $(this).parents('.col-sm-6').siblings('.col-sm-6').children('.form-group').children('.lider_proyecto_edit');
        if (s_lider_proyecto_edit.val() != '') {
            $.ajax({
                type: "GET",
                url: $('#urlInfoEmpleado').val(),
                data: {
                    id: s_lider_proyecto_edit.val()
                },
                dataType: "json",
                success: function (response) {
                    lider_proyecto_edit.html(contenedor_empleado);
                    let cont_empleado = lider_proyecto_edit.children('a.empleado');
                    let img = cont_empleado.children('img');
                    img.attr('src', `${url_users}/${response.empleado.user.foto}`);
                    cont_empleado.attr('href', `${response.urlShow}`);
                    cont_empleado.attr('data-original-title', `${response.empleado.nombre} ${response.empleado.paterno} ${response.empleado.materno}`);
                    toggleTitle();
                }
            });
        } else {
            lider_proyecto_edit.html(vacio);
        }
    });

    $(document).on('change', '.form_editar_proyecto .s_equipo_proyecto_edit', function () {
        let s_equipo_proyecto_edit = $(this);
        let equipo_proyecto_edit = $(this).parents('.col-sm-6').siblings('.col-sm-6').children('.form-group').children('.equipo_proyecto_edit');
        let s_lider_proyecto_edit = $(this).parents('.row').siblings('.contenedor_lider_proyecto').find('select');

        if (s_equipo_proyecto_edit.val() != '') {
            // COMPROBAR QUE NO SE AÑADA 2 VECES AL MISMO EMPLEADO
            let comprueba = equipo_proyecto_edit.find(`[id="create_${s_equipo_proyecto_edit.val()}"]`);
            if (comprueba.length == 0 && s_equipo_proyecto_edit.val() != s_lider_proyecto_edit.val()) {
                $.ajax({
                    type: "GET",
                    url: $('#urlInfoEmpleado').val(),
                    data: {
                        id: s_equipo_proyecto_edit.val()
                    },
                    dataType: "json",
                    success: function (response) {
                        equipo_proyecto_edit.children('.text_muted').remove();
                        equipo_proyecto_edit.append(contenedor_empleado);
                        let cont_empleado = equipo_proyecto_edit.children('a.empleado').last();
                        let img = cont_empleado.children('img');
                        cont_empleado.append(inputs_equipo_create);
                        cont_empleado.append(opciones_equipo);
                        let input = cont_empleado.children('input');
                        input.val(response.empleado.id);

                        img.attr('src', `${url_users}/${response.empleado.user.foto}`);
                        cont_empleado.attr('id', `create_${response.empleado.id}`);
                        cont_empleado.attr('href', `${response.urlShow}`);
                        cont_empleado.attr('data-original-title', `${response.empleado.nombre} ${response.empleado.paterno} ${response.empleado.materno}`);
                        toggleTitle();
                        s_equipo_proyecto_edit.val('').trigger('change');
                        compruebaEquipoEdit(equipo_proyecto_edit);
                    }
                });
            }
        } else {
            compruebaEquipoEdit(equipo_proyecto_edit);
        }
    });

    $(document).on('click', '.form_editar_proyecto .equipo_proyecto_edit a.empleado span.eliminar', function (e) {
        e.preventDefault();
        e.stopPropagation();

        let equipo_proyecto_edit = $(this).parents('.equipo_proyecto_edit');
        let cont_empleado = $(this).parents('a.empleado');
        let aria_tooltip = cont_empleado.attr('aria-describedby');

        let s_equipo_proyecto_edit = $(this).parents('.form_editar_proyecto').find('.s_equipo_proyecto_edit');

        if (cont_empleado.hasClass('existe')) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('#token').val()
                },
                type: "DELETE",
                url: cont_empleado.attr('data-url'),
                dataType: "json",
                success: function (response) {
                    cont_empleado.remove();
                    s_equipo_proyecto_edit.val('').trigger('change');
                    $('[id="' + aria_tooltip + '"]').remove();
                    compruebaEquipoEdit(equipo_proyecto_edit);
                }
            });
        } else {
            cont_empleado.remove();
            s_equipo_proyecto_edit.val('').trigger('change');
            $('[id="' + aria_tooltip + '"]').remove();
            compruebaEquipoEdit(equipo_proyecto_edit);
        }
    });
});

/* CREATE */
function compruebaLiderCreate() {
    let empleados = lider_proyecto_create.children('a.empleado');
    if (empleados.length == 0) {
        lider_proyecto_create.html(vacio);
    }
}

function compruebaEquipoCreate() {
    let empleados = equipo_proyecto_create.children('a.empleado');
    if (empleados.length == 0) {
        equipo_proyecto_create.html(vacio);
        btnGuardaProyectoCreate.prop('disabled', true);
    } else {
        equipo_proyecto_create.children('.text_muted').remove();
        btnGuardaProyectoCreate.prop('disabled', false);
    }
}
/* FIN CREATE */

/* EDIT */
function compruebaEquipoEdit(contenedor) {
    let btnActualizaProyectoEdit = contenedor.parents('.form_editar_proyecto').children('.btnActualizaProyectoEdit').find('button');

    let empleados = contenedor.children('a.empleado');
    if (empleados.length == 0) {
        contenedor.html(vacio);
        btnActualizaProyectoEdit.prop('disabled', true);
    } else {
        contenedor.children('.text_muted').remove();
        btnActualizaProyectoEdit.prop('disabled', false);
    }
}
/* FIN EDIT */

function toggleTitle() {
    $('[data-toggle="tooltip"]').tooltip();
}
