<?php
/* ------------------ */
/* cactus_clients */
/* ------------------ */

function clients($atts,$content='')
{
	wp_enqueue_style('Clients-css', ''.get_template_directory_uri().'/shortcodes/includes/css/clients.css');
	extract(shortcode_atts(array(
		'cols' => '4'
	),$atts));
	
	if($content == '')
	{
		$content = '
		[client][/client]
		[client][/client]
		';
	}
	$content = do_shortcode($content);
	// Display
	ob_start();?>
	
	<div id="clients">				
		<div class="row">
			<?php echo $content;?>
		</div>		
	</div>	
	<?php
	// Return
	$output_string=ob_get_contents();
	ob_end_clean();
	wp_enqueue_script('Clients-js', ''.get_template_directory_uri().'/shortcodes/includes/js/template.js?version=0.3');
	return $output_string;
	?>			
<?php }
add_shortcode('clients','clients');

function client($atts,$content=NULL)
{	
	extract(shortcode_atts(array(
		'img' => '',
		'link' => ''
	),$atts));
	
	if($img == '')
		$img = TEMPLATE_URL.'/images/nothumb.jpg';
	
	$attachment_id = trim((int)$atts['img']); // attachment ID
	//$size = array(179,179);
	$image_attributes = wp_get_attachment_image_src( $attachment_id ); // returns an array
	ob_start();?>
		<?php wp_enqueue_style( 'Clients Css' , '.get_template_directory_uri().', $deps, $ver, $media ); ?>
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 client-item">
			<div class="item item-1">
				<a href="<?php echo $atts[link];?>" title="" target="_blank">
					<img src="<?php echo $image_attributes[0];?>" alt="Clients" title="" />
				</a>
			</div>
		</div>		
	<?php
	// Return
	$output_string = ob_get_contents();
	ob_end_clean();
	return $output_string;
	?>		
<?php 
}
add_shortcode('client','client');

//Visual Composer
add_action( 'after_setup_theme', 'reg_field_clients' );
function reg_field_clients(){
	if(function_exists('vc_map')){
		//parent
		vc_map( array(
			"name" => __("Clients Group", "cactusthemes"),
			"base" => "clients",
			"as_parent" => array('only' => 'client'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
			"content_element" => true,
			"show_settings_on_create" => false,
			"icon" => "wrap-icon",
			"params" => array(
				// add params same as with any other content element
				array(
					"type" => "textfield",
					"heading" => __("Extra class name", "js_composer"),
					"param_name" => "el_class",
					"description" => __("", "js_composer")
				)
			),
			"js_view" => 'VcColumnView'
		) );
		
		//child
		vc_map( array(
			"name" => __("Child Clients", "cactusthemes"),
			"base" => "client",
			"content_element" => true,
			"as_child" => array('only' => 'clients'), // Use only|except attributes to limit parent (separate multiple values with comma)
			"icon" => "child-icon",
			"params" => array(
				array(
					"type" => "attach_image",
					"heading" => __("ID of image attachment", "js_composer"),
					"param_name" => "img",
					"value" => "",
					"description" => "ID of image attachment"
				),
				array(
					"type" => "textfield",
					"heading" => __("URL of out link", "js_composer"),
					"param_name" => "link",
					"value" => "",
					"description" => "URL of out link"
				)
			)
		) );
	}
}
class WPBakeryShortCode_clients extends WPBakeryShortCodesContainer{}
class WPBakeryShortCode_client extends WPBakeryShortCode{}



// add_action( 'after_setup_theme', 'reg_field_clients' );
// function reg_field_clients(){
	// if(function_exists('ct_clients')){
	// ct_clients( array(
		// "name" => __("Clients"),// Title display
		// "base" => "client", // Shortcode name
		// "class" => "",
		// "controls" => "full",
		// "category" => __('Content'),
		// 'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
		// 'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
		// "params" => array(
			// array(
				// "type" => "textfield",
				// "heading" => __("Icon", "cactusthemes"),
				// "param_name" => "icon",
				// "value" => "",
				// "description" => __("FontAwesome 4.0+ icon name. For example: fa-star."),
			// ),
		  // array(
			// "type" => "textfield",
			// "heading" => __("Heading", "cactusthemes"),
			// "param_name" => "heading",
			// "value" => "",
			// "description" => __("Heading text"),
		  // ),
		  // array(
			// "type" => "textarea",
			// "heading" => __("Content text", "cactusthemes"),
			// "param_name" => "content",
			// "value" => "",
			// "description" => __("Content text"),
		  // ),
		  // array(
			 // "type" => "dropdown",
			 // "holder" => "div",
			 // "class" => "",
			 // "heading" => __("Layout", 'cactusthemes'),
			 // "param_name" => "layout",
			 // "value" => array(
			 	// __('Left', 'cactusthemes') => 'left',
				// __('Right', 'cactusthemes') => 'right',
				// __('Center', 'cactusthemes') => 'center',
			 // ),
			 // "description" => 'Choose icon layout'
		  // ),
		  // array(
			 // "type" => "dropdown",
			 // "holder" => "div",
			 // "class" => "",
			 // "heading" => __("Schema", 'cactusthemes'),
			 // "param_name" => "schema",
			 // "value" => array(
			 	// __('Default', 'cactusthemes') => '',
			 	// __('Light', 'cactusthemes') => 'light',
				// __('Dark', 'cactusthemes') => 'dark',
			 // ),
			 // "description" => 'Choose icon schema'
		  // ),
		  // array(
			 // "type" => "colorpicker",
			 // "holder" => "div",
			 // "class" => "",
			 // "heading" => __("Icon Background Color", 'cactusthemes'),
			 // "param_name" => "icon_background_color",
			 // "value" => '',
			 // "description" => 'Choose Icon Background Color (Optional)',
		  // ),
		  // array(
			 // "type" => "colorpicker",
			 // "holder" => "div",
			 // "class" => "",
			 // "heading" => __("Icon Background Hover", 'cactusthemes'),
			 // "param_name" => "icon_background_hover",
			 // "value" => '',
			 // "description" => 'Choose Icon Background when hovered (Optional)',
		  // ),
		  // array(
			 // "type" => "colorpicker",
			 // "holder" => "div",
			 // "class" => "",
			 // "heading" => __("Heading Color", 'cactusthemes'),
			 // "param_name" => "heading_color",
			 // "value" => '',
			 // "description" => 'Choose Heading Color (Optional)',
		  // ),
		  // array(
			 // "type" => "colorpicker",
			 // "holder" => "div",
			 // "class" => "",
			 // "heading" => __("Content color", 'cactusthemes'),
			 // "param_name" => "content_color",
			 // "value" => '',
			 // "description" => 'Choose Content color (Optional)',
		  // ),
		  // array(
			 // "type" => "textarea",
			 // "holder" => "div",
			 // "class" => "",
			 // "heading" => __("Text color", 'cactusthemes'),
			 // "param_name" => "text_color",
			 // "value" => '',
			 // "description" => 'Choose Content color (Optional)',
		  // )
	   // )
	// ));
	// }
// }
?>