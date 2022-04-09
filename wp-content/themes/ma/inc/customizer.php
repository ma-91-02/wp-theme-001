<?php

/**
 * Your MA Theme Customizer
 *
 * @package Your_MA
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function ma_customize_register($wp_customize)
{
	$wp_customize->get_setting('blogname')->transport         = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
	$wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

	if (isset($wp_customize->selective_refresh)) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'ma_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'ma_customize_partial_blogdescription',
			)
		);
	}
	/**
	 * Site Header Links color
	 */
	$wp_customize->add_setting(
		'header_links_color',
		array(
			'default'           => '#fff',
			'type'				=> 'theme_mod',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(new WP_Customize_Color_Control(
		$wp_customize,
		'header_links_color',
		array(

			'label'    => __('Header Links Color', 'ma'),
			'section'  => 'colors',
			'settings' => 'header_links_color'

		)
	));
	/**
	 * Site Content Links color
	 */
	$wp_customize->add_setting(
		'content_links_color',
		array(
			'default'           => '#616571',
			'type'				=> 'theme_mod',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(new WP_Customize_Color_Control(
		$wp_customize,
		'content_links_color',
		array(

			'label'    => __('Content Links Color', 'ma'),
			'section'  => 'colors',
			'settings' => 'content_links_color'

		)
	));
	/**
	 * Site header color
	 */
	$wp_customize->add_setting(
		'header_bg_color',
		array(
			'default'           => '#616571',
			'type'				=> 'theme_mod',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);
	$wp_customize->add_control(new WP_Customize_Color_Control(
		$wp_customize,
		'header_bg_color',
		array(

			'label'    => __('Header Color', 'ma'),
			'section'  => 'colors',
			'settings' => 'header_bg_color'
		)
	));
	/**
	 * Site footer color
	 */
	$wp_customize->add_setting(
		'footer_bg_color',
		array(
			'default'           => '#616571',
			'type'				=> 'theme_mod',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(new WP_Customize_Color_Control(
		$wp_customize,
		'footer_bg_color',
		array(

			'label'    => __('Footer Color', 'ma'),
			'section'  => 'colors',
			'settings' => 'footer_bg_color'
		)
	));
	/**
	 * Site footer text
	 */
	$wp_customize->add_panel('site_footer_panel', array(
		'priority'       => 500,
		'title'          => __('Site Footer', 'ma'),
	));

	$wp_customize->add_section(
		'footer_copyright_text',
		array(
			'title'      => __('ma Footer Text', 'ma'),
			'panel'    => 'site_footer_panel',
			'priority'   => 1,
		)
	);
	$wp_customize->add_setting(
		'footer_text',
		array(
			'transport'         => 'postMessage',
			'default'           	=> 'ma © |  All Rights Reserved',
			'sanitize_callback' 	=> 'sanitize_text',
		)
	);
	$wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		'footer_text',
		array(
			'label'    => __('Footer Text: ', 'ma'),
			'type'     => 'textarea',
			'section'  => 'footer_copyright_text',
			'settings' => 'footer_text'
		)
	));
	// Sanitize text
	function sanitize_text($text)
	{
		return wp_kses($text, array(
			'a' => array(
				'href' => array(),
				'title' => array()
			)
		));
	}
}
add_action('customize_register', 'ma_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function ma_customize_partial_blogname()
{
	bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function ma_customize_partial_blogdescription()
{
	bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function ma_customize_preview_js()
{
	wp_enqueue_script('ma-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), _S_VERSION, true);
}
add_action('customize_preview_init', 'ma_customize_preview_js');
