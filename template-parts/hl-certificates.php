<?php
/* QUALITY & CERTIFICATES (Hai Linh v2) - an neu chua nhap chung chi */
$certificates = hl_option('hl_certificates', array());
if (empty($certificates) || !is_array($certificates)) return;
?>
<section class="hl-section hl-certificates" id="certificates">
    <div class="container">
        <div class="hl-section-head">
            <h2 class="hl-section-title"><?php hl_e('cert_title'); ?></h2>
            <p class="hl-section-desc"><?php hl_e('cert_desc'); ?></p>
        </div>
        <div class="hl-cert-grid">
            <?php foreach ($certificates as $cert) {
                if (empty($cert['image'])) continue; ?>
                <a class="hl-cert hl-lightbox" href="<?php echo esc_url($cert['image']); ?>">
                    <img src="<?php echo esc_url($cert['image']); ?>" alt="<?php echo esc_attr($cert['title']); ?>" loading="lazy">
                    <span><?php echo esc_html($cert['title']); ?></span>
                </a>
            <?php } ?>
        </div>
    </div>
</section>
