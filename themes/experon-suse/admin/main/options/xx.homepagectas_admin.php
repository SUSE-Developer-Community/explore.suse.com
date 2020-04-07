<?php

function thinkup_customizer_theme_options_homepage( $wp_customize ) {

	//----------------------------------------------------
	// 2.2. Homepage CTAs
	//----------------------------------------------------

	// Add CTA Left Section Control
	$wp_customize->add_setting(
		'thinkup_redux_variables[thinkup_section_homepage_ctaleft]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		new thinkup_customizer_customcontrol_section(
			$wp_customize,
			'thinkup_section_homepage_ctaleft',
			array(
				'settings'        => 'thinkup_redux_variables[thinkup_section_homepage_ctaleft]',
				'section'         => 'thinkup_customizer_section_homepagectas',
				'label'           => __( 'Call To Action - Left', 'experon' ),
				'active_callback' => '',
			)
		)
	);

	// Add Homepage - Intro Control
	$wp_customize->add_setting(
		'thinkup_redux_variables[thinkup_homepage_ctaleft_switch]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'thinkup_customizer_callback_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'thinkup_homepage_ctaleft_switch',
		array(
			'settings'		  => 'thinkup_redux_variables[thinkup_homepage_ctaleft_switch]',
			'section'		  => 'thinkup_customizer_section_homepagectas',
			'type'			  => 'checkbox',
			'label'			  => __( 'Message', 'experon' ),
			'description'	  => __( 'Check to enable the left side CTA block on home page.', 'experon' ),
			'active_callback' => '',
		)
	);

	// Add Badge
	$wp_customize->add_setting(
		'thinkup_redux_variables[thinkup_homepage_ctaleft_badge][url]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'thinkup_homepage_ctaleft_badge',
			array(
				'section'         => 'thinkup_customizer_section_homepagectas',
				'settings'        => 'thinkup_redux_variables[thinkup_homepage_ctaleft_badge][url]',
				'label'	          => __( '', 'experon' ),
				'description'	  => __( 'Add a badge (image) to the top left corner of the CTA block. Max size: 100 x 50 px', 'experon' ),
				'active_callback' => '',
			)
		)
	);

	// Add Homepage - Intro Title Control
	$wp_customize->add_setting(
		'thinkup_redux_variables[thinkup_homepage_ctaleft_action]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'thinkup_homepage_ctaleft_action',
		array(
			'settings'		  => 'thinkup_redux_variables[thinkup_homepage_ctaleft_action]',
			'section'		  => 'thinkup_customizer_section_homepagectas',
			'type'			  => 'text',
			'description'	  => __( 'Enter a <strong>title</strong> message.<br /><br />This will be one of the first messages your visitors see. Use this to get their attention.', 'experon' ),
			'active_callback' => '',
		)
	);

	// Add Background Image 
	$wp_customize->add_setting(
		'thinkup_redux_variables[thinkup_homepage_ctaleft_image][url]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'thinkup_homepage_ctaleft_image',
			array(
				'section'         => 'thinkup_customizer_section_homepagectas',
				'settings'        => 'thinkup_redux_variables[thinkup_homepage_ctaleft_image][url]',
				'label'	          => __( '', 'experon' ),
				'description'	  => __( 'Add a background image to the CTA block.', 'experon' ),
				'active_callback' => '',
			)
		)
	);

	// Add Homepage - CTA Left Teaser Control
	$wp_customize->add_setting(
		'thinkup_redux_variables[thinkup_homepage_ctaleft_actionteaser]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'thinkup_homepage_ctaleft_actionteaser',
		array(
			'settings'		  => 'thinkup_redux_variables[thinkup_homepage_ctaleft_actionteaser]',
			'section'		  => 'thinkup_customizer_section_homepagectas',
			'type'			  => 'text',
			'description'	  => __( 'Enter a <strong>teaser</strong> message.<br /><br />Use this to provide more details about what you offer.', 'experon' ),
			'active_callback' => '',
		)
	);

	// Add Homepage - CTA Left Button Control
	$wp_customize->add_setting(
		'thinkup_redux_variables[thinkup_homepage_ctaleft_actiontext1]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'thinkup_homepage_ctaleft_actiontext1',
		array(
			'settings'		  => 'thinkup_redux_variables[thinkup_homepage_ctaleft_actiontext1]',
			'section'		  => 'thinkup_customizer_section_homepagectas',
			'type'			  => 'text',
			'label'			  => __( 'Button - Text', 'experon' ),
			'description'	  => __( 'Specify a text for button 1.', 'experon' ),
			'active_callback' => '',
		)
	);

	// Add Homepage - CTA Left Link Control
	$wp_customize->add_setting(
		'thinkup_redux_variables[thinkup_homepage_ctaleft_actionlink1]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_key',
		)
	);
	$wp_customize->add_control(
		'thinkup_homepage_ctaleft_actionlink1',
		array(
			'settings'		  => 'thinkup_redux_variables[thinkup_homepage_ctaleft_actionlink1]',
			'section'		  => 'thinkup_customizer_section_homepagectas',
			'type'			  => 'radio',
			'label'			  => __( 'Button - Link', 'experon' ),
			'description'	  => __( 'Specify whether the action button should link to a page on your site, out to external webpage or disable the link altogether.', 'experon' ),
			'choices'		  => array(
				'option1' => __( 'Link to a Page', 'experon' ),
				'option2' => __( 'Specify Custom link', 'experon' ),
				'option3' => __( 'Disable Link', 'experon' ),
			),
			'active_callback' => '',
		)
	);

	// Add Homepage - CTA Left Page Control
	$wp_customize->add_setting(
		'thinkup_redux_variables[thinkup_homepage_ctaleft_actionpage1]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'thinkup_customizer_callback_sanitize_dropdown_pages',
		)
	);
	$wp_customize->add_control(
		'thinkup_homepage_ctaleft_actionpage1',
		array(
			'settings'		  => 'thinkup_redux_variables[thinkup_homepage_ctaleft_actionpage1]',
			'section'		  => 'thinkup_customizer_section_homepagectas',
			'type'			  => 'dropdown-pages',
			'label'			  => __( 'Button - Link to a page', 'experon' ),
			'description'	  => __( 'Select a target page for action button link.', 'experon' ),
			'active_callback' => 'thinkup_customizer_callback_active_global',
		)
	);

	// Add Homepage - CTA Left Custom Control
	$wp_customize->add_setting(
		'thinkup_redux_variables[thinkup_homepage_ctaleft_actioncustom1]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'thinkup_homepage_ctaleft_actioncustom1',
		array(
			'settings'		  => 'thinkup_redux_variables[thinkup_homepage_ctaleft_actioncustom1]',
			'section'		  => 'thinkup_customizer_section_homepagectas',
			'type'			  => 'text',
			'label'			  => __( 'Button - Custom link', 'experon' ),
			'description'	  => __( 'Input a custom url for the action button link.<br>Add http:// if linking to an external webpage.', 'experon' ),
			'active_callback' => 'thinkup_customizer_callback_active_global',
		)
	);

	// Add CTA Right Section Control
	$wp_customize->add_setting(
		'thinkup_redux_variables[thinkup_section_homepage_ctaright]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		new thinkup_customizer_customcontrol_section(
			$wp_customize,
			'thinkup_section_homepage_ctaright',
			array(
				'settings'        => 'thinkup_redux_variables[thinkup_section_homepage_ctaright]',
				'section'         => 'thinkup_customizer_section_homepagectas',
				'label'           => __( 'Call To Action - Right', 'experon' ),
				'active_callback' => '',
			)
		)
	);

	// Add Homepage - CTA Right Control
	$wp_customize->add_setting(
		'thinkup_redux_variables[thinkup_homepage_ctaright_switch]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'thinkup_customizer_callback_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'thinkup_homepage_ctaright_switch',
		array(
			'settings'		  => 'thinkup_redux_variables[thinkup_homepage_ctaright_switch]',
			'section'		  => 'thinkup_customizer_section_homepagectas',
			'type'			  => 'checkbox',
			'label'			  => __( 'Message', 'experon' ),
			'description'	  => __( 'Check to enable the right side CTA block on home page.', 'experon' ),
			'active_callback' => '',
		)
	);

	// Add Badge
	$wp_customize->add_setting(
		'thinkup_redux_variables[thinkup_homepage_ctaright_badge][url]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'thinkup_homepage_ctaright_badge',
			array(
				'section'         => 'thinkup_customizer_section_homepagectas',
				'settings'        => 'thinkup_redux_variables[thinkup_homepage_ctaright_badge][url]',
				'label'	          => __( '', 'experon' ),
				'description'	  => __( 'Add a badge (image) to the top left corner of the CTA block. Max size: 100 x 50 px', 'experon' ),
				'active_callback' => '',
			)
		)
	);


	// Add Homepage - CTA Right Title Control
	$wp_customize->add_setting(
		'thinkup_redux_variables[thinkup_homepage_ctaright_action]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'thinkup_homepage_ctaright_action',
		array(
			'settings'		  => 'thinkup_redux_variables[thinkup_homepage_ctaright_action]',
			'section'		  => 'thinkup_customizer_section_homepagectas',
			'type'			  => 'text',
			'description'	  => __( 'Enter a <strong>title</strong> message.<br /><br />This will be one of the first messages your visitors see. Use this to get their attention.', 'experon' ),
			'active_callback' => '',
		)
	);

	// Add Image 
	$wp_customize->add_setting(
		'thinkup_redux_variables[thinkup_homepage_ctaright_image][url]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'thinkup_homepage_ctaright_image',
			array(
				'section'         => 'thinkup_customizer_section_homepagectas',
				'settings'        => 'thinkup_redux_variables[thinkup_homepage_ctaright_image][url]',
				'label'	          => __( '', 'experon' ),
				'description'	  => __( 'Add a background image to the CTA block.', 'experon' ),
				'active_callback' => '',
			)
		)
	);

	// Add Homepage - CTA Right Teaser Control
	$wp_customize->add_setting(
		'thinkup_redux_variables[thinkup_homepage_ctaright_actionteaser]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'thinkup_homepage_ctaright_actionteaser',
		array(
			'settings'		  => 'thinkup_redux_variables[thinkup_homepage_ctaright_actionteaser]',
			'section'		  => 'thinkup_customizer_section_homepagectas',
			'type'			  => 'text',
			'description'	  => __( 'Enter a <strong>teaser</strong> message.<br /><br />Use this to provide more details about what you offer.', 'experon' ),
			'active_callback' => '',
		)
	);

	// Add Homepage - CTA Right Button Control
	$wp_customize->add_setting(
		'thinkup_redux_variables[thinkup_homepage_ctaright_actiontext1]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'thinkup_homepage_ctaright_actiontext1',
		array(
			'settings'		  => 'thinkup_redux_variables[thinkup_homepage_ctaright_actiontext1]',
			'section'		  => 'thinkup_customizer_section_homepagectas',
			'type'			  => 'text',
			'label'			  => __( 'Button - Text', 'experon' ),
			'description'	  => __( 'Specify a text for button 1.', 'experon' ),
			'active_callback' => '',
		)
	);

	// Add Homepage - CTA Right Link Control
	$wp_customize->add_setting(
		'thinkup_redux_variables[thinkup_homepage_ctaright_actionlink1]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_key',
		)
	);
	$wp_customize->add_control(
		'thinkup_homepage_ctaright_actionlink1',
		array(
			'settings'		  => 'thinkup_redux_variables[thinkup_homepage_ctaright_actionlink1]',
			'section'		  => 'thinkup_customizer_section_homepagectas',
			'type'			  => 'radio',
			'label'			  => __( 'Button - Link', 'experon' ),
			'description'	  => __( 'Specify whether the action button should link to a page on your site, out to external webpage or disable the link altogether.', 'experon' ),
			'choices'		  => array(
				'option1' => __( 'Link to a Page', 'experon' ),
				'option2' => __( 'Specify Custom link', 'experon' ),
				'option3' => __( 'Disable Link', 'experon' ),
			),
			'active_callback' => '',
		)
	);

	// Add Homepage - CTA Right Page Control
	$wp_customize->add_setting(
		'thinkup_redux_variables[thinkup_homepage_ctaright_actionpage1]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'thinkup_customizer_callback_sanitize_dropdown_pages',
		)
	);
	$wp_customize->add_control(
		'thinkup_homepage_ctaright_actionpage1',
		array(
			'settings'		  => 'thinkup_redux_variables[thinkup_homepage_ctaright_actionpage1]',
			'section'		  => 'thinkup_customizer_section_homepagectas',
			'type'			  => 'dropdown-pages',
			'label'			  => __( 'Button - Link to a page', 'experon' ),
			'description'	  => __( 'Select a target page for action button link.', 'experon' ),
			'active_callback' => 'thinkup_customizer_callback_active_global',
		)
	);

	// Add Homepage - CTA Right Custom Control
	$wp_customize->add_setting(
		'thinkup_redux_variables[thinkup_homepage_ctaright_actioncustom1]',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'thinkup_homepage_ctaright_actioncustom1',
		array(
			'settings'		  => 'thinkup_redux_variables[thinkup_homepage_ctaright_actioncustom1]',
			'section'		  => 'thinkup_customizer_section_homepagectas',
			'type'			  => 'text',
			'label'			  => __( 'Button - Custom link', 'experon' ),
			'description'	  => __( 'Input a custom url for the action button link.<br>Add http:// if linking to an external webpage.', 'experon' ),
			'active_callback' => 'thinkup_customizer_callback_active_global',
		)
	);
}
add_action( 'customize_register' , 'thinkup_customizer_theme_options_homepage' );

?>