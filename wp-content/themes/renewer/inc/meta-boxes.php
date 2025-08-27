<?php

// SAYFA AYARLARI
add_filter('rwmb_meta_boxes', 'sayfa_ayarlari');
function sayfa_ayarlari($meta_boxes)
{
    $prefix = 'Renewer_sayfalar_';
    $meta_boxes[] = [
        'title'      => esc_html__('Sayfa Ayarları', 'Renewer'),
        'id'         => 'sayfa',
        'post_types' => ['page'],
        'context'    => 'normal',
        'autosave'   => true,
        'fields'     => [
            [
                'type' => 'image',
                'name' => esc_html__('Sayfa Banner Resmi', 'Renewer'),
                'id'   => $prefix . 'banner',
            ],
        ],
    ];
    return $meta_boxes;
}


// SLIDER AYARLARI
add_filter('rwmb_meta_boxes', 'slider_ayarlari');
function slider_ayarlari($meta_boxes)
{
    $prefix = 'Renewer_slider_';

    $meta_boxes[] = [
        'title'      => esc_html__('Slider Ayarları', 'Renewer'),
        'id'         => 'slider',
        'post_types' => ['slider'],
        'context'    => 'normal',
        'autosave'   => true,
        'fields'     => [
            [
                'id'   => $prefix . 'slider_ikinci_baslik',
                'name' => 'Slider İkinci Başlık',
                'type' => 'text',
            ],

        ],
    ];

    return $meta_boxes;
}


// HİZMET AYARLARI
add_filter('rwmb_meta_boxes', 'hizmet_ayarlari');
function hizmet_ayarlari($meta_boxes)
{
    $prefix = 'Renewer_hizmet_';
    $meta_boxes[] = [
        'title'      => esc_html__('Hizmet Ayarları', 'Renewer'),
        'id'         => 'hizmetler',
        'post_types' => ['hizmetler'],
        'context'    => 'normal',
        'autosave'   => true,
        'fields'     => [
            [
                'type' => 'image',
                'name' => esc_html__('Hizmet Kapak Resmi', 'Renewer'),
                'id'   => $prefix . 'hizmet_kapak_img',
            ],
            [
                'type' => 'image',
                'name' => esc_html__('Hizmet Banner Resmi', 'Renewer'),
                'id'   => $prefix . 'hizmet_banner_img',
            ],
            [
                'type' => 'wysiwyg',
                'name' => esc_html__('Hizmet Kısa Açıklama', 'Renewer'),
                'id'   => $prefix . 'hizmet_short_content',
            ],
        ],
    ];
    return $meta_boxes;
}

// FİYATLARIMIZ AYARLARI
add_filter('rwmb_meta_boxes', 'fiyatlarimiz_ayarlari');
function fiyatlarimiz_ayarlari($meta_boxes)
{
    $prefix = 'Renewer_fiyatlarimiz_';
    $meta_boxes[] = [
        'title'      => esc_html__('Fiyatlarımız Ayarları', 'Renewer'),
        'id'         => 'fiyatlar',
        'post_types' => ['fiyatlar'],
        'context'    => 'normal',
        'autosave'   => true,
        'fields'     => [
            [
                'type' => 'wysiwyg',
                'name' => esc_html__('Fiyatlar Açıklama', 'Renewer'),
                'id'   => $prefix . 'fiyatlar_text',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Fiyat', 'Renewer'),
                'id'   => $prefix . 'fiyat',
            ],
        ],
    ];
    return $meta_boxes;
}

// ÜRÜN AYARLARI
add_filter('rwmb_meta_boxes', 'urun_ayarlari');
function urun_ayarlari($meta_boxes)
{
    $prefix = 'Renewer_urun_';
    $meta_boxes[] = [
        'title'      => esc_html__('Ürün Ayarları', 'Renewer'),
        'id'         => 'urun',
        'post_types' => ['urun'],
        'context'    => 'normal',
        'autosave'   => true,
        'fields'     => [
            [
                'type' => 'image',
                'name' => esc_html__('Ürün Resmi', 'Renewer'),
                'id'   => $prefix . 'urun_image',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Ürün Alt Başlık', 'Renewer'),
                'id'   => $prefix . 'urun_altbaslik',
            ],
        ],
    ];
    return $meta_boxes;
}

