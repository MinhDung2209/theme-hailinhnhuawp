<?php
/* ------------------ */
/* cactus_text */
/* ------------------ */
function text($atts,$content='')
{
	wp_enqueue_style('text.css', ''.get_template_directory_uri().'/shortcodes/includes/css/text.css');
	extract(shortcode_atts(array(
		'big_text' => ''
	),$atts));

	$id = rand(1,100);

	$html = "
	<div id='text-".$id."' class='sc-text-wrap'>
		<p>$content</p>
	";

	if($big_text!='')
		$html .= "<h3>$big_text</h3>";

	$html .="
	</div>
	";

	return $html;

}
add_shortcode('text','text');
?>