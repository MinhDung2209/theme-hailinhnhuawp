<?php
/* ------------------ */
/* cactus_testimonials */
/* ------------------ */
function testimonials($atts,$content='')
{
	wp_enqueue_style('testimonials.css', ''.get_template_directory_uri().'/shortcodes/includes/css/testimonials.css');
	$id = rand(1,100);
	
	extract(shortcode_atts(array(
		'auto_play' => 1
	),$atts));
	
	$auto_play = convertStrToBool($auto_play);
	
	$content = do_shortcode($content);
	
	$html = '<div id="owl-main-'.$id.'" class="owl-test owl-carousel">';
	
	$html .= $content;
	
	$html .= '</div>';
	
	$html .= "
		<script type='text/javascript'>
			jQuery(document).ready(function() {
			jQuery('#owl-main-".$id ."').owlCarousel({";
	
	if($auto_play==true)		
		$html .= "autoPlay: 10000,";
	else
		$html .= "autoPlay: 1000000,";
		
	$html .= "
				items : 1,
				itemsCustom : [
				[0, 1],
				[450, 1],
				[600, 1],
				[700, 1],
				[1000, 1],
				[1200, 1],
				[1400, 1],
				[1600, 1]
			  ],
				responsive: true,
				responsiveRefreshRate : 200,
				responsiveBaseWidth: window,
			});
		
			});
		</script>
	";
	
	return $html;
}
add_shortcode('testimonials','testimonials');

function testimonial($atts,$content=''){
	
	extract(shortcode_atts(array(
		'name' => '',
		'position' => '',
		'img' => ''
	),$atts));
	
	if($img=='') 
		$img[0] = TEMPLATE_URL.'/images/img_overlay1.gif';
	else
	{
		$img = wp_get_attachment_image_src(trim((int)$img),'thumbnail');
	}
	
	$id = rand(1,100);
	
	$html = '
			<div id="testimonialitem-'.$id.'" class="item">
				<h5 class="text_sec2">'.$content.'</h5>
				<p class="ke"></p>
				<div class="author-test">
					<div class="crop-img"><img class="fade1" src="'.$img[0].'"></div>
				</div>
				<h4 class="name">'.$name.'</h4>
				<p class="if">'.$position.'</p>
			</div><!--End-item-->			                
	';
	
	return $html;
}
add_shortcode('testimonialitem','testimonial');

add_action( 'after_setup_theme', 'reg_testimonials' );
function reg_testimonials(){
	if(function_exists('wpb_map')){
		vc_map(array(
			"name" => __("Testimonials"),
		   "base" => "testimonials",
		   "as_parent" => array('only' => 'testimonialitem'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
			"content_element" => true,
			"show_settings_on_create" => false,
		   "params" => array(
		   		array(
				 "type" => "dropdown",
				 "holder" => "div",
				 "class" => "",
				 "heading" => __("Auto Play", 'cactusthemes'),
				 "param_name" => "auto_play",
				 "value" => array(
					__('True', 'cactusthemes') => '1',
					__('False', 'cactusthemes') => '0',
				 ),
				 "description" => 'Set auto play mode for the testimonials'
			  )
		   ),
		   "js_view" => 'VcColumnView'
		));
		
		vc_map(array(
			"name" => __("Testimonial item"),
		   "base" => "testimonialitem",
		   "content_element" => true,
		   "as_child" => array('only' => 'testimonials'),
		   "params" => array(
		   		array(
					"type" => "textfield",
					"heading" => __("Name", "cactusthemes"),
					"param_name" => "name",
					"value" => "",
					"description" => __("Full name of the person who spoke this quote."),
				  ),
				array(
					"type" => "textfield",
					"heading" => __("Position", "cactusthemes"),
					"param_name" => "position",
					"value" => "",
					"description" => __("Position of the person who spoke this quote."),
				  ),
				array(
					"type" => "textfield",
					"heading" => __("Content", "cactusthemes"),
					"param_name" => "content",
					"value" => "",
					"description" => __("The quote."),
				  ),
				array(
					"type" => "attach_image",
					"heading" => __("Photo", "cactusthemes"),
					"param_name" => "img",
					"value" => "",
					"description" => __("Photo of the person who spoke this quote.")
				),
		   )
		));
	}
}

class WPBakeryShortCode_testimonials extends WPBakeryShortCodesContainer{}
class WPBakeryShortCode_testimonialitem extends WPBakeryShortCode{}
?>