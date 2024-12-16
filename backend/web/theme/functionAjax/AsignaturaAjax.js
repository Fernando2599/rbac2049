$(document).ready(function () {

    let asignaturaId = 0;

    /*=============================================================================================
    //* Evento para limpiar la variable especialidadId en caso de cerrar el modal
    =============================================================================================*/
    $('#removeAsignaturaModal').on('hidden.bs.modal', function (event) {
        asignaturaId = 0;
    });

    /*=============================================================================================
    //* Evento para obtener el id del proyecto cuando se abre el modal de confirmacion
    =============================================================================================*/
    $('.delete-asignatura-button').on('click', function (event) {

        event.preventDefault(); // Evitar la acción predeterminada del enlace

        asignaturaId = $(this).data('asignatura-id');

    });

    $('#confirmDeleteButton').on('click', function (event) {
        event.preventDefault(); // Evitar la acción predeterminada del enlace
        deleteAsignatura(asignaturaId);
    });

    $('.switch-estado').on('change', function () {

        // Se almacena el input switch en una variable
        let $switch = $(this);

        // Almacena el id del switch desde el atributo data
        let id = $switch.data('asignatura-id');

        // Actualiza el estado basado en si tiene el atributo checked
        let status = $switch.is(":checked");

        // Mensaje a mostrar según el estado
        let message = status ? '¿Estás seguro de habilitar la asignatura?' : '¿Estás seguro de deshabilitar la asignatura?';

        // Llamada de la función para mostrar el mensaje de confirmación
        confirmationMessage(message, function (confirmed) {
            if (confirmed) {
                updateStatus(id, status); // Llama a la función que hace la actualización
            } else {
                $switch.prop('checked', !status); // Revertir el cambio si no se confirma
            }
        });
    });
});

function confirmationMessage(message, callback) {
    Swal.fire({
        html: '<div class="mt-3">' +
            '<lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>' +
            '<div class="mt-4 pt-2 fs-15 mx-5">' +
            '<h4>¿Estás seguro?</h4>' +
            `<p class="text-muted mx-4 mb-0">${message}</p>` +
            '</div>' +
            '</div>',
        showCancelButton: true,
        confirmButtonClass: 'btn btn-primary w-xs me-2 mb-1',
        confirmButtonText: 'Sí, confirmar',
        cancelButtonText: 'Cancelar',
        cancelButtonClass: 'btn btn-danger w-xs mb-1',
        buttonsStyling: false,
        showCloseButton: true
    }).then((result) => {
        callback(result.isConfirmed);
    });
}

function alertMessage(icon, message) {
    Swal.fire({
        position: 'center',
        icon: icon,
        title: message,
        showConfirmButton: false,
        timer: 2000,
        showCloseButton: true
    })
}
/*=============================================================================================
//* Funcion para cambiar el estado del registro
=============================================================================================*/

function updateStatus(id, status) {
    $.ajax({
        url: 'index.php?r=asignatura/update-status&id=' + id,
        method: 'POST', // Asegúrate de usar 'method' en lugar de 'type'
        data: {
            id: id,
            status: status ? 1 : 2,
            _csrf: yii.getCsrfToken() // Agrega el token CSRF
        },
        success: function (response) {
            console.log(response);
            if (response.success === true) {
                alertMessage('success', response.message);
                setTimeout(() => {

                    location.reload(); // Recarga la página
                }, 1800);
            } else {
                alertMessage('danger', response.message);
            }

        },
    });

}

function deleteAsignatura (id) {  
    // Enviar la solicitud AJAX para eliminar el proyecto
    $.ajax({
       url: 'index.php?r=asignatura/delete&id=' + id, // URl de la ruta de la funcion delete en el controllador
       type: 'POST',
       success: function (response) {
       },
       error: function (jqXHR, textStatus, errorThrown) {
           // Manejar errores si es necesario
           console.error('Error:', textStatus, errorThrown);
       }
   });
}