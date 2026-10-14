<?php
/*-----------------------------------------------------------------------------------*/
/*  Core features for all themes
/*-----------------------------------------------------------------------------------*/

/* ----------------------------------------------------------------------------------- */
/*  Function Logo
/*----------------------------------------------------------------------------------- */
	if (!function_exists('hongtq_logo')) {
	    function hongtq_logo($id_option, $class) { ?>
	        <a href="<?php echo home_url(); ?>" title="<?php echo get_bloginfo('name'); ?>" class="<?php echo $class; ?>">
	        	<?php
	        	if(!empty($id_option))
	        		$logo = ot_get_option($id_option);
	        	else
	        		$logo = ot_get_option('logo');

	        	if(!empty($logo)) :
	        		echo '<img src="'.$logo.'" alt="'.get_bloginfo('name').'" title="'.get_bloginfo('name').'">';
	    		else :
	    			echo get_bloginfo('name');
				endif; ?>
	        </a>
	        <?php
	        if(is_front_page())
	        	echo '<h1 class="site-title">'.get_bloginfo('name').' | '.get_bloginfo ( 'description' ).'</h1>';
	    }
	}

/*-----------------------------------------------------------------------------------*/
/*  Redirect the article when searching for a result
/*-----------------------------------------------------------------------------------*/
    add_action('template_redirect', 'eweb_redirect_single_post');
    function eweb_redirect_single_post() {
        if (is_search()) {
            global $wp_query;
            if ($wp_query->post_count == 1) {
                wp_redirect( get_permalink( $wp_query->posts['0']->ID ) );
            }
        }
    }

