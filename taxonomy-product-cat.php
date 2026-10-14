<?php
/* TRANG 1 DONG SAN PHAM (Hai Linh v2). Dong san pham cu (khong co so thu tu) dung archive.php */
get_header();
$term = get_queried_object();
get_template_part('template-parts/hl-page-hero', null, array(
    'title'    => $term->name,
    'subtitle' => get_term_meta($term->term_id, 'hl_line_subtitle', true),
));
?>
<section class="hl-section hl-lines">
    <div class="container">
        <?php hl_render_product_line($term, 0, 'h2'); ?>

        <?php
        $others = array_filter(hl_get_product_lines(), function ($t) use ($term) {
            return $t->term_id !== $term->term_id;
        });
        if ($others) { ?>
            <div class="hl-other-lines">
                <?php foreach ($others as $other) { ?>
                    <a href="<?php echo esc_url(get_term_link($other)); ?>"><?php echo esc_html($other->name); ?></a>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</section>
<?php
get_template_part('template-parts/sec-talk-to-us');
get_footer();
