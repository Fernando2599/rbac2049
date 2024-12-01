$(document).ready(function () {

    let documentoId = 0;

    /*=============================================================================================
    //* Evento para limpiar la variable especialidadId en caso de cerrar el modal
    =============================================================================================*/
    $('#removeDocumentoModal').on('hidden.bs.modal', function (event) {
        documentoId = 0;
    });

    /*=============================================================================================
    //* Evento para obtener el id del proyecto cuando se abre el modal de confirmacion
    =============================================================================================*/
    $('.delete-documento-button').on('click', function (event) {

        event.preventDefault(); // Evitar la acción predeterminada del enlace

        documentoId = $(this).data('documento-id');
        console.log(documentoId);
    });

    $('#confirmDeleteButton').on('click', function (event) {
        event.preventDefault(); // Evitar la acción predeterminada del enlace
        deleteDocumento(documentoId);
    });



}); //-----------------------------Fin Ready -------------------------

/*=============================================================================================
//* Funcion para eliminar un registro al hacer click en el boton del modal
=============================================================================================*/

function deleteDocumento (id) {  
     // Enviar la solicitud AJAX para eliminar el proyecto
     $.ajax({
        url: 'index.php?r=documento/delete&id=' + id, // URl de la ruta de la funcion delete en el controllador
        type: 'POST',
        success: function (response) {
        },
        error: function (jqXHR, textStatus, errorThrown) {
            // Manejar errores si es necesario
            console.error('Error:', textStatus, errorThrown);
        }
    });
}