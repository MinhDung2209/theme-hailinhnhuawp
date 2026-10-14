<?php

/*-----------------------------------------------------------------------------------*/
/*  Config theme for all themes
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/*  Add html5shiv script to <head> conditionally for IE8 and under
/*-----------------------------------------------------------------------------------*/
	function ew_html5shiv() { ?>
		<!--[if lt IE 9]>
			<script src="<?php echo get_template_directory_uri(); ?>/framework/core/js/html5.js" type="text/javascript"></script>
			<script src="<?php echo get_template_directory_uri(); ?>/framework/core/js/css3-mediaqueries.js" type="text/javascript"></script>
		<![endif]-->
	<?php }
	add_action('wp_head', 'ew_html5shiv');

/*-----------------------------------------------------------------------------------*/
/*  Option Tree integration
/*-----------------------------------------------------------------------------------*/
	/**
	* Optional: set 'ot_show_pages' filter to false.
	* This will hide the settings & documentation pages.
	*/
	add_filter( 'ot_show_pages', '__return_false' );
	/**
	 * Optional: set 'ot_show_new_layout' filter to false.
	 * This will hide the "New Layout" section on the Theme Options page.
	 */
	add_filter( 'ot_show_new_layout', '__return_false' );
	/**
	* Required: set 'ot_theme_mode' filter to true.
	*/
	add_filter( 'ot_theme_mode', '__return_true' );
	/**
	* Required: include OptionTree Framework.
	*/
	load_template( trailingslashit( get_template_directory() ) . '/framework/theme_options/option-tree/ot-loader.php' );

/*-----------------------------------------------------------------------------------*/
/*  Enable oEmbed in Text/HTML Widgets
/*-----------------------------------------------------------------------------------*/
	add_filter( 'widget_text', array( $wp_embed, 'run_shortcode' ), 8 );
	add_filter( 'widget_text', array( $wp_embed, 'autoembed'), 8 );

/*-----------------------------------------------------------------------------------*/
/*  Remove size image default
/*-----------------------------------------------------------------------------------*/
	function ew_filter_image_sizes( $sizes) {
		$remove_image_sizes = ot_get_option('remove_image_sizes');
		if(!empty($remove_image_sizes)) :
			foreach($remove_image_sizes as $value) :
				unset( $sizes[$value]);
			endforeach;
		endif;
		// unset( $sizes['thumbnail']);
		// unset( $sizes['medium']);
		// unset( $sizes['large']);
		// unset( $sizes['medium_large']);
		
		return $sizes;
	}
	add_filter('intermediate_image_sizes_advanced', 'ew_filter_image_sizes');

/*-----------------------------------------------------------------------------------*/
/*  Clean WordPress header
/*-----------------------------------------------------------------------------------*/
	function ew_clean_header() {
	    remove_action('wp_head', 'wp_generator'); // Remove wp_generator
		remove_action('wp_head', 'rsd_link'); // Remove Really simple discovery link
		remove_action('wp_head', 'wlwmanifest_link');
		remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
		remove_action('wp_head', 'feed_links', 2);
		remove_action('wp_head', 'feed_links_extra', 3);
		remove_action('wp_head', 'start_post_rel_link', 10, 0);
		remove_action('wp_head', 'parent_post_rel_link', 10, 0);
		remove_action('wp_head', 'index_rel_link');
		remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
		remove_action('wp_head', 'adjacent_posts_rel_link_wp_head, 10, 0'); 
		
		remove_action('wp_head', 'print_emoji_detection_script', 7); // Remove emoji
	    remove_action('wp_print_styles', 'print_emoji_styles'); // Remove emoji
		add_filter('style_loader_src', 'ew_remove_ver_css_js', 9999); // Remove WP Version From Styles
		add_filter('script_loader_src', 'ew_remove_ver_css_js', 9999); // Remove WP Version From Scripts
		// Function to remove version numbers
		function ew_remove_ver_css_js($src) {
			if (strpos($src, 'ver='))
				$src = remove_query_arg('ver', $src);
			return $src;
		}
		remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
		remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
	}
	add_action( 'after_setup_theme', 'ew_clean_header' );

/*-----------------------------------------------------------------------------------*/
/*  Enable shortcode in text widgets
/*-----------------------------------------------------------------------------------*/
	add_filter( 'widget_text', 'do_shortcode' );
	add_filter( 'widget_title', 'do_shortcode' );

/*-----------------------------------------------------------------------------------*/
/*  Add Theme Support
/*-----------------------------------------------------------------------------------*/
	if (!function_exists('ew_theme_setup')){
		function ew_theme_setup(){
			add_theme_support('post-thumbnails');
			add_theme_support('automatic-feed-links' );
			add_theme_support('html5', array('comment-list', 'search-form', 'comment-form', 'gallery', 'caption', ) );
			add_theme_support('title-tag');
			add_theme_support('custom-background');
			add_theme_support('responsive-embeds' );
			// add_theme_support('menus');
			//add_theme_support('custom-logo');
			//add_theme_support('custom-header' );
			//add_theme_support('post-formats', array('aside', 'image', 'video', 'quote', 'link', 'gallery', 'photo', 'status', 'audio', 'chat' ) );
		}
		add_action('init', 'ew_theme_setup');
	}

