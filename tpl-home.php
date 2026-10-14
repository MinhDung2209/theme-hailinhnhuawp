<?php /* Template Name: Template Home */
   get_header();?>
 <?php /* Hai Linh v2: Hero moi thay cho slider cu (slider cu giu trong git, commit goc) */
   get_template_part('template-parts/hl-hero'); ?>
</header>
<main>

   <?php
      get_template_part('template-parts/hl-products-home');
      // get_template_part('template-parts/sec-animation-home-page'); // Hai Linh v2: tat (dong SP cu Filler/Color), thay bang hl-products-home
      get_template_part('template-parts/hl-factory');
      get_template_part('template-parts/hl-certificates');
      get_template_part('template-parts/hl-export');
      get_template_part('template-parts/sec-what-we-do'); // co ca o trang Service (tpl-service.php)
      get_template_part('template-parts/sec-application');
      get_template_part('template-parts/sec-bk-services');
      get_template_part('template-parts/sec-why-choose-us');
      get_template_part('template-parts/sec-out-partner');
      get_template_part('template-parts/hl-library');
      get_template_part('template-parts/hl-contact-map');
      get_template_part('template-parts/sec-talk-to-us');
      get_template_part('template-parts/sec-media');
   ?>

<?php get_footer();?>
