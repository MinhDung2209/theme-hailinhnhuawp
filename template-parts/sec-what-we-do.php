<!-- WHAT WE DO -->
<section class="sec-what-we-do">
   <div class="container-fluid">
      <div class="container">
         <h2 class="title-h2"><?php pll_e("sec_what_we_do_text_1"); ?></h2>
         <h3 class="title-h3"><?php pll_e("sec_what_we_do_text_2"); ?></h3>
         <div class="title-description text-center">
            <p class="mb-0"><?php pll_e("sec_what_we_do_text_3"); ?></p>
         </div>
         <div class="sec-what-we-do-content">
            <div class="row justify-content-center">
               <?php
                    $current_language = pll_current_language();
                    $default_term_id = 25;
                    $translated_term_id = pll_get_term($default_term_id, $current_language);
                    $terms = get_terms([
                        'taxonomy' => 'product-cat',
                        'hide_empty' => false,
                        'parent' => $translated_term_id
                    ]);
                  if ($terms) {
                     foreach ($terms as $term) {
                        $upload_image = get_term_meta($term->term_id, 'term_image', true); ?>
                        <div class="col-xl-4 col-lg-6 mb-4">
                           <div class="sec-what-we-do-item">
                              <a class="hongtq-image-holder" style="background-image: url(<?php echo $upload_image; ?>)" href="<?php echo get_term_link($term->term_id); ?>"></a>
                              <h3><?php echo $term->name; ?></h3>
                              <div class="description">
                                 <h3><?php echo $term->name; ?></h3>
                                 <h4><?php echo $term->description; ?></h4>
                                 <a href="<?php echo get_term_link($term->term_id); ?>"><?php pll_e("text_common_4"); ?> <i class="fa-solid fa-angle-right"></i></a>
                              </div>
                           </div>
                        </div>
                      <?php
                     }
                  }
               ?>
            </div>
         </div>
      </div>
   </div>
</section>
