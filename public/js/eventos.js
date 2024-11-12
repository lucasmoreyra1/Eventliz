
$(document).ready(function() {
    $('#eventoModal').on('show.bs.modal', function (e) {
        var modal = $(this);
        $.ajax({
            url: "/eventos/create",
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

    $('#saveEventoBtn').on('click', function() {
        var form = $('#eventoModal').find('form');
        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: form.serialize(),
            success: function(response) {
                $('#eventoModal').modal('hide');
                swal({
                    title: "Éxito",
                    text: response.message,
                    icon: "success",
                }).then((willReload) => {
                    if (willReload) {
                        location.reload();
                    }
                });
            },
            error: function(xhr) {
                form.find('.text-danger').remove();
                console.error("Error saving form: ", xhr);
                var errors = xhr.responseJSON.errors;
                for (var field in errors) {
                    form.find('[name=' + field + ']').after('<span class="text-danger">' + errors[field][0] + '</span><br>');
                }
    
                // Mostrar alerta con swal
                swal({
                    title: "Error",
                    text: "Por favor, corrige los errores en el formulario.",
                    icon: "error",
                });
            }
        });
    });



    $('#editar').on('show.bs.modal', function (e) {
        var modal = $(this);
    
        // Obtener la fila marcada con la clase 'table-primary'
        var filaSeleccionada = $('.evento-row.table-primary');
        
        // Verificar si se encontró una fila seleccionada
        if (filaSeleccionada.length > 0) {

            // Obtener el ID del evento de la fila seleccionada
            var eventoId = filaSeleccionada.attr('data-evento-id');

            // Realizar la petición AJAX pasando el ID del evento al servidor
            $.ajax({
                url: "/eventos/" + eventoId + "/edit", // Ajusta la URL según tu ruta de edición
                method: 'GET',
                success: function(response) {
                    modal.find('.modal-body').html(response);
                },
                error: function(xhr) {
                    form.find('.text-danger').remove();
                    console.error("Error loading form: ", xhr.responseJSON);
                    modal.find('.modal-body').html("<p>Hubo un error al cargar el formulario.</p>" + xhr.responseJSON.message);
                }
            });
        } else {
            swal({
                title: "Error",
                text: "No se ha seleccionado ningún evento para editar.",
                icon: "error",
            }).then((willClose) => {
                if (willClose) {
                    document.querySelector('.btn-cerrar[data-dismiss="modal"]').click();
                }
              });

        }
    });



    $('#editarEventoBtn').on('click', function() {
        var form = $('#editar').find('form');
        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: form.serialize(),
            success: function(response) {
                $('#editar').modal('hide');
                swal({
                    title: "Éxito",
                    text: response.message,
                    icon: "success",
                }).then((willReload) => {
                    if (willReload) {
                        location.reload();
                    }
                });
            },
            error: function(xhr) {
                console.error("Error saving form: ", xhr);
                var errors = xhr.responseJSON.errors;
                for (var field in errors) {
                    form.find('[name=' + field + ']').after('<span class="text-danger">' + errors[field][0] + '</span>');
                }
    
                // Mostrar alerta con swal
                swal({
                    title: "Error",
                    text: "Por favor, corrige los errores en el formulario.",
                    icon: "error",
                });
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
                    swal({
                        title: "Éxito",
                        text: "Realizado correctamente",
                        icon: "success",
                    }).then((willReload) => {
                        if (willReload) {
                            location.reload();
                        }
                    });
                },
                error: function(xhr) {
                    // Mostrar alerta con swal
                    swal({
                        title: "Error",
                        text: "Error al archivar.",
                        icon: "error",
                    });
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


    $('#finalizarEventoBtn').on('click', function() {

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
                        url: "/eventos/finalizar/" + eventoId, // Ajusta la URL según tu ruta de edición
                        method: 'GET',
                        success: function(response) {
                            swal({
                                title: "Éxito",
                                text: "Realizado correctamente",
                                icon: "success",
                            }).then((willReload) => {
                                if (willReload) {
                                    location.reload();
                                }
                            });
                        },
                        error: function(xhr) {
                            // Mostrar alerta con swal
                            swal({
                                title: "Error",
                                text: "Error al finalizar.",
                                icon: "error",
                            });
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


    $('#activarEventoBtn').on('click', function() {
        var filaSeleccionada = $('.evento-row.table-primary');

        if (filaSeleccionada.length > 0) {
            
            // Obtener el ID del evento de la fila seleccionada
            var eventoId = filaSeleccionada.attr('data-evento-id');
            console.log(eventoId);

            // Realizar la petición AJAX pasando el ID del evento al servidor
            $.ajax({
                url: "/eventos/activar/" + eventoId, // Ajusta la URL según tu ruta de edición
                method: 'GET',
                success: function(response) {
                    swal({
                        title: "Éxito",
                        text: "Realizado correctamente",
                        icon: "success",
                    }).then((willReload) => {
                        if (willReload) {
                            location.reload();
                        }
                    });
                },
                error: function(xhr) {
                    // Mostrar alerta con swal
                    swal({
                        title: "Error",
                        text: "Error inesperado: "+xhr,
                        icon: "error",
                    });
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


$('#visualizar').on('show.bs.modal', function (e) {
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
            url: "/eventos/" + eventoId , // Ajusta la URL según tu ruta de edición
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
        }).then((willClose) => {
            if (willClose) {
                document.querySelector('.btn-cerrarVis[data-dismiss="modal"]').click();
            }
          });

/*           setTimeout(function() {
            modal.modal('hide');
        }, 100); */
    }
});


// Delegar el evento de clic en la tabla en lugar de las filas individuales
$(document).on('click', '.evento-row', function() {
    var fila = $(this);

    // Si la fila ya está seleccionada, la deselecciona
    if (fila.hasClass('table-primary')) {
        fila.removeClass('table-primary');
    } else {
        // Desmarcar cualquier otra fila que esté seleccionada
        $('.evento-row').removeClass('table-primary');

        // Marcar la fila actual como seleccionada
        fila.addClass('table-primary');
    }
});



