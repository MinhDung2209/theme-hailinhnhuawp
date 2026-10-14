<?php /* Template Name: Template Home */
   get_header();?>
 <div class="header-banner slider-header">
    <div id="slider-flyer-banner" class="carousel slide" data-ride="carousel">
        <ul class="carousel-indicators">
            <li data-target="#slider-flyer-banner" data-slide-to="0" class="active"></li>
            <li data-target="#slider-flyer-banner" data-slide-to="1"></li>
            <li data-target="#slider-flyer-banner" data-slide-to="2"></li>
            <li data-target="#slider-flyer-banner" data-slide-to="3"></li>
        </ul>
        <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="container-fluid container-fluid-sub bg-image" style="background-image: url('<?php echo THEME_URL; ?>/img/filler-masterbatch.png');">
                 <div class="container position-relative h-100">
                    <div class="header-description">
                       <h3><?php echo get_bloginfo('description'); ?></h3>
                       <p><?php pll_e('tpl_home_page_text_1'); ?></p>
                       <i><?php pll_e('tpl_home_page_text_2'); ?></i>
                       <a class="btn btn-outline-light btn-get-in-touch" href="#sec-talk-to-us"><?php pll_e('text_common_1'); ?></a>
                    </div>
                 </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="container-fluid container-fluid-sub bg-image" style="background-image: url('<?php echo THEME_URL; ?>/img/hai-linh-plastic-banner-1.png');">
                 <div class="container position-relative h-100">
                    <div class="header-description">
                       <h3><?php echo get_bloginfo('description'); ?></h3>
                       <i><?php pll_e('tpl_home_page_text_4'); ?></i>
                       <a class="btn btn-outline-light btn-get-in-touch" href="#sec-talk-to-us"><?php pll_e('text_common_1'); ?></a>
                    </div>
                 </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="container-fluid container-fluid-sub bg-image" style="background-image: url('<?php echo THEME_URL; ?>/img/hai-linh-plastic-banner-2.png');">
                 <div class="container position-relative h-100">
                    <div class="header-description">
                       <h3><?php echo get_bloginfo('description'); ?></h3>
                       <i><?php pll_e('tpl_home_page_text_6'); ?></i>
                       <a class="btn btn-outline-light btn-get-in-touch" href="#sec-talk-to-us"><?php pll_e('text_common_1'); ?></a>
                    </div>
                 </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="container-fluid container-fluid-sub bg-image" style="background-image: url('<?php echo THEME_URL; ?>/img/hai-linh-plastic-banner-3.png');">
                 <div class="container position-relative h-100">
                    <div class="header-description">
                       <h3><?php echo get_bloginfo('description'); ?></h3>
                       <i class="mb-0"><?php pll_e('tpl_home_page_text_7'); ?></i>
                       <i class="mb-0 pl-3"><?php pll_e('tpl_home_page_text_8'); ?></i>
                       <i class="mb-0 pl-3"><?php pll_e('tpl_home_page_text_9'); ?></i>
                       <i class="pl-3"><?php pll_e('tpl_home_page_text_10'); ?></i>
                       <a class="btn btn-outline-light btn-get-in-touch" href="#sec-talk-to-us"><?php pll_e('text_common_1'); ?></a>
                    </div>
                 </div>
              </div>
            </div>
            
            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#slider-flyer-banner" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#slider-flyer-banner" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>
   </div>
</header>
<main>

   <?php
       get_template_part('template-parts/sec-animation-home-page');
      get_template_part('template-parts/sec-what-we-do');
      get_template_part('template-parts/sec-application');
      get_template_part('template-parts/sec-bk-services');
      get_template_part('template-parts/sec-why-choose-us');
      get_template_part('template-parts/sec-out-partner');
      get_template_part('template-parts/sec-talk-to-us');
       get_template_part('template-parts/sec-media');
   ?>

<?php get_footer();?>
