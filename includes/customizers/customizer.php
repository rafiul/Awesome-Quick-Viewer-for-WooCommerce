<?php
function awqv_customize_register( $wp_customize ) {
	require_once ( Awqv_Lite_Plugin::awqv_dir(). '/toggle-control/class-customizer-toggle-control.php' );
	require_once ( Awqv_Lite_Plugin::awqv_dir(). '/separator-control/class-separator-control.php' );
	require_once ( Awqv_Lite_Plugin::awqv_dir(). '/upsell-inner-section-control/class-upsell-inner-section-control.php' );
	require_once ( Awqv_Lite_Plugin::awqv_dir(). '/slider-range-control/class-slider-range-control.php' );
	require_once ( Awqv_Lite_Plugin::awqv_dir() . '/icon-picker/icon-picker-control.php');
	require_once ( Awqv_Lite_Plugin::awqv_dir(). '/customizer-animation.php' );
	require_once ( Awqv_Lite_Plugin::awqv_dir(). '/customizer-slider.php' );
	
	/**
	 * ************** Add panel **************
	 */
	   $panel = 'awqv_customizer_panel';
		$wp_customize->add_panel(  $panel, 
			array(
				'priority'       => 22,
				'title'            => __( '&#x2611; Quick View Settings', 'awqv' ),
				'description'      => __( 'You can best appearence if you open the Quick view before customize.', 'awqv' ),
			) 
		);
	
	/**
	 * ************** Add Color sections **************
	 */
     $wp_customize->add_section( 'awqv_customizer_section', array(
 		'title'       => __( 'Color Settings', 'awqv' ),
 		'priority'    => 11,
 		'panel'       =>  $panel,
 	) );
	/**
	 * ************** Add General sections **************
	 */ 
     $wp_customize->add_section( 'awqv_general_section', array(
 		'title'       => __( 'General Settings', 'awqv' ),
 		'priority'    => 10,
 		'panel'       =>  $panel,
 	) );
	/**
	 * ************** Add Animation sections **************
	 */
     $wp_customize->add_section( 'awqv_animation_section', array(
 		'title'       => __( 'Animation Settings', 'awqv' ),
 		'priority'    => 10,
 		'panel'       => $panel,
 	) );
	
	/**
	 * ************** Add Icon sections **************
	 */
     $wp_customize->add_section( 'awqv_icon_section', array(
 		'title'       => __( 'Close Icon Settings', 'awqv' ),
 		'priority'    => 10,
 		'panel'       => $panel,
 	) );
	/**
		*************** Add Slider sections **************
	 */
     $wp_customize->add_section( 'awqv_slider_section', array(
 		'title'       => __( 'Slider Settings', 'awqv' ),
 		'priority'    => 10,
 		'panel'       => $panel,
 	) );
	/**
		*************** Add to cart button sections **************
	 */
     $wp_customize->add_section( 'awqv_add_to_cart_section', array(
 		'title'       => __( 'Add to Cart Settings', 'awqv' ),
 		'priority'    => 10,
 		'panel'       => $panel,
 	) );
	/** 
		************** window Bg **************
	**/
	$wp_customize->add_setting(
      'awqv_window_bg', //give it an ID
      array(
		'transport' => 'postMessage',
        'default' => '#fff', // Give it a default
		'sanitize_callback' => 'sanitize_hex_color',
		'type' => 'option'
      )
	);
	$wp_customize->add_control(
     new WP_Customize_Color_Control(
         $wp_customize,
         'awqv_window_bg', //give it an ID
         array(
             'label'      => __( 'Popup Background', 'awqv' ), 
             'section'    => 'awqv_customizer_section',  
             'settings'   => 'awqv_window_bg'
         )
    )
  );
	
   /** 
   ************** Sale Flash **************
  **/
	$wp_customize->add_setting(
      'awqv_sale_flash_bg', //give it an ID
      array(
		'transport' => 'postMessage',
        'default' => '#111111', // Give it a default
		'sanitize_callback' => 'sanitize_hex_color',
		'type' => 'option'

      )
	);
	$wp_customize->add_control(
     new WP_Customize_Color_Control(
         $wp_customize,
         'awqv_sale_flash_bg', //give it an ID
         array(
             'label'      => __( 'Sale flash Background', 'awqv' ), 
             'section'    => 'awqv_customizer_section',  
             'settings'   => 'awqv_sale_flash_bg'
         )
    )
  );
  
/** 
   ************** Title Color **************
  **/
	$wp_customize->add_setting(
      'awqv_title_color', //give it an ID
      array(
		'transport' => 'postMessage',
        'default' => '#111111', // Give it a default
		'sanitize_callback' => 'sanitize_hex_color',
		'type' => 'option'

      )
	);
	$wp_customize->add_control(
     new WP_Customize_Color_Control(
         $wp_customize,
         'awqv_title_color', //give it an ID
         array(
             'label'      => __( 'Title Color', 'awqv' ), 
             'section'    => 'awqv_customizer_section',  
             'settings'   => 'awqv_title_color'
         )
    )
  );
  
  /** 
   ************** Description Color **************
  **/
	$wp_customize->add_setting(
      'awqv_desc_color', //give it an ID
      array(
		'transport' => 'postMessage',
        'default' => '#111111', // Give it a default
		'sanitize_callback' => 'sanitize_hex_color',
		'type' => 'option'
      )
	);
	$wp_customize->add_control(
     new WP_Customize_Color_Control(
         $wp_customize,
         'awqv_desc_color', //give it an ID
         array(
             'label'      => __( 'Description Color', 'awqv' ), 
             'section'    => 'awqv_customizer_section',  
             'settings'   => 'awqv_desc_color'
         )
    )
  ); 
  /** 
   ************** Meta Pruduct Color **************
  **/
	$wp_customize->add_setting(
      'awqv_product_meta_color', //give it an ID
      array(
		'transport' => 'postMessage',
        'default' => '#111111', // Give it a default
		'sanitize_callback' => 'sanitize_hex_color',
		'type' => 'option'
      )
	);
	$wp_customize->add_control(
     new WP_Customize_Color_Control(
         $wp_customize,
         'awqv_product_meta_color', //give it an ID
         array(
             'label'      => __( 'Pruduct Meta Color', 'awqv' ), 
             'section'    => 'awqv_customizer_section',  
             'settings'   => 'awqv_product_meta_color'
         )
    )
  );
  /** 
   ************** Meta Pruduct Link Color **************
  **/
	$wp_customize->add_setting(
      'awqv_product_meta_link_color', //give it an ID
      array(
		'transport' => 'postMessage',
        'default' => '#111111', // Give it a default
		'sanitize_callback' => 'sanitize_hex_color',
		'type' => 'option'
      )
	);
	$wp_customize->add_control(
     new WP_Customize_Color_Control(
         $wp_customize,
         'awqv_product_meta_link_color', //give it an ID
         array(
             'label'      => __( 'Pruduct Meta Link Color', 'awqv' ), 
             'section'    => 'awqv_customizer_section',  
             'settings'   => 'awqv_product_meta_link_color'
         )
    )
  );
   /** 
   ************** Price Color **************
  **/
	$wp_customize->add_setting(
      'awqv_product_price_color', //give it an ID
      array(
		'transport' => 'postMessage',
        'default' => '#111111', // Give it a default
		'sanitize_callback' => 'sanitize_hex_color',
		'type' => 'option'
      )
	);
	$wp_customize->add_control(
     new WP_Customize_Color_Control(
         $wp_customize,
         'awqv_product_price_color', //give it an ID
         array(
             'label'      => __( 'Pruduct Price Color', 'awqv' ), 
             'section'    => 'awqv_customizer_section',  
             'settings'   => 'awqv_product_price_color'
         )
    )
  );
  /** 
   ************** Review Color **************
  **/
	$wp_customize->add_setting(
      'awqv_product_review_color', //give it an ID
      array(
		'transport' => 'postMessage',
        'default' => '#111111', // Give it a default
		'sanitize_callback' => 'sanitize_hex_color',
		'type' => 'option'
      )
	);
	$wp_customize->add_control(
     new WP_Customize_Color_Control(
         $wp_customize,
         'awqv_product_review_color', //give it an ID
         array(
             'label'      => __( 'Pruduct Review Color', 'awqv' ), 
             'section'    => 'awqv_customizer_section',  
             'settings'   => 'awqv_product_review_color'
         )
    )
  );
	  /** 
	   ************** Quick View Button Label  **************
	  **/
	$wp_customize->add_setting( 'qv_button_label', array(
		  'transport' => 'postMessage',
		  'type' => 'option',
		  'default' => 'Quick View',
		  'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'qv_button_label', array(
		  'type' => 'text',
		  'section' => 'awqv_general_section', // Add a default or your own section
		  'label' => __( 'Quick View Button Label','awqv' ),
		  'priority' => 1,
	) );
	$wp_customize->add_setting( 'awqv_general_section', array(
    'default' => 'awqv-icon-cancel-3',
		'capability' => 'edit_theme_options',
		'type' => 'option',
		'transport'  => 'postMessage',
	));

	$wp_customize->add_control(new awqv_Customizer_Icon_Picker_Control($wp_customize, 'awqv_general_section', array(
		'label' => __('Quick View Button Icon', 'awqv'),
		'description' => __('Choose an icon', 'awqv'),
		'iconset' => 'awqv-icon',
		'section' => 'awqv_general_section',
		'priority' => 2,
		'settings' => 'awqv_general_section',
		'choices' => array(
			'default' 				=> __('Default', 'awqv'),
			'awqv-icon-eye'			=> __('awqv-icon-eye','awqv'),
			'awqv-icon-viewer'		=> __('awqv-icon-viewer','awqv'),
			'awqv-icon-file'		=> __('awqv-icon-file','awqv'),
			'awqv-icon-search'		=> __('awqv-icon-search','awqv'),
			'awqv-icon-eye-outline'	=> __('awqv-icon-eye-outline','awqv'),
		)
	)));
	
	$wp_customize->add_setting(
      'awqv_action_button_bg', //give it an ID
      array(
		'transport' => 'postMessage',
        'default' => '#111111', // Give it a default
		'sanitize_callback' => 'sanitize_hex_color',
		'type' => 'option'
      )
	);
	$wp_customize->add_control(
     new WP_Customize_Color_Control(
         $wp_customize,
         'awqv_action_button_bg', //give it an ID
         array(
             'label'      => __( 'Button Background', 'awqv' ), 
             'section'    => 'awqv_general_section',  
             'settings'   => 'awqv_action_button_bg'
         )
    )
  );
	
  /** 
	************** Close Icon Color ************** 
  **/
	
	$wp_customize->add_setting(
      'awqv_icon_color', //give it an ID
      array(
		'transport' => 'postMessage',
        'default' => '#111111', // Give it a default
		'sanitize_callback' => 'sanitize_hex_color',
		'type' => 'option'
      )
	);
	$wp_customize->add_control(
     new WP_Customize_Color_Control(
         $wp_customize,
         'awqv_icon_color', //give it an ID
         array(
             'label'      => __( 'Close Icon Color', 'awqv' ), 
             'section'    => 'awqv_icon_section',  
             'settings'   => 'awqv_icon_color'
         )
    )
  );
  	$wp_customize->add_setting( 'awqv_icon_picker', array(
    'default' => 'awqv-icon-cancel-3',
		'capability' => 'edit_theme_options',
		'type' => 'option',
		'transport'  => 'postMessage',
	));

	$wp_customize->add_control(new awqv_Customizer_Icon_Picker_Control($wp_customize, 'awqv_icon_picker', array(
		'label' => __('Close Icons', 'awqv'),
		'description' => __('Choose an icon', 'awqv'),
		'iconset' => 'awqv-icon',
		'section' => 'awqv_icon_section',
		'priority' => 5,
		'settings' => 'awqv_icon_picker',
		'choices' => array(
			'default' => 'Default',
			'awqv-icon-cancel-circled-outline' => __('Close-1','awqv'),
			'awqv-icon-cancel-outline' => __('Close-2','awqv'),
			'awqv-icon-cancel' => __('Close-3','awqv'),
			'awqv-icon-cancel-circled-1' => __('Close-4','awqv'),
			'awqv-icon-window-close' => __('Close-5','awqv'),
			'awqv-icon-close' => __('Close-6','awqv')
		)
	)));
	
	/** 
	************** Add to Cart Button ************** 
  **/
	$wp_customize->add_setting( 'btn_padding_top_bottom',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => '',
			'type' => 'option'
		)
	);
	$wp_customize->add_control( new Awqv_Slider_Custom_Control( $wp_customize, 'btn_padding_top_bottom',
		array(
			'label' => esc_html__( 'Padding Top/Bottom (px)' ),
			'type' => 'slider_control',
			'section' => 'awqv_add_to_cart_section',
			'settings' => 'btn_padding_top_bottom',
			'input_attrs' => array(
				'min'    => 5,
				'max'    => 100,
				'step'   => 1,
				'suffix' => 'px', //optional suffix
			),
		)
	) );
	$wp_customize->add_setting( 'btn_padding_left_right',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => '',
			'type' => 'option'
		)
	);
	$wp_customize->add_control( new Awqv_Slider_Custom_Control( $wp_customize, 'btn_padding_left_right',
		array(
			'label' => esc_html__( 'PADDING LEFT/RIGHT (px)' ),
			'type' => 'slider_control',
			'section' => 'awqv_add_to_cart_section',
			'settings' => 'btn_padding_left_right',
			'input_attrs' => array(
				'min'    => 10,
				'max'    => 100,
				'step'   => 1,
				'suffix' => 'px', //optional suffix
			),
		)
	) );
	$wp_customize->add_setting(
      'awqv_cart_button_bg', //give it an ID
      array(
		'transport' => 'postMessage',
        'default' => '#111111', // Give it a default
		'sanitize_callback' => 'sanitize_hex_color',
		'type' => 'option'

      )
	);
	$wp_customize->add_control(
     new WP_Customize_Color_Control(
         $wp_customize,
         'awqv_cart_button_bg', //give it an ID
         array(
             'label'      => __( 'Cart Button Background', 'awqv' ), 
             'section'    => 'awqv_add_to_cart_section',  
             'settings'   => 'awqv_cart_button_bg'
         )
    )
  );
   /** 
  **************  View Button **************
  **/
	$wp_customize->add_setting(
      'awqv_view_cart_button_bg', //give it an ID
      array(
		'transport' => 'postMessage',
        'default' => '#111111', // Give it a default
		'sanitize_callback' => 'sanitize_hex_color',
		'type' => 'option'

      )
	);
	$wp_customize->add_control(
     new WP_Customize_Color_Control(
         $wp_customize,
         'awqv_view_cart_button_bg', //give it an ID
         array(
             'label'      => __( 'View Cart Button', 'awqv' ), 
			 'description'=> __('View Cart Background', 'awqv'),
             'section'    => 'awqv_add_to_cart_section',
             'settings'   => 'awqv_view_cart_button_bg'
         )
    )
  );

}
add_action( 'customize_register', 'awqv_customize_register' );