<?php
/* ------------------ */
/* cactus_messagebox */
/* ------------------ */
function message($atts,$content='')
{
	wp_enqueue_style('messagebox.css', ''.get_template_directory_uri().'/shortcodes/includes/css/messagebox.css');
	extract(shortcode_atts(array(
		'icon' => '',
		'color' => '',
		'border' => false
	),$atts));

	$id = rand(1,100);

	if($icon!='')
	{
		$icon = "fa fa-".trim(strtolower($icon));
		$content = "<i class='".$icon."'></i> ".trim($content);
	}
	$border = convertStrToBool($border);
	if($color!='')
	{
		$html = "<style type='text/css'>
			#messagebox-".$id." {
		";

		if($color!='' and $border===false)
			$html .= "background-color: $color;";
		if($color!='' and $border===true)
		{
			$html .= "
				background-color: transparent;
				border-color: $color;
				color: #343434;
			}
			";
			$html .= "
				#messagebox-".$id." span a{
					color: $color;
			";
		}

		$html .= "
			{
		</style>";
	}
	else
	{
		$html = "<style type='text/css'>
		#messagebox-".$id." {
		";

		if($border===true)
		{
			$html .= "
				background-color: transparent;
				border-color: #69c4a3;
				color: #343434;
			}
			";
			$html .= "
				#messagebox-".$id." span a{
					color: #69c4a3;
			";
		}


		$html .= "
			{
		</style>";
	}

	$html .= "<div id='messagebox-".$id."' class='sc-messagebox clearfix'>$content<span><a href='javascript:void(0)'><i class='fa fa-times'></i></a></span></div>";

	return $html;

}
add_shortcode('message','message');

add_action( 'after_setup_theme', 'reg_message' );
function reg_message(){
	if(function_exists('wpb_map')){
	wpb_map( array(
	   "name" => __("The Message Box"),
	   "base" => "message",
	   "class" => "",
	   "controls" => "full",
	   "category" => __('Content'),
	   "params" => array(
		   array(
			"type" => "textfield",
			"heading" => __("Icon", "cactusthemes"),
			"param_name" => "icon",
			"value" => "",
			"description" => __("FontAwesome 4.0+ icon name. For example: fa-star."),
		  ),
		  array(
			"type" => "textarea",
			"heading" => __("Content text", "cactusthemes"),
			"param_name" => "content",
			"value" => "",
			"description" => __("Content text"),
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Color", 'cactusthemes'),
			 "param_name" => "color",
			 "value" => '',
			 "description" => 'Color of the message box',
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Border", 'cactusthemes'),
			 "param_name" => "border",
			 "value" => array(
			 	__('No', 'cactusthemes') => 'false',
			 	__('Yes', 'cactusthemes') => 'true',
			 ),
			 "description" => 'Set border for the message box.'
		  ),
	   )
	));
	}
}
?>