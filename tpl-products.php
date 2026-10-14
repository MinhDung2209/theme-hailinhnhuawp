<?php /* Template Name: Template Products (Hai Linh v2) */
get_header();
get_template_part('template-parts/hl-page-hero', null, array(
    'title'    => get_the_title(),
    'subtitle' => hl_t('products_desc'),
));
$lines = hl_get_product_lines();
?>
<section class="hl-section hl-lines">
    <div class="container">
        <?php
        if ($lines) {
            foreach ($lines as $i => $term) {
                hl_render_product_line($term, $i);
            }
        } else { ?>
            <p class="text-center"><?php pll_e('text_common_2'); ?></p>
        <?php }

        // Cac danh muc cu (Color, Transparent...) - giu link cu
        $others = hl_get_other_lines();
        if ($others) { ?>
            <h3 class="hl-sub-title hl-other-title"><?php hl_e('other_products'); ?></h3>
            <div class="hl-other-grid">
                <?php foreach ($others as $term) { ?>
                    <a class="hl-other" href="<?php echo esc_url(get_term_link($term)); ?>">
                        <img src="<?php echo esc_url(get_term_meta($term->term_id, 'term_image', true)); ?>" alt="<?php echo esc_attr($term->name); ?>" loading="lazy">
                        <span><?php echo esc_html($term->name); ?></span>
                    </a>
                <?php } ?>
            </div>
        <?php }

        // Noi dung soan them trong trang (neu co)
        while (have_posts()) {
            the_post();
            if (trim(get_the_content())) { ?>
                <div class="hl-page-content"><?php the_content(); ?></div>
            <?php }
        } ?>
    </div>
</section>
<?php
get_template_part('template-parts/hl-contact-map');
get_footer();
