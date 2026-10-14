<?php /* Template Name: Template Blog */
	get_header();?>
	<div class="header-banner header-banner-blog-page">
		<div class="container-fluid container-fluid-sub">
			<div class="container position-relative h-100">
				<div class="header-description header-about text-center w-100">
					<h3><?php pll_e('tpl_blogs_text_1'); ?></h3>
					<p><?php pll_e('tpl_blogs_text_2'); ?></p>
				</div>
			</div>
		</div>
	</div>
</header>

<main>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="title-blog-page"><?php pll_e('tpl_blogs_text_3'); ?></h2>
                </div>
            </div>
        </div>
        
        <div class="container">
            <div class="row">
                <?php
                    $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
                    $posts_per_page_settings = get_option('posts_per_page');
                    $args = array(
                        'posts_per_page' => $posts_per_page_settings,
                        'paged' => $paged
                    );
                    $query = new WP_Query($args);
                    if ($query->have_posts()) {
                        while ($query->have_posts()) {
                            $query->the_post(); ?>
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
                            <?php wp_pagenavi(array( 'query' => $query )); ?>
                        </nav>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php get_template_part('template-parts/sec-talk-to-us'); ?>

<?php get_footer();?>
