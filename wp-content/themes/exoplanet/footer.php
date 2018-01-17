<?php
/**
 * The template for displaying the footer
 *
 * @package Exoplanet
 */

?>

	</div><!-- #content -->
<?php
if ( ! is_front_page() ) {
$exoplanet_page_template = basename( get_page_template() );
if ( $exoplanet_page_template == 'page-features-cta.php' || $exoplanet_page_template == 'page-cta.php' ) {
	$cta_link = get_theme_mod('cta_link');
	if ( $cta_link ) {
	$cta_button = get_theme_mod('cta_button', esc_html__( 'Read More', 'exoplanet' ));
?>
<section id="cta-section" class="section">
	<div class="container clearfix">
		<div class="cta-left">
			<p><span class="leadin"><?php echo get_the_title($cta_link); ?></span></p>
			<?php
			$cta_excerpt = get_post($cta_link)->post_excerpt;
			if ( $cta_excerpt != '' ) {
				echo '<p>'.esc_html( $cta_excerpt ).'</p>';
			}
			?>
		</div>
		<div class="cta-right">
		<a href="<?php echo esc_url( get_permalink( $cta_link ) ); ?>"><?php echo esc_html( $cta_button ); ?></a>
		</div>
	</div>
</section>
<?php }
}
}
?>

	<footer id="colophon" class="site-footer">
		<?php if(is_active_sidebar('exoplanet-footer1') || is_active_sidebar('exoplanet-footer2') || is_active_sidebar('exoplanet-footer3') || is_active_sidebar('exoplanet-footer4') ): ?>
		<div id="top-footer">
			<div class="container">
				<div class="top-footer clearfix">
					<div class="footer footer1">
						<?php if(is_active_sidebar('exoplanet-footer1')): 
							dynamic_sidebar('exoplanet-footer1');
						endif;
						?>	
					</div>

					<div class="footer footer2">
						<?php if(is_active_sidebar('exoplanet-footer2')): 
							dynamic_sidebar('exoplanet-footer2');
						endif;
						?>	
					</div>

					<div class="footer footer3">
						<?php if(is_active_sidebar('exoplanet-footer3')): 
							dynamic_sidebar('exoplanet-footer3');
						endif;
						?>	
					</div>

					<div class="footer footer4">
						<?php if(is_active_sidebar('exoplanet-footer4')): 
							dynamic_sidebar('exoplanet-footer4');
						endif;
						?>	
					</div>
				</div>
			</div>
		</div>
		<?php endif; ?>

		<?php if(is_active_sidebar('exoplanet-about-footer')): ?>
		<div id="middle-footer">
			<div class="container">
				<?php 
					dynamic_sidebar('exoplanet-about-footer');
				?>
			</div>
		</div>
		<?php endif; ?>

		<div id="bottom-footer">
			<div class="container clearfix">
				<div class="site-info">
					<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'exoplanet' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'exoplanet' ), 'WordPress' ); ?></a>
					<span class="sep"> | </span>
					<?php printf( esc_html__( 'Theme: %2$s by %1$s', 'exoplanet' ), 'uXL Themes', '<a href="https://uxlthemes.com/theme/exoplanet/" rel="designer">Exoplanet</a>'); ?>
				</div>

				<?php wp_nav_menu( array( 
                'theme_location' => 'footer',
                'container_id' => 'footer-menu',
                'menu_id' => 'footer-menu', 
                'menu_class' => 'exoplanet-footer-nav',
                'depth' => 1,
                'fallback_cb' => '',
				) ); ?>

			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
