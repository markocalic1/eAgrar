<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
/**
 * Set up the WordPress core custom header feature.
 *
 * @uses corporately_blogging_header_style()
 */
function corporately_blogging_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'corporately_blogging_custom_header_args', array(
		'default-image'			=> get_theme_file_uri( '/images/bg-img.png' ),
		'default-text-color'     => 'fff',
		'width'                  => 1600,
		'height'                 => 500,
		'flex-height'            => true,
		'flex-width'	         => true,
		'wp-head-callback'       => 'corporately_blogging_header_style',
	) ) );
 
	register_default_headers( array(
		'header-bg' => array(
			'url'           => get_theme_file_uri( '/images/bg-img.png' ),
			'thumbnail_url' => get_theme_file_uri( '/images/bg-img.png' ),
			'description'   => _x( 'Default', 'Default header image', 'corporately-blogging' )
			),	
	
	) );

}
add_action( 'after_setup_theme', 'corporately_blogging_custom_header_setup' );

if ( ! function_exists( 'corporately_blogging_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see corporately_blogging_custom_header_setup().
 */
function corporately_blogging_header_style() {
	$header_text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail
        if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // corporately_blogging_header_style