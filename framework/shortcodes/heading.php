<?php
/* ------------------ */
/* cactus_heading */
/* ------------------ */
function heading($atts,$content='')
{
	global $theme_redux_options;
	extract(shortcode_atts(array(
		'margin'=>'',
	),$atts));
	$d_margin = '';
	if(empty($content)) $content = "Heading Text";
	if($margin=='')
		$d_margin = "0 0 0 0";
	else
		$d_margin = $margin;
	$id = rand(1,100);
	if($d_margin != '0 0 0 0')
	{
		$html = "
			<style type='text/css'>
				.sc_heading-".$id."{
					margin:$d_margin;
				}
			</style>
		";
	}
	$html .="<h1 class='sc_heading-".$id."'>".$content."</h1>";
	return $html;
}
add_shortcode('heading', 'heading');
?>