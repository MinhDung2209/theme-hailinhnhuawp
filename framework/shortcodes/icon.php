<?php
/* ------------------ */
/* cactus_icon */
/* ------------------ */
function icon($atts,$content=NULL)
{
	wp_enqueue_style('icon.css', ''.get_template_directory_uri().'/shortcodes/includes/css/icon.css');
	global $theme_redux_options;
	extract(shortcode_atts(array(
		'name' => 'search',
		'type' => 'squared',
		'color' => '',
		'hover_color' => ''
	),$atts));
	if(empty($name) or $name == '') 
		$name = 'fa fa-search';
	elseif(!empty($name) or $name != '')
		$name = 'fa fa-'.trim(strtolower($name)); 
		
	$id = rand(1,100);
	
	if($type!='' or $color!='' or $hover_color!='')
	{
		$html = "<style type='text/css'>";
		
		if($color!='')
		{
			$html .= "
				#icon-".$id." a {
				color: ".$color.";
				border-color:".$color.";
			}
			";
		}
		
		if($hover_color!='')
		{
			$html .= "
				#icon-".$id." a:hover {
				background-color:".$hover_color.";
				border-color:".$hover_color.";";
			
			if($color!='')
				$html .= "color:#fff";
			
			$html .= "}
			";
		}
		
		$html .= "</style>";
	} 
	 
	$html .= "<div id='icon-".$id."' class='hi-icon-wrap hi-icon-effect hi-icon-effect-1'>";
	
	if($type=='rounded')
		$html .= "<a href='javascript:void(0)' class='hi-icon hi-icon-ship hi-icon-rounded'>";
	else
		$html .= "<a href='javascript:void(0)' class='hi-icon hi-icon-ship'>";
	
	$html .= "
				<i class='".$name."'></i>
			</a>
		</div>
	";
	
	return $html;
}
add_shortcode( 'icon', 'icon' );

add_action( 'after_setup_theme', 'reg_icon' );
function reg_icon(){
	if(function_exists('wpb_map')){
	wpb_map( array(
	   "name" => __("Icon"),
	   "base" => "icon",
	   "class" => "",
	   "controls" => "full",
	   "category" => __('Content'),
	   "params" => array(
	      array(
			"type" => "textfield",
			"heading" => __("Name", "cactusthemes"),
			"param_name" => "name",
			"value" => "",
			"description" => __("FontAwesome 4.0+ icon name. For example: star."),
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Type", 'cactusthemes'),
			 "param_name" => "type",
			 "value" => array(
			 	__('Squared', 'cactusthemes') => 'squared',
				__('Rounded', 'cactusthemes') => 'rounded',
			 ),
			 "description" => 'Set the icon is squared or rounded.'
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Icon Color", 'cactusthemes'),
			 "param_name" => "color",
			 "value" => '',
			 "description" => 'Choose Icon Color (Optional)',
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Icon Hover Color", 'cactusthemes'),
			 "param_name" => "hover_color",
			 "value" => '',
			 "description" => 'Color of the icon when user hover mouse on it.',
		  ),
	   )
	));
	}
}
?>