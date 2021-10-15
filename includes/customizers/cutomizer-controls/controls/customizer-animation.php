<?php 
	$wp_customize->add_setting('pro_setting', array(
		'sanitize_callback' => 'sep_sanitize_html'
	));
	$wp_customize->add_control(new Awqv_Upsell_Inner_Section_Control($wp_customize, 
	   'pro_setting', array(
	   'settings' => 'pro_setting',
	   'section' => 'awqv_animation_section',
	   'label'   => 'Premium Controls',
	   'priority'   => 1,
	   'url' 		=> 'https://themesbyte.com/quick-viewer/?add-to-cart=3036',
	   'background'	=> '#22b147',
	)));

?>