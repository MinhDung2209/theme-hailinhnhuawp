<?php
function admin_template_js(){
	wp_enqueue_script( 'admin_template', get_template_directory_uri() . '/admin/assets/js/admin_template.js', array('jquery'), '', true );
}
add_action( 'admin_enqueue_scripts', 'admin_template_js' );

function admin_css(){?>
<style type="text/css">
.farbtastic {
	z-index:9999;
}
.new-color-picker{
	position:relative !important;
	z-index:99;
}
.new-color-picker .farbtastic {
	position: absolute !important;
	left:106%;
	top:-75px;
}
</style>
<?php }
add_action( 'admin_head', 'admin_css' );

add_action( 'admin_init', 'cactus_shortcode' );
function cactus_shortcode() {
	add_filter( "mce_external_plugins", "cactus_add_buttons_classic" );
	add_filter( 'mce_buttons', 'cactus_register' );
}
function cactus_add_buttons_classic($plugin_array) {
    $plugin_array['cactus_shortcode_button_message_box'] = get_template_directory_uri() . '/shortcodes/includes/classic_editor/classic_editor_message_box.js';
    $plugin_array['cactus_shortcode_button_icon'] = get_template_directory_uri() . '/shortcodes/includes/classic_editor/classic_editor_icon.js';
    $plugin_array['cactus_shortcode_animation_counter'] = get_template_directory_uri() . '/shortcodes/includes/classic_editor/classic_animated_counter.js';
    $plugin_array['cactus_shortcode_animation_progress'] = get_template_directory_uri() . '/shortcodes/includes/classic_editor/classic_animated_progress.js';
    $plugin_array['cactus_shortcode_animation_percentage'] = get_template_directory_uri() . '/shortcodes/includes/classic_editor/classic_animated_percentage.js';
    $plugin_array['cactus_shortcode_animation_testimonials'] = get_template_directory_uri() . '/shortcodes/includes/classic_editor/classic_shortcode_testimonials.js';
    $plugin_array['cactus_shortcode_animation_divider'] = get_template_directory_uri() . '/shortcodes/includes/classic_editor/classic_shortcode_divider.js';
	return $plugin_array;
}
function cactus_register($buttons) {
    array_push( $buttons, 'message', 'icon','animation-counter','animation-progress','animation-percentage','button','testimonials','divider' );

	//$kenburnActive = is_plugin_active('ct-kenburn-slider/ct-kenburn-slider.php');
	//var_dump($kenburnActive);die;
	//if($kenburnActive){
		//array_push( $buttons, 'kenburn');
	//}
	//var_dump($buttons);die;
    return $buttons;

}


















?>