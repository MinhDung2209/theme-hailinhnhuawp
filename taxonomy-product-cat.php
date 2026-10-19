<?php
/*
 * TRANG 1 DONG SAN PHAM hoac 1 MUC CON (VD: Filler Masterbatch > Woven) - Hai Linh v2.
 * Danh muc cu (khong co so thu tu, khong phai muc con) dung archive.php.
 */
get_header();
$term   = get_queried_object();
$parent = hl_parent_line($term);
$line   = $parent ? $parent : $term;
$subs   = hl_get_sub_items($line);

get_template_part('template-parts/hl-page-hero', null, array(
    'title'    => $term->name,
    'subtitle' => $parent ? $parent->name : get_term_meta($term->term_id, 'hl_line_subtitle', true),
));

if ($subs) { ?>
    <nav class="hl-sub-nav" aria-label="<?php echo esc_attr($line->name); ?>">
        <div class="container">
            <a class="<?php echo $parent ? '' : 'is-active'; ?>" href="<?php echo esc_url(get_term_link($line)); ?>"><?php echo esc_html($line->name); ?></a>
            <?php foreach ($subs as $sub) { ?>
                <a class="<?php echo $sub->term_id === $term->term_id ? 'is-active' : ''; ?>" href="<?php echo esc_url(get_term_link($sub)); ?>"><?php echo esc_html($sub->name); ?></a>
            <?php } ?>
        </div>
    </nav>
<?php }

if ($parent) {
    /* ---------- Muc con: anh + bai viet ---------- */
    $images = hl_line_images($term); ?>
    <section class="hl-section hl-lines hl-sub-page">
        <div class="container">
            <div class="row">
                <?php if ($images['main']) { ?>
                    <div class="col-lg-5 mb-4 mb-lg-0">
                        <a class="hl-sub-img hl-lightbox" href="<?php echo esc_url($images['main']); ?>">
                            <img src="<?php echo esc_url($images['main']); ?>" alt="<?php echo esc_attr($term->name); ?>">
                        </a>
                    </div>
                <?php } ?>
                <div class="<?php echo $images['main'] ? 'col-lg-7' : 'col-lg-10 mx-auto'; ?>">
                    <?php hl_render_article($term); ?>
                    <p><a class="hl-btn hl-btn-light" href="<?php echo esc_url(get_term_link($parent)); ?>"><i class="fa-solid fa-arrow-left"></i> <?php echo esc_html($parent->name); ?></a></p>
                </div>
            </div>
        </div>
    </section>
<?php } else {
    /* ---------- Dong san pham: the ma hang + bai viet + muc con + lien quan ---------- */ ?>
    <section class="hl-section hl-lines">
        <div class="container">
            <?php hl_render_product_line($term, 0, 'h2'); ?>

            <?php if (trim(wp_strip_all_tags(term_description($term->term_id, 'product-cat')))) { ?>
                <div class="hl-article-wrap"><?php hl_render_article($term); ?></div>
            <?php } ?>

            <?php if ($subs) { ?>
                <h2 class="hl-sub-title hl-block-title"><?php hl_e('sub_items_title'); ?></h2>
                <?php hl_render_term_cards($subs); ?>
            <?php } ?>

            <?php $related = hl_get_related_lines($term);
            if ($related) { ?>
                <h2 class="hl-sub-title hl-block-title"><?php hl_e('related_products'); ?></h2>
                <?php hl_render_term_cards($related); ?>
            <?php } ?>

            <?php
            $others = array_filter(hl_get_product_lines(), function ($t) use ($term) {
                return $t->term_id !== $term->term_id;
            });
            if ($others) { ?>
                <div class="hl-other-lines">
                    <?php foreach ($others as $other) { ?>
                        <a href="<?php echo esc_url(get_term_link($other)); ?>"><?php echo esc_html($other->name); ?></a>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </section>
<?php }

get_template_part('template-parts/sec-talk-to-us');
get_footer();
