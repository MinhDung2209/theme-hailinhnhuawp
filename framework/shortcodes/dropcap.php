<?php
/* ------------------ */
/* cactus_dropcap*/
/* ------------------ */
function dropcap($atts,$content='')
{
	wp_enqueue_style('dropcap.css', ''.get_template_directory_uri().'/shortcodes/includes/css/dropcap.css');
	global $theme_redux_options;
	extract(shortcode_atts(array(
		'background' => '',
		'color' => '',
		'circle' => false
	),$atts));
	
	if(!empty($content)) $content = trim(strtoupper($content));
	$circle = convertStrToBool($circle);
	
	$id = rand(1,100);
	
	if($background!='' or $color!='')
	{
		$html = "<style type='text/css'>";
		if($background!='')
		{
			$html .= "
				#dropcap-".$id."{
					background-color: $background;
				}
			";
		}
		
		if($color!='')
		{
			$html .= "
				#dropcap-".$id." p{
					color: $color;
				}
			";
		}
		
		$html .= "
		</style>";
	}
	
	if($circle===true)	
		$html .= '<div id="dropcap-'.$id.'" class="sc-dropcap sc-dropcap-circle"><p>'.$content.'</p></div>';
	else 
		$html .= '<div id="dropcap-'.$id.'" class="sc-dropcap"><p>'.$content.'</p></div>';
	
	return $html;
}
add_shortcode('dropcap','dropcap');
?>