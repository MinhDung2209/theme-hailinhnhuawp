<?php
/* ------------------ */
/* cactus_divider*/
/* ------------------ */
function divider($atts,$content=NULL)
{
	wp_enqueue_style('divider.css', ''.get_template_directory_uri().'/shortcodes/includes/css/divider.css');
	global $theme_redux_options;
	extract(shortcode_atts(array(
		'align' => 'center',
		'icon' => '',
		'color' => '',
		'text' => ''
	),$atts));

	if(empty($color)) $color = $theme_redux_options['theme-default-color'];
	if(!empty($icon)) $icon = "<i class='fa ".trim(strtolower($icon))."'></i>";
	
	switch($align)
	{
		case 'left':
			$styleBoxText = "text-align: left;";
		break;
		case 'right':
			$styleBoxText = "text-align: right;";
		break;
		case 'center':
			$styleBoxText = "text-align: center;";
		break;
	}
	$id = rand(1,100);
	
	$html = "
	<style type='text/css'>
		#divider-".$id." .sc_divider{
			".$styleBoxText."
		}
		#divider-".$id." .sc_divider_text{
			border:3px solid ".$color.";
		}
		#divider-".$id." .sc_divider_text h6{
			color: ".$color.";
		}
		#divider-".$id." .sc_divider span{
			border-bottom: solid 3px ".$color.";
		}
	</style>
	";
	
	$html .= '
		<div class="clearfix"></div>
		<div id="divider-'.$id.'">
			<div class="sc_divider clearfix">
					<div class="sc_divider_text">';
	
	if($text!='' or $icon!='')
		$html .= '<h6>'.$icon.' '.$text.'</h6>';	
	$html .= '					
					</div><!--End-sc_divider_text-->
					<span></span>
			</div>
		</div>
	';
	
	return $html;
}
add_shortcode('divider','divider');

add_action( 'after_setup_theme', 'reg_vs_divider' );
function reg_vs_divider(){
	if(function_exists('wpb_map')){
		wpb_map( 			
			array(
			   "name" => __("Divider"),
			   "base" => "divider",
			   "class" => "",
			   "controls" => "full",
			   "category" => __('Content'),
			   "params" => array(					
					array(
						"type" => "dropdown",
						"heading" => __("Align", 'cactusthemes'),
						"param_name" => "align",
						"value" => array(
							__('Center', 'cactusthemes') => 'center',
							__('Right', 'cactusthemes') => 'right',
							__('Left', 'cactusthemes') => 'left',
						),
						"description" => 'Align for divider'
					),
					array(
						"type" => "textfield",
						"heading" => __("Icon", 'cactusthemes'),
						"param_name" => "icon",
						"value" => 'fa-',
						"description" => 'Name of font-awesome icon ',
					),
					array(
						"type" => "colorpicker",
						"heading" => __("Color", 'cactusthemes'),
						"param_name" => "color",
						"value" => '',
						"description" => 'Color for icon and text',
					),					
					array(
						"type" => "textfield",
						"heading" => __("Text", "cactusthemes"),
						"param_name" => "text",
						"value" => "",
						"description" => __("Text"),
					),																															 
				)
			)
		);
	}
}
?>