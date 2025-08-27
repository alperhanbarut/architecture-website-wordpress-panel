<?php
function ekStylesScripts()
{

    /* Styles */
    wp_enqueue_style('elygourmet-style', get_stylesheet_uri());
    wp_enqueue_style('elygourmet-app', get_template_directory_uri() . '/assets/css/app.css', array(), '1.0', 'all');
    wp_enqueue_style('elygourmet-responsive', get_template_directory_uri() . '/assets/css/responsive.css', array(), '1.0', 'all');

    // CDN CSS Kütüphaneleri
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', array(), '5.3.3', 'all');
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css', array(), '6.5.0', 'all');
    wp_enqueue_style('fancybox', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css', array(), '3.5.7', 'all');
    wp_enqueue_style('owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css', array(), '2.3.4', 'all');
    wp_enqueue_style('owl-theme', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css', array('owl-carousel'), '2.3.4', 'all');
    wp_enqueue_style('animate', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css', array(), '4.1.1', 'all');
    wp_enqueue_style('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), '11', 'all');
    wp_enqueue_style('imagehover', 'https://cdn.jsdelivr.net/gh/ciar4n/imagehover.css/css/imagehover.min.css', array(), null, 'all');

    /* Scripts */
    // jQuery
    wp_enqueue_script('jquery-cdn', 'https://code.jquery.com/jquery-3.7.1.min.js', array(), '3.7.1', true);

    // Bootstrap Bundle (Popper dahil)
    wp_enqueue_script('bootstrap-bundle', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array('jquery-cdn'), '5.3.3', true);

    // Owl Carousel
    wp_enqueue_script('owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', array('jquery-cdn'), '2.3.4', true);

    // Swiper
    wp_enqueue_script('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), '11', true);

    // WOW.js
    wp_enqueue_script('wowjs', 'https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js', array(), '1.1.2', true);
    wp_add_inline_script('wowjs', 'new WOW().init();');

    // Fancybox
    wp_enqueue_script('fancyboxjs', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js', array('jquery-cdn'), '3.5.7', true);

    // Projeye özel JS
    wp_enqueue_script('indexjs', get_template_directory_uri() . '/assets/js/index.js', array('jquery-cdn'), '1.0', true);
}

add_action('wp_enqueue_scripts', 'ekStylesScripts');
