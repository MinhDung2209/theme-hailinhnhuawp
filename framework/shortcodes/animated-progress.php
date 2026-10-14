<?php
/* ------------------ */
/* cactus_animated_progress*/
/* ------------------ */
function animated_progress($atts,$content='')
{
	global $theme_redux_options;
	extract(shortcode_atts(array(
		'value' => '75',
		'full_color' => '',
		'part_color' => '',
		'text_color' => '',
	),$atts));
	
	if(empty($atts['value'])) $atts['value'] = 1;	
	if($atts['value']>100 or $atts['value']<0) $atts['value'] = 80;
	if(empty($atts['full_color'])) $atts['full_color'] = '#fff';	
	if(empty($atts['part_color'])) $atts['part_color'] = '#69c4a5';	
	if(empty($atts['text_color'])) $atts['text_color'] = '#fff';	
	if(empty($content)) $content = 'Content Text';		
	$num_id = rand();
	$html = '
	<style>
	#progress_bar_'.$num_id.'{width: 100%;clear: both;padding-bottom:46px;}
	#progress_bar_'.$num_id.' .bg-profress{height:24px;background:'.$atts['full_color'].';margin-bottom:9px}
	#progress_bar_'.$num_id.' .ui-progress {height: 24px;background-color: '.$atts['part_color'].'}
	#progress_bar_'.$num_id.' .title-progress,
	#progress_bar_'.$num_id.' .value-progress_'.$num_id.'{float:left;line-height: 12.85px;font-size:12.85px;font-family:Montserrat!important;color:'.$atts['text_color'].';text-transform: uppercase}
	#progress_bar_'.$num_id.' .value-progress_'.$num_id.'{float:right;font-weight:400}
	#progress_bar_'.$num_id.' .title-value-progress{float:left;width: 100%}
	</style>
	<div id="progress_bar_'.$num_id.'">
		<div class="bg-profress">
			<div class="ui-progress"></div>
		</div>		
		<div class="title-value-progress">
			<span class="title-progress">'.$content.'</span>
			<b class="value-progress_'.$num_id.'"></b>
		</div>		
    </div>	
	<script type="text/javascript">
		(function( $ ){  
			jQuery.fn.animateProgress = function(progress, callback) {    
				return this.each(function() {
					jQuery(this).animate({
						width: progress+"%"
					},{
						duration: 2000,                 
						easing: "swing",
						// this gets called every step of the animation, and updates the label
						step: function( progress ){			          
							//if (Math.ceil(progress) == 100) {
								//$("#progress_bar_'.$num_id.' .value-progress_'.$num_id.'").text("Completed");						
							//}else{						
								$("#progress_bar_'.$num_id.' .value-progress_'.$num_id.'").text(Math.ceil(progress) + "%");
							//}
						},
						complete: function(scope, i, elem) {
							if (callback) {
							callback.call(this, i, elem );
							};
						}
					});
				});
			};
			// Set initial value
			$("#progress_bar_'.$num_id.' .ui-progress").css("width", "0");
			// Simulate some progress
			$("#progress_bar_'.$num_id.' .ui-progress").animateProgress('.$atts['value'].', function() {});
		})( jQuery );
		
	</script>
	';
	
	return $html;
}
add_shortcode('progress','animated_progress');

add_action( 'after_setup_theme', 'reg_vs_progress' );
function reg_vs_progress(){
	if(function_exists('wpb_map')){
		wpb_map(			
			array(
			   "name" => __("Animated Progress"),
			   "base" => "progress",
			   "class" => "",
			   "controls" => "full",
			   "category" => __('Content'),
			   "params" => array(
					array(
						"type" => "textfield",
						"heading" => __("Value Number", "cactusthemes"),
						"param_name" => "value",
						"value" => "75",
						"description" => __("Number 1-100 (percentage)."),
					),
					array(
						"type" => "colorpicker",
						"holder" => "div",
						"class" => "",
						"heading" => __("Color of full bar", 'cactusthemes'),
						"param_name" => "full_color",
						"value" => '#fff',
						"description" => 'Choose Color(Optional)',
					),
					array(
						"type" => "colorpicker",
						"holder" => "div",
						"class" => "",
						"heading" => __("Color of the percentage part", 'cactusthemes'),
						"param_name" => "part_color",
						"value" => '#c2c2c2',
						"description" => 'Choose Color (Optional)',
					),
					array(
						"type" => "colorpicker",
						"holder" => "div",
						"class" => "",
						"heading" => __("Color of text", 'cactusthemes'),
						"param_name" => "text_color",
						"value" => '#c2c2c2',
						"description" => 'Choose Color (Optional)',
					),																														
					array(
						"type" => "textfield",
						"heading" => __("Content text", "cactusthemes"),
						"param_name" => "content",
						"value" => "",
						"description" => __("Content Animated Progress"),
					),														  
				)
			)
		);
	}
}
?>