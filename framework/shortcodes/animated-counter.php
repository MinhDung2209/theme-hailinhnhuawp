<?php
/* ------------------ */
/* cactus_animated_count*/
/* ------------------ */
function animated_count($atts,$content='')
{
	global $theme_redux_options;
	extract(shortcode_atts(array(
		'value' => '',
		'title' => '',
		'num_color' => '',
		'text_color' => '',
	),$atts));
	
	if(empty($atts['value'])) $atts['value'] = 1.784;	
	if($atts['value']<0) $atts['value'] = 1.784;	
	if(empty($atts['num_color'])) $atts['num_color'] = '#69c4a3';	
	if(empty($atts['text_color'])) $atts['text_color'] = '#69c4a3';			
	if(empty($content)) $content = 'Content Text';	
	
	wp_enqueue_script('waypoints.min.js', ''.get_template_directory_uri().'/shortcodes/includes/js/waypoints.min.js', array('jquery'),'2.0.3',false);
	wp_enqueue_script('jquery.counterup.min.js', ''.get_template_directory_uri().'/shortcodes/includes/js/jquery.counterup.min.js', array('jquery'),'1.0',false);
	$num_id = rand();
	$html = '
	<style>	
	.column-'.$num_id.'{text-align: center}
	.column-'.$num_id.' h3{font-size:86.81px;color:'.$atts['num_color'].';margin:0;font-family:Montserrat}
	.column-'.$num_id.' span{font-size:20.83px;color:'.$atts['text_color'].';font-family:Montserrat}	
	.column-'.$num_id.' p{color:'.$atts['text_color'].';font-family: "Open Sans", sans-serif;font-size: 12.85px;}
	</style>
	<script>
		jQuery(document).ready(function( $ ) {
			$(".counter-'.$num_id.'").counterUp({
				delay: 10,
				time: 1000
			});
		});
	</script>
	<div class="column-'.$num_id.'">
		<h3 class="counter-'.$num_id.'">'.number_format($atts['value'], 0, ",", ",").'</h3>
		<span>'.$atts['title'].'</span>
		<p>'.$content.'</p>
	</div>	
	';
	
	return $html;
}
add_shortcode('counter','animated_count');

add_action( 'after_setup_theme', 'reg_vs_counter' );
function reg_vs_counter(){
	if(function_exists('wpb_map')){
		wpb_map( 
			array(
			   "name" => __("Animated Counter"),
			   "base" => "counter",
			   "class" => "",
			   "controls" => "full",
			   "category" => __('Content'),
			   "params" => array(
					array(
						"type" => "textfield",
						"heading" => __("Value Number", "cactusthemes"),
						"param_name" => "value",
						"value" => "",
						"description" => __("Not input character."),
					),
					array(
						"type" => "textfield",
						"heading" => __("Title", "cactusthemes"),
						"param_name" => "title",
						"value" => "",
						"description" => __("Title Counter"),
					),					
					array(
						"type" => "colorpicker",
						"holder" => "div",
						"class" => "",
						"heading" => __("Number Color", 'cactusthemes'),
						"param_name" => "num_color",
						"value" => '',
						"description" => 'Choose Number Color (Optional)',
					),
					array(
						"type" => "colorpicker",
						"holder" => "div",
						"class" => "",
						"heading" => __("Text color", 'cactusthemes'),
						"param_name" => "text_color",
						"value" => '',
						"description" => 'Choose Text color (Optional)',
					),
					array(
						"type" => "textarea",
						"heading" => __("Content text", "cactusthemes"),
						"param_name" => "content",
						"value" => "",
						"description" => __("Content Counter"),
					),														  
				)
			)
		);
	}
}

?>