<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

  <!-- WhatsApp Butonu -->
  <a href="https://wa.me/<?= ts("whatsapp") ?>" target="_blank" class="whatsapp-button" aria-label="WhatsApp">
    <i class="fa-brands fa-whatsapp"></i>
  </a>

  <!-- Yukarı Scroll Butonu -->
  <button id="scrollTopBtn" aria-label="Sayfa yukarı scroll">
    &#8679;
  </button>

  <!-- Header -->
  <header class="site-navigation d-none d-xl-block">
    <div class="container-fluid">
      <div class="row">
        <!-- Logo -->
        <div class="col-lg-3">
          <div class="website-logo">
            <a href="<?php echo esc_url(home_url('/')); ?>">
              <?php
              $logo = ts("logo");
              if (!empty($logo['url'])): ?>
                <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php bloginfo('name'); ?>" class="image-fluid" />
              <?php endif; ?>
            </a>
          </div>
        </div>

        <!-- Menü -->
        <div class="col-lg-6">
          <div class="menu-wrapper">
            <?php
            wp_nav_menu(array(
              'theme_location' => 'main-menu',
              'menu_class'     => 'site-navigation-menu',
              'container'      => false,
              'walker'         => new Custom_Main_Menu_Walker(),
              'menu_id'        => 'main-menu',
              'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            ));
            ?>
            <div class="land-marker" id="marker"></div>
          </div>
        </div>

        <!-- Dil Seçenekleri -->
        <div class="col-lg-3">
          <ul class="site-navigation-lang-menu" style="list-style:none; margin-top:9% !important; padding:0; margin:0; display:flex; gap:10px;">
            <?php
            $languages = icl_get_languages('skip_missing=0&orderby=code');
            if (!empty($languages)) {
              foreach ($languages as $language) {
                if (!$language['active']) { ?>
                  <li>
                    <a href="<?php echo esc_url($language['url']); ?>" style="display:inline-block;">
                      <img src="<?php echo esc_url($language['country_flag_url']); ?>"
                        alt="<?php echo esc_attr($language['code']); ?>"
                        style="width:24px; height:auto;">
                    </a>
                  </li>
            <?php }
              }
            } ?>
          </ul>
        </div>

      </div>
    </div>
  </header>

  <?php wp_footer(); ?>
</body>

</html>