import { mensajesAlerta } from './funciones.js';


$(document).ready(function() {
    $('#agregarCliente').on('show.bs.modal', function (e) {
        var modal = $(this);
        $.ajax({
            url: "/clientes/create",
            method: 'GET',
            success: function(response) {
                modal.find('.modal-body').html(response);
            },
            error: function(xhr) {
                console.error("Error loading form: ", xhr);
                modal.find('.modal-body').html("<p>Hubo un error al cargar el formulario.</p>");
            }
        });
    });


    $('#saveClienteBtn').on('click', function() {
        var form = $('#agregarCliente').find('form');
        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: form.serialize(),
            success: function(response) {
                mensajesAlerta("success", form);
            },
            error: function(xhr) {
                mensajesAlerta("error", form, xhr);
            }
        });
    });




    $('#editarCliente').on('show.bs.modal', function (e) {
        var modal = $(this);

        // Obtener la fila marcada con la clase 'table-primary'
        var filaSeleccionada = $('.evento-row.table-primary');

        // Verificar si se encontró una fila seleccionada
        if (filaSeleccionada.length > 0) {

            // Obtener el ID del evento de la fila seleccionada
            var eventoId = filaSeleccionada.attr('data-evento-id');
            console.log(eventoId);
            // Realizar la petición AJAX pasando el ID del evento al servidor
            $.ajax({
                url: "/clientes/" + eventoId + "/edit", // Ajusta la URL según tu ruta de edición
                method: 'GET',
                success: function(response) {
                    modal.find('.modal-body').html(response);
                },
                error: function(xhr) {
                    console.error("Error loading form: ", xhr.responseJSON);
                    modal.find('.modal-body').html("<p>Hubo un error al cargar el formulario.</p>" + xhr.responseJSON.message);
                }
            });
        } else {
            // Si no se seleccionó ninguna fila, mostrar un mensaje de error o manejar la situación según sea necesario
            console.error("No se ha seleccionado ningún evento para editar.");
            // Aquí podrías mostrar un mensaje de error al usuario o tomar otra acción según tu lógica de aplicación
        }
    });

    $('#editarClienteBtn').on('click', function() {
        var form = $('#editarCliente').find('form');
        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: form.serialize(),
            success: function(response) {
                mensajesAlerta("success", form);
            },
            error: function(xhr) {
                mensajesAlerta("error", form, xhr);
            }
        });
    });


});



$('#eliminarClienteBtn').on('click', function() 
{
    var filaSeleccionada = $('.evento-row.table-primary');

        if (filaSeleccionada.length > 0) {
            
            // Obtener el ID del evento de la fila seleccionada
            var eventoId = filaSeleccionada.attr('data-evento-id');
            console.log(eventoId);

            var token = $('meta[name="csrf-token"]').attr('content');
            // Realizar la petición AJAX pasando el ID del evento al servidor
            $.ajax({
                url: "clientes/" + eventoId, // Ajusta la URL según tu ruta de edición
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': token // Incluir el token CSRF en los encabezados
                },
                success: function(response) {
                    mensajesAlerta("success");

                },
                error: function(xhr) {
                    mensajesAlerta("error", xhr);

                }
            });
        } else {
            // Si no se seleccionó ninguna fila, mostrar un mensaje de error o manejar la situación según sea necesario
            console.error("No se ha seleccionado ningún evento para editar.");
            // Aquí podrías mostrar un mensaje de error al usuario o tomar otra acción según tu lógica de aplicación
        }
});



