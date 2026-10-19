<!-- TALK TO US -->
<section class="sec-talk-to-us" id="sec-talk-to-us">
   <div class="container-fluid">
      <div class="container">
         <div class="sec-talk-to-us-content">
            <div class="row">
               <div class="col-lg-6 text-left d-flex flex-column align-self-center">
                  <h3 class="title-h3 mb-4"><span><?php pll_e('sec_talk_to_us_text_1'); ?></span></h3>
                  
                  <div class="d-flex align-items-top address mb-32px">
                     <i class="fa-solid fa-location-dot mr-3 mb-0"></i>
                     <div class="mb-0"><?php pll_e('sec_talk_to_us_text_2'); ?></div>
                  </div>
                  
                  <?php /* Hai Linh v2: so dien thoai / email sua trong Theme Options > "Hai Linh - Trang chu & lien he" > TALK TO US */
                  foreach (hl_sales_contacts() as $hl_row) { ?>
                  <div class="d-flex align-items-top address mb-32px">
                     <i class="fa-regular fa-envelope mr-3 mb-0"></i>
                     <div>
                        <label class="mb-0"><?php echo esc_html($hl_row['label']); ?></label>
                        <?php if ($hl_row['phone']) { ?>
                           <p class="mb-0">WhatsApps: <a class="text-dark" href="tel:+<?php echo esc_attr($hl_row['tel']); ?>"><?php echo esc_html($hl_row['phone']); ?></a></p>
                        <?php } ?>
                        <?php foreach ($hl_row['emails'] as $hl_i => $hl_email) { ?>
                           <p class="mb-0<?php echo $hl_i ? ' hl-email-more' : ''; ?>"><?php echo $hl_i ? '' : 'Email: '; ?><a class="text-dark" href="mailto:<?php echo esc_attr($hl_email); ?>"><?php echo esc_html($hl_email); ?></a></p>
                        <?php } ?>
                     </div>
                  </div>
                  <?php } ?>
               </div>
               <div class="col-lg-6">
                   <?php
                   $cf7_short_code = ot_get_option('cf7_short_code');
                   if ($cf7_short_code) {
                       echo do_shortcode($cf7_short_code);
                   } else {
                    echo '<div class="text-red text-center">' . pll__('sec_talk_to_us_text_3') . '</div>';
                   }?>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
