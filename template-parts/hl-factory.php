<?php
/* OUR FACTORY (Hai Linh v2) - an neu chua chon anh */
$ids = hl_gallery_ids('hl_factory_photos');
if (!$ids) return;
?>
<section class="hl-section hl-factory" id="factory">
    <div class="container">
        <div class="hl-section-head">
            <h2 class="hl-section-title"><?php hl_e('factory_title'); ?></h2>
            <p class="hl-section-desc"><?php hl_e('factory_desc'); ?></p>
        </div>
        <div class="hl-factory-grid">
            <?php foreach ($ids as $id) {
                $full = wp_get_attachment_image_url($id, 'full');
                if (!$full) continue;
                $thumb   = wp_get_attachment_image_url($id, 'medium_large');
                $caption = wp_get_attachment_caption($id); ?>
                <figure class="hl-factory-item">
                    <a class="hl-lightbox" href="<?php echo esc_url($full); ?>">
                        <img src="<?php echo esc_url($thumb ? $thumb : $full); ?>" alt="<?php echo esc_attr($caption ? $caption : get_post_meta($id, '_wp_attachment_image_alt', true)); ?>" loading="lazy">
                    </a>
                    <?php if ($caption) { ?><figcaption><?php echo esc_html($caption); ?></figcaption><?php } ?>
                </figure>
            <?php } ?>
        </div>
    </div>
</section>
