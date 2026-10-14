<?php
/* ------------------ */
/* cactus_textbox */
/* ------------------ */
function textbox($atts,$content='')
{
	wp_enqueue_style('textbox.css', ''.get_template_directory_uri().'/shortcodes/includes/css/textbox.css');
	global $theme_redux_options;
	extract(shortcode_atts(array(
		'icon' => '',
		'icon_color' => '',
		'icon_hover_color' => '',
		'layout' => 'center',
		'title' => '',
		'title_color' => '',
		'content_color' => '',
		'divider_color' => ''
	),$atts));
	if($icon!='') $icon = "fa fa-".trim(strtolower($icon));
	if($title_color!='')
	{
		$titleStyle = "color:".$title_color.";";
	}
	if($content_color!='')
	{	
		$contentStyle = "color:".$content_color.";";
	}
	if($divider_color!='')
	{
		$lineStyle = "background-color: ".$divider_color.";";
	}
	switch($layout)
	{
		case 'left':
			$align = "float: left;";
			$textAlign = "text-align: left";
			$divStyle = "margin-left: 71px;";
			$titleStyle .= "margin:0; margin-bottom:15px;";
			$lineStyle .= "margin:0;  margin-bottom:15px;";
			$contentStyle .= "text-align:left;";
		break;
		case 'right':
			$align = "float: right;";
			$textAlign = "text-align: right";
			$divStyle = "margin-right: 71px;";
			$titleStyle .= "margin:0; margin-bottom:15px;";
			$lineStyle .= "margin:0; margin-bottom:15px;";
			$contentStyle .= "text-align:right;";
		break;
	}
	$id = rand(1,100);
	
	$html = "<style type='text/css'>";
	
	if($icon_color!='')
	{
		$html .= "
		#textbox-".$id." .hi-icon-wrap a {
			color: ".$icon_color.";
			border-color:".$icon_color.";
		}
		";
	}
	
	if($icon_hover_color)
	{
		$html .= "
		#textbox-".$id." .hi-icon-wrap a:hover {
			background-color:".$icon_hover_color.";
			border-color:".$icon_hover_color.";
		}
		";
	}
	
	if($align and $align!='')
	{
		$html .= "
		#textbox-".$id." #set-1 {
			$align
		}";
	}
		
	if($titleStyle and $titleStyle!='')
	{
		$html .= "
			#textbox-".$id." .textbox-content h5.title {
				$titleStyle";
		if($textAlign and $textAlign!='')
			$html .= $textAlign;
		$html .= "	}";
	}
	
	if($lineStyle and $lineStyle!='')
	{
		$html .= "
			#textbox-".$id." .textbox-content p.ke {
				$lineStyle";
		if($align and $align!='')		
			$html .= $align;
		$html .= "	}";
	}
	
	if($contentStyle and $contentStyle!='')
	{
		$html .= "
			#textbox-".$id." .textbox-content .content{
				$contentStyle";
		if($align and $align!='')
			$html.= $align;
		$html .= "}
		";
	}
	
	
	if($divStyle!='')
	{
		$html .= "
		#textbox-".$id." .textbox-content {
			$divStyle
		}	
		";
	}
	
	$html .= "</style>";
	
	$html .= "
			<div id='textbox-".$id."' class='sc-textbox'>
				<div class='box-wwd clearfix'>";
				
	if($icon!='')
	{
		$html .= "
					<section id='set-1'>
						<div class='hi-icon-wrap hi-icon-effect-1 hi-icon-effect'>
							<a href='#set-1' class='hi-icon hi-icon-ship'>
								<i class='".$icon."'></i>
							</a>
						</div>
					</section>
		";
	}
					
	$html .= "		<div class='textbox-content clearfix'>
						<h5 class='title'>$title</h5>";

	$html .= "			<p class='ke'></p>
						<p class='content'>$content</p>
					</div>
				</div><!-- end-box-wwd -->
			</div><!-- end-col -->
			";
	return $html;
}
add_shortcode( 'textbox', 'textbox' );

add_action( 'after_setup_theme', 'reg_textbox' );
function reg_textbox(){
	if(function_exists('wpb_map')){
	wpb_map( array(
	   "name" => __("Textbox"),
	   "base" => "textbox",
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
			"type" => "textfield",
			"heading" => __("Title", "cactusthemes"),
			"param_name" => "title",
			"value" => "",
			"description" => __("Title text"),
		  ),
		  array(
			"type" => "textarea",
			"heading" => __("Content text", "cactusthemes"),
			"param_name" => "content",
			"value" => "",
			"description" => __("Content text"),
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Layout", 'cactusthemes'),
			 "param_name" => "layout",
			 "value" => array(
			 	__('Left', 'cactusthemes') => 'left',
				__('Right', 'cactusthemes') => 'right',
				__('Center', 'cactusthemes') => 'center',
			 ),
			 "description" => 'Choose icon layout'
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Icon Color", 'cactusthemes'),
			 "param_name" => "icon_color",
			 "value" => '',
			 "description" => 'Choose Icon Color (Optional)',
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Icon Hover Color", 'cactusthemes'),
			 "param_name" => "icon_hover_color",
			 "value" => '',
			 "description" => 'Choose Icon Background when hovered (Optional)',
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Title Color", 'cactusthemes'),
			 "param_name" => "title_color",
			 "value" => '',
			 "description" => 'Choose Title Color (Optional)',
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Content color", 'cactusthemes'),
			 "param_name" => "content_color",
			 "value" => '',
			 "description" => 'Choose Content color (Optional)',
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Divider color", 'cactusthemes'),
			 "param_name" => "divider_color",
			 "value" => '',
			 "description" => 'Choose Divider color (Optional)',
		  )
	   )
	));
	}
}
?>