/*-----------------------------------------------------------------------------------*/
/*  Get archive title
/*-----------------------------------------------------------------------------------*/
	if ( ! function_exists( 'ew_the_archive_title' ) ) :
	function ew_the_archive_title( $before = '', $after = '' ) {
		if ( is_category() ) {
			$title = sprintf( __( 'Category: %s', 'eweb' ), single_cat_title( '', false ) );
		} elseif ( is_tag() ) {
			$title = sprintf( __( 'Tag: %s', 'eweb' ), single_tag_title( '', false ) );
		} elseif ( is_author() ) {
			$title = sprintf( __( 'Author: %s', 'eweb' ), '<span class="vcard">' . get_the_author() . '</span>' );
		} elseif ( is_year() ) {
			$title = sprintf( __( 'Year: %s', 'eweb' ), get_the_date( _x( 'Y', 'yearly archives date format', 'eweb' ) ) );
		} elseif ( is_month() ) {
			$title = sprintf( __( 'Month: %s', 'eweb' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'eweb' ) ) );
		} elseif ( is_day() ) {
			$title = sprintf( __( 'Day: %s', 'eweb' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'eweb' ) ) );
		} elseif ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = _x( 'Asides', 'post format archive title', 'eweb' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = _x( 'Galleries', 'post format archive title', 'eweb' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = _x( 'Images', 'post format archive title', 'eweb' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = _x( 'Videos', 'post format archive title', 'eweb' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = _x( 'Quotes', 'post format archive title', 'eweb' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = _x( 'Links', 'post format archive title', 'eweb' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = _x( 'Statuses', 'post format archive title', 'eweb' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = _x( 'Audio', 'post format archive title', 'eweb' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = _x( 'Chats', 'post format archive title', 'eweb' );
		} elseif ( is_post_type_archive() ) {
			$title = sprintf( __( 'Archives: %s', 'eweb' ), post_type_archive_title( '', false ) );
		} elseif ( is_tax() ) {
			$tax = get_taxonomy( get_queried_object()->taxonomy );
			/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
			$title = sprintf( __( '%1$s: %2$s', 'eweb' ), $tax->labels->singular_name, single_term_title( '', false ) );
		} else {
			$title = __( 'Archives', 'eweb' );
		}

		/**
		 * Filter the archive title.
		 *
		 * @param string $title Archive title to be displayed.
		 */
		$title = apply_filters( 'get_the_archive_title', $title );

		if ( ! empty( $title ) ) {
			echo $before . $title . $after;
		}
	}
	endif;

/*-----------------------------------------------------------------------------------*/
/*  Get archive description
/*-----------------------------------------------------------------------------------*/
	if ( ! function_exists( 'ew_the_archive_description' ) ) :
		function ew_the_archive_description( $before = '', $after = '' ) {
			$description = apply_filters( 'get_the_archive_description', term_description() );

			if ( ! empty( $description ) ) {
				/**
				 * Filter the archive description.
				 *
				 * @see term_description()
				 *
				 * @param string $description Archive description to be displayed.
				 */
				echo $before . $description . $after;
			}
		}
	endif;

/*-----------------------------------------------------------------------------------*/
/*  Get related posts
/*  @params $post_id (optional). If not passed, it will try to get global $post
/*-----------------------------------------------------------------------------------*/
// if(!function_exists('ew_get_related_posts')){
// 	function ew_get_related_posts( $post_id = null, $number ) {
// 		if(!$post_id){
// 			global $post;
// 			if($post) {
// 				$post_id = $post->ID;
// 			} else {
// 				// return if cannot find any post
// 				return;
// 			}
// 		}
// 		$args = array(
// 		  	'post_status' => 'publish',
// 		  	'posts_per_page' => $number,
// 		  	'orderby' => 'date',
// 		  	'ignore_sticky_posts' => 1,
// 			'post__not_in' => array ($post_id)
// 		);
// 		$categories = wp_get_post_categories($post_id);
// 		$args['category__in'] = $categories;
// 		$related_items = new WP_Query( $args );
// 		return $related_items;
// 	}
// }

/* ----------------------------------------------------------------------------------- */
/*  Function Show Tags
/*----------------------------------------------------------------------------------- */
	if(!function_exists('ew_show_tags')){
		function ew_show_tags() {
			$show_hidden_tag = ot_get_option('show_hidden_tag');
			if($show_hidden_tag == 'on') :
			    $post_tags = get_the_tags();
			    $separator = ', ';
			    if (!empty($post_tags)) {
			    	echo '<i class="fa fa-tags"></i>&nbsp;';
			        foreach ($post_tags as $tag) {
			            $output .= '<a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>' . $separator;
			        }
			        return trim($output, $separator);
			    }
		    endif;
		}
	}

/* ----------------------------------------------------------------------------------- */
/*  Function Comment Facebook
/*----------------------------------------------------------------------------------- */
	if(!function_exists('ew_comment_fb')){
		function ew_comment_fb() {
			$hidden_comment_fb = ot_get_option('hidden_comment_fb');
			if($hidden_comment_fb == 'on') :
			    $app_id = ot_get_option('app_id_facebook');
			    if (!empty($app_id)) { ?>
			        <div id="fb-root"></div>
			        <script>(function(d, s, id) {
			            var js, fjs = d.getElementsByTagName(s)[0];
			            if (d.getElementById(id)) return;
			            js = d.createElement(s); js.id = id;
			            js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.3&appId=<?php echo $app_id; ?>";
			            fjs.parentNode.insertBefore(js, fjs);
			        }(document, 'script', 'facebook-jssdk'));</script>
			        <div class="box-comment">
			            <!-- <div class="share-send">
			                <div class="fb-btn fb-send" data-href="<?php the_permalink(); ?>"></div>
			                <div class="fb-btn fb-like" data-href="<?php the_permalink(); ?>" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
			            </div> -->
			            <div class="fb-comments" data-href="<?php the_permalink(); ?>" data-width="100%" data-numposts="5" data-colorscheme="light"></div>
			        </div>
			        <?php
			    }
		    endif;
		}
	}

/*-----------------------------------------------------------------------------------*/
/*  Retrieves the attachment ID from the file URL
/*-----------------------------------------------------------------------------------*/
	function ew_get_image_id($image_url) {
		global $wpdb;
		$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url )); 
	        return $attachment[0]; 
	}

/* ----------------------------------------------------------------------------------- */
/*  Get background Option Tree
/*----------------------------------------------------------------------------------- */
	if(!function_exists('ew_bgColor_ot')){
		function ew_bgColor_ot( $wpm_options, $wpm_class, $identifier){ 
		    $wpm_options = ot_get_option( $wpm_options, array() );  
		    if($wpm_options['background-color'] | $wpm_options['background-repeat'] | $wpm_options['background-attachment'] | $wpm_options['background-position'] | $wpm_options['background-image'] ){ echo 
		        $identifier.$wpm_class . "
		        background-color: ".$wpm_options['background-color']."; 
		        background-repeat:".$wpm_options['background-repeat']."; 
		        background-attachment:".$wpm_options['background-attachment']."; 
		        background-position:".$wpm_options['background-position']."; 
		        background-image:url(".$wpm_options['background-image'].") ; 
		        background-size:".$wpm_options['background-size']."; 
		         ";   
		    } 
		}
	}
	if(!function_exists('ew_bgColor_meta')){
		function ew_bgColor_meta( $wpm_options, $wpm_class, $identifier, $post_id){
			if(!empty($post_id)){
				$post_id = $post_id;
			} else{
				global $post;
				$post_id = $post->ID;
			}
			
		    $wpm_options = get_post_meta($post_id ,$wpm_options, true );  
		    if($wpm_options['background-color'] | $wpm_options['background-repeat'] | $wpm_options['background-attachment'] | $wpm_options['background-position'] | $wpm_options['background-image'] ){ echo 
		        $identifier.$wpm_class . "
		        background-color: ".$wpm_options['background-color']."; 
		        background-repeat:".$wpm_options['background-repeat']."; 
		        background-attachment:".$wpm_options['background-attachment']."; 
		        background-position:".$wpm_options['background-position']."; 
		        background-image:url(".$wpm_options['background-image'].") ; 
		        background-size:".$wpm_options['background-size']."; 
		         ";   
		    } 
		}
	}

/*-----------------------------------------------------------------------------------*/
/*  Get label of an option in Option Tree / Theme Options
/*-----------------------------------------------------------------------------------*/
	// if ( ! function_exists( 'ew_get_setting_label_by_id' ) ){
	// 	function ew_get_setting_label_by_id( $id ) {
	// 		if ( empty( $id ) )
	// 			return false;
	// 		$settings = get_option( 'option_tree_settings' );
	// 		if ( empty( $settings['settings'] ) )
	// 			return false;
	// 		foreach( $settings['settings'] as $setting ) {
	// 			if ( $setting['id'] == $id && isset( $setting['label'] ) ) {
	// 				return $setting['label'];
	// 			}
	// 		}
	// 	}
	// }

/* ----------------------------------------------------------------------------------- */
/*  Get total items in a sidebar
/*----------------------------------------------------------------------------------- */
	// function getTotalItemsInSidebar($sidebar_id){
	// 	$the_sidebars = wp_get_sidebars_widgets();
	//     if( !isset( $the_sidebars[$sidebar_id] ) )
	//         return __( 'Invalid sidebar ID' );
	//     else
	//         return count( $the_sidebars[$sidebar_id] );
	// }

/*-----------------------------------------------------------------------------------*/
/*  Truncate title
/*-----------------------------------------------------------------------------------*/
	if ( ! function_exists( 'ew_truncate_title' ) ){
		function ew_truncate_title($amount,$echo='',$post_id='') {
			if(!empty($post_id)){
				$content_post = get_post($post_id);
				$truncate = $content_post->post_title;
			}else{
				global $post;
				$truncate = $post->post_title;
			}

			$truncate = preg_replace('@\[caption[^\]]*?\].*?\[\/caption]@si', '', $truncate);

			if(!empty($amount))
				$amount = $amount;
			else
				$amount = 30;

			if ( strlen($truncate) <= $amount )
				$echo_out = '';
			else
				$echo_out = '...';

			$truncate = apply_filters('the_title', $truncate);
			$truncate = preg_replace('@<script[^>]*?>.*?</script>@si', '', $truncate);
			$truncate = preg_replace('@<style[^>]*?>.*?</style>@si', '', $truncate);

			$truncate = strip_tags($truncate);

			if ($echo_out == '...')
				$truncate = mb_substr($truncate, 0, strrpos(mb_substr($truncate, 0, $amount), ' '));
			else
				$truncate = mb_substr($truncate, 0, $amount);

			if (!empty($echo))
				return $truncate . $echo;
			else
				return $truncate . $echo_out;
		}
	}

/*-----------------------------------------------------------------------------------*/
/*  Truncate description
/*-----------------------------------------------------------------------------------*/
	if ( ! function_exists( 'ew_truncate_description' ) ){
		function ew_truncate_description($amount,$echo='',$post_id='') {
			if(!empty($post_id)){
				$content_post = get_post($post_id);
				$truncate = $content_post->post_content;
			}else{
				global $post;
				$truncate = $post->post_content;
			}
			$truncate = preg_replace('@\[caption[^\]]*?\].*?\[\/caption]@si', '', $truncate);

			if(!empty($amount))
				$amount = $amount;
			else
				$amount = 100;

			if ( strlen($truncate) <= $amount )
				$echo_out = '';
			else
				$echo_out = '...';

			$truncate = apply_filters('the_content', $truncate);
			$truncate = preg_replace('@<script[^>]*?>.*?</script>@si', '', $truncate);
			$truncate = preg_replace('@<style[^>]*?>.*?</style>@si', '', $truncate);

			$truncate = strip_tags($truncate);

			if ($echo_out == '...')
				$truncate = mb_substr($truncate, 0, strrpos(mb_substr($truncate, 0, $amount), ' '));
			else
				$truncate = mb_substr($truncate, 0, $amount);

			if (!empty($echo))
				return $truncate . $echo;
			else
				return $truncate . $echo_out;
		}
	}

/*-----------------------------------------------------------------------------------*/
/*  short_title
/*-----------------------------------------------------------------------------------*/
if(!function_exists('short_title')){
    function short_title($after = '', $length) {
        $qdztitle = explode(' ', get_the_title(), $length);
        if (count($qdztitle)>=$length) {
            array_pop($qdztitle);
            $qdztitle = implode(" ",$qdztitle). $after;
        } else {
            $qdztitle = implode(" ",$qdztitle);
        }
        return $qdztitle;
    }
}

/*-----------------------------------------------------------------------------------*/
/*  Short excerpt
/*-----------------------------------------------------------------------------------*/
function short_excerpt($limit) {
      $excerpt = explode(' ', get_the_excerpt(), $limit);

      if (count($excerpt) >= $limit) {
          array_pop($excerpt);
          $excerpt = implode(" ", $excerpt) . ' ...';
      } else {
          $excerpt = implode(" ", $excerpt);
      }

      $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);

      return $excerpt;
}

/*-----------------------------------------------------------------------------------*/
/*  Short content
/*-----------------------------------------------------------------------------------*/
function short_content($limit) {
    $content = explode(' ', get_the_content(), $limit);

    if (count($content) >= $limit) {
        array_pop($content);
        $content = implode(" ", $content) . ' ...';
    } else {
        $content = implode(" ", $content);
    }

    $content = preg_replace('/\[.+\]/','', $content);
    $content = apply_filters('the_content', $content); 
    $content = str_replace(']]>', ']]&gt;', $content);

    return $content;
}
/*-----------------------------------------------------------------------------------*/
/*  Sub string unicode
/*-----------------------------------------------------------------------------------*/
	// function cstr($text, $start=0, $limit=12) {
 //        if (function_exists('mb_substr')) {
 //            $more = (mb_strlen($text) > $limit) ? TRUE : FALSE;
 //            $text = mb_substr($text, 0, $limit, 'UTF-8');
 //            return array($text, $more);
 //        } elseif (function_exists('iconv_substr')) {
 //            $more = (iconv_strlen($text) > $limit) ? TRUE : FALSE;
 //            $text = iconv_substr($text, 0, $limit, 'UTF-8');
 //            return array($text, $more);
 //        } else {
 //              preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/",  $text, $ar);
 //            if(func_num_args() >= 3) {
 //                if (count($ar[0])>$limit) {
 //                    $more = TRUE;
 //                    $text = join("",array_slice($ar[0],0,$limit))."...";
 //                }
 //                $more = TRUE;
 //                $text = join("",array_slice($ar[0],0,$limit));
 //            } else {
 //                $more = FALSE;
 //                $text =  join("",array_slice($ar[0],0));
 //            }
 //            return array($text, $more);
 //        }
	// }
	// function sub_str($text, $limit=25) {
	// 	$text = strip_tags($text);
	//     $val = cstr($text, 0, $limit);
	//     return $val[1] ? $val[0]."..." : $val[0];
	// }

/* ----------------------------------------------------------------------------------- */
/*  Enable title widget run Shortcode
/*  Create shortcode assign title widget
/*----------------------------------------------------------------------------------- */
	add_shortcode('fa', 'ew_shortcode_fa');
	if ( ! function_exists( 'ew_shortcode_fa' ) ){
		function ew_shortcode_fa($attr, $content) {
		    return '<i class="fa fa-' . $content . '"></i>';
		}
	}

/* ----------------------------------------------------------------------------------- */
/*  Add column IMAGE to page manager post
/*----------------------------------------------------------------------------------- */
    // Get thumb image by post ID insert to wp-admin
    if (!function_exists('ew_get_featured_image')) {
        function ew_get_featured_image($post_ID) {
            $post_thumbnail_id = get_post_thumbnail_id($post_ID);
            if ($post_thumbnail_id) {
                $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, '', true);
                return $post_thumbnail_img[0];
            }
        }
    }
    // Add new column in wp-admin
    if (!function_exists('ew_columns_head')) {
        function ew_columns_head($defaults) {
            $defaults['featured_image'] = 'Featured Image';
            return $defaults;
        }
    }
    // Show the featured image
    if (!function_exists('ew_columns_content')) {
        function ew_columns_content($column_name, $post_ID) {
            if ($column_name == 'featured_image') {
                $post_featured_image = ew_get_featured_image($post_ID);
                if ($post_featured_image) {
                    // HAS A FEATURED IMAGE
                    echo '<img style="width:50px;height:auto" src="' . $post_featured_image . '" />';
                } else {
                    // NO FEATURED IMAGE, SHOW THE DEFAULT ONE
                    echo '<img style="width:50px;height:auto" src="' . get_bloginfo('template_url') . '/framework/images/featured-default.png" />';
                }
            }
        }
    }
    add_filter('manage_posts_columns', 'ew_columns_head');
    add_action('manage_posts_custom_column', 'ew_columns_content', 10, 2);

/*-----------------------------------------------------------------------------------*/
/*  Browser detection body_class() output
/*-----------------------------------------------------------------------------------*/
	add_filter( 'body_class', 'ew_browser_body_class' );
	if ( ! function_exists( 'ew_browser_body_class' ) ){
		function ew_browser_body_class( $classes ) {
		    global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

		    if($is_lynx) $classes[] = 'lynx';
		    elseif($is_gecko) $classes[] = 'gecko';
		    elseif($is_opera) $classes[] = 'opera';
		    elseif($is_NS4) $classes[] = 'ns4';
		    elseif($is_safari) $classes[] = 'safari';
		    elseif($is_chrome) $classes[] = 'chrome';
		    elseif($is_IE) {
		        $browser = $_SERVER['HTTP_USER_AGENT'];
		        $browser = substr( "$browser", 25, 8);
		        if ($browser == "MSIE 7.0"  ) {
		            $classes[] = 'ie7';
		            $classes[] = 'ie';
		        } elseif ($browser == "MSIE 6.0" ) {
		            $classes[] = 'ie6';
		            $classes[] = 'ie';
		        } elseif ($browser == "MSIE 8.0" ) {
		            $classes[] = 'ie8';
		            $classes[] = 'ie';
		        } elseif ($browser == "MSIE 9.0" ) {
		            $classes[] = 'ie9';
		            $classes[] = 'ie';
		        } else {
		            $classes[] = 'ie';
		        }
		    }
		    else $classes[] = 'unknown';

		    if( $is_iphone ) $classes[] = 'iphone';

		    return $classes;
		}
	}

/*-----------------------------------------------------------------------------------*/
/*  Add button to wp admin bar
/*-----------------------------------------------------------------------------------*/
    if(!function_exists('ew_add_button_to_wpadminbar')){
        function ew_add_button_to_wpadminbar(){
            global $wp_admin_bar;
            $wp_admin_bar->add_menu( array(
                'id' => 'Google Analytics',
                'title' => __('Google Analytics'),
                'href' => 'https://www.google.com/analytics/'
            ));
            $wp_admin_bar->add_menu( array(
                'id' => 'Webmaster Tool',
                'title' => __('Webmaster Tool'),
                'href' => 'https://www.google.com/webmasters/'
            ));
        }
        add_action( 'wp_before_admin_bar_render', 'ew_add_button_to_wpadminbar' );
    }

/*-----------------------------------------------------------------------------------*/
/*  Display navigation to next/previous post when applicable.
/*-----------------------------------------------------------------------------------*/
	/*if ( ! function_exists( 'ew_post_nav' ) ) :
		function ew_post_nav() {
			// Don't print empty markup if there's nowhere to navigate.
			$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
			$next     = get_adjacent_post( false, '', false );

			if ( ! $next && ! $previous ) {
				return;
			}
			?>
			<div class="simple-navigation">
				<?php if( get_previous_post(true)!='' or get_next_post(true)!='' ): ?>
					<div class="row">
						<?php if( get_previous_post(true) ): ?>
							<?php if(get_next_post(true)!=''){ ?>
							<div class="col-md-6 col-sm-6 col-xs-6 simple-navigation-item pull-left">
							<?php }else{ ?>
							<div class="col-md-6 col-sm-6 col-xs-6 simple-navigation-item pull-left">
							<?php } ?>
								<i class="fa fa-angle-left pull-left"></i>
								<div class="simple-navigation-item-content">
									<?php previous_post_link('%link','Bài cũ hơn',true); ?>
									<h5><?php previous_post_link('%link','%title',true); ?></h5>
								</div>
							</div><!--End-col-->
						<?php endif; ?>
						<?php if( get_next_post(true)): ?>
							<div class="col-md-6 col-sm-6 col-xs-6 simple-navigation-item pull-right">
								<i class="fa fa-angle-right pull-right"></i>
								<div class="simple-navigation-item-content">
									<?php next_post_link('%link','Bài mới hơn',true); ?>
									<h5><?php next_post_link('%link','%title',true); ?></h5>
								</div>
							</div><!--End-col-->
						<?php endif; ?>
					</div><!--End-row-->
				<?php endif; ?>
			</div><!--End-simple-navigation-->
			<?php
		}
	endif;*/

/*-----------------------------------------------------------------------------------*/
/*  Display navigation to next/previous post_type when applicable.
/*-----------------------------------------------------------------------------------*/
	/*if(!function_exists('ew_post_nav_post_type')) :
		function ew_post_nav_post_type(){
			global $post;
			// get_posts in same custom taxonomy
			$postlist_args = array(
			   'posts_per_page'  => -1,
			   'orderby'         => 'menu_order title',
			   'order'           => 'ASC',
			   'post_type'       => 'news',
			   'your_custom_taxonomy' => 'categories'
			);
			$postlist = get_posts( $postlist_args );

			// get ids of posts retrieved from get_posts
			$ids = array();
			foreach ($postlist as $thepost) {
			   $ids[] = $thepost->ID;
			}

			// get and echo previous and next post in the same taxonomy
			$thisindex = array_search($post->ID, $ids);
			$previd = $ids[$thisindex-1];
			$nextid = $ids[$thisindex+1];
			if ( !empty($previd) ) {?>
				<span class="nav-previous">
					<a href="<?php echo get_permalink($previd);?>" rel="prev">
						<span class="meta-nav">
							<i class="glyphicon glyphicon-chevron-left"></i>
						</span>
						<?php echo get_the_title($previd); ?>
					</a>
				</span>
			<?php }
			if ( !empty($nextid) ) {?>
				<span class="nav-next">
					<a href="<?php echo get_permalink($nextid);?>" rel="next">
						<?php echo get_the_title($nextid); ?>
						<span class="meta-nav">
							<i class="glyphicon glyphicon-chevron-right"></i>
						</span>
					</a>
				</span>
			<?php }
		}
	endif;*/

/*-----------------------------------------------------------------------------------*/
/*  Get post view
/*-----------------------------------------------------------------------------------*/
	if ( ! function_exists( 'ew_getPostViews' ) ){
		function ew_getPostViews($postID){ // hàm này dùng để lấy số người đã xem qua bài viết
		    $count_key = 'post_views_count';
		    $count = get_post_meta($postID, $count_key, true);
		    if($count==''){ // Nếu như lượt xem không có
		        delete_post_meta($postID, $count_key);
		        add_post_meta($postID, $count_key, '0');
		        return "0"; // giá trị trả về bằng 0
		    }
		    return $count; // Trả về giá trị lượt xem
		}
	}

/*-----------------------------------------------------------------------------------*/
/*  Set post view
/*-----------------------------------------------------------------------------------*/
	if ( ! function_exists( 'ew_setPostViews' ) ){
		function ew_setPostViews($postID) {// hàm này dùng để set và update số lượt người xem bài viết.
		    $count_key = 'post_views_count';
		    $count = get_post_meta($postID, $count_key, true);
		    if($count==''){
		        $count = 0;
		        delete_post_meta($postID, $count_key);
		        add_post_meta($postID, $count_key, '0');
		    }else{
		        $count++; // cộng dồn view
		        update_post_meta($postID, $count_key, $count); // update count
		    }
		}
	}
