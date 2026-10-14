<?php
/* Register shortcode with Visual Composer */
add_action( 'after_setup_theme', 'reg_vs_kenburn' );
function reg_vs_kenburn(){
	if(function_exists('wpb_map')){	
		
		function show_custom_tax(){
			$cats = get_terms( 'kenburn_sliders_category', 'hide_empty=0' );
			//var_dump($cats);die;
			$cat_array = array();
			if($cats){
				foreach ($cats as $acat){
					$cat_array[$acat->name] = $acat->slug;
				}
			}
			//var_dump($cat_array);die;
			wpb_map( 
				array(
				   "name" => __("Kenburn Slider"),
				   "base" => "kenburn",
				   "class" => "",
				   "controls" => "full",
				   "category" => __('Content'),
				   "params" => array(
						array(
							"type" => "dropdown",
							"heading" => __("Select kenburn slider", "cactusthemes"),
							"param_name" => "slider",						
							"description" => __("Select kenburn slider."),
							"value" => $cat_array,
						),
						array(
							"type" => "textfield",
							"heading" => __("Set height for your kenburn slider", "cactusthemes"),
							"param_name" => "height_slider",						
							"description" => __("This must be numeric."),
							"value" => '650',
						),
						array(
							"type" => "textfield",
							"heading" => __("Zoom effect", "cactusthemes"),
							"param_name" => "zoom_effect",						
							"description" => __("This must be numeric.Do you need more/less zoom effect?"),
							"value" => '1.5',
						),
						array(
							"type" => "textfield",
							"heading" => __("Zoom effect speed", "cactusthemes"),
							"param_name" => "zoom_effect_speed",						
							"description" => __("This must be numeric.Do you need faster/slower zoom effect?(determined by seconds)?"),
							"value" => '5',
						),
						array(
							"type" => "textfield",
							"heading" => __("Kenburn slider delay", "cactusthemes"),
							"param_name" => "delay",						
							"description" => __("This must be numeric.Set delay time for slider(determined by seconds)"),
							"value" => '6000',
						),
						array(
							"type" => "dropdown",
							"heading" => __("Show/Hide Icons", "cactusthemes"),
							"param_name" => "switch_icon",						
							"description" => __(""),
							"value" => array(
								__('True', 'cactusthemes') => '1',
								__('False', 'cactusthemes') => '0',								
							),
						),
						array(
							"type" => "dropdown",
							"heading" => __("Kenburn slider effect select", "cactusthemes"),
							"param_name" => "switch_effect",						
							"description" => __("Select effect when switch slider"),
							"value" => array(
								__('Fading effect', 'cactusthemes') => 'fade',
								__('Carousel effect', 'cactusthemes') => 'carousel',								
							),
						),
						array(
							"type" => "dropdown",
							"heading" => __("Turn On/Turn Off Responsive mode", "cactusthemes"),
							"param_name" => "switch_responsive",						
							"description" => __(""),
							"value" => array(
								__('On', 'cactusthemes') => '1',
								__('Off', 'cactusthemes') => '0',								
							),
						),
						array(
							"type" => "textfield",
							"heading" => __("Kenburn slider min width", "cactusthemes"),
							"param_name" => "min_width_slider",						
							"description" => __("This must be numeric."),
							"value" => '650',
						),
					)
				)
			);
		}
		add_action('init','show_custom_tax');
		
	}
}
?>