<?php
/**
 * Custom hooks and function for woocommerce compatibility
 *
 * @package Exoplanet
 */

remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action('woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10);
remove_action('woocommerce_archive_description', 'woocommerce_product_archive_description', 10);
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');

add_action('woocommerce_before_main_content', 'exoplanet_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'exoplanet_theme_wrapper_end', 10);
add_action('exoplanet_woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10);
add_action('exoplanet_woocommerce_archive_description', 'woocommerce_product_archive_description', 10);
add_action('woocommerce_before_subcategory_title', 'exoplanet_before_subcategory_html', 10);
add_action('woocommerce_after_subcategory_title', 'exoplanet_after_subcategory_html', 10);

function exoplanet_theme_wrapper_start() {
$page_header_position = get_theme_mod('page_header_position','header');
if ($page_header_position == "content") {
	echo '<header class="main-header">';
	echo '</header>';
	echo '<div class="container">';
	echo '<div class="title-header">';
	echo '<h1 class="main-title">';
	woocommerce_page_title();
	echo '</h1>';
	do_action('exoplanet_woocommerce_archive_description');
	echo '</div>';

	echo '<div id="primary">';
} else {
	echo '<header class="main-header">';
	echo '<div class="container">';
	echo '<div class="header-title">';
	echo '<h1 class="main-title">';
	woocommerce_page_title();
	echo '</h1>';
	do_action('exoplanet_woocommerce_archive_description');
	echo '</div>';
	echo '</div>';
	echo '</header>';

	echo '<div class="container">';
	echo '<div id="primary">';
}
}

function exoplanet_theme_wrapper_end() {
  echo '</div>';
  get_sidebar('shop');
  echo '</div>';
}

function exoplanet_before_subcategory_html(){
	echo '<div class="woo-title-price clearfix">';
}

function exoplanet_after_subcategory_html(){
	echo '</div>';
}

// Change number or products per row to 3
add_filter('loop_shop_columns', 'exoplanet_loop_columns');
if (!function_exists('exoplanet_loop_columns')) {
	function exoplanet_loop_columns() {
		return 3; 
	}
}

// Display 12 products per page.
if (!function_exists('exoplanet_product_per_page')) {
	function exoplanet_product_per_page() {
		return 12; 
	}
}
add_filter('loop_shop_per_page', 'exoplanet_product_per_page', 20 );

add_filter('woocommerce_show_page_title', '__return_false');

// Filter product image sizes
function exoplanet_set_product_thumbnail_size() {
	return 'exoplanet-shop-thumbnail';
}
add_filter( 'single_product_small_thumbnail_size', 'exoplanet_set_product_thumbnail_size' );

function exoplanet_set_product_single_size() {
	return 'exoplanet-shop-single';
}
add_filter( 'single_product_large_thumbnail_size', 'exoplanet_set_product_single_size' );

function exoplanet_set_archive_thumbnail_size() {
	return 'exoplanet-shop-archive';
}
add_filter( 'subcategory_archive_thumbnail_size', 'exoplanet_set_archive_thumbnail_size' );

//Change number of related products on product page
function exoplanet_related_products_args( $args ) {
	$args['posts_per_page'] = 3; // 3 related products
	$args['columns'] = 3; // arranged in 3 columns
	return $args;
}
add_filter('woocommerce_output_related_products_args', 'exoplanet_related_products_args');

add_filter('woocommerce_product_description_heading', '__return_false');

add_filter('woocommerce_product_additional_information_heading', '__return_false');

add_filter('woocommerce_pagination_args', 'exoplanet_change_prev_text');

function exoplanet_change_prev_text( $args ){
	$args['prev_text'] = '&lang;';
	$args['next_text'] = '&rang;';
	return $args;
}

function exoplanet_change_breadcrumb_delimiter( $defaults ) {
	$defaults['delimiter'] = '<i class="fa fa-angle-right"></i>';
	return $defaults;
}
add_filter( 'woocommerce_breadcrumb_defaults', 'exoplanet_change_breadcrumb_delimiter' );