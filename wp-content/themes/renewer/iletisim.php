<?php /* Template Name:İletişim Sayfası */ ?>
<?php get_header(); ?>

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

<div>
    <div class="container">
        <div class="contact-parent">

            <div class="contact-child child1">

                <?php if (ts("logo") && ts("logo")["url"]): ?>
                    <img src="<?php echo esc_url(ts("logo")["url"]); ?>" alt="Renewer İnşaat Logo" class="logo">
                <?php endif; ?>

                <?php if (ts("background-image") && ts("background-image")["url"]): ?>
                    <img src="<?php echo esc_url(ts("background-image")["url"]); ?>" alt="Arka Plan" class="bg-img">
                <?php endif; ?>

                <p>
                    <i class="fas fa-map-marker-alt"></i> Adres <br />
                    <span><?php echo esc_html(ts("adres")); ?></span>
                </p>

                <p>
                    <i class="fas fa-phone-alt"></i> Telefon <br />
                    <span><a href="tel:<?php echo esc_attr(ts("sabit-telefon")); ?>"><?php echo esc_html(ts("sabit-telefon")); ?></a></span>
                </p>

                <p>
                    <i class="far fa-envelope"></i> E-posta <br />
                    <span><a href="mailto:<?php echo esc_attr(ts("e-posta")); ?>"><?php echo esc_html(ts("e-posta")); ?></a></span>
                </p>

            </div>

            <div class="contact-child child2">
                <div class="inside-contact">
                    <?php echo do_shortcode('[contact-form-7 id="4565823" title="Contact form 1"]'); ?>
                </div>
            </div>

        </div>
    </div>
</div>

<?php if (ts("harita")): ?>
    <div class="iletisim_map">
        <iframe
            src="<?php echo esc_url(ts("harita")); ?>"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
<?php endif; ?>

<?php get_footer(); ?>