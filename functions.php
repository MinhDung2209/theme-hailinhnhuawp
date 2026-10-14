<?php
/**
 * hongtq_dev functions and definitions
 *
 */

/* ----------------------------------------------------------------------------------- */
/*  Khai bao hang gia tri
/*  THEME_URL = lay duong dan thu muc theme
/*  CORE = lay duong dan cua thu muc /framework
/*----------------------------------------------------------------------------------- */
	define('THEME_URL', get_template_directory_uri());
	define('CORE', THEME_URL."/framework");
	// define('EW_PREFIX', 'hongtq_dev' );

/* ----------------------------------------------------------------------------------- */
/*  Make theme available for translation.
/*  Translations can be filed in the /languages/ directory.
/*  If you're building a theme based on hongtq, use a find and replace
/*  to change 'hongtq_dev' to the name of your theme in all the template files
/*----------------------------------------------------------------------------------- */
	load_theme_textdomain('hongtq_dev', THEME_URL . '/languages');

/* ----------------------------------------------------------------------------------- */
/*  Core Features
/*----------------------------------------------------------------------------------- */
    require get_template_directory() . '/framework/core/config-theme.php';

/* ----------------------------------------------------------------------------------- */
/*  Data Function
/*----------------------------------------------------------------------------------- */
    require get_template_directory() . '/framework/core/ew-core.php';

/* ----------------------------------------------------------------------------------- */
/*  Register Widget
/*----------------------------------------------------------------------------------- */
    include get_template_directory() . '/framework/widgets/create_widget.php';
    include get_template_directory() . '/framework/widgets/create_area_widget.php';

/* ----------------------------------------------------------------------------------- */
/*  Create custom post type
/*----------------------------------------------------------------------------------- */
    include get_template_directory() . '/framework/custom_post_type/custom_post_type.php';

/* ----------------------------------------------------------------------------------- */
/*  Create custom taxonomy
/*----------------------------------------------------------------------------------- */
    include get_template_directory() . '/framework/custom_taxonomy/custom_taxonomy.php';

/* ----------------------------------------------------------------------------------- */
/*  Create upload image in taxonomy
/*----------------------------------------------------------------------------------- */
    include get_template_directory() . '/framework/upload_image_taxonomy/function.php';

/* ----------------------------------------------------------------------------------- */
/*  Template Woocommerce
/*----------------------------------------------------------------------------------- */
    // require get_template_directory() . '/function-woo.php';


/* ----------------------------------------------------------------------------------- */
/*  Register translate use plugin "Polylang"
/*----------------------------------------------------------------------------------- */
    require get_template_directory() . '/function-polylang.php';

/* ----------------------------------------------------------------------------------- */
/*  Hai Linh v2: 5 dong san pham moi, hero, chung chi, library, map (10/2026)
/*----------------------------------------------------------------------------------- */
    require get_template_directory() . '/inc/hailinh-v2.php';

/* ----------------------------------------------------------------------------------- */
/*  Create metadata
/*----------------------------------------------------------------------------------- */
    include get_template_directory() . '/framework/custom_field/metadata.php';

/* ----------------------------------------------------------------------------------- */
/*  Create Shortcode
/*----------------------------------------------------------------------------------- */
    //include get_template_directory() . '/framework/shortcodes/ew-shortcodes.php';

/* ----------------------------------------------------------------------------------- */
/*  Optimize HTML & CSS
/*----------------------------------------------------------------------------------- */
    //include get_template_directory() . '/framework/optimize/html.php';
    //include get_template_directory() . '/framework/optimize/css.php';

/* ----------------------------------------------------------------------------------- */
/*  Theme Option
/*----------------------------------------------------------------------------------- */
    include get_template_directory() . '/framework/modules/theme-options.php';

/* ----------------------------------------------------------------------------------- */
/*  Tgm Plugin Activation
/*----------------------------------------------------------------------------------- */
    include get_template_directory() . '/framework/modules/class-tgm-plugin-activation.php';
    include get_template_directory() . '/framework/modules/activation.php';


/* ----------------------------------------------------------------------------------- */
/*  Register Menu
/*----------------------------------------------------------------------------------- */
    register_nav_menus(array(
        'main_menu' => __('Menu Header', 'hongtq_dev'),
        'switch_language_menu' => __('Menu switch language', 'hongtq_dev'),
        'footer_menu_company' => __('Menu Footer - Company', 'hongtq_dev'),
        'footer_menu_services' => __('Menu Footer - Services', 'hongtq_dev'),
    ));

