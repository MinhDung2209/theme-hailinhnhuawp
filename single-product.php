<?php
/* TRANG CHI TIET 1 MA HANG (Hai Linh v2) */
get_header();
the_post();

$terms = get_the_terms(get_the_ID(), 'product-cat');
$line  = null;
if ($terms && !is_wp_error($terms)) {
    foreach ($terms as $t) {
        if (hl_is_product_line($t)) { $line = $t; break; }
    }
    $line = $line ? $line : $terms[0];
}
$g = hl_grade_data(get_post());

get_template_part('template-parts/hl-page-hero', null, array(
    'title'    => get_the_title(),
    'subtitle' => $line ? $line->name : '',
));
?>
<section class="hl-section hl-grade-detail">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 mb-4 mb-lg-0">
                <?php if (has_post_thumbnail()) { ?>
                    <a class="hl-grade-img hl-lightbox" href="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>">
                        <?php the_post_thumbnail('large', array('alt' => esc_attr(get_the_title()))); ?>
                    </a>
                <?php } elseif ($line) {
                    $images = hl_line_images($line);
                    if ($images['main']) { ?>
                        <a class="hl-grade-img hl-lightbox" href="<?php echo esc_url($images['main']); ?>"><img src="<?php echo esc_url($images['main']); ?>" alt="<?php the_title_attribute(); ?>"></a>
                    <?php }
                } ?>
            </div>
            <div class="col-lg-7">
                <table class="hl-spec">
                    <tr><th><?php hl_e('grade_code'); ?></th><td><b><?php echo esc_html($g['code']); ?></b></td></tr>
                    <?php if ($g['resin']) { ?><tr><th><?php hl_e('grade_resin'); ?></th><td><?php echo esc_html($g['resin']); ?></td></tr><?php } ?>
                    <?php if ($g['min'] !== null || $g['max'] !== null) { ?>
                        <tr><th><?php hl_e('grade_filler'); ?></th><td><div class="hl-grade-head hl-grade-head-single"><?php hl_render_ratio_bar($g['min'], $g['max']); ?></div></td></tr>
                    <?php } ?>
                </table>

                <div class="hl-grade-content single-article"><?php the_content(); ?></div>

                <div class="hl-line-actions">
                    <a class="hl-btn hl-btn-primary" href="<?php echo esc_url(hl_contact_url()); ?>"><?php hl_e('btn_quote_short'); ?></a>
                    <?php if ($line) { ?>
                        <a class="hl-btn hl-btn-light" href="<?php echo esc_url(get_term_link($line)); ?>"><i class="fa-solid fa-arrow-left"></i> <?php hl_e('btn_back_to_line'); ?></a>
                    <?php } ?>
                </div>
            </div>
        </div>

        <?php if ($line) {
            $others = array_filter(hl_get_grades($line->term_id), function ($p) {
                return $p->ID !== get_the_ID();
            });
            if ($others) { ?>
                <div class="hl-other-grades">
                    <h3 class="hl-sub-title"><?php hl_e('other_grades'); ?></h3>
                    <div class="hl-other-lines">
                        <?php foreach ($others as $p) {
                            $d = hl_grade_data($p); ?>
                            <a href="<?php echo esc_url($d['url']); ?>"><?php echo esc_html($d['code'] . ($d['resin'] ? ' - ' . $d['resin'] : '')); ?></a>
                        <?php } ?>
                    </div>
                </div>
            <?php }
        } ?>
    </div>
</section>
<?php
get_template_part('template-parts/sec-talk-to-us');
get_footer();
