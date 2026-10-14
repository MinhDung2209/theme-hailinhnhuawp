<?php /* Template Name: Template Library (Hai Linh v2) */
get_header();
get_template_part('template-parts/hl-page-hero', null, array('title' => get_the_title()));

get_template_part('template-parts/hl-library');
get_template_part('template-parts/hl-certificates');

while (have_posts()) {
    the_post();
    if (trim(get_the_content())) { ?>
        <section class="hl-section"><div class="container hl-page-content"><?php the_content(); ?></div></section>
    <?php }
}

get_template_part('template-parts/hl-contact-map');
get_footer();
