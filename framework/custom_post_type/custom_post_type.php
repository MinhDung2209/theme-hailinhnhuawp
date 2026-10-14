<?php
add_action( 'init', 'codex_custom_init' );

if (!function_exists('codex_custom_init')) {
	function codex_custom_init() {
		// // Sản phẩm
		$labels = array(
			'name'               => __('Products','hongtq_dev'),
			'singular_name'      => __('Product','hongtq_dev'),
			'add_new'            => __('Add new','hongtq_dev'),
			'add_new_item'       => __('Add new product','hongtq_dev'),
			'edit_item'          => __('Edit product','hongtq_dev'),
			'new_item'           => __('New product','hongtq_dev'),
			'all_items'          => __('View all','hongtq_dev'),
			'view_item'          => __('View product','hongtq_dev'),
			'search_items'       => __('Search product','hongtq_dev'),
			'not_found'          =>  __('Not found','hongtq_dev'),
			'not_found_in_trash' => __('Not found in trash','hongtq_dev'),
			'parent_item_colon'  => '',
			'menu_name'          => __('All products','hongtq_dev')
		);
		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'product' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			//'menu_icon'        => 'dashicons-video-alt3', //https://developer.wordpress.org/resource/dashicons/#album
			'menu_position'      => 5,
			// 'supports'           => array( 'title', 'editor', 'thumbnail','author','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'),
			'supports'           => array( 'title', 'editor', 'thumbnail'),
			// 'taxonomies'         => array('','post_tag')
		);
		register_post_type( 'product', $args );

		flush_rewrite_rules();
	}
}