// DİKEY SLIDER AYARLARI
add_filter('rwmb_meta_boxes', 'dikey_slider_ayarlari');
function dikey_slider_ayarlari($meta_boxes)
{
    $prefix = 'Renewer_dikey_slider_';
    $meta_boxes[] = [
        'title'      => esc_html__('Dikey Slider Ayarları', 'Renewer'),
        'id'         => 'dikey_slider',
        'post_types' => ['dikey_slider'],
        'context'    => 'normal',
        'autosave'   => true,
        'fields'     => [
            [
                'type' => 'image',
                'name' => esc_html__('Dikey Slider Background Resmi', 'Renewer'),
                'id'   => $prefix . 'dikey_slider_background_image',
            ],
            [
                'type' => 'image',
                'name' => esc_html__('Dikey Slider Mobil Resmi', 'Renewer'),
                'id'   => $prefix . 'dikey_slider_mobil_image',
            ],
        ],
    ];
    return $meta_boxes;
}
// HABERLER AYARLARI
add_filter('rwmb_meta_boxes', 'haberler_ayarlari');
function haberler_ayarlari($meta_boxes)
{
    $prefix = 'haberler_';
    $meta_boxes[] = [
        'title'      => esc_html__('Haberler Ayarları', 'Renewer'),
        'id'         => 'haberler_meta',
        'post_types' => ['haberler'],
        'context'    => 'normal',
        'autosave'   => true,
        'fields'     => [
            [
                'type' => 'date',
                'name' => esc_html__('Tarih', 'Renewer'),
                'id'   => $prefix . 'tarih',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Yazan Kişi', 'Renewer'),
                'id'   => $prefix . 'yazar',
            ],
        ],
    ];
    return $meta_boxes;
}

// projeler AYARLARI
add_filter('rwmb_meta_boxes', 'projeler_ayarlari');
function projeler_ayarlari($meta_boxes)
{
    $prefix = 'projeler_';
    $meta_boxes[] = [
        'title'      => esc_html__('projeler Ayarları', 'Renewer'),
        'id'         => 'projeler_meta',
        'post_types' => ['projeler'],
        'context'    => 'normal',
        'autosave'   => true,
        'fields'     => [
            [
                'type' => 'date',
                'name' => esc_html__('Tarih', 'Renewer'),
                'id'   => $prefix . 'tarih',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Yazan Kişi', 'Renewer'),
                'id'   => $prefix . 'yazar',
            ],
        ],
    ];
    return $meta_boxes;
}
// faaliyet_alan AYARLARI
add_filter('rwmb_meta_boxes', 'faaliyet_alan_ayarlari');
function faaliyet_alan_ayarlari($meta_boxes)
{
    $prefix = 'faaliyet_alan_';
    $meta_boxes[] = [
        'title'      => esc_html__('faaliyet_alan Ayarları', 'Renewer'),
        'id'         => 'faaliyet_alan_meta',
        'post_types' => ['faaliyet_alan'],
        'context'    => 'normal',
        'autosave'   => true,
        'fields'     => [
            [
                'type' => 'text',
                'name' => esc_html__('Proje Baslik', 'Renewer'),
                'id'   => $prefix . 'proje_baslik',
            ],
        ],
    ];
    return $meta_boxes;
}


// Faaliyet ikon ve renk meta box ekleme
add_action('add_meta_boxes', 'faaliyet_icon_renk_metabox');
function faaliyet_icon_renk_metabox()
{
    add_meta_box(
        'faaliyet_icon_renk',         // ID
        'Faaliyet İkon ve Renk',      // Başlık
        'faaliyet_icon_renk_callback', // Callback fonksiyonu
        'faaliyet',                   // Post type
        'side',                       // Context (side, normal)
        'default'
    );
}

function faaliyet_icon_renk_callback($post)
{
    // Mevcut değerleri al
    $icon = get_post_meta($post->ID, '_faaliyet_icon', true);
    $color = get_post_meta($post->ID, '_faaliyet_color', true);
?>
    <p>
        <label>İkon (Font Awesome class):</label>
        <input type="text" name="faaliyet_icon" value="<?php echo esc_attr($icon); ?>" placeholder="fa-home">
    </p>
    <p>
        <label>Renk (Hex kodu):</label>
        <input type="text" name="faaliyet_color" value="<?php echo esc_attr($color); ?>" placeholder="#1f3a93">
    </p>
<?php
}

// Kaydetme işlemi
add_action('save_post', 'faaliyet_icon_renk_save');
function faaliyet_icon_renk_save($post_id)
{
    if (isset($_POST['faaliyet_icon'])) {
        update_post_meta($post_id, '_faaliyet_icon', sanitize_text_field($_POST['faaliyet_icon']));
    }
    if (isset($_POST['faaliyet_color'])) {
        update_post_meta($post_id, '_faaliyet_color', sanitize_text_field($_POST['faaliyet_color']));
    }
}
