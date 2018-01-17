<?php
/**
 * Template Name: Featured Services & Content
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
		<?php 
		the_title('<h1 class="main-title">', '</h1>'); 
		$enable_bread = get_theme_mod('enable_bread', true);
		if ($enable_bread) {
			exoplanet_breadcrumb_trail();
		}
		?>
	</div>
</div>
<?php
} else {
?>
<header class="main-header">
	<div class="container">
		<div class="header-title">
			<?php 
			the_title('<h1 class="main-title">', '</h1>'); 
			$enable_bread = get_theme_mod('enable_bread', true);
			if ($enable_bread) {
				exoplanet_breadcrumb_trail();
			}
			?>
		</div>
	</div>
</header><!-- .entry-header -->
<?php
}

$enable_featured_link = get_theme_mod('enable_featured_link', true);
?>
<section id="featured-post-section" class="section">
	<div class="container">
	<?php $featured_title = get_theme_mod('featured_title');
		if ( $featured_title ) {
	?>
		<div class="featured-section-title">
			<span><?php echo esc_html( $featured_title );?></span>
		</div>
	<?php
		}
	?>
		<div class="featured-post-wrap clearfix">
			<?php
			$featured_page_link1 = get_theme_mod('featured_page_link1');
			if (!$featured_page_link1) {
			 	# display latest posts
				$exoplanet_recent_args = array(
					'numberposts' => '4',
					'orderby' => 'post_date',
					'order' => 'DESC',
					'post_type' => 'post',
					'post_status' => 'publish',
					);
				$recent_posts = wp_get_recent_posts( $exoplanet_recent_args );
				$featured_post_number = 1;
				foreach( $recent_posts as $recent ){
					$featured_page_icon = get_theme_mod('featured_page_icon'.$featured_post_number, 'fa fa-check');
					?>
					<div class="featured-post featured-post<?php echo $featured_post_number; ?>">
						<a href="<?php echo esc_url( get_permalink( $recent["ID"] ) ); ?>"><span class="featured-icon"><i class="<?php echo esc_attr( $featured_page_icon ); ?>"></i></span>
						<h4><?php echo get_the_title($recent["ID"]); ?></h4></a>
						<div class="featured-excerpt">
						<?php
						//$featured_page_excerpt = get_the_excerpt($recent["ID"]);//doesn't work as expected because if excerpt is empty it defaults to current page excerpt then current page content
						$featured_page_excerpt = apply_filters('the_excerpt', get_post_field('post_excerpt', $recent["ID"]));
						if ('' != $featured_page_excerpt) {
							echo $featured_page_excerpt;
						} else {
							$featured_page_content = get_post($recent["ID"])->post_content;
							echo '<p>' . exoplanet_excerpt_words($featured_page_content,10) . '</p>';
						}
						?>
						<a href="<?php echo esc_url( get_permalink( $recent["ID"] ) ); ?>" class="button featured-readmore"><?php echo esc_html__( 'Read More', 'exoplanet' );?></a>
						</div>
					</div>
					<?php
					$featured_post_number++;
				}
				wp_reset_postdata();
			} else {
				# display chosen
				for( $i = 1; $i < 5; $i++ ){
					$featured_page_icon = get_theme_mod('featured_page_icon'.$i, 'fa fa-check');
					$featured_page_link = get_theme_mod('featured_page_link'.$i);					
					if($featured_page_link){
					?>
					<div class="featured-post featured-post<?php echo $i ;?>">
						<a href="<?php echo esc_url( get_page_link( $featured_page_link ) ); ?>"><span class="featured-icon"><i class="<?php echo esc_attr( $featured_page_icon ); ?>"></i></span>
						<h4><?php echo get_the_title($featured_page_link); ?></h4></a>
						<div class="featured-excerpt">
						<?php
						$featured_page_excerpt = apply_filters('the_excerpt', get_post_field('post_excerpt', $featured_page_link));
						if ('' != $featured_page_excerpt) {
							echo $featured_page_excerpt;
						} else {
							$featured_page_content = get_post($featured_page_link)->post_content;
							echo '<p>' . exoplanet_excerpt_words($featured_page_content,10) . '</p>';
						}
						if($enable_featured_link){
						?>
						<a href="<?php echo esc_url( get_page_link( $featured_page_link ) ); ?>" class="button featured-readmore"><?php echo esc_html__( 'Read More', 'exoplanet' );?></a>
						<?php
						}
						?>
						</div>
					</div>
				<?php
					}
				}
			}
			?>
		</div>
	</div>
</section>







<div class="container">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part('template-parts/content', 'page'); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
