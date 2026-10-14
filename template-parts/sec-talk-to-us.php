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
                  
                  <div class="d-flex align-items-top address mb-32px">
                     <i class="fa-regular fa-envelope mr-3 mb-0"></i>
                     <div>
                        <label class="mb-0"><?php pll_e('footer_text_6'); ?></label>
                        <p class="mb-0">WhatsApps: <a class="text-dark" href="tel:+84378680868">(+84) 84378680868</a></p>
                        <p class="mb-0">Email: <a class="text-dark" href="mailto:info@hailinhplastic.com">info@hailinhplastic.com</a></p>
                     </div>
                  </div>
                  
                  <div class="d-flex align-items-top address mb-32px">
                     <i class="fa-regular fa-envelope mr-3 mb-0"></i>
                     <div>
                        <label class="mb-0"><?php pll_e('footer_text_5'); ?></label>
                        <p class="mb-0">WhatsApps: <a class="text-dark" href="tel:+84358918210">(+84) 358918210</a></p>
                        <p class="mb-0">Email: <a class="text-dark" href="mailto:Annathu.do707@gmail.com">Annathu.do707@gmail.com</a></p>
                     </div>
                  </div>
               </div>
               <div class="col-lg-6">
                   <?php
                   $cf7_short_code = ot_get_option('cf7_short_code');
                   if ($cf7_short_code) {
                       echo do_shortcode($cf7_short_code);
                   } else {
                    echo '<div class="text-red text-center">' + pll_e('sec_talk_to_us_text_3') + '</div>';
                   }?>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
