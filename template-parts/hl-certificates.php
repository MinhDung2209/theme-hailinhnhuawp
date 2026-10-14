<?php
/* QUALITY YOU CAN VERIFY (Hai Linh v2) - an neu chua co anh chung chi */
$cert_image   = hl_option('hl_cert_image');
$points       = hl_text_lines('hl_cert_points');
$verify_url   = hl_option('hl_cert_verify_url');
$certificates = hl_option('hl_certificates', array());
$certificates = is_array($certificates) ? array_filter($certificates, function ($cert) { return !empty($cert['image']); }) : array();
if (!$cert_image && !$certificates) return;
?>
<section class="hl-section hl-certificates" id="quality">
    <div class="container">
        <?php if ($cert_image) { ?>
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="hl-section-title"><?php hl_e('cert_title'); ?></h2>
                    <p class="hl-section-desc"><?php hl_e('cert_desc'); ?></p>
                    <?php if ($points) { ?>
                        <ul class="hl-checks">
                            <?php foreach ($points as $point) { ?><li><?php echo esc_html($point); ?></li><?php } ?>
                        </ul>
                    <?php } ?>
                    <?php if ($verify_url) { ?>
                        <a class="hl-btn hl-btn-primary" href="<?php echo esc_url($verify_url); ?>" target="_blank" rel="noopener"><?php hl_e('btn_verify_cert'); ?></a>
                    <?php } ?>
                </div>
                <div class="col-lg-6">
                    <a class="hl-cert-main hl-lightbox" href="<?php echo esc_url($cert_image); ?>">
                        <img src="<?php echo esc_url($cert_image); ?>" alt="<?php echo esc_attr(hl_t('cert_title')); ?>" loading="lazy">
                    </a>
                    <p class="hl-cert-hint"><?php hl_e('click_to_enlarge'); ?></p>
                </div>
            </div>
        <?php } else { ?>
            <div class="hl-section-head hl-head-left">
                <h2 class="hl-section-title"><?php hl_e('cert_title'); ?></h2>
                <p class="hl-section-desc"><?php hl_e('cert_desc'); ?></p>
            </div>
        <?php } ?>

        <?php if ($certificates) { ?>
            <?php if ($cert_image) { ?><h3 class="hl-sub-title"><?php hl_e('cert_more'); ?></h3><?php } ?>
            <div class="hl-cert-grid">
                <?php foreach ($certificates as $cert) { ?>
                    <a class="hl-cert hl-lightbox" href="<?php echo esc_url($cert['image']); ?>">
                        <img src="<?php echo esc_url($cert['image']); ?>" alt="<?php echo esc_attr($cert['title']); ?>" loading="lazy">
                        <span><?php echo esc_html($cert['title']); ?></span>
                    </a>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</section>
