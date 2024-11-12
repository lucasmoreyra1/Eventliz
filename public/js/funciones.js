export function mensajesAlerta(tipo, form = null, xhr = null)
{
    if (tipo == "success") {
        swal({
            title: "Éxito",
            text: "Realizado con exito.",
            icon: "success",
        }).then((willReload) => {
            if (willReload) {
                location.reload();
            }
        });
    }
    else if(tipo == "error")
    {
        if(form != null && xhr != null)
        {
            console.error("Error saving form: ", xhr);
            var errors = xhr.responseJSON.errors;
    
            // Eliminar mensajes de error anteriores
            form.find('.text-danger').remove();
    
            for (var field in errors) {
                var errorMessage = '<span class="text-danger">' + errors[field][0] + '</span>';
                form.find('[name=' + field + ']').after(errorMessage);
            }
        }

        // Mostrar alerta con swal
        swal({
            title: "Error",
            text: "Ocurrió un error, vuelve a intentarlo.",
            icon: "error",
        });
    }
}