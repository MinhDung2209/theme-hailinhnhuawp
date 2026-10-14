<?php
/* ------------------ */
/* cactus_banner */
/* ------------------ */
function banner($atts,$content='')
{
	wp_enqueue_style('banner.css', ''.get_template_directory_uri().'/shortcodes/includes/css/banner.css');
	global $shortcodes;
	global $theme_redux_options;
	extract(shortcode_atts(array(
		'heading' => '',
		'heading_hover' => '',
		'hover_overlay_color' => '',
		'img' => '',
		'link' => '',
	),$atts));
	
	foreach($shortcodes as $shortcode)
	{
		if(has_shortcode($content,$shortcode))
		{
			do_shortcode($content);
		}
	}
	
	if($hover_overlay_color == '') $hover_overlay_color = $theme_redux_options['theme-default-color'];
	if($img=='') 
		$img[0] = TEMPLATE_URL.'/images/img_overlay1.gif';
	else
	{
		$img = wp_get_attachment_image_src(trim((int)$img),'medium');
	}
	
	$id = rand(1,100);
	
	$hover_overlay_color = hex2rgb($hover_overlay_color);
	
	$html = "
	<style type='text/css'>
		#banner-".$id.":hover .overlay-hover {
			background: rgba(".$hover_overlay_color[0].",".$hover_overlay_color[1].",".$hover_overlay_color[2].",0.7);
		}
	</style>
	";
	
	$html .= "
		<div id='banner-".$id."' class='sc-banner'>
            
				<div class='banner-inner'>
					<div class='heading-text'>
						<h4>$heading</h4>
                        ";
	
	if($content!=''){
		$html .= "<p class='divider'></p>
                 <p class='content'>$content</p>";
	}
	
	$html .= "
					</div>
				</div>
				
            	<img class='img-bg' src='".$img[0]."'>
                
                <a href='".trim($link)."'><span class='overlay-hover'></span></a><!-- end overlay-hover -->
                
				<a href='".trim($link)."'><div class='banner-inner hover'><h4 class='heading-text'>$heading_hover</h4></div></a>

		</div>		
			";
	
	return $html;
}
add_shortcode( 'banner', 'banner' );

add_action( 'after_setup_theme', 'reg_banner' );
function reg_banner(){
	if(function_exists('wpb_map')){
	wpb_map( array(
	   "name" => __("Interactive Banner"),
	   "base" => "banner",
	   "class" => "",
	   "controls" => "full",
	   "category" => __('Content'),
	   "params" => array(
		  array(
			"type" => "textfield",
			"heading" => __("Heading", "cactusthemes"),
			"param_name" => "heading",
			"value" => "",
			"description" => __("Big heading text"),
		  ),
		  array(
			"type" => "textfield",
			"heading" => __("Hover Heading", "cactusthemes"),
			"param_name" => "heading_hover",
			"value" => "",
			"description" => __("Big heading text when banner is hovered"),
		  ),
		   array(
			"type" => "textarea",
			"heading" => __("Content text", "cactusthemes"),
			"param_name" => "content",
			"value" => "",
			"description" => __("Big heading text when banner is hovered"),
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Hover Overlay Color", 'cactusthemes'),
			 "param_name" => "hover_overlay_color",
			 "value" => '',
			 "description" => 'Overlay color when banner is hovered',
		  ),
		  array(
				"type" => "attach_image",
				"heading" => __("Banner Image", "cactusthemes"),
				"param_name" => "img",
				"value" => "",
				"description" => __("Banner Image.")
			),
		  array(
			"type" => "textfield",
			"heading" => __("Link", "cactusthemes"),
			"param_name" => "link",
			"value" => "",
			"description" => __("URL of navigation link when banner is clicked"),
		  ),
	   )
	));
	}
}
?>