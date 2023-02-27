;
(function ($) {
    $(document).ready(function () {

        var notificationTimeout;
        var modal_info_actividad = $("#modal_info_actividad");
        var actividad_actual = null;
        var elemento_actual = null;
        //Shows updated notification popup 
        var updateNotification = function (task, notificationText, newClass) {
            var notificationPopup = $('.notification-popup ');
            notificationPopup.find('.task').text(task);
            notificationPopup.find('.notification-text').text(notificationText);
            notificationPopup.removeClass('hide success');
            // If a custom class is provided for the popup, add It
            if (newClass)
                notificationPopup.addClass(newClass);
            // If there is already a timeout running for hiding current popup, clear it.
            if (notificationTimeout)
                clearTimeout(notificationTimeout);
            // Init timeout for hiding popup after 3 seconds
            notificationTimeout = setTimeout(function () {
                notificationPopup.addClass('hide');
            }, 3000);
        };

        // Adds a new Task to the todo list 
        var addTask = function () {
            // Get the new task entered by user
            var newTask = $('#new-task').val();
            // If new task is blank show error message
            if (newTask === '') {
                $('#new-task').addClass('error');
                $('.new-task-wrapper .error-message').removeClass('hidden');
            } else {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('#token').val()
                    },
                    type: "POST",
                    url: $('#urlStoreActividad').val(),
                    data: {
                        nombre: newTask
                    },
                    dataType: "json",
                    success: function (response) {
                        var todoListScrollHeight = $('.task-list-body').prop('scrollHeight');
                        // Make a new task template
                        var newTemplate = $(response.actividadTemplate).clone();
                        // update the task label in the new template
                        var task_label = newTemplate.find('.task-label');
                        task_label.attr('data-url', response.url);
                        task_label.text(response.actividad.nombre);
                        // update the task url check
                        var task_check = newTemplate.find('.task-check');
                        var complete_btn = task_check.find('.complete-btn');
                        complete_btn.attr('data-url', response.url);
                        // Add new class to the template
                        newTemplate.addClass('new');
                        // Remove complete class in the new Template in case it is present
                        newTemplate.removeClass('completed');
                        //Append the new template to todo list
                        $('#task-list').append(newTemplate);
                        // Clear the text in textarea
                        $('#new-task').val('');
                        // As a new task is added, hide the mark all tasks as incomplete button & show the mark all finished button
                        $('#mark-all-finished').removeClass('move-up');
                        $('#mark-all-incomplete').addClass('move-down');

                        // Show notification
                        updateNotification(response.actividad.nombre, 'Agregado a la lista');
                        // Smoothly scroll the todo list to the end
                        $('.task-list-body').animate({
                            scrollTop: todoListScrollHeight
                        }, 1000);
                        actualizaInfoProyecto();
                    }
                });

            }
        };

        // Closes the panel for entering new tasks & shows the button for opening the panel
        var closeNewTaskPanel = function () {
            $('.add-task-btn').toggleClass('visible');
            $('.new-task-wrapper').toggleClass('visible');
            if ($('#new-task').hasClass('error')) {
                $('#new-task').removeClass('error');
                $('.new-task-wrapper .error-message').addClass('hidden');
            }
        };

        // Initalizes HTML template for a given task 
        //var taskTemplate = $($('#task-template').html());
        var taskTemplate = `
        <li class="task">
            <div class="task-container">
                <span class="task-action-btn task-check">
                    <span class="action-circle large complete-btn" title="Mark Complete"><i class="material-icons">check</i></span>
                </span>
                <span class="task-label" contenteditable="true"></span>
                <span class="task-action-btn task-btn-right">
                    <span class="action-circle large delete-btn" title="Eliminar tarea"><i class="material-icons">delete</i></span>
                </span>
            </div>
        </li>`;
        // Shows panel for entering new tasks
        $('.add-task-btn').click(function () {
            var newTaskWrapperOffset = $('.new-task-wrapper').offset().top;
            $(this).toggleClass('visible');
            $('.new-task-wrapper').toggleClass('visible');
            // Focus on the text area for typing in new task
            $('#new-task').focus();
            // Smoothly scroll to the text area to bring the text are in view
            $('body').animate({
                scrollTop: newTaskWrapperOffset
            }, 1000);
        });

        // Deletes task on click of delete button
        $('#task-list').on('click', '.task-action-btn .delete-btn', function () {
            var task = $(this).closest('.task');
            var taskText = task.find('.task-label').text();
            var url = $(this).attr('data-url');

            $.ajax({
                headers: {
                    'x-csrf-token': $('#token').val()
                },
                type: "DELETE",
                url: url,
                dataType: "json",
                success: function (response) {
                    task.remove();
                    updateNotification(response.nombre, ' ha sido eliminado.');
                    actualizaInfoProyecto();
                }
            });
        });

        // Boton para actualizar informacion de la actividad
        $('#task-list').on('click', '.task-action-btn .informacion-btn', function () {
            elemento_actual = $(this).parents("li.task");
            actividad_actual = $(this).attr('data-url');
            iniciaForm();
            modal_info_actividad.modal("show");
        });

        // Boton para descargar el archivo
        $('#task-list').on('click', '.contenedor_info_iconos .info_actividad.descargar', function (e) {
            console.log("asdasdasdasda");
            e.preventDefault();
            var url = $(this).attr('data-url');
            console.log(url);

            $.ajax({
                headers: {
                    'x-csrf-token': $('#token').val()
                },
                type: "POST",
                url: url,
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    const data = response;
                    const link = document.createElement('a');
                    link.setAttribute('href', data);
                    link.setAttribute('download', ''); // Need to modify filename ...
                    link.click();
                },
                error:function(err){
                    console.log(err);
                }
            });
        });

        // Task label Keyup Update
        $('#task-list').on('change blur', '.task-label', function () {
            let task_label = $(this);
            let task = task_label.closest('.task');
            let nombre = task_label.text();
            let url = task_label.attr('data-url');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('#token').val()
                },
                type: "PUT",
                url: url,
                data: {
                    nombre: nombre
                },
                dataType: "json",
                success: function (response) {
                    task.addClass('new');
                    task_label.text(response.nombre)
                }
            });
        });

        // Marks a task as complete
        $('#task-list').on('click', '.task-action-btn .complete-btn', function () {
            elemento_actual = $(this).parents("li.task")
            let self = $(this);
            var task = $(this).closest('.task');
            var taskText = task.find('.task-label').text();
            var newTitle = task.hasClass('completed') ? 'Mark Complete' : 'Mark Incomplete';
            $(this).attr('title', newTitle);
            var url = $(this).attr('data-url');

            var estado = 'PENDIENTE';
            if (task.hasClass('completed')) {
                updateNotification(taskText, 'tarea incompleta.');
                estado = 'PENDIENTE';
            } else {
                updateNotification(taskText, ' Tarea completada.', 'success')
                estado = 'COMPLETO';
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('#token').val()
                },
                type: "PUT",
                url: url,
                data: {
                    estado: estado
                },
                dataType: "json",
                success: function (response) {
                    task.toggleClass('completed');
                    actualizaInfoProyecto();
                    $("#txt_nombre_tarea").text(response.actividad.nombre);

                    let el_actualizado = $(response.actividadTemplate).clone();
                    elemento_actual.html(el_actualizado.html());
                    actividad_actual = response.url;

                    if (response.actividad.estado == 'COMPLETO') {
                        iniciaForm();
                        modal_info_actividad.modal("show");
                    } else {
                        actividad_actual = null;
                    }
                }
            });

        });

        // ENVIO INFORMACION ADICIONAL
        $("#btnEnvioInfoActividad").click(function () {
            if (actividad_actual) {
                actualizaInfoAdicionalProyecto(event);
            } else {
                modal_info_actividad.modal("hide");
            }
        });

        // Adds a task on hitting Enter key, hides the panel for entering new task on hitting Esc. key
        $('#new-task').keydown(function (event) {
            // Get the code of the key that is pressed
            var keyCode = event.keyCode;
            var enterKeyCode = 13;
            var escapeKeyCode = 27;
            // If error message is already displayed, hide it.
            if ($('#new-task').hasClass('error')) {
                $('#new-task').removeClass('error');
                $('.new-task-wrapper .error-message').addClass('hidden');
            }
            // If key code is that of Enter Key then call addTask Function
            if (keyCode == enterKeyCode) {
                event.preventDefault();
                addTask();
            }
            // If key code is that of Esc Key then call closeNewTaskPanel Function
            else if (keyCode == escapeKeyCode)
                closeNewTaskPanel();

        });

        // Add new task on click of add task button
        $('#add-task').click(addTask);

        // Close new task panel on click of close panel button
        $('#close-task-panel').click(closeNewTaskPanel);

        // Mark all tasks as complete on click of mark all finished button
        $('#mark-all-finished').click(function () {
            $('#task-list .task').addClass('completed');
            $('#mark-all-incomplete').removeClass('move-down');
            $(this).addClass('move-up');
            updateNotification('All tasks', 'tarea completada.', 'success');
        });

        // Mark all tasks as incomplete on click of mark all incomplete button
        $('#mark-all-incomplete').click(function () {
            $('#task-list .task').removeClass('completed');
            $(this).addClass('move-down');
            $('#mark-all-finished').removeClass('move-up');
            updateNotification('All tasks', 'tarea incompleta.');
        });

        var actualizaInfoProyecto = function () {
            $.ajax({
                type: "GET",
                url: $('#urlInfoProyecto').val(),
                data: {
                    id: $('#_i_p').val()
                },
                dataType: "json",
                success: function (response) {
                    $('#txtTareasPendientes').text(response.pendientes);
                    $('#txtTareasCompletas').text(response.completos);
                    $('#baraProgreso').css('width', `${response.porcentaje}%`);
                    $('#baraProgreso').attr('data-original-title', `${response.porcentaje}%`);
                    $('#txtPorcentaje').text(`${response.porcentaje}%`);
                }
            });
        }

        var actualizaInfoAdicionalProyecto = function (e) {
            e.preventDefault();
            let archivo_actividad = $("#archivo_actividad");
            let empresa_adjudicado = $("#empresa_adjudicado");
            let monto = $("#monto");

            let formData = new FormData();
            let archivo = archivo_actividad[0].files[0];
            formData.append("archivo", archivo);
            formData.append("empresa_adjudicado", empresa_adjudicado.val());
            formData.append("monto", monto.val());

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('#token').val()
                },
                type: "POST",
                url: actividad_actual,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (response) {
                    actualizaInfoProyecto();
                    $("#txt_nombre_tarea").text(response.actividad.nombre);
                    updateNotification(response.actividad.nombre, 'Tarea actualizada', 'success')
                    modal_info_actividad.modal("hide");
                    let el_actualizado = $(response.actividadTemplate).clone();
                    elemento_actual.html(el_actualizado.html());
                    actividad_actual = null;
                    limpiarForm();
                    toggleTitle();
                }
            });
        }

        var iniciaForm = function () {
            let boton_info = elemento_actual.find(".informacion-btn");
            let nombre = boton_info.attr('data-nombre');
            $("#txt_nombre_tarea").text(nombre);
            $("#empresa_adjudicado").val(boton_info.attr('data-empresa'));
            $("#monto").val(boton_info.attr('data-monto'));
        }

        var limpiarForm = function () {
            $("#archivo_actividad").val("");
            $("#empresa_adjudicado").val("");
            $("#monto").val("");
        }
    });
}(jQuery))
