<?php
/* 5 DONG SAN PHAM - TRANG CHU (Hai Linh v2) */
$lines = hl_get_product_lines();
if (!$lines) return;
?>
<section class="hl-section hl-products-home" id="hl-products">
    <div class="container">
        <div class="hl-section-head">
            <h2 class="hl-section-title"><?php hl_e('products_title'); ?></h2>
            <p class="hl-section-desc"><?php hl_e('products_desc'); ?></p>
        </div>
        <div class="hl-cards">
            <?php foreach ($lines as $i => $term) {
                $images   = hl_line_images($term);
                $subtitle = get_term_meta($term->term_id, 'hl_line_subtitle', true);
                $number   = (int) get_term_meta($term->term_id, 'hl_line_order', true); ?>
                <a class="hl-card" href="<?php echo esc_url(get_term_link($term)); ?>">
                    <span class="hl-card-img">
                        <?php if ($images['main']) { ?>
                            <img src="<?php echo esc_url($images['main']); ?>" alt="<?php echo esc_attr($term->name); ?>" loading="lazy">
                        <?php } ?>
                    </span>
                    <span class="hl-card-body">
                        <span class="hl-line-num"><?php echo esc_html($number ? $number : $i + 1); ?></span>
                        <strong><?php echo esc_html($term->name); ?></strong>
                        <?php if ($subtitle) { ?><small><?php echo esc_html($subtitle); ?></small><?php } ?>
                        <em><?php hl_e('btn_view_grades'); ?> <i class="fa-solid fa-arrow-right"></i></em>
                    </span>
                </a>
            <?php } ?>
        </div>
        <div class="hl-products-more">
            <a class="hl-btn hl-btn-primary" href="<?php echo esc_url(hl_products_url()); ?>"><?php hl_e('btn_view_products'); ?> <i class="fa-solid fa-arrow-right"></i></a>
        </div>
    </div>
</section>
