<?php
/**
 * The sidebar containing the main widget area
 *
 * @package Exoplanet
 */

if ( ! is_active_sidebar('exoplanet-shop-sidebar') ) {
	return;
}
?>

<div id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar('exoplanet-shop-sidebar'); ?>
</div><!-- #secondary -->
