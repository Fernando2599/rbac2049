$(document).ready(function () {

    let academicoId = 0;

    /*=============================================================================================
    //* Evento para limpiar la variable empresaId en caso de cerrar el modal
    =============================================================================================*/
    $('#removeAcademincoModal').on('hidden.bs.modal', function (event) {
        academicoId = 0;
    });

    /*=============================================================================================
    //* Evento para obtener el id del proyecto cuando se abre el modal de confirmacion
    =============================================================================================*/
    $('.delete-academico-button').on('click', function (event) {

        event.preventDefault(); // Evitar la acción predeterminada del enlace

        academicoId = $(this).data('academico-id');
        console.log(academicoId);

    });

    $('#confirmDeleteButton').on('click', function (event) {
        event.preventDefault(); // Evitar la acción predeterminada del enlace
        deleteAcademico(academicoId);
    });



}); //-----------------------------Fin Ready -------------------------

/*=============================================================================================
//* Funcion para eliminar un registro al hacer click en el boton del modal
=============================================================================================*/

function deleteAcademico (id) {  
     // Enviar la solicitud AJAX para eliminar el proyecto
     $.ajax({
        url: 'index.php?r=grado-academico/delete&id=' + id, // URl de la ruta de la funcion delete en el controllador
        type: 'POST',
        success: function (response) {
        },
        error: function (jqXHR, textStatus, errorThrown) {
            // Manejar errores si es necesario
            console.error('Error:', textStatus, errorThrown);
        }
    });
}