<?php
/**
 * Initialize the custom theme options.
 */
add_action( 'init', 'custom_theme_options' );

/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options() {
  
  /* OptionTree is not loaded yet, or this is not an admin request */
  if ( ! function_exists( 'ot_settings_id' ) || ! is_admin() )
    return false;
    
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( ot_settings_id(), array() );
  
  /**
   * Custom settings array that will eventually be 
   * passes to the OptionTree Settings API Class.
   */
  $custom_settings = array( 
    'contextual_help' => array( 
      'sidebar'       => ''
    ),
    'sections'        => array( 
      array(
        'id'          => 'general_settings',
        'title'       => __( 'Cài đặt chung', 'hongtq_dev' )
      )
    ),
    'settings'        => array(
      array(
        'id'          => 'logo',
        'label'       => __( 'Logo', 'hongtq_dev' ),
        'desc'        => __( '<span style="color: red">(Upload logo for your Website.)</span>', 'hongtq_dev' ),
        'type'        => 'upload',
        'section'     => 'general_settings',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'favicon',
        'label'       => __( 'Favicon', 'hongtq_dev' ),
        'desc'        => __( '<span style="color: red">(Upload favicon for your Website.)</span>', 'hongtq_dev' ),
        'type'        => 'upload',
        'section'     => 'general_settings',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'cf7_short_code',
        'label'       => __( 'Short code cf7', 'hongtq_dev' ),
        'type'        => 'textarea-simple',
        'section'     => 'general_settings',
        'rows'        => 1,
        'operator'    => 'and'
      ),
      array(
        'id'          => 'remove_image_sizes',
        'label'       => 'Remove Image Sizes',
        'type'        => 'checkbox',
        'std'         => 'thumbnail',
        'section'     => 'general_settings',
        'operator'    => 'and',
        'choices'     => array(
          array(
            'value'       => 'thumbnail',
            'label'       => 'Thumbnail',
          ),
          array(
            'value'       => 'medium',
            'label'       => 'Medium',
          ),
          array(
            'value'       => 'large',
            'label'       => 'Large',
          ),
          array(
            'value'       => 'medium_large',
            'label'       => 'Medium Large',
          )
        )
      ),
      array(
        'id'          => 'tracking_code_head',
        'label'       => __( 'Add Code Header', 'hongtq_dev' ),
        'desc'        => __( '<span style="color: red">(Paste code remarketing (or other) tracking code here.)</span>', 'hongtq_dev' ),
        'type'        => 'textarea-simple',
        'section'     => 'general_settings',
        'rows'        => 3,
        'operator'    => 'and'
      ),
      array(
        'id'          => 'tracking_code_body',
        'label'       => __( 'Add Code Body', 'hongtq_dev' ),
        'desc'        => __( '<span style="color: red">(Paste code remarketing (or other) tracking code here.)</span>', 'hongtq_dev' ),
        'type'        => 'textarea-simple',
        'section'     => 'general_settings',
        'rows'        => 3,
        'operator'    => 'and'
      ),
      array(
        'id'          => 'tracking_code',
        'label'       => __( 'Add Code Footer', 'hongtq_dev' ),
        'desc'        => __( '<span style="color: red">(Note: Paste Google Analytics (or other) tracking code here.)</span>', 'hongtq_dev' ),
        'type'        => 'textarea-simple',
        'section'     => 'general_settings',
        'rows'        => 3,
        'operator'    => 'and'
      ),
      array(
        'id'          => 'custom_css',
        'label'       => __( 'Custom CSS', 'hongtq_dev' ),
        'std'         => '#custom {}',
        'type'        => 'css',
        'section'     => 'general_settings',
        'rows'        => '20',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'theme_information',
        'label'       => __( 'Theme Information', 'hongtq_dev' ),
        'desc'        => __( '<p>Theme Name: Hai Linh plastic - minhdungai</p>
                            <p>Theme URI: </p>
                            <p>Author: Dũng AI (minhdung2209.work@gmail.com)</p>
                            <p>Author URI: https://cv.gnud.io.vn</p>
                            <p>Description: Hai Linh plastic theme wordpress</p>
                            <p>Version: v1.6</p>', 'hongtq_dev' ),
        'type'        => 'textblock-titled',
        'section'     => 'general_settings',
        'operator'    => 'and'
      )
    )
  );
  
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( ot_settings_id() . '_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( ot_settings_id(), $custom_settings ); 
  }
  
  /* Lets OptionTree know the UI Builder is being overridden */
  global $ot_has_custom_theme_options;
  $ot_has_custom_theme_options = true;
  
}