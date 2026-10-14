<?php
/* 5 DONG SAN PHAM - TRANG CHU (Hai Linh v2): hien day du anh + ma hang + thanh ty le nhu ban demo */
$lines = hl_get_product_lines();
if (!$lines) return;
$others = hl_get_other_lines();
?>
<section class="hl-section hl-products-home" id="hl-products">
    <div class="container">
        <div class="hl-section-head hl-head-left">
            <h2 class="hl-section-title"><?php hl_e('products_title'); ?></h2>
            <p class="hl-section-desc"><?php hl_e('products_note'); ?></p>
        </div>
        <div class="hl-lines">
            <?php foreach ($lines as $i => $term) {
                hl_render_product_line($term, $i, 'h3');
            } ?>
        </div>

        <?php if ($others) { ?>
            <h3 class="hl-sub-title"><?php hl_e('other_products'); ?></h3>
            <div class="hl-other-grid">
                <?php foreach ($others as $term) { ?>
                    <a class="hl-other" href="<?php echo esc_url(get_term_link($term)); ?>">
                        <img src="<?php echo esc_url(get_term_meta($term->term_id, 'term_image', true)); ?>" alt="<?php echo esc_attr($term->name); ?>" loading="lazy">
                        <span><?php echo esc_html($term->name); ?></span>
                    </a>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</section>
