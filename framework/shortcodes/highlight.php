<?php
/* ------------------ */
/* cactus_highlight*/
/* ------------------ */
function highlight($atts,$content='')
{
	wp_enqueue_style('highlight.css', ''.get_template_directory_uri().'/shortcodes/includes/css/highlight.css');
	global $theme_redux_options;
	extract(shortcode_atts(array(
		'color' => '',
		'background' => '',
		'text1' => '',
		'text2' => '',
		'auto_play' => 0
	),$atts));
	if(empty($content)) $content = "Text to highlight";
	$auto_play = convertStrToBool($auto_play);
	
	$id = rand(1,100);
	
	$html = "
	<style type='text/css'>
		#highlight-".$id." span, #highlight-".$id." span:after{";
		
		if($background!='')
			$html .= "background-color: $background;";
		if($color!='')
			$html .= "color: $color;";
				
	$html .= "	}
	</style>
	";
	
	if($text1!=''){
		$data_title = trim($text1);
	}
	else{
		$data_title = trim($content);
	}

	
	if($auto_play!==false){
		$autoClass = 'autoplay';
	}
	$html .= "<a id='highlight-".$id."' class='highlight highlight-0' href='javascript:void(0)'><span class='".$autoClass."' data-title='".$data_title."' >$content</span></a>";
	
	return $html;
}
add_shortcode( 'highlight', 'highlight' );
?>