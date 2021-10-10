<?php
	$wp_customize->add_setting('inner_link_setting', array(
		'sanitize_callback' => 'sep_sanitize_html'
	));
	$wp_customize->add_control(new Awqv_Upsell_Inner_Section_Control($wp_customize, 
	   'inner_link_setting', array(
	   'settings' => 'inner_link_setting',
	   'section' => 'awqv_slider_section',
	   'label'   => 'Premium Controls',
	   'priority'   => 1,
	   'url' 		=> '#',
	   'background'	=> '#2bd420',
	)));
 ?>