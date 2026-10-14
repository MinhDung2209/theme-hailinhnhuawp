<?php
/* ------------------ */
/* cactus_animated_percentage*/
/* ------------------ */
function animated_percentage($atts,$content='')
{
	global $theme_redux_options;
	extract(shortcode_atts(array(
		'value' => '',
		'full_color' => '',
		'part_color' => '',
		'text_color' => '',
		'num_color' => '',	
		'title' => '',			
	),$atts));
	
	if(empty($atts['value'])) $atts['value'] = 75;
	if($atts['value'] > 100 or $atts['value']<0) $atts['value'] = 75;
	if(empty($atts['full_color'])) $atts['full_color'] = '#fff';
	if(empty($atts['part_color'])) $atts['part_color'] = '#69c4a3';
	if(empty($atts['num_color'])) $atts['num_color'] = '#fff';
	if(empty($atts['title'])) $atts['title'] = 'Title';
	if(empty($content)) $content = 'Content Text';
		
	
	wp_enqueue_script('jquery.circliful.min.js', ''.get_template_directory_uri().'/shortcodes/includes/js/jquery.circliful.min.js', array('jquery'),'',false);
	wp_enqueue_style('jquery.circliful.css', ''.get_template_directory_uri().'/shortcodes/includes/css/jquery.circliful.css');
	

	$num_id = rand();
	
	$html = '
		<script>
			jQuery( document ).ready(function() {
			jQuery("#myStat'.$num_id.'").circliful();
			});
		</script>
		<style>
			#myStat'.$num_id.' .circle-text{color:'.$atts['num_color'].'}
			.process-bar-'.$num_id.'{
				float: left;
				width: 250px;text-align: center
			}
			.process-bar-'.$num_id.' span{		
				color: '.$atts['text_color'].';
				font-size:20.83px;
				font-family:Montserrat;
			}
			.process-bar-'.$num_id.' p{font-size:12.85px;color: '.$atts['text_color'].'}
		</style>
		<div class="process-bar-'.$num_id.'">
			<div id="myStat'.$num_id.'" data-dimension="250" data-text="'.$atts['value'].'%" data-info="" data-width="11" data-fontsize="62.5" data-percent="'.$atts['value'].'" data-fgcolor="'.$atts['part_color'].'" data-bgcolor="'.$atts['full_color'].'"></div>
			<span>'.$atts['title'].'</span>
			<p>'.$content.'</p>
		</div>
	';
	
	return $html;
}
add_shortcode('percentage','animated_percentage');

add_action( 'after_setup_theme', 'reg_vs_percentage' );
function reg_vs_percentage(){
	if(function_exists('wpb_map')){
		wpb_map( 			
			array(
			   "name" => __("Animated Percentage"),
			   "base" => "percentage",
			   "class" => "",
			   "controls" => "full",
			   "category" => __('Content'),
			   "params" => array(
					array(
						"type" => "colorpicker",
						"holder" => "div",
						"class" => "",
						"heading" => __("Background Color", 'cactusthemes'),
						"param_name" => "full_color",
						"value" => '',
						"description" => 'Background Color',
					),
					array(
						"type" => "colorpicker",
						"holder" => "div",
						"class" => "",
						"heading" => __("Percentage Color", 'cactusthemes'),
						"param_name" => "part_color",
						"value" => '',
						"description" => 'Percentage Color',
					),
					array(
						"type" => "colorpicker",
						"holder" => "div",
						"class" => "",
						"heading" => __("Number Color", 'cactusthemes'),
						"param_name" => "num_color",
						"value" => '',
						"description" => 'Number Color',
					),
					array(
						"type" => "colorpicker",
						"holder" => "div",
						"class" => "",
						"heading" => __("Text Color", 'cactusthemes'),
						"param_name" => "text_color",
						"value" => '',
						"description" => 'Text Color',
					),					
					array(
						"type" => "textfield",
						"heading" => __("Value Number", "cactusthemes"),
						"param_name" => "value",
						"value" => "",
						"description" => __("Not input character(Number: 0~>100)."),
					),																														
					array(
						"type" => "textfield",
						"heading" => __("Title", "cactusthemes"),
						"param_name" => "title",
						"value" => "",
						"description" => __("Title Percentage"),
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