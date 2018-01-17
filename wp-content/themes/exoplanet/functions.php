<?php
/**
 * Exoplanet functions and definitions
 *
 * @package Exoplanet
 */

if ( ! function_exists('exoplanet_setup') ) :

//Sets up theme defaults and registers support for various WordPress features

function exoplanet_setup() {
	// Make theme available for translation
	load_theme_textdomain('exoplanet', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head
	add_theme_support('automatic-feed-links');

	// Let WordPress manage the document title
	add_theme_support('title-tag');

	// Support for woocommerce
	add_theme_support('woocommerce');

	//Enable support for Post Thumbnails on posts and pages.
	add_theme_support('post-thumbnails');
	add_image_size('exoplanet-about-thumb', 400, 420, true );
	add_image_size('exoplanet-blog-thumb', 800, 420, true );

	//WooCommerce image sizes
	add_image_size('exoplanet-shop-thumbnail', 120, 120, true );
	add_image_size('exoplanet-shop-single', 600, 600, true );
	add_image_size('exoplanet-shop-archive', 325, 380, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'exoplanet' ),
		'footer' => esc_html__( 'Footer Menu', 'exoplanet' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support('html5', array(
		'search-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature
	add_theme_support('custom-background', apply_filters('exoplanet_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Enable support for Custom Logo
	add_theme_support('custom-logo', array(
    	'width'	=> '300',
    	'height'	=> '60',
	) );

	// Support for WooCommerce 2.7+ product gallery features
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

}
endif; // exoplanet_setup
add_action('after_setup_theme', 'exoplanet_setup');

function exoplanet_content_width() {
	$GLOBALS['content_width'] = apply_filters('exoplanet_content_width', 1200 );
}
add_action('after_setup_theme', 'exoplanet_content_width', 0 );

// Enables the Excerpt meta box in Page edit screen
function exoplanet_add_excerpt_support_for_pages() {
	add_post_type_support('page', 'excerpt');
}
add_action('init', 'exoplanet_add_excerpt_support_for_pages');

// Register widget area
function exoplanet_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'exoplanet' ),
		'id'            => 'exoplanet-right-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar', 'exoplanet' ),
		'id'            => 'exoplanet-left-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Shop Sidebar', 'exoplanet' ),
		'id'            => 'exoplanet-shop-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 1', 'exoplanet' ),
		'id'            => 'exoplanet-footer1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 2', 'exoplanet' ),
		'id'            => 'exoplanet-footer2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 3', 'exoplanet' ),
		'id'            => 'exoplanet-footer3',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 4', 'exoplanet' ),
		'id'            => 'exoplanet-footer4',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Middle Footer', 'exoplanet' ),
		'id'            => 'exoplanet-about-footer',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
}
add_action('widgets_init', 'exoplanet_widgets_init');

if ( ! function_exists('exoplanet_fonts_url') ) :
/**
 * Register Google fonts for Exoplanet
 * @return string Google fonts URL for the theme
 */
function exoplanet_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Source Sans Pro, translate this to 'off'. Do not translate into your own language.
	 */
	if ('off' !== _x('on', 'Google fonts: on or off', 'exoplanet') ) {

		$fonts[] = get_theme_mod('font_header', 'Ubuntu:300,400,500,700');
		$fonts[] = get_theme_mod('font_nav', 'Hind:300,400,500,600,700');
		$fonts[] = get_theme_mod('font_page_title', 'Ubuntu:300,400,500,700');
		$fonts[] = get_theme_mod('font_content', 'Source Sans Pro:300,400,600,700');
		$fonts[] = get_theme_mod('font_headings', 'Montserrat:400,700');
		$fonts[] = get_theme_mod('font_footer', 'Hind:300,400,500,600,700');

	}

	/*
	 * Translators: To add an additional character subset specific to your language,
	 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
	 */
	$subset = _x('no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'exoplanet');

	if ('cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ('greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ('devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ('vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' =>  urlencode( implode('|', array_unique($fonts) ) ),
			'subset' =>  urlencode( $subsets ),
		), '//fonts.googleapis.com/css');
	}

	return esc_url_raw($fonts_url);
}
endif;

/**
 * Enqueue scripts and styles.
 */
function exoplanet_scripts() {
	wp_enqueue_script('modernizr', get_template_directory_uri() . '/js/modernizr.js', array(), '2.6.3', true );
	wp_enqueue_script('jquery-bxslider', get_template_directory_uri() . '/js/jquery.bxslider.js', array('jquery'), '4.1.2', true );
	wp_enqueue_script('jquery-superfish', get_template_directory_uri() . '/js/jquery.superfish.js', array('jquery'), '20160213', true );
	wp_enqueue_script('exoplanet-custom', get_template_directory_uri() . '/js/exoplanet-custom.js', array('jquery'), '20160520', true );	
	wp_enqueue_style('exoplanet-fonts', exoplanet_fonts_url(), array(), null );
	wp_enqueue_style('animate', get_template_directory_uri() . '/css/animate.css', array(), '1.0');
	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.css', array(), '4.4.0');
	wp_enqueue_style('exoplanet-style', get_stylesheet_uri() );
	wp_add_inline_style( 'exoplanet-style', exoplanet_dynamic_style() );
	if ( is_singular() && comments_open() && get_option('thread_comments') ) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'exoplanet_scripts');

/**
 * Enqueue admin style
 */
function exoplanet_admin_scripts($hook) {
    if ( 'post.php' == $hook || 'post-new.php' == $hook ) {
		wp_enqueue_style('exoplanet-admin-style', get_template_directory_uri() . '/functions/css/admin-style.css', array(), '1.0');
	} else {
		return;
	}
}
add_action('admin_enqueue_scripts', 'exoplanet_admin_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/functions/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/functions/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/functions/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/functions/customizer.php';

/**
 * Load Woocommerce additions.
 */
require get_template_directory() . '/functions/woo-functions.php';

/**
 * Breadcrumbs.
 */
require get_template_directory() . '/functions/breadcrumbs.php';

/**
 * Theme help page.
 */
if ( is_admin() ) {
	require get_template_directory() . '/functions/theme-help.php';
}