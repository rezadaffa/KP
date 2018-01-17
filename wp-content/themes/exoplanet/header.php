<?php
/**
 * The theme header.
 *
 * @package Exoplanet
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page">
	<header id="masthead" class="site-header">
		<div class="container clearfix">
			<div id="site-branding">
				<?php the_custom_logo() ;?>
					<?php if ( is_front_page() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url('/') ); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url('/') ); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
					<?php endif; ?>
					<p class="site-description"><?php bloginfo('description'); ?></p>
			</div><!-- #site-branding -->

			<div class="toggle-nav">
				<span></span>
			</div>
			
			<nav id="site-navigation" class="main-navigation">
				<?php 
				wp_nav_menu( array( 
					'theme_location' => 'primary', 
					'container_class' => 'menu clearfix' ,
					'menu_class' => 'clearfix',
					'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'fallback_cb' => 'exoplanet_primary_menu_fallback',
				) ); 
				?>
			</nav><!-- #site-navigation -->

	        <a href="#x" class="exoplanet-overlay" id="search"></a>
	        <div class="exoplanet-modal">
				<?php get_search_form(); ?>
	            <a class="fa fa-close" href="#close"></a>
	        </div>

		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content clearfix">
<header class="custom-post-type-header">
</header>