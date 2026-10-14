<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie ie6 ie-lt10 ie-lt9 ie-lt8 ie-lt7 no-js" lang="vi-VN"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 ie-lt10 ie-lt9 ie-lt8 no-js" lang="vi-VN"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 ie-lt10 ie-lt9 no-js" lang="vi-VN"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 ie-lt10 no-js" lang="vi-VN"> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<html <?php language_attributes(); ?>>
<head>
  <?php wp_head();?>
  <?php
    if (checkLangVi()) { ?>
      <style>
        body {
          font-family: 'Roboto', sans-serif;
        }
      </style>
    <?php }
   ?>
</head>

<body <?php body_class('main'); ?>>
  <?php
  $tracking_code_body = ot_get_option('tracking_code_body');
  if(!empty($tracking_code_body))
    echo $tracking_code_body;
  ?>

   <header class="position-relative">
      <div class="container-fluid container-fluid-menu">
         <div class="container">
            <nav class="navbar navbar-expand-lg main-menu px-0">
               <?php hongtq_logo('logo','logo-wrapper navbar-brand'); ?>
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                  <i class="fa-solid fa-bars text-white"></i>
               </button>
               <div class="collapse navbar-collapse" id="main-menu">
                  <?php
                     wp_nav_menu( array(
                        'theme_location'  => 'main_menu',
                        'depth'           => 2,
                        'container_id'    => '',
                        'container_class' => 'ml-auto menu-header',
                        'menu_class'      => 'navbar-nav',
                        'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                        'walker'          => new WP_Bootstrap_Navwalker()
                     ));
                  ?>
               </div>
            </nav>
         </div>
      </div>
