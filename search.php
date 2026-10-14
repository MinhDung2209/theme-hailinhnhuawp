<?php
get_header();?>
<main class="content py-4 bg-custom">
   <section class="container-fluid">
      <div class="container real-estate">
         <div class="row">
            <div class="col-md-3">
               <?php $object = get_queried_object();
               $currentId = $object->term_id;
               $cat_args = array(
                  'orderby'       => 'term_id', 
                  'order'         => 'ASC',
                  'hide_empty'    => 0, 
               );
               $terms = get_terms('product-cat', $cat_args);
               if ($terms) { ?>
                  <ul class="list-group">
                     <li class="list-group-item sec-title"><b>DANH MỤC TÀI SẢN ĐẤU GIÁ</b></li>
                     <?php foreach($terms as $item) { ?>
                        <li class="list-group-item sec-pro <?php if ($item->term_id === $currentId) echo 'active'; ?>"><a href="<?php echo get_term_link($item); ?>"><?php echo $item->name; ?></a></li>
                     <?php } ?>
                  </ul>
                  <?php wp_reset_query();
               } ?>
            </div>
            <div class="col-md-9">
               <?php
               if(have_posts()){ ?>
                  <div class="row">
                     <?php while(have_posts()){
                        the_post(); ?>
                        <div class="col-md-4">
                           <div class="card">
                              <a class='hongtq-image-holder height-164-before' loading='lazy' href="<?php the_permalink(); ?>"
                                 style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>')">
                              </a>
                              <div class="card-body">
                                 <a href="<?php the_permalink(); ?>" class="card-text"><?php the_title(); ?></a>
                                 <?php
                                    $produc_status = get_post_meta(get_the_ID(), 'produc_status', true);
                                    $price_start = get_post_meta(get_the_ID(), 'price_start', true);
                                    $product_code = get_post_meta(get_the_ID(), 'product_code', true);
                                    if ($price_start) {
                                       echo '<p class="card-prince mb-0 text-center">'.$price_start.'</p>';
                                    } else {
                                       echo '<p class="card-prince mb-0 text-center">Liên hệ</p>';
                                    }
                                 ?>
                              </div>
                              <div class="card-footer text-center">
                                 <a href="javascript:void(0)" class="btn btn-danger" onClick="getInfo('<?php echo $product_code; ?>', '<?php the_title(); ?>')">ĐẤU GIÁ</a>
                              </div>
                           </div>
                        </div>
                     <?php } ?>
                  </div>
                  <?php if(function_exists('wp_pagenavi')) { ?>
                     <div class="hongtq-pagination mt-4 text-right">
                        <?php wp_pagenavi(); ?>
                     </div>
                  <?php } wp_reset_query();
               } else {
                  echo '<label>Không có data</label>';
               } ?>
            </div>
         </div>
      </div>
   </section>
</main>
<?php get_footer();?>