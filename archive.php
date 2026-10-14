<?php get_header();?>

<div class="header-banner header-banner-other-page bg-image" style="background-image: url('<?php echo THEME_URL; ?>/img/bg-header-arcive.png');">
        <div class="container-fluid container-fluid-sub">
            <div class="container position-relative h-100">
                <div class="header-description header-about text-center w-100">
                        <h3><?php
                            if(is_author()){
                                printf( 'Author: %s', '<span class="vcard">' . get_the_author() . '</span>' );
                            } elseif (is_day()){
                                printf( 'Day: %s', '<span>' . get_the_date('d/m/Y') . '</span>' );
                            } elseif (is_month()){
                                printf( 'Month: %s', '<span>' . get_the_date( 'm') . '</span>' );
                            } elseif (is_year()){
                                printf( 'Year: %s', '<span>' . get_the_date( 'Y') . '</span>' );
                            } elseif (is_tag()){
                                $title = single_tag_title('Tag: ',false);
                                echo $title;
                            } else {
                                $title = single_cat_title('',false);
                                echo $title;
                            }
                        ?>
                            
                        </h3>
                    <a class="btn btn-outline-light btn-get-in-touch margin-0-auto" href="#sec-talk-to-us"><?php pll_e('text_common_1'); ?></a>
                </div>
            </div>
        </div>
    </div>
</header>

<main>
    <?php if ( function_exists('yoast_breadcrumb') ) { ?>
        <div class="custom-breadcrumb container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <?php yoast_breadcrumb(); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <?php
      $terms = get_terms([
          'taxonomy' => 'product-cat',
          'hide_empty' => false,
          'parent' => get_queried_object()->term_id
      ]);
      if ($terms) {
            echo '<div class="container-fluid mt-5"><div class="container"><div class="row justify-content-center">';
                foreach ($terms as $term) {
                $upload_image = get_term_meta($term->term_id, 'term_image', true); ?>
                <div class="col-md-2 col-4 mb-3 text-center">
                    <a href="<?php echo get_term_link($term->term_id); ?>" class="btn btn-outline-dark"><?php echo $term->name; ?></a>
                </div>
                <?php
                }
            echo '</div></div></div>';
      }
    ?>
    <div class="container-fluid mt-5">
        <div class="container">
            <div class="row">
                <?php
                    if (have_posts()) {
                        while (have_posts()) {
                            the_post(); ?>
                            <div class="col-lg-4 col-md-6 mb-24px">
                                <?php get_template_part('template-parts/sec-single-post'); ?>
                            </div>
                        <?php }
                    } else { ?>
                        <p><?php pll_e( 'text_common_2' ); ?></p>
                    <?php }
                    wp_reset_postdata();
                if(function_exists('wp_pagenavi')) {?>
                    <div class="col-12 text-center">
                        <nav class="news-pagenavi">
                            <?php wp_pagenavi(); ?>
                        </nav>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php get_template_part('template-parts/sec-talk-to-us'); ?>
<?php get_footer();?>