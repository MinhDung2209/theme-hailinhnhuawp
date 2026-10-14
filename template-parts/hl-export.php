<?php
/* PACKED FOR EXPORT (Hai Linh v2) - an neu chua chon anh */
$ids = hl_gallery_ids('hl_export_photos');
if (!$ids) return;
$points = hl_text_lines('hl_export_points');
?>
<section class="hl-section hl-export" id="export">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="hl-section-title"><?php hl_e('export_title'); ?></h2>
                <p class="hl-section-desc"><?php hl_e('export_desc'); ?></p>
                <?php if ($points) { ?>
                    <ul class="hl-checks">
                        <?php foreach ($points as $point) { ?><li><?php echo esc_html($point); ?></li><?php } ?>
                    </ul>
                <?php } ?>
            </div>
            <div class="col-lg-6">
                <div class="hl-export-grid">
                    <?php foreach (array_slice($ids, 0, 4) as $id) {
                        $full = wp_get_attachment_image_url($id, 'full');
                        if (!$full) continue;
                        $thumb = wp_get_attachment_image_url($id, 'medium_large'); ?>
                        <a class="hl-lightbox" href="<?php echo esc_url($full); ?>">
                            <img src="<?php echo esc_url($thumb ? $thumb : $full); ?>" alt="<?php echo esc_attr(wp_get_attachment_caption($id)); ?>" loading="lazy">
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
