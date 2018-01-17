<?php

/* * *
 * Theme help
 *
 * Adds a simple Theme help page to the Appearance section of the WordPress Dashboard.
 *
 */

// Add Theme help page to admin menu.
add_action( 'admin_menu', 'exoplanet_add_theme_help_page' );

function exoplanet_add_theme_help_page() {

	// Get Theme Details from style.css
	$theme = wp_get_theme();

	add_theme_page(
		sprintf( esc_html__( 'Welcome to %1$s %2$s', 'exoplanet' ), $theme->get( 'Name' ), $theme->get( 'Version' ) ), esc_html__( 'Theme Help', 'exoplanet' ), 'edit_theme_options', 'exoplanet', 'exoplanet_display_theme_help_page'
	);
}

// Display Theme help page.
function exoplanet_display_theme_help_page() {

	// Get Theme Details from style.css.
	$theme = wp_get_theme();
	?>

	<div class="wrap theme-help-wrap">

		<h1><?php printf( esc_html__( 'Welcome to %1$s %2$s', 'exoplanet' ), $theme->get( 'Name' ), $theme->get( 'Version' ) ); ?></h1>

		<div class="theme-description"><?php echo esc_html( $theme->get( 'Description' ) ); ?></div>

		<hr>
		<div class="important-links clearfix">
			<p><strong><?php esc_html_e( 'Theme Links', 'exoplanet' ); ?>:</strong>
				<a href="<?php echo esc_url( 'http://uxlthemes.com/theme/exoplanet/' ); ?>" target="_blank"><?php esc_html_e( 'Theme Page', 'exoplanet' ); ?></a>
				<a href="<?php echo esc_url( 'http://uxlthemes.com/demo/?demo=exoplanet' ); ?>" target="_blank"><?php esc_html_e( 'Theme Demo', 'exoplanet' ); ?></a>
				<a href="<?php echo esc_url( 'http://uxlthemes.com/docs/exoplanet-theme/' ); ?>" target="_blank"><?php esc_html_e( 'Theme Documentation', 'exoplanet' ); ?></a>
				<a href="<?php echo esc_url( 'http://uxlthemes.com/forums/forum/exoplanet/' ); ?>" target="_blank"><?php esc_html_e( 'Theme Support', 'exoplanet' ); ?></a>
				<a href="<?php echo esc_url( 'http://wordpress.org/support/theme/exoplanet/reviews/?filter=5' ); ?>" target="_blank"><?php esc_html_e( 'Rate this theme', 'exoplanet' ); ?></a>
			</p>
		</div>
		<hr>

		<div id="getting-started">

			<h3><?php printf( esc_html__( 'Getting Started with %s', 'exoplanet' ), $theme->get( 'Name' ) ); ?></h3>

			<div class="columns-wrapper clearfix">

				<div class="column column-half clearfix">

					<div class="section">
						<h4><?php esc_html_e( 'Theme Documentation', 'exoplanet' ); ?></h4>

						<p class="about">
							<?php esc_html_e( 'Do you need help to setup, configure and configure this theme? Check out the extensive theme documentation on our website.', 'exoplanet' ); ?>
						</p>
						<p>
							<a href="<?php echo esc_url( 'http://uxlthemes.com/docs/exoplanet-theme/' ); ?>" target="_blank" class="button button-secondary">
								<?php printf( esc_html__( 'View %s Documentation', 'exoplanet' ), 'Exoplanet' ); ?>
							</a>
						</p>
					</div>

					<div class="section">
						<h4><?php esc_html_e( 'Theme Options', 'exoplanet' ); ?></h4>

						<p class="about">
							<?php printf( esc_html__( '%s makes use of the Customizer for the theme settings.', 'exoplanet' ), $theme->get( 'Name' ) ); ?>
						</p>
						<p>
							<a href="<?php echo wp_customize_url(); ?>" class="button button-primary">
								<?php esc_html_e( 'Customize Theme', 'exoplanet' ); ?>
							</a>
						</p>
					</div>

				</div>

				<div class="column column-half clearfix">

					<img src="<?php echo get_template_directory_uri(); ?>/screenshot.png" />

				</div>

			</div>

		</div>

		<hr>

		<div id="theme-author">

			<p>
				<?php printf( esc_html__( '%1$s is proudly brought to you by %2$s. If you like this theme, %3$s :)', 'exoplanet' ), $theme->get( 'Name' ), '<a target="_blank" href="http://uxlthemes.com/" title="uXL Themes">uXL Themes</a>', '<a target="_blank" href="http://wordpress.org/support/theme/exoplanet/reviews/?filter=5" title="' . esc_html__( 'Exoplanet Review', 'exoplanet' ) . '">' . esc_html__( 'rate it', 'exoplanet' ) . '</a>' ); ?>
			</p>

		</div>

	</div>

	<?php
}

// Add CSS for Theme help Panel.
add_action( 'admin_enqueue_scripts', 'exoplanet_theme_help_page_css' );

function exoplanet_theme_help_page_css( $hook ) {

	// Load styles and scripts only on theme help page.
	if ( 'appearance_page_exoplanet' != $hook ) {
		return;
	}

	// Embed theme help css style.
	wp_enqueue_style( 'exoplanet-theme-help-css', get_template_directory_uri() . '/css/theme-help.css' );
}
