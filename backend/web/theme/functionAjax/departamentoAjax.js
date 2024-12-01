$(document).ready(function () {

    let departamentoId = 0;

    /*=============================================================================================
    //* Evento para limpiar la variable especialidadId en caso de cerrar el modal
    =============================================================================================*/
    $('#removeDepartamentoModal').on('hidden.bs.modal', function (event) {
        departamentoId = 0;
    });

    /*=============================================================================================
    //* Evento para obtener el id del proyecto cuando se abre el modal de confirmacion
    =============================================================================================*/
    $('.delete-departamento-button').on('click', function (event) {

        event.preventDefault(); // Evitar la acción predeterminada del enlace

        departamentoId = $(this).data('departamento-id');

    });

    $('#confirmDeleteButton').on('click', function (event) {
        event.preventDefault(); // Evitar la acción predeterminada del enlace
        deleteDepartamento(departamentoId);
    });



}); //-----------------------------Fin Ready -------------------------

/*=============================================================================================
//* Funcion para eliminar un registro al hacer click en el boton del modal
=============================================================================================*/

function deleteDepartamento (id) {  
     // Enviar la solicitud AJAX para eliminar el proyecto
     $.ajax({
        url: 'index.php?r=departamento/delete&id=' + id, // URl de la ruta de la funcion delete en el controllador
        type: 'POST',
        success: function (response) {
        },
        error: function (jqXHR, textStatus, errorThrown) {
            // Manejar errores si es necesario
            console.error('Error:', textStatus, errorThrown);
        }
    });
}