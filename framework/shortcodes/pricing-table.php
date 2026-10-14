<?php
/* ------------------ */
/* cactus_pricingtable*/
/* ------------------ */
function pricing($atts,$content='')
{
	wp_enqueue_style('pricing-table.css', ''.get_template_directory_uri().'/shortcodes/includes/css/pricing-table.css');
	global $theme_redux_options;
	extract(shortcode_atts(array(
		'background' => '',
		'color' => '',
	),$atts));
	$content = do_shortcode($content);
	if(empty($background))
		$background = $theme_redux_options['theme-default-color'];
	
	if(!empty($color))
	{
		$style = "color:$color";
	}
	
	$html .= " 	
	</style>";
		$html .= "
			<div class='box_pricing'>
				<div class='row wp_box' style='".$style."'>$content</div>
			</div><!--End-box_pricing-->
			";
	
	return $html;
}
add_shortcode( 'pricing', 'pricing' );

function p_plan($atts,$content='')
{
	global $theme_redux_options;
	extract(shortcode_atts(array(
		'highlighted'                => '0',
		'header'                     => 'Header text',
		'header_backgroud'           => '#000',
		'header_color'               => '#FFF',
		'currency'                   =>'$',
		'price'                      => '8',
		'description'                => '',
		'price_backgroud'            => '',
		'price_color'                => '#FFF' 
	),$atts));
	$id = rand(1,100);
	$highlighted = ($highlighted =='1')?'box_main_highligh box_main border_trasition':'box_main border_trasition';
	$header = isset($atts['header']) ? $atts['header'] : '';
	$html .='
			<style type="text/css">
				#sc_p_header-'.$id.'{
					background-color:'.$header_backgroud.';
				}
				#sc_p_header-'.$id.' h5{
					color:'.$header_color.';
				}
				.box_pricing .box_main:hover #sc_p_header-'.$id.'{
					background-color: '.$price_backgroud.';
				}
				.box_pricing #sc-box_main'.$id.':hover{
					border-color: '.$price_backgroud.';
				}
			</style>
	';
	$html .= "<style type='text/css'>
				#p-highlight-".$id." span , #p-highlight-".$id." p{
					color: ".$price_color.";
				}
				#p-highlight-".$id."{
					background-color: ".$price_backgroud.";
				</style>";

				$currency = isset($atts['currency']) ? $atts['currency'] : '$';
				$price = isset($atts['price']) ? $atts['price'] : '8';
				$description = isset($atts['description']) ? $atts['description'] : '';
				$content = do_shortcode($content);	
				
				$html .= '
				<div class="col-lg-4 wrap_pricing">
									<div class="'.$highlighted.'" id="sc-box_main'.$id.'">
										<div class="top_box bg_transition" id="sc_p_header-'.$id.'">
											<h5>'.$header.'</h5>
										</div>
										<div id="p-highlight-'.$id.'" class="price">
											<p class="units">
												<span class="money">'.$currency.'</span><span class="num_price">'.$price.'</span>/mo
											</p>
											<p class="text_bt">
												'.$description.'
											</p>
										</div>
										'.$content.'
									</div><!--End-highlighted-->
			    </div>
			';
	return $html;
}
add_shortcode('p_plan','p_plan');

function p_row($atts,$content)
{
	if(empty($content))
		$content = 'Content text';
	$content = do_shortcode($content);
	$html = "
		<div class='bg_table_row'><a>".$content."</a></div>
		";
	return $html;
}
add_shortcode('p-row','p_row');

/* end cactus_pricingtable */

/** Add shortcode to Visual Composer **/

add_action( 'after_setup_theme', 'reg_field_pricing_table' );
function reg_field_pricing_table(){
	if(function_exists('vc_map')){		
		vc_map( array(
			"name" => __("Pricing Table", "cactusthemes"),
			"base" => "pricing",
			"as_parent" => array('only' => 'p_plan'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
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
			"name" => __("Pricing Plan", "cactusthemes"),
			"base" => "p_plan",
			"content_element" => true,
			"as_child" => array('only' => 'pricing'), // Use only|except attributes to limit parent (separate multiple values with comma)
			"as_parent" => array('only' => 'p-row'),
			"icon" => "child-icon",
			"params" => array(					
				array(
					"type" => "dropdown",
					"heading" => __("Highlighted", "js_composer"),
					"param_name" => "highlighted",
					"value"       => array(
						'False'   => '0',
						'True'   => '1',						
					),
					"description" => "Define which plan is highlighted"
				),
				array(
					"type" => "textfield",
					"heading" => __("Header", "js_composer"),
					"param_name" => "header",
					"value" => "Header text",
					"description" => "Header text"
				),				
				array(
					"type" => "colorpicker",
					"holder" => "div",
					"class" => "",
					"heading" => __("Header Backgroud", 'cactusthemes'),
					"param_name" => "header_backgroud",
					"value" => '',
					"description" => 'Header Backgroud',
				),
				array(
					"type" => "colorpicker",
					"holder" => "div",
					"class" => "",
					"heading" => __("Header color", 'cactusthemes'),
					"param_name" => "header_color",
					"value" => '',
					"description" => 'Header color',
				),
				array(
					"type" => "textfield",
					"heading" => __("Currency", "js_composer"),
					"param_name" => "currency",
					"value" => "$",
					"description" => "Currency"
				),
				array(
					"type" => "textfield",
					"heading" => __("Price", "js_composer"),
					"param_name" => "price",
					"value" => "",
					"description" => "Price"
				),
				array(
					"type" => "textfield",
					"heading" => __("Description", "js_composer"),
					"param_name" => "description",
					"value" => "empty text",
					"description" => "Description"
				),
				array(
					"type" => "colorpicker",
					"holder" => "div",
					"class" => "",
					"heading" => __("Price Backgroud", 'cactusthemes'),
					"param_name" => "price_backgroud",
					"value" => '',
					"description" => 'Price Backgroud',
				),
				array(
					"type" => "colorpicker",
					"holder" => "div",
					"class" => "",
					"heading" => __("Price Color", 'cactusthemes'),
					"param_name" => "price_color",
					"value" => '',
					"description" => 'Price Color',
				)
			)
		) );
		//child
		vc_map( array(
			"name" => __("Row content", "cactusthemes"),
			"base" => "p-row",
			"content_element" => true,
			"as_child" => array('only' => 'p_plan'), // Use only|except attributes to limit parent (separate multiple values with comma)
			"icon" => "child-icon",
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Content", "cactusthemes"),
					"param_name" => "content",
					"value" => "",
					"description" => ""
				)
			)
		) );
	}
}
//class WPBakeryShortCode_pricing extends WPBakeryShortCodesContainer{}

class WPBakeryShortCode_pricing extends WPBakeryShortCodesContainer{}
class WPBakeryShortCode_p_plan extends WPBakeryShortCodesContainer{}
class WPBakeryShortCode_p_row extends WPBakeryShortCode{}

?>