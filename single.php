<?php get_header();
if (have_posts()) { ?>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="header-banner-img-single-page">
                        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" title="<?php the_title(); ?>" width="100%">
                    </div>
                </div>
            </div>
        </div>
	</div>
</header>
<?php } wp_reset_postdata(); ?>

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

     <section class="container-fluid">
        <div class="container">
           <div class="row single-content">
               <div class="col-12 mb-5">
                    <?php if (have_posts()) {
                        the_post();
                        $postCats = get_the_category(); ?>
                        <div class="single-tag">
                              <?php if ($postCats) {
                                 foreach($postCats as $key=>$cat) {
                                    if ($key === 0) {
                                       echo '<a href="'.get_category_link($cat->term_id).'">'.$cat->name.'</a>';
                                    } else {
                                       echo ', <a href="'.get_category_link($cat->term_id).'">'.$cat->name.'</a>';
                                    }
                                 }
                              } ?>
                        </div>
                        <h1 class="single-title text-center"><?php the_title(); ?></h1>
                        <div class="single-time text-center d-flex justify-content-center">
                            <?php
                            echo '<span>By ' . get_the_author_meta('display_name') . '</span>';
                            echo '<span class="mx-3">•</span>';
                            echo '<span>' . get_the_date('j F, Y') . '</span>';
                            ?>
                        </div>
                        <div class="single-article">
                            <article><?php the_content(); ?></article>
                        </div>
                    <?php } wp_reset_postdata(); ?>
               </div>
               <div class="col-12">
                <nav class="nav-single text-center">
                    <span class="nav-previous">
                        <?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr; Previous', 'Previous post link', '' ) . '</span>' ); ?>
                    </span>
                    <span class="nav-next">
                        <?php next_post_link( '%link', '<span class="meta-nav ml-4">' . _x( 'Next &rarr;', 'Next post link', '' ) . '</span>' ); ?>
                    </span>
                </nav>
 
 
               </div>
               <div class="col-12">
                   <?php $args = array(
                        'ignore_sticky_posts' => 1,
                        'showposts'   => 3,
                        'post__not_in' => array(get_the_ID())
                    );
                    $query = new WP_Query($args);
                    if ($query->have_posts()) { ?>
                        <div class="row single-related-post">
                            <div class="col-12 text-left header-single-related-post">Related Posts</div>
                            <?php while ($query->have_posts()) {
                                $query->the_post(); ?>
                                <div class="col-lg-4 mb-24px">
                                    <?php get_template_part('template-parts/sec-single-post'); ?>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } wp_reset_postdata(); ?>
               </div>
            </div>
        </div>
    </div>
<?php get_template_part('template-parts/sec-talk-to-us'); ?>
<?php get_footer();?>