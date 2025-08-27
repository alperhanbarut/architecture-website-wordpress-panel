<?php
/* taxonomy-proje_kategori.php */
// Bu dosya proje_kategori taxonomy’sindeki sayfaları listeler

get_header();

$term = get_queried_object();

$args = array(
    'post_type' => 'proje',
    'tax_query' => array(
        array(
            'taxonomy' => 'proje-kategori',
            'field'    => 'slug',
            'terms'    => $term->slug,
        ),
    ),
);

$query = new WP_Query($args);
?>

<!-- Hero Bölümü -->
<div id="hero-anim-track">
    <div class="hero">
        <div class="txt">
            <h1><?php echo $term->name;
                ?></h1>
        </div>
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/banner.jpg" alt="Banner">
    </div>
</div>

<!-- Projeler Listesi -->
<div class="proje_container">
    <?php if ($query->have_posts()) : ?>
        <?php while ($query->have_posts()) : $query->the_post(); ?>
            <div class="proje">
                <div class="proje_image">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('large', ['alt' => get_the_title()]); ?>
                    <?php else : ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/default.jpg" alt="<?php the_title(); ?>">
                    <?php endif; ?>

                    <div class="proje_overlay">
                        <h2><?php the_title(); ?></h2>
                        <p><?php the_excerpt(); ?></p>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    <?php else : ?>
        <p>Hiç proje bulunamadı.</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>