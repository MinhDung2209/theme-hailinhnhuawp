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

        // Danh muc cu (Filler/Transparent/White cu...) khong hien nua: link cu tu chuyen sang dong moi (hl_term_redirects)

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
