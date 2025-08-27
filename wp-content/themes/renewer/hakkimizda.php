<?php /* Template Name:Hakkımızda Sayfası */ ?>
<?php get_header(); ?>

<div class="about_us_page">

    <!-- Hero Bölümü -->
    <div id="hero-anim-track">
        <div class="hero">
            <div class="txt">
                <h1><?php the_title(); ?></h1>
            </div>
            <?php

            if (has_post_thumbnail()) {
                the_post_thumbnail('full', ['alt' => get_the_title()]);
            } else { ?>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/banner.jpg" alt="Banner" />
            <?php } ?>
        </div>
    </div>


    <div class="content">
        <div class="txt">
            <?php

            if (have_posts()) :
                while (have_posts()) : the_post();
                    the_content();
                endwhile;
            endif;
            ?>
        </div>
    </div>

</div>

<?php get_footer(); ?>