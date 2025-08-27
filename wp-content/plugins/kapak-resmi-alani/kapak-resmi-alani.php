<?php
/*
Plugin Name: Kapak Resmi Alanı
Description: Products-category taxonomy’sine kapak resmi ekleme alanı.
*/

// Alanı kategori ekleme ekranına ekle
add_action('products-category_add_form_fields', function() {
    ?>
    <div class="form-field">
        <label for="kapak_resmi"><?php _e('Kapak Resmi', 'textdomain'); ?></label>
        <input type="hidden" name="kapak_resmi" id="kapak_resmi" value="" />
        <button class="button upload_kapak_resmi">Yükle</button>
        <div class="preview_kapak_resmi" style="margin-top:10px;"></div>
    </div>
    <?php
});

// Alanı kategori düzenleme ekranına ekle
add_action('products-category_edit_form_fields', function($term) {
    $kapak_resmi = get_term_meta($term->term_id, 'kapak_resmi', true);
    ?>
    <tr class="form-field">
        <th scope="row"><label for="kapak_resmi"><?php _e('Kapak Resmi', 'textdomain'); ?></label></th>
        <td>
            <input type="hidden" name="kapak_resmi" id="kapak_resmi" value="<?php echo esc_attr($kapak_resmi); ?>" />
            <button class="button upload_kapak_resmi">Yükle</button>
            <div class="preview_kapak_resmi" style="margin-top:10px;">
                <?php if ($kapak_resmi): ?>
                    <img src="<?php echo esc_url($kapak_resmi); ?>" style="max-width:150px;" />
                <?php endif; ?>
            </div>
        </td>
    </tr>
    <?php
});

// Kaydetme
add_action('created_products-category', function($term_id) {
    if (isset($_POST['kapak_resmi'])) {
        update_term_meta($term_id, 'kapak_resmi', esc_url_raw($_POST['kapak_resmi']));
    }
});
add_action('edited_products-category', function($term_id) {
    if (isset($_POST['kapak_resmi'])) {
        update_term_meta($term_id, 'kapak_resmi', esc_url_raw($_POST['kapak_resmi']));
    }
});

// Admin script ve medya yükleyici
add_action('admin_enqueue_scripts', function($hook) {
    if (($hook === 'edit-tags.php' || $hook === 'term.php') && isset($_GET['taxonomy']) && $_GET['taxonomy'] === 'products-category') {
        wp_enqueue_media();
        wp_enqueue_script('kapak-resmi-js', plugin_dir_url(__FILE__) . 'kapak-resmi.js', ['jquery'], '1.0', true);
    }
});
