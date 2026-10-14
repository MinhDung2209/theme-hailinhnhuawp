<!-- MEDIA -->
<?php
   $args = array(
      'ignore_sticky_posts' => 1,
      'showposts'   => 4
   );
   $num = 0;
   $query = new WP_Query($args);
   if ($query->have_posts()) { ?>
      <section class="sec-media">
         <div class="container-fluid">
            <div class="container">
               <div class="sec-media-content">
                  <div class="row">
                     <div class="col-12">
                        <h2 class="title-h2 text-left"><?php pll_e('sec_media_text_1'); ?></h2>
                        <div class="d-flex mb-24px align-items-center">
                           <h3 class="title-h3"><?php pll_e('sec_media_text_2'); ?></h3>
                           <a href="<?php echo get_page_url('tpl-blog'); ?>" title="<?php pll_e('View All post'); ?>" class="ml-auto btn custom-btn"><?php pll_e('sec_media_text_3'); ?> <i class="fa-solid fa-angle-right"></i></a>
                        </div>
                     </div>

                     <?php while ($query->have_posts()) {
                        $query->the_post();
                        $postcats = get_the_category(get_the_ID());
                        if ($num === 0) { ?>
                           <div class="col-xl-5">
                              <div class="item display-type-1">
                                 <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                    <div class="media-img hongtq-image-holder" style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>')"></div>
                                 </a>
                                 <div class="other-content">
                                    <div class="media-time"><?php echo get_the_date('j F, Y'); ?></div>
                                    <div class="media-title">
                                       <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                          <?php the_title(); ?>
                                       </a>
                                    </div>
                                    <div class="media-tag">
                                       <ul>
                                          <?php if ($postcats) {
                                             foreach($postcats as $key=>$cat) {
                                                if ($key === 0) {
                                                   echo '<li><a href="'.get_category_link($cat->term_id).'">'.$cat->name.'</a></li>';
                                                } else {
                                                   echo '<li><a href="'.get_category_link($cat->term_id).'"><i class="fas fa-circle"></i> '.$cat->name.'</a></li>';
                                                }
                                             }
                                          } ?>
                                       </ul>
                                    </div>
                                    <p class="mb-0 media-short-content d-xl-block d-none">
                                       <?php echo short_excerpt(300); ?>
                                    </p>
                                 </div>
                              </div>
                           </div>
                        <?php } ?>
                        <?php if ($num === 1) { echo '<div class="col-xl-7">'; } ?>
                        <?php if ($num > 0) { ?>
                           <div class="item display-type-2">
                              <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                 <div class="media-img hongtq-image-holder" style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>')"></div>
                              </a>
                              <div class="other-content">
                                 <div class="media-time"><?php echo get_the_date('j F, Y'); ?></div>
                                 <div class="media-title">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                       <?php the_title(); ?>
                                    </a>
                                 </div>
                                 <div class="media-tag">
                                    <ul>
                                       <?php if ($postcats) {
                                          foreach($postcats as $key=>$cat) {
                                             if ($key === 0) {
                                                echo '<li><a href="'.get_category_link($cat->term_id).'">'.$cat->name.'</a></li>';
                                             } else {
                                                echo '<li><a href="'.get_category_link($cat->term_id).'"><i class="fas fa-circle"></i> '.$cat->name.'</a></li>';
                                             }
                                          }
                                       } ?>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                        <?php }
                        if ($num === ($query->post_count - 1)) { echo '</div>'; }
                        $num++;
                     } ?>
                  </div>
               </div>
            </div>
         </div>
      </section>
   <?php }
   wp_reset_postdata();
?>