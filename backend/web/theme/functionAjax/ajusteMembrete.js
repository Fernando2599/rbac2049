$('#membrete-header-file-input').on('change', function(event) {
    const input = event.target;
    const preview = $('#membrete-preview-header');
    const status = $('#upload-status');

    if (input.files && input.files[0]) {
        const file = input.files[0];
        const reader = new FileReader();

        // Previsualiza la imagen seleccionada
        reader.onload = function(e) {
            preview.attr('src', e.target.result);
        };

        reader.readAsDataURL(file);

        // Subir la imagen mediante AJAX
        const formData = new FormData();
        formData.append('Membrete[archivo]', file);

        $.ajax({
            url: 'index.php?r=membrete%2Fcreate-header',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                
                if (data.success) {
                    status.html(`<span class="text-success">${data.message}</span>`);
                    preview.attr('src', '<?= Yii::getAlias("@web/") ?>' + data.ruta);
                    location.reload();
                } else {
                    status.html(`<span class="text-danger">Error: ${data.message}</span>`);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                status.html(`<span class="text-danger">Error en la subida: ${errorThrown}</span>`);
            }
        });
    }
});
$('#membrete-footer-file-input').on('change', function(event) {
    const input = event.target;
    const preview = $('#membrete-preview-footer');
    const status = $('#upload-status');

    if (input.files && input.files[0]) {
        const file = input.files[0];
        const reader = new FileReader();

        // Previsualiza la imagen seleccionada
        reader.onload = function(e) {
            preview.attr('src', e.target.result);
        };

        reader.readAsDataURL(file);

        // Subir la imagen mediante AJAX
        const formData = new FormData();
        formData.append('Membrete[archivo]', file);

        $.ajax({
            url: 'index.php?r=membrete%2Fcreate-footer',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                
                if (data.success) {
                    status.html(`<span class="text-success">${data.message}</span>`);
                    preview.attr('src', '<?= Yii::getAlias("@web/") ?>' + data.ruta);
                    location.reload();
                } else {
                    status.html(`<span class="text-danger">Error: ${data.message}</span>`);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                status.html(`<span class="text-danger">Error en la subida: ${errorThrown}</span>`);
            }
        });
    }
});

