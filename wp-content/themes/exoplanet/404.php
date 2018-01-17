<?php
/**
 * The template for displaying 404 page
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
		<h1 class="main-title"><?php esc_html_e('404 Error', 'exoplanet'); ?></h1>
	</div>
<?php
} else {
?>
<header class="main-header">
	<div class="container">
		<div classs="header-title">
			<h1 class="main-title"><?php esc_html_e('404 Error', 'exoplanet'); ?></h1>
		</div>
	</div>
</header><!-- .entry-header -->
<?php
}
?>

<div class="container">

	<p><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'exoplanet'); ?></p>

	<p><?php esc_html_e('Maybe try a search?', 'exoplanet'); ?> <?php get_search_form(); ?></p>

	<p><?php esc_html_e('Browse our pages.', 'exoplanet'); ?></p>
	<ul>
	<?php wp_list_pages( array( 'title_li' => '' ) ); ?>
	</ul>

</div>

<?php get_footer(); ?>
