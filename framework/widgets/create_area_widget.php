<?php
add_action( 'widgets_init', 'ew_widgets_init' );

if(!function_exists('ew_widgets_init')){
	function ew_widgets_init() {
		register_sidebar( array(
			'name' => __( 'Trang chủ - Danh mục đấu giá', 'hongtq_dev' ),
			'id' => 'home-page',
			'before_widget' => '<div id="%1$s" class="%2$s">',
	        'after_widget' => '</div>',
	        'before_title' => '',
	        'after_title' => ''
		));
	}
}