<?php /* Template Name: Faaliyet Alanları Sayfası */ ?>
<?php get_header(); ?>

<div id="hero-anim-track">
    <div class="hero">
        <div class="txt">
            <h1><?php the_title(); ?></h1>
        </div>
        <?php if (has_post_thumbnail()) {
            the_post_thumbnail('full', ['alt' => get_the_title()]);
        } else { ?>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/banner.jpg" alt="Banner" />
        <?php } ?>
    </div>
</div>

<?php
$args = [
    'post_type'      => 'faaliyet',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC'
];

$posts = new WP_Query($args);
if ($posts->have_posts()):
    $posts_array = [];
    while ($posts->have_posts()): $posts->the_post();
        $posts_array[] = [
            'title'        => get_the_title(),
            'image'        => get_the_post_thumbnail_url(get_the_ID(), 'full') ?: get_template_directory_uri() . '/assets/images/default.jpg',
            'content'      => apply_filters('the_content', get_the_content()),
            'proje_baslik' => get_post_meta(get_the_ID(), 'faaliyet_alan_proje_baslik', true),
        ];
    endwhile;
?>

    <div class="faaliyet_kapsayici">
        <?php foreach ($posts_array as $post): ?>
            <div class="faaliyet_item">
                <div class="faaliyet_resim">
                    <img src="<?= esc_url($post["image"]) ?>" alt="<?= esc_attr($post["title"]) ?>">
                </div>
                <div class="faaliyet_icerik">
                    <h2><?= esc_html($post["proje_baslik"] ?: $post["title"]) ?></h2>
                    <p><?= wp_kses_post($post["content"]) ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

<?php
endif;
wp_reset_postdata();
get_footer();
?>