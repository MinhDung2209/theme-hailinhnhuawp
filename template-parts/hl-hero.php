<?php
/* HERO TRANG CHU (Hai Linh v2) */
$hero_bg = hl_option('hl_hero_bg', THEME_URL . '/img/v2/hero-factory.webp');
$stats = hl_stats();
?>
<div class="hl-hero" style="background-image: url('<?php echo esc_url($hero_bg); ?>');">
    <div class="container">
        <div class="hl-hero-content">
            <h2 class="hl-hero-company"><?php hl_e('hero_title'); ?></h2>
            <p class="hl-hero-title"><?php hl_e('hero_subtitle'); ?></p>
            <p class="hl-hero-desc"><?php hl_e('hero_desc'); ?></p>
            <div class="hl-hero-more">
                <p class="hl-hero-question"><?php hl_e('hero_question'); ?></p>
                <p class="hl-hero-answer"><?php hl_e('hero_question_text'); ?></p>
            </div>
            <div class="hl-hero-actions">
                <a class="hl-btn hl-btn-primary" href="<?php echo esc_url(hl_products_url()); ?>"><?php hl_e('btn_view_products'); ?></a>
                <a class="hl-btn hl-btn-outline" href="<?php echo esc_url(hl_contact_url()); ?>"><?php hl_e('btn_request_quote'); ?></a>
            </div>
        </div>

        <?php if ($stats) { ?>
            <div class="hl-stats">
                <?php foreach ($stats as $stat) { ?>
                    <div class="hl-stat">
                        <strong><?php echo esc_html(isset($stat['title']) ? $stat['title'] : ''); ?></strong>
                        <span><?php echo esc_html(isset($stat['label']) ? $stat['label'] : ''); ?></span>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>
