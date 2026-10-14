<?php
/* CONTACT & LOCATION + GOOGLE MAP (Hai Linh v2) */
$address = hl_option('hl_address');
if (!$address && function_exists('pll__')) {
    $address = pll__('footer_text_1');
    $address = $address === 'footer_text_1' ? '' : $address;
}
$email = hl_option('hl_email', 'info@hailinhplastic.com');
$phone = hl_option('hl_phone', '+84 358 918 210');
$map   = hl_option('hl_map_embed');
$profile_file = hl_option('hl_profile_file');

// Chi chap nhan iframe Google Maps; neu dan link thi tu boc vao iframe
$map_src = '';
if ($map && preg_match('~src=["\']([^"\']+)["\']~', $map, $m)) {
    $map_src = $m[1];
} elseif ($map && preg_match('~^https?://~', trim($map))) {
    $map_src = trim($map);
} elseif ($address) {
    $map_src = 'https://www.google.com/maps?q=' . rawurlencode(wp_strip_all_tags($address)) . '&output=embed';
}
?>
<section class="hl-section hl-contact-map" id="contact-location">
    <div class="container">
        <div class="hl-section-head">
            <h2 class="hl-section-title"><?php hl_e('contact_title'); ?></h2>
        </div>
        <div class="row align-items-center">
            <div class="col-lg-7 mb-4 mb-lg-0">
                <div class="hl-map">
                    <?php if ($map_src) { ?>
                        <iframe src="<?php echo esc_url($map_src); ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen title="<?php echo esc_attr(hl_t('contact_title')); ?>"></iframe>
                    <?php } ?>
                </div>
            </div>
            <div class="col-lg-5">
                <ul class="hl-contact-list">
                    <?php if ($address) { ?>
                        <li><i class="fa-solid fa-location-dot"></i><div><b><?php hl_e('contact_address'); ?></b><?php echo esc_html(wp_strip_all_tags($address)); ?></div></li>
                    <?php } ?>
                    <?php if ($email) { ?>
                        <li><i class="fa-regular fa-envelope"></i><div><b><?php hl_e('contact_email'); ?></b><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></div></li>
                    <?php } ?>
                    <?php if ($phone) { ?>
                        <li><i class="fa-solid fa-phone"></i><div><b><?php hl_e('contact_phone'); ?></b><a href="tel:<?php echo esc_attr(preg_replace('/[^\d+]/', '', $phone)); ?>"><?php echo esc_html($phone); ?></a></div></li>
                    <?php } ?>
                </ul>
                <div class="hl-contact-actions">
                    <a class="hl-btn hl-btn-primary" href="<?php echo esc_url(hl_contact_url()); ?>"><?php hl_e('btn_send_inquiry'); ?></a>
                    <?php if ($profile_file) { ?>
                        <a class="hl-btn hl-btn-light" href="<?php echo esc_url($profile_file); ?>" target="_blank" rel="noopener" download><?php hl_e('btn_download_profile'); ?></a>
                    <?php } ?>
                </div>
                <?php hl_social_links(); ?>
            </div>
        </div>
    </div>
</section>
