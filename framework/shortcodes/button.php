<?php
/* ------------------ */
/* cactus_button */
/* ------------------ */
function button($atts,$content='')
{	
	global $theme_redux_options;
	extract(shortcode_atts(array(
		'type'   => '',
		'color'  => '',
		'link'   => '',
		'target' => '',
		'hover'  => 'light',
		'framename' => ''
	),$atts));
	
	wp_enqueue_style('button.css', ''.get_template_directory_uri().'/shortcodes/includes/css/button.css');
	if(empty($content)) $content = "buy now";
	$bg_color = '';
	$link = isset($atts['link']) ? $atts['link'] : '#';
	$target = isset($atts['target']) ? $atts['target'] : ' ';
	
	if(trim(strtolower($type)) == 'solid'){
		$bg_color = "$color";
	}
	else
		$bg_color = 'transparent';
		$id = rand(1,100);
		switch($hover){
			case 'light':
				$hover1 = "background: #343434 ; color: #FFF ; border-color:#343434";
			break;
			case 'dark':
				$hover1 = "background: #FFF; color: #343434 ; border-color:#FFF";
			break;
		}
		if($type!='' or $color!=''){
			$html = "<style type='text/css'>
					#sc_button-".$id."{";

			if($color!='')
			{
				if($type=='solid'){
					$html .= "
						border: 3px solid $color;
						background-color:$color;
						color:#FFF;
					";
				}else{
					$html .= "
						border: 3px solid $color;
						color: $color;
					";
				}
			}else{
				if($type=='solid'){
					$html .= "
						border: 3px solid ".$theme_redux_options['theme-default-color'].";
						background-color:".$theme_redux_options['theme-default-color'].";
						color:#FFF;
					";
				}
			} 
			$html .= "}";
			$html .="
				#sc_button-".$id.":hover{
					".$hover1."
				}
			";
			$html .= "}</style>";
		}
		if($target=='framename' and $framename!='') $target = trim($framename);
		$html .= "<a href='".$link."' target='".$target."' class='box_button' id='sc_button-".$id."'>$content</a>";
		return $html;
}
add_shortcode( 'button', 'button' );

add_action( 'after_setup_theme', 'reg_button' );
function reg_button(){
	if(function_exists('wpb_map')){
		wpb_map( array(
		   "name" => __("Signal Button"),
		   "base" => "button",
		   "class" => "",
		   "controls" => "full",
		   "category" => __('Content'),
		   "params" => array(
		   		array(
					 "type" => "dropdown",
					 "holder" => "div",
					 "class" => "",
					 "heading" => __("Type", 'cactusthemes'),
					 "param_name" => "type",
					 "value" => array(
						__('None', 'cactusthemes') => '',
						__('Solid', 'cactusthemes') => 'solid',
					 ),
					 "description" => 'Type of the button(solid background or just has border).'
				  ),
				  array(
					"type" => "textfield",
					"heading" => __("Button text", "cactusthemes"),
					"param_name" => "content",
					"value" => "",
					"description" => __("The text inside button."),
				  ),
				 array(
					 "type" => "colorpicker",
					 "holder" => "div",
					 "class" => "",
					 "heading" => __("Button Color", 'cactusthemes'),
					 "param_name" => "color",
					 "value" => '',
					 "description" => 'Choose Button Color (Optional).',
				  ),
				  array(
					"type" => "textfield",
					"heading" => __("Link", "cactusthemes"),
					"param_name" => "link",
					"value" => "",
					"description" => __("URL to navigate."),
				  ),
				  array(
					 "type" => "dropdown",
					 "holder" => "div",
					 "class" => "",
					 "heading" => __("Target", 'cactusthemes'),
					 "param_name" => "target",
					 "value" => array(
						__('Blank', 'cactusthemes') => '_blank',
						__('Parent', 'cactusthemes') => '_parent',
						__('Self', 'cactusthemes') => '_self',
						__('Top', 'cactusthemes') => '_top',
						__('Framename', 'cactusthemes') => 'framename',
					 ),
					 "description" => 'Target of the link.'
				  ),
				  array(
					"type" => "textfield",
					"heading" => __("Framename", "cactusthemes"),
					"param_name" => "framename",
					"value" => "",
					"description" => __("If you choose the target of link is Framename, please type the framename into here."),
				  ),
				  array(
					 "type" => "dropdown",
					 "holder" => "div",
					 "class" => "",
					 "heading" => __("Hover", 'cactusthemes'),
					 "param_name" => "hover",
					 "value" => array(
						__('Light', 'cactusthemes') => 'light',
						__('Dark', 'cactusthemes') => 'dark'
					 ),
					 "description" => 'Hover state.'
				  ),
		   )
		));
	}
}
?>