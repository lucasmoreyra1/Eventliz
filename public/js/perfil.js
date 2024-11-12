$('#example').DataTable();


$(document).ready(function() {



    $('#saveNombreBtn').on('click', function() {
        var form = $('#cambiarNombre').find('form');
        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: form.serialize(),
            success: function(response) {
                $('#cambiarNombre').modal('hide');
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


    $('#saveEmailBtn').on('click', function() {
        var form = $('#cambiarEmail').find('form');
        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: form.serialize(),
            success: function(response) {
                $('#cambiarEmail').modal('hide');
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



    $('#savePasswordBtn').on('click', function() {
        var form = $('#cambiarContraseña').find('form');
        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: form.serialize(),
            success: function(response) {
                $('#cambiarContraseña').modal('hide');
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
    

});


