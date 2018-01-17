<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * @package Exoplanet
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses exoplanet_header_style()
 * @uses exoplanet_admin_header_image()
 */
function exoplanet_custom_header_setup() {

	register_default_headers( array(
		'bridge' => array(
			'url'           => '%s/images/exoplanet-header.jpg',
			'thumbnail_url' => '%s/images/exoplanet-header-thumbnail.jpg',
			'description'   => esc_html__( 'Bridge', 'exoplanet' )
		)
	) );

	add_theme_support('custom-header', apply_filters('exoplanet_custom_header_args', array(
		'default-image'			=> get_template_directory_uri().'/images/exoplanet-header.jpg',
		'default-text-color'	=> 'ffffff',
		'header_text'			=> true,
		'width'					=> 1600,
		'height'				=> 333,
		'flex-height'			=> false,
		'flex-width'			=> false,
		'wp-head-callback'		=> 'exoplanet_header_style',
	) ) );
}
add_action('after_setup_theme', 'exoplanet_custom_header_setup');

if ( ! function_exists('exoplanet_header_style') ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see exoplanet_custom_header_setup().
 */
function exoplanet_header_style() {
	$header_text_color = get_header_textcolor();
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-title a,
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
endif; // exoplanet_header_style