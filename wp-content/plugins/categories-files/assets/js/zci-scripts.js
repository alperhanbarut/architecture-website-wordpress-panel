jQuery(document).ready(function($) {
    var upload_button;
    
    $(".z_upload_pdf_button").on('click', function(event) {
        upload_button = $(this);
        var frame;
        if (zci_config.wordpress_ver >= "3.5") {
            event.preventDefault();
            if (frame) {
                frame.open();
                return;
            }
            frame = wp.media();
            
            frame.on("select", function() {
                var attachment = frame.state().get("selection").first();
                var attachmentUrl = attachment.attributes.url;
                var attachmentId = attachment.attributes.id;
                
                frame.close();
                $("#zci_taxonomy_pdf").val(attachmentUrl);
                $("#zci_taxonomy_pdf_id").val(attachmentId);
                $(".zci-taxonomy-pdf-link").attr("href", attachmentUrl).text("Seçilen PDF Dosyası");
            });
            
            frame.open();
        }
        else {
            tb_show("", "media-upload.php?type=application/pdf&amp;TB_iframe=true");
            return false;
        }
    });
    
    $(".z_remove_pdf_button").on('click', function() {
        $("#zci_taxonomy_pdf").val("");
        $("#zci_taxonomy_pdf_id").val("");
        $(".zci-taxonomy-pdf-link").attr("href", "").text("");
        return false;
    });
});
