<?php
if ('page' == get_option('show_on_front') ) {
get_template_part('template-parts/home');
}else{
get_header();
?>
<header class="main-header">
</header><!-- .entry-header -->

<div class="container">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part('template-parts/content'); ?>

			<?php endwhile; ?>

			<?php the_posts_pagination(); ?>

		<?php else : ?>

			<?php get_template_part('template-parts/content', 'none'); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
</div>

<?php
}
get_footer(); ?>