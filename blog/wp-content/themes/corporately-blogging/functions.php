<?php 
// Parent styles
add_action( 'wp_enqueue_scripts', 'corporately_blogging_enqueue_styles' );
function corporately_blogging_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' ); 
} 


// Updated foundation CSS
function corporately_blogging_foundation_enqueue() {
	wp_enqueue_style( 'foundation', get_stylesheet_directory_uri() . '/assets/foundation/css/foundation.css' );
}

add_action( 'wp_enqueue_scripts', 'corporately_blogging_foundation_enqueue' );



// Header changes
require get_stylesheet_directory() . '/inc/custom-header.php';



// Sidebar positioning / hide sidebar
function corporately_blogging_customize_register( $wp_customize ) { 
	$wp_customize->add_section(
		'sidebar_settings',
		array(
			'title' => __('Sidebar ', 'corporately-blogging'),
			'description' => __('Customizer preview is not working, please view your site after publishing to see the correct output.', 'corporately-blogging'),
			'priority' => 99,
			)
		);  
	$wp_customize->add_section( 'corporately-blogging-options', array(
		'title'         => __( 'Theme Options', 'corporately-blogging' ),
		'capability'    => 'edit_theme_options',
		'description'   => __( 'Change the default display options for the theme.', 'corporately-blogging' ),
		) );
	$wp_customize->add_setting( 'layout_setting',
		array(
			'default'           => 'sidebar-right',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'corporately-blogging_sanitize_layout',
			'transport'         => 'postMessage'
			) );
	$wp_customize->add_control( 'layout_control',
		array(
			'settings'          => 'layout_setting',
			'type'              => 'radio',
			'label'             => __( 'Sidebar position', 'corporately-blogging' ),
			'choices'           => array(
				'no-sidebar'    => __( 'No sidebar', 'corporately-blogging' ),
				'sidebar-right' => __( 'Sidebar right', 'corporately-blogging' ),
				'sidebar-left'  => __( 'Sidebar left', 'corporately-blogging' ),
				),
			'section'           => 'sidebar_settings'
			) );
}
add_action( 'customize_register', 'corporately_blogging_customize_register' );
