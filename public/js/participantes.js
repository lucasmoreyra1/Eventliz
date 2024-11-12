import { mensajesAlerta } from './funciones.js';


$(document).ready(function() {

    $('#gestionarParticipantes').on('click', function() {
        var filaSeleccionada = $('.evento-row.table-primary');
        
        if (filaSeleccionada.length > 0) {
            // Obtener el ID del evento de la fila seleccionada
            var eventoId = filaSeleccionada.attr('data-evento-id');
            
            // Redirigir a la URL deseada
            window.location.href = "/participantes/eventos/" + eventoId;
        } else {
            swal({
                title: "Error",
                text: "No se ha seleccionado ningún evento.",
                icon: "error",
            });
        }
    });

    



    $('#agregarParticipante').on('show.bs.modal', function (e) {
        var modal = $(this);
        var eventoId = $('#botonAgregarParticipante').attr('data-evento-id');
        console.log("/participantes/create/" + eventoId);

        $.ajax({
            url: "/agregar/create/" + eventoId,
            method: 'GET',
            success: function(response) {
                modal.find('.modal-body').html(response);
            },
            error: function(xhr) {
                console.error("Error loading form: ", xhr);
                modal.find('.modal-body').html(xhr.responseText);
            }
        });
    });


    $('#saveParticipanteBtn').on('click', function() {
        var form = $('#agregarParticipante').find('form');
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




    $('#editarParticipante').on('show.bs.modal', function (e) {
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
                url: "/participantes/" + eventoId + "/edit", // Ajusta la URL según tu ruta de edición
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
            swal({
                title: "Error",
                text: "No se ha seleccionado ningún evento.",
                icon: "error",
            });
        }
    });

    $('#editarParticipanteBtn').on('click', function() {
        var form = $('#editarParticipante').find('form');
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


    $('#archivarEventoBtn').on('click', function() {
        var filaSeleccionada = $('.evento-row.table-primary');

        if (filaSeleccionada.length > 0) {
            
            // Obtener el ID del evento de la fila seleccionada
            var eventoId = filaSeleccionada.attr('data-evento-id');
            console.log(eventoId);

            // Realizar la petición AJAX pasando el ID del evento al servidor
            $.ajax({
                url: "/eventos/archivar/" + eventoId, // Ajusta la URL según tu ruta de edición
                method: 'GET',
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr) {
                    console.error("Error loading form: ", xhr.responseJSON);
                    
                }
            });
        } else {
            swal({
                title: "Error",
                text: "No se ha seleccionado ningún evento.",
                icon: "error",
            });
        }



    });

});



$('#eliminarParticipanteBtn').on('click', function() 
{
    var filaSeleccionada = $('.evento-row.table-primary');

        if (filaSeleccionada.length > 0) {
            
            // Obtener el ID del evento de la fila seleccionada
            var eventoId = filaSeleccionada.attr('data-evento-id');
            console.log(eventoId);

            var token = $('meta[name="csrf-token"]').attr('content');
            // Realizar la petición AJAX pasando el ID del evento al servidor
            $.ajax({
                url: "/participantes/" + eventoId, // Ajusta la URL según tu ruta de edición
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
            swal({
                title: "Error",
                text: "No se ha seleccionado ningún elemento.",
                icon: "error",
            });
        }
});


$('#realizarPago').on('click', function() {

    swal({
        title: "¿Estás seguro?",
        text: "¡No podrás revertir esta acción!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {

            var filaSeleccionada = $('.evento-row.table-primary');
            if (filaSeleccionada.length > 0) {
                // Obtener el ID del evento de la fila seleccionada
                var eventoId = filaSeleccionada.attr('data-evento-id');
                // Realizar la petición AJAX pasando el ID del evento al servidor
                $.ajax({
                    url: "/participantes/pago/" + eventoId, // Ajusta la URL según tu ruta de edición
                    method: 'GET',
                    success: function(response) {
                        mensajesAlerta("success");
                    },
                    error: function(xhr) {
                        mensajesAlerta("error", xhr);
                    }
                });
            } else {
                swal({
                    title: "Error",
                    text: "No se ha seleccionado ningún evento.",
                    icon: "error",
                });
            }
        }
    });

});