/* ----------------------------------------------------------------------------------- */
/*  Adding Default Thumbnail Sizes
/*----------------------------------------------------------------------------------- */
    // add_image_size('thumb_368x394', 368, 394, true);

/*-----------------------------------------------------------------------------------*/
/*  Info Head
/*-----------------------------------------------------------------------------------*/
    add_action('wp_head', 'hongtq_info_head',1,1);
    function hongtq_info_head(){?>
        <!--
        *********************************************************************
        *       DEVELOPER:  Sale themes wordpress              				*
        *       EMAIL:  salethemeswp@gmail.com     							*
        *       SKYPE: tranhongcnttk58nd@outlook.com                 		*
        *       WEBSITE: https://salethemeswp.com							*
        *		Zalo: +84972608111											*
        *********************************************************************
        -->
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <?php
        $app_id = ot_get_option('app_id_facebook');
        if(!empty($app_id))
            echo '<meta property="fb:app_id" content="'.$app_id.'"/>';
        
        $favicon = ot_get_option('favicon');
        if( !empty($favicon) )
            echo '<link rel="shortcut icon" href="'.$favicon.'" />';

        $tracking_code_head = ot_get_option('tracking_code_head');
        if(!empty($tracking_code_head))
            echo $tracking_code_head;
    }

/* ----------------------------------------------------------------------------------- */
/*  Load Required CSS Styles
/*----------------------------------------------------------------------------------- */
    if (!function_exists('load_theme_styles')) {
        function load_theme_styles() {
            wp_enqueue_style('bootstrap', THEME_URL . '/lib/bootstrap-4.0.0/dist/css/bootstrap.min.css');
            wp_enqueue_style('fontawesome', THEME_URL . '/lib/fontawesome-6.4.0/css/all.min.css');
            wp_enqueue_style('slick-css', THEME_URL . '/lib/slick-1.8.1/slick/slick.css');
            wp_enqueue_style('slick-theme', THEME_URL . '/lib/slick-1.8.1/slick/slick-theme.css');
            wp_enqueue_style('animate', THEME_URL . '/css/animate.css');
            if (is_page_template('tpl-portfolio-companies.php')) {
                wp_enqueue_style('lightslider', THEME_URL . '/lib/lightslider-master/dist/css/lightslider.min.css');
            }
            wp_enqueue_style('style', get_stylesheet_uri());
        }
    }
    add_action('wp_enqueue_scripts', 'load_theme_styles');



/* ----------------------------------------------------------------------------------- */
/*  Load Required CSS Styles in footer
/*----------------------------------------------------------------------------------- */
    // if (!function_exists('load_theme_styles_in_footer')) {

    //     function load_theme_styles_in_footer() {
    //         wp_enqueue_style('slick', THEME_URL . '/css/slick.css');
    //         wp_enqueue_style('slick-theme', THEME_URL . '/css/slick-theme.css');
    //     }
    // }
    // add_action('get_footer', 'load_theme_styles_in_footer');


/* ----------------------------------------------------------------------------------- */
/*  Load Required JS Scripts
/*----------------------------------------------------------------------------------- */
	if (!function_exists('load_theme_scripts')) {
	    function load_theme_scripts() {
            wp_enqueue_script('jquery');
            wp_enqueue_script('jquery-3.3.1', THEME_URL . '/js/jquery-3.3.1.min.js', '', '3.3.1', false);
            wp_enqueue_script('bootstrap-popper', THEME_URL . '/lib/bootstrap-4.0.0/assets/js/vendor/popper.min.js', '', '4.0.0', true);
            wp_enqueue_script('bootstrap', THEME_URL . '/lib/bootstrap-4.0.0/dist/js/bootstrap.min.js', '', '4.0.0', true);
            wp_enqueue_script('slick', THEME_URL . '/lib/slick-1.8.1/slick/slick.js', '', '1.8.1', true);
            wp_enqueue_script('lazyload', THEME_URL . '/lib/vanilla-lazyload-master/dist/lazyload.min.js', '', '1.8.1', true);
            if (is_page_template('tpl-portfolio-companies.php')) {
                wp_enqueue_script('lightslider', THEME_URL . '/lib/lightslider-master/dist/js/lightslider.min.js', '', '1.1.6', true);
            }
            wp_enqueue_script('global', THEME_URL . '/js/custom.js', array('jquery'), '', true);
	    }
	}
	add_action('wp_enqueue_scripts', 'load_theme_scripts');

