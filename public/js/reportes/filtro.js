$(document).ready(function () {
    usuarios();
    empleados();
});

function usuarios() {
    var role = $('#m_usuarios #role').parents('.form-group');

    role.hide();
    $('#m_usuarios select#filtro').change(function () {
        let filtro = $(this).val();
        switch (filtro) {
            case 'todos':
                role.hide();
                break;
            case 'role':
                role.show();
                break;
        }
    });
}

function empleados() {
    var empresa = $('#m_empleados #empresa').parents('.form-group');
    var departamento = $('#m_empleados #departamento').parents('.form-group');
    var designacion = $('#m_empleados #designacion').parents('.form-group');

    empresa.hide();
    departamento.hide();
    designacion.hide();
    $('#m_empleados select#filtro').change(function () {
        let filtro = $(this).val();
        switch (filtro) {
            case 'todos':
                empresa.hide();
                departamento.hide();
                designacion.hide();
                break;
            case 'empresa':
                empresa.show();
                departamento.hide();
                designacion.hide();
                break;
            case 'departamento':
                empresa.hide();
                departamento.show();
                designacion.hide();
                break;
            case 'designacion':
                empresa.hide();
                departamento.hide();
                designacion.show();
                break;
        }
    });
}
