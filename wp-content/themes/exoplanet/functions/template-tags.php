<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Exoplanet
 */

if ( ! function_exists('exoplanet_posted_on') ) :
/**
 * Prints HTML with meta information for the current post-date/time, author and comments
 */
function exoplanet_posted_on() {

	if ( get_theme_mod('disable_blog_date') ) {
	$posted_on = '';
	} else {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time('U') !== get_the_modified_time('U') ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date('c') ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date('c') ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			esc_html_x('%s', 'post date', 'exoplanet'),
			'<span class="posted-on"><i class="fa fa-calendar-o"></i><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a></span>'
		);
	}

	if ( get_theme_mod('disable_blog_author') ) {
		$byline = '';
	} else {
		$byline = sprintf(
			esc_html_x('%s', 'post author', 'exoplanet'),
		'<span class="byline"><i class="fa fa-user"></i><span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta('ID') ) ) . '">' . esc_html( get_the_author() ) . '</a></span></span>'
		);
	}

	$comment_count = get_comments_number(); // get_comments_number returns only a numeric value

	if ( comments_open() ) {
		if ( $comment_count == 0 ) {
			$comments = esc_html__( 'No Comments', 'exoplanet' );
		} elseif ( $comment_count > 1 ) {
			$comments = $comment_count . esc_html__( ' Comments', 'exoplanet' );
		} else {
			$comments = esc_html__( '1 Comment', 'exoplanet' );
		}
		$comment_link = '<span class="comment-count"><i class="fa fa-comments"></i><a href="' . get_comments_link() .'">'. $comments.'</a></span>';
	}else{
		$comment_link = '';
	}

	echo $posted_on . $byline . $comment_link ; // WPCS: XSS OK.

}
endif;

if ( ! function_exists('exoplanet_entry_footer') ) :
/**
 * Prints HTML with meta information for the categories and tags.
 */
function exoplanet_entry_footer() {
	// Hide category and tag text for pages.
	if ('post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'exoplanet' ) );
		if ( $categories_list && exoplanet_categorized_blog() ) {
			printf('<span class="cat-links"><i class="fa fa-folder"></i>' . esc_html__( '%1$s', 'exoplanet' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list('', esc_html__( ', ', 'exoplanet' ) );
		if ( $tags_list ) {
			printf('<span class="tags-links"><i class="fa fa-tags"></i>' . esc_html__( '%1$s', 'exoplanet' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function exoplanet_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient('exoplanet_categories') ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient('exoplanet_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so exoplanet_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so exoplanet_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in exoplanet_categorized_blog.
 */
function exoplanet_category_transient_flusher() {
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient('exoplanet_categories');
}
add_action('edit_category', 'exoplanet_category_transient_flusher');
add_action('save_post',     'exoplanet_category_transient_flusher');
