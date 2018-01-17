<?php
/**
 * The template for displaying search results pages
 *
 * @package Exoplanet
 */

get_header();
$page_header_position = get_theme_mod('page_header_position','header');
if ($page_header_position == "content") {
?>
<header class="main-header">
</header>
<div class="container">
	<div class="title-header">
		<h1 class="main-title"><?php printf( esc_html__( 'Search Results for: %s', 'exoplanet' ), '<span>' . get_search_query() . '</span>'); ?></h1>
	</div>
<?php
} else {
?>
<header class="main-header">
	<div class="container">
		<div class="header-title">
			<h1 class="main-title"><?php printf( esc_html__( 'Search Results for: %s', 'exoplanet' ), '<span>' . get_search_query() . '</span>'); ?></h1>
		</div>
	</div>
</header><!-- .entry-header -->
<div class="container">
<?php
}
?>
	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part('template-parts/content', 'search');
				?>

			<?php endwhile; ?>

			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part('template-parts/content', 'none'); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
