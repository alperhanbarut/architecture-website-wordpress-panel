jQuery(document).ready(function($){
    var mediaUploader;

    $(document).on('click', '.upload_kapak_resmi', function(e){
        e.preventDefault();
        var button = $(this);
        var inputField = button.siblings('input#kapak_resmi');
        var previewDiv = button.siblings('.preview_kapak_resmi');

        // Medya yükleyici varsa aç
        if (mediaUploader) {
            mediaUploader.open();
            return;
        }

        // Yeni medya yükleyici oluştur
        mediaUploader = wp.media({
            title: 'Kapak Resmi Seç',
            button: { text: 'Kullan' },
            multiple: false
        });

        mediaUploader.on('select', function(){
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            inputField.val(attachment.url);
            previewDiv.html('<img src="'+attachment.url+'" style="max-width:150px; margin-top:10px;" />');
        });

        mediaUploader.open();
    });
});
