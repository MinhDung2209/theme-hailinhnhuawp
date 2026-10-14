<?php
/* ------------------ */
/* cactus_timeline */
/* ------------------ */
function timeline($atts,$content='')
{
	wp_enqueue_style('timeline.v2.css', ''.get_template_directory_uri().'/shortcodes/includes/css/timeline.v2.css');
	if(empty($content))
	{
		$content = '
		[t-item]
				Content Text
			[/t-item]
		
		[t-item]
				Content Text
			[/t-item]
		
		[t-item]
				Content Text
			[/t-item]

		';
	}
	$content = do_shortcode($content);
	
	$html = "
	<ul class='timeline_items'>
		$content
	</ul>	
	";
	
	return $html;
	
}
add_shortcode('timeline','timeline');

function t_item($atts,$content)
{	
	extract(shortcode_atts(array(
		'title' => '',
		'time' => '',
		'img' => ''
	),$atts));
			
	if(empty($content)) $content = 'Content Text';
	
	$attachment_id = trim((int)$atts['img']); // attachment ID
	$size = array(179,179);
	$image_attributes = wp_get_attachment_image_src( $attachment_id,$size ); // returns an array
	global $align;
	if(!$align){
		$align = 1;
	}else{$align++;}
	?>
	<style>
	.timeline_items li.count-<?php echo $align;?> h5 .image-time{ background:url(<?php echo $image_attributes[0];?>) no-repeat;background-size: cover;background-position: center;width: 180px;height: 180px;-webkit-border-radius: 50%;border-radius: 50%;text-align: center;position: absolute;margin-top: 0;left: 50%;margin-left: -90px;color: #fff;font-family: "Montserrat";font-size: 34.72px;}		
	</style>		
	<?php ob_start();?>	
	<li class="count-<?php echo $align;?> <?php if($align%2==0){echo 'even';}else{echo 'odd';}?>">
		<div class="title-img">
			<h5>
				<span class="bg-white">
					<span class="image-time">
						<div class="time"><?php echo $atts['time'];?></div>
					</span>
				</span>
				<?php echo $atts['title'];?>
			</h5>
		</div>
		<div class="des-timeline">
			<div class="content-timeline"><div class="desc"><p><?php echo $content;?></p></div></div>
		</div>
	</li>	
	
	<?php
	// Return
	$output_string = ob_get_contents();
	ob_end_clean();
	return $output_string;
	?>
<?php 
}	
add_shortcode('t-item','t_item');
/* end cactus_timeline */
add_action( 'after_setup_theme', 'reg_field_timeline' );
function reg_field_timeline(){
	if(function_exists('vc_map')){		
		vc_map( array(
			"name" => __("Timeline Group", "cactusthemes"),
			"base" => "timeline",
			"as_parent" => array('only' => 't-item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
			"content_element" => true,
			"show_settings_on_create" => false,
			"icon" => "wrap-icon",
			"params" => array(				
				array(
					"type" => "textfield",
					"heading" => __("Extra class name", "js_composer"),
					"param_name" => "el_class",
					"description" => __("", "js_composer")
				)
			),
			"js_view" => 'VcColumnView'
		) );				
		vc_map( array(
			"name" => __("Child timeline", "cactusthemes"),
			"base" => "t-item",
			"content_element" => true,
			"as_child" => array('only' => 'timeline'), // Use only|except attributes to limit parent (separate multiple values with comma)
			"icon" => "child-icon",
			"params" => array(				
				array(
					"type" => "attach_image",
					"heading" => __("Timeline Image", "js_composer"),
					"param_name" => "img",
					"value" => "",
					"description" => "Timeline Image"
				),
				array(
					"type" => "textfield",
					"heading" => __("Title", "js_composer"),
					"param_name" => "title",
					"value" => "",
					"description" => "Title"
				),
				array(
					"type" => "textfield",
					"heading" => __("Time", "js_composer"),
					"param_name" => "time",
					"value" => "",
					"description" => "Time"
				),
				array(
					"type" => "textarea",
					"heading" => __("Content text", "cactusthemes"),
					"param_name" => "content",
					"value" => "",
					"description" => __("Content Text"),
				)
			)
		) );
	}
}
class WPBakeryShortCode_timeline extends WPBakeryShortCodesContainer{}
//class WPBakeryShortCode_t-item extends WPBakeryShortCode{}

?>