/* ----------------------------------------------------------------------------------- */
/*  Info Footer
/*----------------------------------------------------------------------------------- */
	add_action('wp_footer', 'hongtq_footer');

	if (!function_exists('hongtq_footer')) {
		function hongtq_footer() {
		    $tracking_code = ot_get_option('tracking_code');
		    if (!empty($tracking_code)) {
		        echo $tracking_code;
		    }
		    
		    if (is_page_template('tpl-portfolio-companies.php')) { ?>
		        <script>
                    $(document).ready(function() {
                        $("#lightSlider").lightSlider({
                            gallery:true,
                            loop:true,
                            keyPress:true,
                            item:1,
                            slideMargin: 0,
                            speed: 0,
                            auto:false,
                            loop:true,
                            easing: '',
                            prevHtml: '<div><img src="<?php echo THEME_URL; ?>/img/left.png" width="44px"></div>',
                            nextHtml: '<div><img src="<?php echo THEME_URL; ?>/img/right.png" width="44px"></div>',
                            adaptiveHeight: true
                        });
                    });
                </script>
		    <?php }
		}
	}
/* ----------------------------------------------------------------------------------- */
/*  Function Thumbnail
/*----------------------------------------------------------------------------------- */
	if (!function_exists('hongtq_thumbnail_post')) {
	    function hongtq_thumbnail_post($class) {
	    	global $post;
	    	$featured_img_url = get_the_post_thumbnail_url($post->ID, 'full');
	    	// $post_format = get_post_format($post->ID);
	    	// $custom = get_post_custom($post->ID); ?>
	    	<a title="<?php echo get_the_title($post->ID); ?>" href="<?php echo get_the_permalink($post->ID); ?>" class="<?php echo $class; ?> ew-image-holder" 
	    		style="<?php //if($post_format == 'video') : 
	    					//echo "background-image: url('http://img.youtube.com/vi/".$custom['link'][0]."/0.jpg')";
    					//else :
    						echo 'background-image: url('.$featured_img_url.')';
						//endif; ?>">
                <?php
                //if($post_format == 'video') echo '<span class="format-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></span>';
                //else echo '<div class="overlay"></div>';
                ?>
            </a>
	    <?php }
	}


/*-----------------------------------------------------------------------------------*/
/* Change editor from new design to old design
/*-----------------------------------------------------------------------------------*/
    add_filter('use_block_editor_for_post', '__return_false');

/*-----------------------------------------------------------------------------------*/
/* Change widget from new design to old design
///*-----------------------------------------------------------------------------------*/
    add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );
    add_filter( 'use_widgets_block_editor', '__return_false' );

/*-----------------------------------------------------------------------------------*/
/*  Navwalker Bootstrap 4
/*-----------------------------------------------------------------------------------*/
    if ( ! file_exists( get_template_directory() . '/class-wp-bootstrap-navwalker.php' ) ) {
            // file does not exist... return an error.
        return new WP_Error( 'class-wp-bootstrap-navwalker-missing', __( 'It appears the class-wp-bootstrap-navwalker.php file may be missing.', 'wp-bootstrap-navwalker' ) );
    } else {
            // file exists... require it.
        require_once get_template_directory() . '/wp_bootstrap_polylang.php';
        require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
    }

/*-----------------------------------------------------------------------------------*/
/*  Option tree format datepicker
/*-----------------------------------------------------------------------------------*/
    add_filter('ot_type_date_picker_date_format', function($format) {
       return 'dd-mm-yy';
    });


/*-----------------------------------------------------------------------------------*/
/*  Get page url by template
/*-----------------------------------------------------------------------------------*/
function get_page_url($template_name) {
    $pages = get_posts([
        'post_type' => 'page',
        'post_status' => 'publish',
        'meta_query' => [
            [
                'key' => '_wp_page_template',
                'value' => $template_name.'.php',
                'compare' => '='
            ]
        ]
    ]);
    if(!empty($pages)) {
      foreach($pages as $pages__value) {
          return get_permalink($pages__value->ID);
      }
    }
    return get_bloginfo('url');
}


/*-----------------------------------------------------------------------------------*/
/*  Get short content by ID
/*-----------------------------------------------------------------------------------*/
function get_short_content($postId) {
    $content_post = get_post($postId);
    $content = $content_post->post_content;
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    return $content;
}

/*-----------------------------------------------------------------------------------*/
/*  Hidden switch language in admin login page
/*-----------------------------------------------------------------------------------*/
add_filter( 'login_display_language_dropdown', '__return_false' );

/*-----------------------------------------------------------------------------------*/
/*  Check language is viet nam
/*-----------------------------------------------------------------------------------*/
function checkLangVi() {
    $currLang = get_bloginfo('language');
    return $currLang === 'vi';
}
