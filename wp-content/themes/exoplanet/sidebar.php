<?php
/**
 * The sidebar containing the main widget area
 *
 * @package Exoplanet
 */

if ( is_home() || is_archive() || is_search() ) {
	$exoplanet_sidebar_layout = get_theme_mod( 'blog_layout', 'right_sidebar' );
} else {
	$exoplanet_sidebar_layout = get_post_meta( $post->ID, 'exoplanet_sidebar_layout', true );
}

if(!$exoplanet_sidebar_layout){
	$exoplanet_sidebar_layout = 'right_sidebar';
}

if ( $exoplanet_sidebar_layout == "no_sidebar" || $exoplanet_sidebar_layout == "no_sidebar_condensed" ) {
	return;
}

if( is_active_sidebar('exoplanet-right-sidebar') &&  $exoplanet_sidebar_layout == "right_sidebar" ){
	?>
	<div id="secondary" class="widget-area">
		<?php dynamic_sidebar('exoplanet-right-sidebar'); ?>
	</div><!-- #secondary -->
	<?php
}

if( is_active_sidebar('exoplanet-left-sidebar') &&  $exoplanet_sidebar_layout == "left_sidebar" ){
	?>
	<div id="secondary" class="widget-area">
		<?php dynamic_sidebar('exoplanet-left-sidebar'); ?>
	</div><!-- #secondary -->
	<?php
}