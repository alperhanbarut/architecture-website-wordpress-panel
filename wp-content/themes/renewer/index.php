<?php get_header(); ?>



<!-- SLİDER -->


<?php
$args = [
  'post_type'      => 'slider',
  'post_status'    => 'publish',
  'posts_per_page' => -1,
  'orderby'        => 'menu_order',
  'order'          => 'ASC'
];

$posts = new WP_Query($args);

if ($posts->have_posts()):
  $posts_array = [];

  while ($posts->have_posts()):
    $posts->the_post();

    $posts_array[] = [
      'title'                => get_the_title(),
      'image'                => get_the_post_thumbnail_url(get_the_ID(), 'full'),
      'content'              => get_the_content(),
      'slider_ikinci_baslik' => get_post_meta(get_the_ID(), 'Renewer_slider_slider_ikinci_baslik', true),
    ];
  endwhile;
?>


  <div class="slider_area">
    <div id="slider-container">
      <?php foreach ($posts_array as $post): ?>
        <div class="slide" data-bg="<?= $post["image"] ?>">
          <div class="heading-container">
            <h1><?= $post["title"] ?></h1>
          </div>
          <div class="content-container">
            <h2><?= $post["slider_ikinci_baslik"] ?></h2>
            <p><?= $post["content"] ?></p>
          </div>
        </div>
      <?php endforeach; ?>
      <!-- Navigation -->
      <span class="nav-arrow" id="prev-arrow">&#10094;</span>
      <span class="nav-arrow" id="next-arrow">&#10095;</span>
      <div class="dots-container"></div>
    </div>
  </div>
<?php
endif;
wp_reset_postdata();
?>



<!-- PROJELER -->
<?php
$proje_kategorileri = get_terms(array(
  'taxonomy' => 'proje-kategori',
  'parent' => 0,
  'hide_empty' => false,
));
?>

<section class="wrapper">
  <?php if (!empty($proje_kategorileri) && !is_wp_error($proje_kategorileri)): ?>
    <?php foreach ($proje_kategorileri as $kategori): ?>
      <div class="<?= $kategori->slug === 'devam-eden' ? 'devam-projeler' : 'tamamlanan-projeler' ?>">
        <h2><?= esc_html($kategori->name); ?></h2>
        <div class="items">
          <?php
          $proje_sorgu = new WP_Query(array(
            'post_type' => 'proje',
            'tax_query' => array(
              array(
                'taxonomy' => 'proje-kategori',
                'field'    => 'term_id',
                'terms'    => $kategori->term_id,
              ),
            ),
            'posts_per_page' => -1,
          ));
          ?>

          <?php if ($proje_sorgu->have_posts()): ?>
            <?php while ($proje_sorgu->have_posts()): $proje_sorgu->the_post(); ?>
              <div class="item i1" tabindex="0" style="background-image: url('<?= get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>');">
                <div class="item-overlay">
                  <h3><?= get_the_title(); ?></h3>
                  <p><?= get_the_content(); ?></p>
                  <!-- Detay butonu kategori sayfasına yönlendiriyor -->
                  <a href="<?= get_term_link($kategori); ?>" class="detay-btn">Detayları Gör</a>
                </div>
              </div>
            <?php endwhile; ?>
          <?php else: ?>
            <p>Bu kategoride henüz proje bulunmamaktadır.</p>
          <?php endif; ?>
          <?php wp_reset_postdata(); ?>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</section>

<!-- Faaliyet Alanları -->
<?php
$args = array(
  'post_type' => 'faaliyet',
  'post_status' => 'publish',
  'posts_per_page' => -1,
  'orderby' => 'menu_order',
  'order' => 'ASC'
);
$posts = new WP_Query($args);

if ($posts->have_posts()):
?>
  <div class="faaliyet_container">
    <div class="faaliyetbaslik">
      <h2>Faaliyet Alanlarımız</h2>
    </div>
    <div class="container">
      <?php while ($posts->have_posts()): $posts->the_post();
        $icon = get_post_meta(get_the_ID(), '_faaliyet_icon', true);
        $color = get_post_meta(get_the_ID(), '_faaliyet_color', true);
      ?>
        <div class="serviceBox">
          <div class="icon" style="--i: <?php echo esc_attr($color); ?>">
            <i class="fas <?php echo esc_attr($icon); ?>"></i>
          </div>
          <div class="content">
            <h2><?php the_title(); ?></h2>
            <p><?php the_content(); ?></p>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
<?php endif;
wp_reset_postdata(); ?>

<!-- HAKKIMIZDA -->
<?php
$args = array(
  'post_type' => 'hakkimizda',
  'post_status' => 'publish',
  'posts_per_page' => -1,
  'orderby' => 'menu_order',
  'order' => 'ASC'
);
$posts = new WP_Query($args);

if ($posts->have_posts()):
  while ($posts->have_posts()): $posts->the_post();
?>

    <section class="hakkimizda">
      <div class="hakkimizda-container">
        <div class="hakkimizda-content">
          <h2>Hakkımızda</h2>
          <p><?php the_content(); ?></p>
          <a href="<?php echo site_url('/hakkimizda'); ?>" class="btn">Daha Fazla</a>
        </div>
      </div>
    </section>

<?php
  endwhile;
  wp_reset_postdata();
endif;
?>







<!-- Haberler -->

<div class="blog-container">
  <?php
  $args = [
    'post_type'      => 'haberler',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'orderby'        => 'date',
    'order'          => 'DESC',
  ];

  $query = new WP_Query($args);

  if ($query->have_posts()):
    while ($query->have_posts()): $query->the_post();
      $tarih = rwmb_meta('haberler_tarih');
      $yazar = rwmb_meta('haberler_yazar');
      $img = get_the_post_thumbnail_url(get_the_ID(), 'full');
  ?>
      <article>
        <figure>
          <div class="date-and-time">
            <?php
            echo date_i18n('M', strtotime($tarih));
            echo '<span>' . date_i18n('d', strtotime($tarih)) . '</span>';
            echo '<span>' . date_i18n('Y', strtotime($tarih)) . '</span>';
            ?>
          </div>
          <?php if ($img): ?>
            <img src="<?php echo esc_url($img); ?>" alt="<?php the_title(); ?>" loading="lazy" />
          <?php endif; ?>
          <figcaption>
            <span><?php the_title(); ?></span>
            <span>By <?php echo esc_html($yazar); ?> | By Admin</span>
          </figcaption>
        </figure>
      </article>
  <?php endwhile;
    wp_reset_postdata();
  endif; ?>
</div>
<div class="overlay" id="overlay"></div>
<div class="popup" id="popup">
  <span id="close-btn" class="material-symbols-outlined">
    kapat
  </span>
  <div id="popup-content"></div>
</div>





<?php get_footer(); ?>