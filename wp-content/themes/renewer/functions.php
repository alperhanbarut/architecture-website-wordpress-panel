<?php
add_theme_support('title-tag');

/* Logo Support */
add_theme_support('custom-logo');

/* Thumbnails Support*/
add_theme_support('post-thumbnails');
the_post_thumbnail('thumbnail');
the_post_thumbnail('medium');
the_post_thumbnail('medium_large');
the_post_thumbnail('large');
the_post_thumbnail('full');
the_post_thumbnail(array(540, 540), 'page-image');
the_post_thumbnail(array(1080, 1080), 'page-image-large');
the_post_thumbnail(array(540, 1080), 'page-image-reserve');
the_post_thumbnail(array(1080, 2160), 'page-image-reserve-large');
the_post_thumbnail(array(1920, 250), 'banner');

/* Theme Settings */
require __DIR__ . "/inc/theme-settings.php";

/* Theme Styles and Scripts */
require __DIR__ . "/inc/theme-style-scripts.php";

/* Meta Boxes */
require  __DIR__ . "/inc/meta-boxes.php";

require  __DIR__ . "/inc/menuWalker.php";



/* Get Theme Setting */
function ts($setting)
{
    $options = get_option('Renewer');
    return $options[$setting];
}
/* Get Theme Array Settings */
function tsa($setting, $row)
{
    $options = get_option("Renewer");
    return $options[$setting][$row];
}


register_nav_menus(
    array(
        'main-menu'     => __('Ana Menü',   'Renewer'),
        'mobile-menu'   => __('Mobil Menü', 'Renewer'),
        'footer-menu-1' => __('Alt Menü 1', 'Renewer'),
        'footer-menu-2' => __('Alt Menü 2', 'Renewer'),

    )
);


function theme_enqueue_marker_assets()
{
    // Marker CSS
    wp_add_inline_style('theme-style', '
        .land-marker {
            position: absolute;
            bottom: 0;
            height: 3px;
            background-color: #ff6600;
            transition: all 0.3s ease;
            opacity: 0;
        }
        .main-menu {
            position: relative;
        }
    ');
}
add_action('wp_enqueue_scripts', 'theme_enqueue_marker_assets');

function iletisim_customize_register($wp_customize)
{
    $wp_customize->add_section('iletisim_ayarlar', array(
        'title' => 'İletişim Sayfası Ayarları',
        'priority' => 30,
    ));

    $wp_customize->add_setting('iletisim_aciklama', array('default' => 'Firma açıklamanız buraya gelecek.'));
    $wp_customize->add_control('iletisim_aciklama', array(
        'label' => 'Açıklama',
        'section' => 'iletisim_ayarlar',
        'type' => 'textarea'
    ));

    $wp_customize->add_setting('iletisim_telefon', array('default' => '+90 123 456 7890'));
    $wp_customize->add_control('iletisim_telefon', array(
        'label' => 'Telefon',
        'section' => 'iletisim_ayarlar',
        'type' => 'text'
    ));

    $wp_customize->add_setting('iletisim_email', array('default' => 'info@ornek.com'));
    $wp_customize->add_control('iletisim_email', array(
        'label' => 'E-posta',
        'section' => 'iletisim_ayarlar',
        'type' => 'email'
    ));

    $wp_customize->add_setting('iletisim_adres', array('default' => 'İstanbul, Türkiye'));
    $wp_customize->add_control('iletisim_adres', array(
        'label' => 'Adres',
        'section' => 'iletisim_ayarlar',
        'type' => 'text'
    ));

    $wp_customize->add_setting('iletisim_harita', array('default' => 'https://www.google.com/maps/embed?...'));
    $wp_customize->add_control('iletisim_harita', array(
        'label' => 'Google Maps Linki',
        'section' => 'iletisim_ayarlar',
        'type' => 'text'
    ));
}
add_action('customize_register', 'iletisim_customize_register');


function custom_excerpt_length($length)
{
    return 20; // İstediğin kelime sayısı
}
add_filter('excerpt_length', 'custom_excerpt_length', 999);


function custom_wpcf7_form_elements($content)

{

    // Belirli sınıfa sahip span etiketlerini kaldır

    $content = preg_replace('/<span class="wpcf7-form-control-wrap"[^>]*>/', '', $content);

    $content = str_replace('</span>', '', $content);



    // Tüm p etiketlerini kaldır

    $content = str_replace(array('<p>', '</p>'), '', $content);



    return $content;
}

add_filter('wpcf7_form_elements', 'custom_wpcf7_form_elements');


/* Pagination */
if (! function_exists('pagination')) :

    function pagination($paged = '', $max_page = '')
    {
        $big = 999999999;
        if (! $paged) {
            $paged = get_query_var('paged');
        }

        if (! $max_page) {
            global $wp_query;
            $max_page = isset($wp_query->max_num_pages) ? $wp_query->max_num_pages : 1;
        }

        echo paginate_links(array(
            'base'       => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format'     => '?paged=%#%',
            'current'    => max(1, $paged),
            'total'      => $max_page,
            'mid_size'   => 1,
            'prev_text'  => __('«'),
            'next_text'  => __('»'),
            'type'       => 'list'
        ));
    }
endif;
