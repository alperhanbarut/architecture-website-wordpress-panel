<footer class="site-footer">
  <div class="footer-container">

    <!-- Logo ve İletişim Bilgileri -->
    <div class="footer-section logo-contact">
      <img src="<?= ts("footer-logo")["url"] ?>" alt="Ely Gourmet Logo" class="footer-logo">
      <p><?= ts("footer-description") ?></p>
      <p><i class="fas fa-phone-alt"></i> <?= ts("sabit-telefon") ?></p>
      <p><i class="fas fa-envelope"></i> <?= ts("e-posta") ?></p>
    </div>

    <!-- Hızlı Menü -->
    <div class="footer-section quick-links">
      <h4>Hızlı Menü</h4>
      <?php
      $args = [
        "menu" => "footer-menu-1",
        "container" => "",
        "items_wrap" => '<ul >%3$s</ul>',
        "theme_location" => "footer-menu-1",
        "container_id" => "",
        'add_a_class' => ''
      ];
      wp_nav_menu($args);

      ?>
    </div>

    <!-- Sosyal Medya -->
    <div class="footer-section social-media">
      <h4>Bizi Takip Edin</h4>
      <div class="social-icons">
        <?php $facebook = ts("facebook");
        if ($facebook != null) { ?>

          <a href="<?= $facebook ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>

        <?php } ?>
        <?php $instagram = ts("instagram");
        if ($instagram != null) { ?>

          <a href="<?= $instagram ?>" target="_blank"><i class="fab fa-instagram"></i></a>

        <?php } ?>
        <?php $twitter = ts("whatsapp");
        if ($twitter != null) { ?>

          <a href="<?= $twitter ?>" target="_blank"><i class="fab fa-whatsapp"></i></a>

        <?php } ?>
        <?php $youtube = ts("youtube");
        if ($youtube != null) { ?>

          <a href="<?= $youtube ?>" target="_blank"><i class="fab fa-youtube"></i></a>

        <?php } ?>
      </div>
    </div>

  </div>

  <!-- Alt Bilgi -->
  <div class="footer-bottom">
    <p><?= ts("copyright") ?></p>
  </div>



</footer>

<?php wp_footer(); ?>

<script>
  new WOW().init();
</script>

</body>

</html>