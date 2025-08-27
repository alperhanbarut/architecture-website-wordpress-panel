<?php /* Template Name:Page Sayfası */ ?>
<?php get_header(); ?>
<?php $banner_image = get_post_meta(get_the_ID(), 'renewer_sayfalar_banner', true); ?>
<section class="banner" style="background:url('<?= wp_get_attachment_url($banner_image); ?>')">
    <div class="container-fluid maxWidth">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="banner-description wow animate__ animate__fadeInUp" data-wow-duration="1s">
                    <h1><?= get_the_title(); ?></h1>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="page-content">
    <div class="container-fluid maxWidth">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12  wow animate__ animate__fadeInUp" data-wow-duration="1s">
                <div class="page-content-description">
                    <?= get_the_content(); ?>
                </div>
            </div>
        </div>
    </div>
</section>


<?php get_footer(); ?>