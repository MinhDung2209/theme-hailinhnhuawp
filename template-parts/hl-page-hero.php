<?php
/* BANNER DAU TRANG CON (Hai Linh v2). Bien: $args['title'], $args['subtitle'] */
$title    = isset($args['title']) ? $args['title'] : get_the_title();
$subtitle = isset($args['subtitle']) ? $args['subtitle'] : '';
$hero_bg  = hl_option('hl_hero_bg', THEME_URL . '/img/v2/hero-factory.webp');
?>
<div class="hl-page-hero" style="background-image: url('<?php echo esc_url($hero_bg); ?>');">
    <div class="container">
        <h1 class="hl-page-title"><?php echo esc_html($title); ?></h1>
        <?php if ($subtitle) { ?><p class="hl-page-sub"><?php echo esc_html($subtitle); ?></p><?php } ?>
    </div>
</div>
</header>
<main>
<?php if (function_exists('yoast_breadcrumb')) { ?>
    <div class="custom-breadcrumb container-fluid">
        <div class="container"><?php yoast_breadcrumb(); ?></div>
    </div>
<?php } ?>