/*-----------------------------------------------------------------------------------*/
/*  Set $ CONTENT_WIDTH to declare the size of the content width
/*-----------------------------------------------------------------------------------*/
	// if ( ! isset( $content_width ) ) {
 //   		$content_width = 620;
	// }

/*-----------------------------------------------------------------------------------*/
/*  Show an admin notice if .htaccess isn't writable
/*-----------------------------------------------------------------------------------*/
	if(!function_exists('ew_htaccess_writable')){
		function ew_htaccess_writable() {
		    if (!is_writable(get_home_path() . '.htaccess')) {
		        if (current_user_can('administrator')) {
		            add_action('admin_notices', create_function('', "echo '<div class=\"error\"><p>" . sprintf(__('Please make sure your <a href="%s">.htaccess</a> file is writable ', 'ew'), admin_url('options-permalink.php')) . "</p></div>';"));
		        }
		    }
		}
		add_action('admin_init', 'ew_htaccess_writable');
	}

/*-----------------------------------------------------------------------------------*/
/*  When active theme then redirect to theme options
/*-----------------------------------------------------------------------------------*/
	global $pagenow;
	if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ){
    	wp_redirect( admin_url('admin.php?page=ot-theme-options' ) );
	    exit;
	}

/*-----------------------------------------------------------------------------------*/
/*  Customize admin footer text
/*-----------------------------------------------------------------------------------*/
	if(!function_exists('ew_custom_admin_footer')){
		function ew_custom_admin_footer() {
			echo 'Thiết kế website bởi <a href="https://cv.gnud.io.vn" target="_blank" rel="noopener" title="minhdung2209.work@gmail.com">Dũng AI</a>';
		}
		add_filter('admin_footer_text', 'ew_custom_admin_footer');
	}

/*-----------------------------------------------------------------------------------*/
/*  CUSTOM ADMIN LOGIN HEADER LINK & ALT TEXT
/*-----------------------------------------------------------------------------------*/
	function ew_login_logo_url() {
	    return get_bloginfo( 'url' );
	}
	add_filter( 'login_headerurl', 'ew_login_logo_url' );

	function ew_login_logo_url_title() {
		return '';
	}
	add_filter( 'login_headertitle', 'ew_login_logo_url_title' );

/*-----------------------------------------------------------------------------------*/
/*  CUSTOM ADMIN LOGIN HEADER LOGO
/*-----------------------------------------------------------------------------------*/
	if(!function_exists('ew_custom_login_logo')){
		function ew_custom_login_logo() { ?>
		    <style type="text/css">
				body.login {background: #fbfbfb url('<?php echo get_bloginfo( 'template_directory' ) ?>/framework/images/bg-admin.png') no-repeat fixed center;}
				.login h1 a {background-image: url('<?php echo get_bloginfo( 'template_directory' ) ?>/framework/images/logo.png')!important;background-size: 50%!important;width: 100%!important; background-position: center center !important;}
				.message.register{display: none}
				.login form {border: 1px solid rgba(0,0,0,.2);-moz-border-radius: 5px;-webkit-border-radius: 5px;border-radius: 5px;background: rgba(255, 255, 255, 0.5)!important}
				.login label {color: #fff!important}
				.login form .input,
				.login input[type="text"] { font-size: 13pt!important}
				input#rememberme {height: 18px;width: 18px;display: inline;vertical-align: middle;margin: 2px 5px 0 0;float: left}
				body.login div#login p#backtoblog {display:inline}
				body.login div#login p#backtoblog a {float:right;display:inline}
				div.updated,.login .message {background-color: lightYellow;border-color: #E6DB55;font-family: 'Open Sans Condensed', sans-serif;font-size: 16px;font-weight: 700}
				body.login div#login form#loginform input#user_pass,
				body.login div#login form#loginform input#user_login {font-size: 12px}
		    </style>
		<?php }
	}

	add_action('login_enqueue_scripts', 'ew_custom_login_logo');

/*-----------------------------------------------------------------------------------*/
/*  Remove default widgets
/*-----------------------------------------------------------------------------------*/
	function stwp_remove_wp_default_widgets() {
		unregister_widget('WP_Widget_Tag_Cloud');
		unregister_widget('WP_Widget_Pages');
		// unregister_widget('WP_Widget_Links');
		// unregister_widget('WP_Widget_Text');
		unregister_widget('WP_Widget_Archives');
		unregister_widget('WP_Widget_Calendar');
		unregister_widget('WP_Widget_Recent_Comments');
		unregister_widget('WP_Widget_RSS');
		unregister_widget('WP_Widget_Media_Audio');
		unregister_widget('WP_Widget_Media_Gallery');
		// unregister_widget('WP_Nav_Menu_Widget');
		unregister_widget('WP_Widget_Recent_Posts');
		unregister_widget('WP_Widget_Categories');
		unregister_widget('WP_Widget_Meta');
		// unregister_widget('WP_Widget_Search');
	}
	add_action('widgets_init', 'stwp_remove_wp_default_widgets', 11);