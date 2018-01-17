<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Exoplanet
 */

/**
 * Adds custom classes to the array of body classes
 *
 * @param array $classes Classes for the body element
 * @return array
 */
function exoplanet_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	$exoplanet_post_type = array('post' ,'page');

	if ( is_singular( $exoplanet_post_type ) ) {
		global $post;
		$exoplanet_sidebar_layout = get_post_meta( $post->ID, 'exoplanet_sidebar_layout', true );

		if(!$exoplanet_sidebar_layout){
			$exoplanet_sidebar_layout = 'right_sidebar';
		}

		$classes[] = 'exoplanet_'.esc_attr($exoplanet_sidebar_layout);
	} elseif ( is_home() || is_archive() || is_search() ) {
		$exoplanet_sidebar_layout = get_theme_mod( 'blog_layout', 'right_sidebar' );

		if(!$exoplanet_sidebar_layout){
			$exoplanet_sidebar_layout = 'right_sidebar';
		}

		$classes[] = 'exoplanet_'.esc_attr($exoplanet_sidebar_layout);
	}




	return $classes;
}
add_filter('body_class', 'exoplanet_body_classes');

function exoplanet_primary_menu_fallback() {
	if ( is_user_logged_in() && current_user_can('administrator') ) {
		echo '<div class="menu clearfix"><ul><li class="menu-item"><a href="' . admin_url('nav-menus.php') . '">' . esc_html__( 'Create your Primary Menu here', 'exoplanet' ) . '</a></li></ul></div>';
	} else {
		return;
	}

}

if( !function_exists('exoplanet_slider') ){
	function exoplanet_slider(){
		$slider_page1 = get_theme_mod('slider_page1');
		$slider_page2 = get_theme_mod('slider_page2');
		$slider_page3 = get_theme_mod('slider_page3');
		if ( !$slider_page1 && !$slider_page2 && !$slider_page3 ) { 
			$slider_opacity = get_theme_mod('slider_opacity', '0');
			if ($slider_opacity >0) {
				$slider_opacity = $slider_opacity /100;
				$slider_opacity = ' linear-gradient( rgba(0, 0, 0, '.$slider_opacity.'), rgba(0, 0, 0, '.$slider_opacity.') ), ';
			}else{
				$slider_opacity = '';
			}
			$slider_image = get_theme_mod('slider_bg', get_template_directory_uri().'/images/exoplanet-background.jpg');
			?>
<section id="home-slider-section">
	<div id="bx-slider">
	<div class="slide slide-count1" style="background-image: <?php echo esc_html($slider_opacity ); ?>url('<?php echo esc_url( $slider_image ); ?>');">
	</div>
	</div>
</section>
		<?php } else {
	?>
<section id="home-slider-section">
	<div id="bx-slider">
	<?php for ($i=1; $i < 4; $i++) {
			$slider_page = exoplanet_wpml_page_id( get_theme_mod('slider_page'.$i) );
if ( $slider_page !='' ) { 
			$slider_title = get_the_title($slider_page);
			$slider_subtitle = get_the_excerpt($slider_page);
			$slider_button_left = get_theme_mod('slider_button_left'.$i);
			$slider_left_link = get_theme_mod('slider_left_link'.$i);
			$slider_button_right = get_theme_mod('slider_button_right'.$i);
			$slider_right_link = get_theme_mod('slider_right_link'.$i);
			if ( has_post_thumbnail($slider_page) ) {
				$slider_image = get_the_post_thumbnail_url($slider_page, 'full');
			} else {
				$slider_image = get_theme_mod('slider_bg', get_template_directory_uri().'/images/exoplanet-background.jpg');
			}

		if( $slider_title !='' ){
			$slider_opacity = get_theme_mod('slider_opacity', '0');
			if ($slider_opacity >0) {
				$slider_opacity = $slider_opacity /100;
				$slider_opacity = ' linear-gradient( rgba(0, 0, 0, '.$slider_opacity.'), rgba(0, 0, 0, '.$slider_opacity.') ), ';
			}else{
				$slider_opacity = '';
			}
		?>		
		<div class="slide slide-count<?php echo $i; ?>" style="background-image: <?php echo esc_html($slider_opacity ); ?>url('<?php echo esc_url( $slider_image ); ?>');">
						
			<?php if( $slider_title || $slider_subtitle){ ?>
				<div class="slide-caption">
					<div class="slide-cap-title animated fadeInDown">
						<?php echo esc_html( $slider_title ); ?>
					</div>

					<div class="slide-cap-desc animated fadeInUp">
						<?php echo esc_html( $slider_subtitle ); ?>
					</div>

					<?php if( $slider_button_left && $slider_button_right){?>
					<div class="slide-cta animated fadeInRight">
						<a href="<?php echo esc_url( get_page_link( $slider_left_link ) ); ?>" class="slide-button-left"><?php echo esc_html( $slider_button_left ); ?></a>
					</div>
					<div class="slide-cta animated fadeInLeft">
						<a href="<?php echo esc_url( get_page_link( $slider_right_link ) ); ?>" class="slide-button-right"><?php echo esc_html( $slider_button_right ); ?></a>
					</div>
					<?php }else{?>

						<?php if( $slider_button_left ){?>
						<div class="slide-cta-center animated fadeInUp">
							<a href="<?php echo esc_url( get_page_link( $slider_left_link ) ); ?>" class="slide-button-left"><?php echo esc_html( $slider_button_left ); ?></a>
						</div>
						<?php }?>
						<?php if( $slider_button_right ){?>
						<div class="slide-cta-center animated fadeInUp">
							<a href="<?php echo esc_url( get_page_link( $slider_right_link ) ); ?>" class="slide-button-right"><?php echo esc_html( $slider_button_right ); ?></a>
						</div>
						<?php }?>

					<?php }?>

				</div>
			<?php } ?>
		</div>
	<?php
}
		}
	} ?>
	</div>
</section>
<?php
		}
	}
}

if( !function_exists('exoplanet_excerpt_words') ){
	function exoplanet_excerpt_words( $content , $word_count ){
		$content = strip_shortcodes( $content );
		$content = strip_tags( $content );
		$content = wp_trim_words( $content, $word_count);

		if( strlen( $content ) == $word_count ){
			$content .= "&hellip;";
		}
		return esc_html( $content );
	}
}

function exoplanet_custom_excerpt_length( $length ) {
	return 110;
}
add_filter( 'excerpt_length', 'exoplanet_custom_excerpt_length', 999 );

function exoplanet_excerpt_more( $more ) {
    return sprintf( '&hellip; <a class="read-more" href="%1$s">%2$s</a>',
        esc_url( get_permalink( get_the_ID() ) ),
        esc_html__( 'Read More', 'exoplanet' )
    );
}
add_filter( 'excerpt_more', 'exoplanet_excerpt_more' );

if( !function_exists('exoplanet_change_wp_page_menu_args') ){
	function exoplanet_change_wp_page_menu_args( $args ){
		$args['menu_class'] = 'menu clearfix';	
		return $args;
	}
}
add_filter('wp_page_menu_args' , 'exoplanet_change_wp_page_menu_args');

function exoplanet_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);
	$tag = ('div' === $args['style'] ) ? 'div' : 'li';
	?>
	<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] )  ? 'parent' : '', $comment ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
					<?php echo sprintf('<b class="fn">%s</b>', get_comment_author_link( $comment )  ); ?>
				</div><!-- .comment-author -->

				<?php if ('0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'exoplanet' ); ?></p>
				<?php endif; ?>
				<?php edit_comment_link( esc_html__( 'Edit', 'exoplanet' ), '<span class="edit-link">', '</span>'); ?>
			</footer><!-- .comment-meta -->

			<div class="comment-content">
				<?php comment_text(); ?>
			</div><!-- .comment-content -->

			<div class="comment-metadata clearfix">
				<a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
					<time datetime="<?php comment_time('c'); ?>">
						<?php
							/* translators: 1: comment date, 2: comment time */
							printf( esc_html__( '%1$s at %2$s', 'exoplanet' ), get_comment_date('', $comment ), get_comment_time() );
						?>
					</time>
				</a>

				<?php
				comment_reply_link( array_merge( $args, array(
					'add_below' => 'div-comment',
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
					'before'    => '<div class="reply">',
					'after'     => '</div>'
				) ) );
				?>
			</div><!-- .comment-metadata -->
		</article><!-- .comment-body -->
<?php
}

function exoplanet_css_font_family($font_family) {
	$font_family = substr($font_family, 0, strpos($font_family, ':'));
	return esc_attr($font_family);
}

function exoplanet_dynamic_style( $css = array() ){

	$font_header = get_theme_mod('font_header','Ubuntu:300,400,500,700');
	if ($font_header && $font_header != 'Ubuntu:300,400,500,700') {
		$css[] = '#masthead,.site-title{font-family:\''.exoplanet_css_font_family($font_header).'\', Helvetica, Arial, Verdana, sans-serif;}';
	}

	$font_nav = get_theme_mod('font_nav','Hind:300,400,500,600,700');
	if ($font_nav && $font_nav != 'Hind:300,400,500,600,700') {
		$css[] = '#site-navigation{font-family:\''.exoplanet_css_font_family($font_nav).'\', Helvetica, Arial, Verdana, sans-serif;}';
	}

	$font_page_title = get_theme_mod('font_page_title','Ubuntu:300,400,500,700');
	if ($font_page_title && $font_page_title != 'Ubuntu:300,400,500,700') {
		$css[] = '.main-title{font-family:\''.exoplanet_css_font_family($font_page_title).'\', Helvetica, Arial, Verdana, sans-serif;}';
	}

	$font_content = get_theme_mod('font_content','Source+Sans+Pro:300,400,600,700');
	if ($font_content && $font_content != 'Source+Sans+Pro:300,400,600,700') {
		$css[] = 'body,button,input,select,textarea{font-family:\''.exoplanet_css_font_family($font_content).'\', Helvetica, Arial, Verdana, sans-serif;}';
	}

	$font_headings = get_theme_mod('font_headings','Montserrat:400,700');
	if ($font_headings && $font_headings != 'Montserrat:400,700') {
		$css[] = 'h1,h2,h3,h4,h5,h6,.featured-section-title span,#cta-section .cta-left .leadin{font-family:\''.exoplanet_css_font_family($font_headings).'\', Helvetica, Arial, Verdana, sans-serif;}';
	}

	$font_footer = get_theme_mod('font_footer','Hind:300,400,500,600,700');
	if ($font_footer && $font_footer != 'Hind:300,400,500,600,700') {
		$css[] = '#colophon{font-family:\''.exoplanet_css_font_family($font_footer).'\', Helvetica, Arial, Verdana, sans-serif;}';
	}

	$fullwidth = get_theme_mod('fullwidth');
	if ($fullwidth) {
		$css[] = '.container{width:100%}';
	}
	else {
		$sitewidth = get_theme_mod('sitewidth');
		if ($sitewidth && $sitewidth != 1200) {
			if ($sitewidth < 1120) {
				$sitewidth = 1120;
			}
		$css[] = '.container{width:'.esc_attr($sitewidth).'px}';
		}
	}


	$site_title_font_size = get_theme_mod('site_title_font_size', '46');
	if ( $site_title_font_size > 18 && $site_title_font_size != "46" ) {
		$st_fontsize_scr = round( $site_title_font_size * 0.869 );
		$st_fontsize_1024 = round( $site_title_font_size * 0.826 );
		$st_fontsize_768 = round( $site_title_font_size * 0.739 );
		$st_fontsize_580 = round( $site_title_font_size * 0.652 );
		$st_fontsize_380 = round( $site_title_font_size * 0.565 );
		$st_fontsize_320 = round( $site_title_font_size * 0.522 );
		$css[] = '.site-title{font-size:'.esc_attr($site_title_font_size).'px;}
		#masthead.scrolled .site-title{font-size:'.esc_attr($st_fontsize_scr).'px !important;}
		@media screen and (max-width: 1024px){.site-title, #masthead.scrolled .site-title{font-size:'.esc_attr($st_fontsize_1024).'px !important;}}
		@media screen and (max-width: 768px){.site-title, #masthead.scrolled .site-title{font-size:'.esc_attr($st_fontsize_768).'px !important;}}
		@media screen and (max-width: 580px){.site-title, #masthead.scrolled .site-title{font-size:'.esc_attr($st_fontsize_580).'px !important;}}
		@media screen and (max-width: 380px){.site-title, #masthead.scrolled .site-title{font-size:'.esc_attr($st_fontsize_380).'px !important;}}
		@media screen and (max-width: 320px){.site-title, #masthead.scrolled .site-title{font-size:'.esc_attr($st_fontsize_320).'px !important;}}';
	} else {
		$css[] = '.site-title, #masthead.scrolled .site-title{font-size:'.esc_attr($site_title_font_size).'px;}';
	}

	$tagline_font_size = get_theme_mod('tagline_font_size', '16');
	if ( $tagline_font_size > 12 && $tagline_font_size != "16" ) {
		$tg_fontsize_scr = round( $tagline_font_size * 0.875 );
		$tg_fontsize_580 = round( $tagline_font_size * 0.75 );
		$css[] = '.site-description{font-size:'.esc_attr($tagline_font_size).'px;}
		#masthead.scrolled .site-description{font-size:'.esc_attr($tg_fontsize_scr).'px !important;}
		@media screen and (max-width: 768px){.site-description, #masthead.scrolled .site-description{font-size:'.esc_attr($tg_fontsize_scr).'px !important;}}
		@media screen and (max-width: 580px){.site-description, #masthead.scrolled .site-description{font-size:'.esc_attr($tg_fontsize_580).'px !important;}}';
	} else {
		$css[] = '.site-description, #masthead.scrolled .site-description{font-size:'.esc_attr($tagline_font_size).'px;}';
	}

	$page_header_bg = get_theme_mod('header_image', get_template_directory_uri().'/images/exoplanet-header.jpg');
	$page_header_pattern = get_theme_mod('page_header_pattern', 'none');
	if ($page_header_pattern && $page_header_pattern != "none") {
		if ($page_header_bg) {
			$page_header_opacity = get_theme_mod('page_header_opacity', '0');
			if ($page_header_opacity >0) {
				$page_header_opacity = $page_header_opacity /100;
				$page_header_opacity = ' linear-gradient( rgba(0, 0, 0, '.esc_attr($page_header_opacity).'), rgba(0, 0, 0, '.esc_attr($page_header_opacity).') ), ';
				$page_header_opacity_cover = 'auto, ';
			}else{
				$page_header_opacity = '';
				$page_header_opacity_cover = '';
			}
		$css[] = '.main-header,.custom-post-type-header{background: '.esc_attr($page_header_opacity).'url('.esc_url(get_template_directory_uri().'/images/'.$page_header_pattern.'.png)').' top center repeat, url('.get_header_image().') top center no-repeat;background-size: '.esc_attr($page_header_opacity_cover).'auto, cover;}';
		}
	} else {
		if ($page_header_bg) {
			$page_header_opacity = get_theme_mod('page_header_opacity', '0');
			if ($page_header_opacity >0) {
				$page_header_opacity = $page_header_opacity /100;
				$page_header_opacity = ' linear-gradient( rgba(0, 0, 0, '.esc_attr($page_header_opacity).'), rgba(0, 0, 0, '.esc_attr($page_header_opacity).') ), ';
			}else{
				$page_header_opacity = '';
			}
		$css[] = '.main-header,.custom-post-type-header{background-image: '.esc_attr($page_header_opacity).'url('.get_header_image().')}';
		}		
	}

	$slider_pattern = get_theme_mod('slider_pattern');
	if ($slider_pattern && $slider_pattern != "none") {
		$css[] = '.slide:after {content: "";background: url('.esc_url(get_template_directory_uri().'/images/'.$slider_pattern.'.png)').' repeat fixed;top: 0;left: 0;bottom: 0;right: 0;position: absolute;z-index: -1;}';
	}

	$header_bg = get_theme_mod('header_bg', 'rgba(0,0,0,0.08)');
	if ($header_bg && $header_bg != "rgba(0,0,0,0.08)") {
		$css[] = '#masthead, .slide-caption {background: '.esc_attr($header_bg).';}';
	}

	$header_text_color = get_header_textcolor();
	if ($header_text_color != "blank") {
		$css[] = '.slide-cap-title,.slide-cap-desc,a.slide-button-left {color: #'.esc_attr($header_text_color).';}.slide-button-left {border-color: #'.esc_attr($header_text_color).';}';
	} else {
		$header_text_color2 = get_theme_mod('menu_item_color');
		if ($header_text_color2) {
			$css[] = '.slide-cap-title,.slide-cap-desc,a.slide-button-left {color: '.esc_attr($header_text_color2).';}.slide-button-left {border-color: '.esc_attr($header_text_color2).';}';
		}
	}

	$header_bg_scr = get_theme_mod('header_bg_scr', 'rgba(0,0,0,0.8)');
	if ($header_bg_scr && $header_bg_scr != "rgba(0,0,0,0.8)") {
		$css[] = '#masthead.scrolled {background: '.esc_attr($header_bg_scr).';}';
	}

	$disable_header_hover = get_theme_mod('disable_header_hover');
	if ($disable_header_hover) {
		$css[] = '#masthead:hover {box-shadow: none;}';
	} else {
		if ($header_bg_scr && $header_bg_scr != "rgba(0,0,0,0.8)") {
			$css[] = '#masthead:hover {box-shadow: inset 0 -260px 0 '.esc_attr($header_bg_scr).';}';
		}
	}

	$menu_height = get_theme_mod('menu_height', '82');
	if ($menu_height && $menu_height != "82") {
		if ( $menu_height > 33 ) {
			$scroll_menu_height = $menu_height - 15;
		} else {
			$scroll_menu_height = $menu_height;
		}
		$css[] = '.main-navigation li {line-height: '.esc_attr($menu_height).'px;} #masthead.scrolled .main-navigation li {line-height: '.esc_attr($scroll_menu_height).'px;}';
	}

	$body_text_color = get_theme_mod('body_text_color', '#6a7382');
	if ($body_text_color && $body_text_color != "#6a7382") {
		$css[] = 'body, button, input, select, textarea, .title-header .taxonomy-description, .title-header .breadcrumbs, .title-header .breadcrumbs a, .title-header .term-description {color: '.esc_attr($body_text_color).';} .sticky .post-wrapper {border-color: '.esc_attr($body_text_color).';}';
	}

	$heading_color = get_theme_mod('heading_color', '#515b69');
	if ($heading_color && $heading_color != "#515b69") {
		$css[] = 'h1, h2, h3, h4, h5, h6, .entry-header .entry-title a, .featured-section-title span, .title-header .main-title, .featured-post h4 a {color: '.esc_attr($heading_color).';}';
	}

	$background_color = get_theme_mod('background_color', 'ffffff');
	if ($background_color && $background_color != "ffffff") {
		$css[] = '.featured-section-title span {background: #'.esc_attr($background_color).';}';
	}

	$post_bgcolor = get_theme_mod('post_bgcolor', '#f9f9f9');
	if ($post_bgcolor && $post_bgcolor != "#f9f9f9") {
		$css[] = '.post-wrapper {background: '.esc_attr($post_bgcolor).';}';
	}

	$sidebar_bgcolor = get_theme_mod('sidebar_bgcolor', '#f9f9f9');
	if ($sidebar_bgcolor && $sidebar_bgcolor != "#f9f9f9") {
		$css[] = '#secondary {background: '.esc_attr($sidebar_bgcolor).';}';
	}

	$sidebar_linkcolor = get_theme_mod('sidebar_linkcolor', '#000000');
	if ($sidebar_linkcolor && $sidebar_linkcolor != "#000000") {
		$css[] = '.widget a {color: '.esc_attr($sidebar_linkcolor).';}';
	}

	$page_header_align = get_theme_mod('page_header_align', 'center');
	if ($page_header_align && $page_header_align == "center") {
	$css[] = '.main-header {min-height: 1px !important;}';
	} elseif ($page_header_align && $page_header_align == "left") {
	$css[] = '@media screen and (min-width: 581px){.main-title {width:70%;float:left;text-align:left;margin-bottom:20px;} .breadcrumbs {width:30%;float:right;text-align:right;height:100%;margin-bottom:20px;}ul.trail-items{padding-top:12px !important}}';
	} elseif ($page_header_align && $page_header_align == "right") {
	$css[] = '@media screen and (min-width: 581px){.main-title {width:70%;float:right;text-align:right;margin-bottom:20px;} .breadcrumbs {width:30%;float:left;text-align:left;height:100%;margin-bottom:20px;}ul.trail-items{padding-top:12px !important}}';
	}

	$page_header_bgcolor = get_theme_mod('page_header_bgcolor', '#232629');
	if ($page_header_bgcolor && $page_header_bgcolor != "#232629") {
		$css[] = '.main-header {background-color: '.esc_attr($page_header_bgcolor).';}';
	}

	$page_header_titlecolor = get_theme_mod('page_header_titlecolor', '#ffffff');
	if ($page_header_titlecolor && $page_header_titlecolor != "#ffffff") {
		$css[] = '.main-title, .breadcrumbs, .breadcrumbs a {color: '.esc_attr($page_header_titlecolor).';}';
	}

	$page_footertop_color = get_theme_mod('page_footertop_color', '#232629');
	if ($page_footertop_color && $page_footertop_color != "#232629") {
		$css[] = '#top-footer {background: '.esc_attr($page_footertop_color).';}';
	}

	$page_footermid_color = get_theme_mod('page_footermid_color', '#1c1e21');
	if ($page_footermid_color && $page_footermid_color != "#1c1e21") {
		$css[] = '#middle-footer {background: '.esc_attr($page_footermid_color).';}';
	}

	$page_footerbot_color = get_theme_mod('page_footerbot_color', '#15171A');
	if ($page_footerbot_color && $page_footerbot_color != "#15171A") {
		$css[] = '#bottom-footer {background: '.esc_attr($page_footerbot_color).';}';
	}

	$hi_color = get_theme_mod('hi_color');
	if ($hi_color && $hi_color != "#b50b52") {
		$css[] = 'button,input[type="button"],input[type="reset"],input[type="submit"],.widget-area .widget-title:before,.widget-area .widget-title:after,h3#reply-title:after,h3.comments-title:after,.comment-navigation .nav-previous a,.comment-navigation .nav-next a,.section-title:after,.menu > ul > li > a:hover:before,.menu > ul > li.current_page_item a:before,.menu > ul > li.current-menu-item a:before,.slide-cap-title:after,.slide-button-right,#home-slider-section .bx-wrapper .bx-controls-direction a:hover,.featured-post h4:before,.featured-post h4:after,.featured-readmore,#cta-section,.woocommerce ul.products li.product .button.add_to_cart_button,.woocommerce a.added_to_cart,.woocommerce #respond input#submit.alt,.woocommerce a.button.alt,.woocommerce button.button.alt,.woocommerce input.button.alt,.woocommerce #respond input#submit.alt:hover,.woocommerce a.button.alt:hover,.woocommerce button.button.alt:hover,.woocommerce input.button.alt:hover,.woocommerce #respond input#submit:hover,.woocommerce a.button:hover,.woocommerce button.button:hover,.woocommerce input.button:hover,.woocommerce #respond input#submit.alt.disabled,.woocommerce #respond input#submit.alt.disabled:hover,.woocommerce #respond input#submit.alt:disabled,.woocommerce #respond input#submit.alt:disabled:hover,.woocommerce #respond input#submit.alt:disabled[disabled],.woocommerce #respond input#submit.alt:disabled[disabled]:hover,.woocommerce a.button.alt.disabled, .woocommerce a.button.alt.disabled:hover,.woocommerce a.button.alt:disabled, .woocommerce a.button.alt:disabled:hover,.woocommerce a.button.alt:disabled[disabled],.woocommerce a.button.alt:disabled[disabled]:hover,.woocommerce button.button.alt.disabled,.woocommerce button.button.alt.disabled:hover,.woocommerce button.button.alt:disabled,.woocommerce button.button.alt:disabled:hover,.woocommerce button.button.alt:disabled[disabled],.woocommerce button.button.alt:disabled[disabled]:hover,.woocommerce input.button.alt.disabled,.woocommerce input.button.alt.disabled:hover,.woocommerce input.button.alt:disabled,.woocommerce input.button.alt:disabled:hover,.woocommerce input.button.alt:disabled[disabled],.woocommerce input.button.alt:disabled[disabled]:hover,.woocommerce #respond input#submit,.woocommerce a.button,.woocommerce button.button,.woocommerce input.button,.woocommerce div.product .woocommerce-tabs ul.tabs li.active:after,.woocommerce .widget_price_filter .ui-slider .ui-slider-range,.woocommerce .widget_price_filter .ui-slider .ui-slider-handle{background:'.esc_attr($hi_color).'}';

		$css[] = 'a,a:hover,a:focus,a:active,.single-entry-content a,.single-entry-content a:hover,.widget-area a:hover,.comment-list a:hover,.main-navigation a:hover,.main-navigation .current_page_item > a,.main-navigation .current-menu-item > a,.main-navigation .current_page_ancestor > a,.slide-button-left:hover,a:hover.slide-button-left,.featured-post .featured-icon,.featured-post h4 a:hover,#cta-section .cta-right a:hover,.pagination a:hover,.pagination .current,.woocommerce .woocommerce-breadcrumb a:hover,.woocommerce nav.woocommerce-pagination ul li a:focus,.woocommerce nav.woocommerce-pagination ul li a:hover,.woocommerce nav.woocommerce-pagination ul li span.current,.woocommerce ul.products li.product h3 a:hover,.woocommerce ul.products li.product .price,.woocommerce div.product p.price,.woocommerce div.product span.price,.woocommerce .woocommerce-message:before,.woocommerce .woocommerce-info:before{color:'.esc_attr($hi_color).'}';

		$css[] = '.featured-post .featured-icon,.pagination a:hover,.pagination .current,.woocommerce nav.woocommerce-pagination ul li a:focus,.woocommerce nav.woocommerce-pagination ul li a:hover,.woocommerce nav.woocommerce-pagination ul li span.current{border: 1px solid '.esc_attr($hi_color).'}';

		$css[] = '.comment-navigation .nav-next a:after{border-left: 11px solid '.esc_attr($hi_color).'}';
		$css[] = '.comment-navigation .nav-previous a:after{border-right: 11px solid '.esc_attr($hi_color).'}';
		$css[] = '.slide-button-right{border: 2px solid '.esc_attr($hi_color).'}';

		$css[] = '.woo-title-price{border-top: 1px dashed '.esc_attr($hi_color).'}';

		$css[] = '.woocommerce div.product div.images .flex-control-thumbs li img.flex-active, .woocommerce div.product div.images .flex-control-thumbs li img:hover{border-color: '.esc_attr($hi_color).'}';
	}

	$menu_item_color = get_theme_mod('menu_item_color', '#ffffff');
	if ($menu_item_color && $menu_item_color != "#ffffff") {
		$css[] = '@media screen and (min-width: 1025px){.main-navigation a {color: '.esc_attr($menu_item_color).';}.sf-arrows .sf-with-ul:after{border-top-color: '.esc_attr($menu_item_color).';}}
		.toggle-nav i {color: '.esc_attr($menu_item_color).';}
		.toggle-nav span,.toggle-nav span:before,.toggle-nav span:after {background: '.esc_attr($menu_item_color).';}';
	}

	$lastmenu_hi_color = get_theme_mod('lastmenu_hi_color', '#b50b52');
	if ($lastmenu_hi_color && $lastmenu_hi_color != "#b50b52") {
		$css[] = '.main-navigation .menu > ul > li.highlight{background: '.esc_attr($lastmenu_hi_color).';}';
	}

	$menu_uppercase = get_theme_mod('menu_uppercase');
	if ($menu_uppercase) {
		$css[] = '.main-navigation a {text-transform: uppercase;}';
	}

	$blog_meta_layout = get_theme_mod('blog_meta_layout', 'left');
	if ($blog_meta_layout && $blog_meta_layout != "left") {
		$css[] = '.entry-header {text-align: '.esc_attr($blog_meta_layout).'}';
	}

	return implode( '', $css );

}


function exoplanet_customize_nav( $items, $args ) {
    if ( $args->theme_location == 'primary' &&  get_theme_mod( 'menu_search' ) ) {   
    	$items .= '<li class="menu-item exoplanet-search"><a class="exoplanet-search" href="#search" role="button"><span class="fa fa-search"></span></a></li>';
    } else {
    	$items .= '';
    }
		return $items;
}
add_filter('wp_nav_menu_items', 'exoplanet_customize_nav', 10, 2);


/**
 * Adds a box to the main column on the Post and Page edit screens
 */
function exoplanet_sidebar_layout_meta_box(){

	if (isset($_GET['post'])) {
		$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'];
	} else {
		$post_id = 0;
	}
	
	if ( $post_id != get_option('page_for_posts') ) {
		$screens = array('post', 'page');

		add_meta_box(
			'exoplanet_sidebar_layout',
			esc_html__('Sidebar Layout', 'exoplanet' ),
			'exoplanet_sidebar_layout_meta_box_callback',
			$screens,
			'normal',
			'high'
		);

	}

} 
add_action('add_meta_boxes', 'exoplanet_sidebar_layout_meta_box');


/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page
 */
function exoplanet_sidebar_layout_meta_box_callback( $post ){

	// Add a nonce field so we can check for it later.
	wp_nonce_field('exoplanet_sidebar_layout_save_meta_box', 'exoplanet_sidebar_layout_meta_box_nonce');

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$exoplanet_sidebar_layout = get_post_meta( $post->ID, 'exoplanet_sidebar_layout', true );

	if(!$exoplanet_sidebar_layout){
		$exoplanet_sidebar_layout = 'right_sidebar';
	}

	echo '<label>';
	echo '<input type="radio" name="exoplanet_sidebar_layout" value="left_sidebar" '.checked( $exoplanet_sidebar_layout, 'left_sidebar', false ).' />';
	echo '<img src="'.get_template_directory_uri().'/images/left-sidebar.png"/>';
	echo '</label>';

	echo '<label>';
	echo '<input type="radio" name="exoplanet_sidebar_layout" value="right_sidebar" '.checked( $exoplanet_sidebar_layout, 'right_sidebar', false ).' />';
	echo '<img src="'.get_template_directory_uri().'/images/right-sidebar.png"/>';
	echo '</label>';
	
	echo '<label>';
	echo '<input type="radio" name="exoplanet_sidebar_layout" value="no_sidebar" '.checked( $exoplanet_sidebar_layout, 'no_sidebar', false ).' />';
	echo '<img src="'.get_template_directory_uri().'/images/no-sidebar.png"/>';
	echo '</label>';

	echo '<label>';
	echo '<input type="radio" name="exoplanet_sidebar_layout" value="no_sidebar_condensed" '.checked( $exoplanet_sidebar_layout, 'no_sidebar_condensed', false ).' />';
	echo '<img src="'.get_template_directory_uri().'/images/no-sidebar-condensed.png"/>';
	echo '</label>';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function exoplanet_sidebar_layout_save_meta_box( $post_id ){

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['exoplanet_sidebar_layout_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['exoplanet_sidebar_layout_meta_box_nonce'], 'exoplanet_sidebar_layout_save_meta_box') ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( ! current_user_can('edit_post', $post_id ) ) {
		return;
	}

	/* OK, it's safe for us to save the data now. */
	
	// Make sure that it is set.
	if ( isset( $_POST['exoplanet_sidebar_layout'] ) ) {
		// Sanitize user input.
		$exoplanet_data = sanitize_text_field( $_POST['exoplanet_sidebar_layout'] );
		// Update the meta field in the database.
		update_post_meta( $post_id, 'exoplanet_sidebar_layout', $exoplanet_data );
	}
		
}
add_action('save_post', 'exoplanet_sidebar_layout_save_meta_box');

if(!function_exists('exoplanet_wpml_page_id')){
	function exoplanet_wpml_page_id($id){
		if ( function_exists( 'wpml_object_id' ) ) {
			return apply_filters( 'wpml_object_id', $id, 'page' );
		} elseif ( function_exists( 'icl_object_id' ) ) {
			return icl_object_id( $id, 'page', true );
		} else {
			return $id;
		}
	}
}

if(!function_exists('exoplanet_fontawesome_array')){
	function exoplanet_fontawesome_array(){
		return array('500px','address-book','address-book-o','address-card','address-card-o','adjust','adn','align-center','align-justify','align-left','align-right','amazon','ambulance','american-sign-language-interpreting','anchor','android','angellist','angle-double-down','angle-double-left','angle-double-right','angle-double-up','angle-down','angle-left','angle-right','angle-up','apple','archive','area-chart','arrow-circle-down','arrow-circle-left','arrow-circle-o-down','arrow-circle-o-left','arrow-circle-o-right','arrow-circle-o-up','arrow-circle-right','arrow-circle-up','arrow-down','arrow-left','arrow-right','arrow-up','arrows','arrows-alt','arrows-h','arrows-v','asl-interpreting','assistive-listening-systems','asterisk','at','audio-description','automobile','backward','balance-scale','ban','bandcamp','bank','bar-chart','bar-chart-o','barcode','bars','bath','battery-0','battery-1','battery-2','battery-3','battery-4','battery-empty','battery-full','battery-half','battery-quarter','battery-three-quarters','bed','beer','behance','behance-square','bell','bell-o','bell-slash','bell-slash-o','bicycle','binoculars','birthday-cake','bitbucket','bitbucket-square','bitcoin','black-tie','blind','bluetooth','bluetooth-b','bold','bolt','bomb','book','bookmark','bookmark-o','braille','briefcase','btc','bug','building','building-o','bullhorn','bullseye','bus','buysellads','cab','calculator','calendar','calendar-check-o','calendar-minus-o','calendar-o','calendar-plus-o','calendar-times-o','camera','camera-retro','car','caret-down','caret-left','caret-right','caret-square-o-down','caret-square-o-left','caret-square-o-right','caret-square-o-up','caret-up','cart-arrow-down','cart-plus','cc','cc-amex','cc-diners-club','cc-discover','cc-jcb','cc-mastercard','cc-paypal','cc-stripe','cc-visa','certificate','chain','chain-broken','check','check-circle','check-circle-o','check-square','check-square-o','chevron-circle-down','chevron-circle-left','chevron-circle-right','chevron-circle-up','chevron-down','chevron-left','chevron-right','chevron-up','child','chrome','circle','circle-o','circle-o-notch','circle-thin','clipboard','clock-o','clone','close','cloud','cloud-download','cloud-upload','cny','code','code-fork','codepen','codiepie','coffee','cog','cogs','columns','comment','comment-o','commenting','commenting-o','comments','comments-o','compass','compress','connectdevelop','contao','copy','copyright','creative-commons','credit-card','credit-card-alt','crop','crosshairs','css3','cube','cubes','cut','cutlery','dashboard','dashcube','database','deaf','deafness','dedent','delicious','desktop','deviantart','diamond','digg','dollar','dot-circle-o','download','dribbble','dropbox','drupal','edge','edit','eercast','eject','ellipsis-h','ellipsis-v','empire','envelope','envelope-o','envelope-open','envelope-open-o','envelope-square','envira','eraser','etsy','eur','euro','exchange','exclamation','exclamation-circle','exclamation-triangle','expand','expeditedssl','external-link','external-link-square','eye','eye-slash','eyedropper','fa','facebook','facebook-f','facebook-official','facebook-square','fast-backward','fast-forward','fax','feed','female','fighter-jet','file','file-archive-o','file-audio-o','file-code-o','file-excel-o','file-image-o','file-movie-o','file-o','file-pdf-o','file-photo-o','file-picture-o','file-powerpoint-o','file-sound-o','file-text','file-text-o','file-video-o','file-word-o','file-zip-o','files-o','film','filter','fire','fire-extinguisher','firefox','first-order','flag','flag-checkered','flag-o','flash','flask','flickr','floppy-o','folder','folder-o','folder-open','folder-open-o','font','font-awesome','fonticons','fort-awesome','forumbee','forward','foursquare','free-code-camp','frown-o','futbol-o','gamepad','gavel','gbp','ge','gear','gears','genderless','get-pocket','gg','gg-circle','gift','git','git-square','github','github-alt','github-square','gitlab','gittip','glass','glide','glide-g','globe','google','google-plus','google-plus-circle','google-plus-official','google-plus-square','google-wallet','graduation-cap','gratipay','grav','group','h-square','hacker-news','hand-grab-o','hand-lizard-o','hand-o-down','hand-o-left','hand-o-right','hand-o-up','hand-paper-o','hand-peace-o','hand-pointer-o','hand-rock-o','hand-scissors-o','hand-spock-o','hand-stop-o','handshake-o','hard-of-hearing','hashtag','hdd-o','header','headphones','heart','heart-o','heartbeat','history','home','hospital-o','hotel','hourglass','hourglass-1','hourglass-2','hourglass-3','hourglass-end','hourglass-half','hourglass-o','hourglass-start','houzz','html5','i-cursor','id-badge','id-card','id-card-o','ils','image','imdb','inbox','indent','industry','info','info-circle','inr','instagram','institution','internet-explorer','intersex','ioxhost','italic','joomla','jpy','jsfiddle','key','keyboard-o','krw','language','laptop','lastfm','lastfm-square','leaf','leanpub','legal','lemon-o','level-down','level-up','life-bouy','life-buoy','life-ring','life-saver','lightbulb-o','line-chart','link','linkedin','linkedin-square','linode','linux','list','list-alt','list-ol','list-ul','location-arrow','lock','long-arrow-down','long-arrow-left','long-arrow-right','long-arrow-up','low-vision','magic','magnet','mail-forward','mail-reply','mail-reply-all','male','map','map-marker','map-o','map-pin','map-signs','mars','mars-double','mars-stroke','mars-stroke-h','mars-stroke-v','maxcdn','meanpath','medium','medkit','meetup','meh-o','mercury','microchip','microphone','microphone-slash','minus','minus-circle','minus-square','minus-square-o','mixcloud','mobile','mobile-phone','modx','money','moon-o','mortar-board','motorcycle','mouse-pointer','music','navicon','neuter','newspaper-o','object-group','object-ungroup','odnoklassniki','odnoklassniki-square','opencart','openid','opera','optin-monster','outdent','pagelines','paint-brush','paper-plane','paper-plane-o','paperclip','paragraph','paste','pause','pause-circle','pause-circle-o','paw','paypal','pencil','pencil-square','pencil-square-o','percent','phone','phone-square','photo','picture-o','pie-chart','pied-piper','pied-piper-alt','pied-piper-pp','pinterest','pinterest-p','pinterest-square','plane','play','play-circle','play-circle-o','plug','plus','plus-circle','plus-square','plus-square-o','podcast','power-off','print','product-hunt','puzzle-piece','qq','qrcode','question','question-circle','question-circle-o','quora','quote-left','quote-right','ra','random','ravelry','rebel','recycle','reddit','reddit-alien','reddit-square','refresh','registered','remove','renren','reorder','repeat','reply','reply-all','retweet','rmb','road','rocket','rotate-left','rotate-right','rouble','rss','rss-square','rub','ruble','rupee','safari','save','scissors','scribd','search','search-minus','search-plus','sellsy','send','send-o','server','share','share-alt','share-alt-square','share-square','share-square-o','shekel','sheqel','shield','ship','shirtsinbulk','shopping-bag','shopping-basket','shopping-cart','shower','sign-in','sign-language','sign-out','signal','signing','simplybuilt','sitemap','skyatlas','skype','slack','sliders','slideshare','smile-o','snapchat','snapchat-ghost','snapchat-square','snowflake-o','soccer-ball-o','sort','sort-alpha-asc','sort-alpha-desc','sort-amount-asc','sort-amount-desc','sort-asc','sort-desc','sort-down','sort-numeric-asc','sort-numeric-desc','sort-up','soundcloud','space-shuttle','spinner','spoon','spotify','square','square-o','stack-exchange','stack-overflow','star','star-half','star-half-empty','star-half-full','star-half-o','star-o','steam','steam-square','step-backward','step-forward','stethoscope','sticky-note','sticky-note-o','stop','stop-circle','stop-circle-o','street-view','strikethrough','stumbleupon','stumbleupon-circle','subscript','subway','suitcase','sun-o','superpowers','superscript','support','table','tablet','tachometer','tag','tags','tasks','taxi','telegram','television','tencent-weibo','terminal','text-height','text-width','th','th-large','th-list','themeisle','thermometer-empty','thermometer-full','thermometer-half','thermometer-quarter','thermometer-three-quarters','thumb-tack','thumbs-down','thumbs-o-down','thumbs-o-up','thumbs-up','ticket','times','times-circle','times-circle-o','tint','toggle-down','toggle-left','toggle-off','toggle-on','toggle-right','toggle-up','trademark','train','transgender','transgender-alt','trash','trash-o','tree','trello','tripadvisor','trophy','truck','try','tty','tumblr','tumblr-square','turkish-lira','tv','twitch','twitter','twitter-square','umbrella','underline','undo','universal-access','university','unlink','unlock','unlock-alt','unsorted','upload','usb','usd','user','user-circle','user-circle-o','user-md','user-o','user-plus','user-secret','user-times','users','venus','venus-double','venus-mars','viacoin','viadeo','viadeo-square','video-camera','vimeo','vimeo-square','vine','vk','volume-control-phone','volume-down','volume-off','volume-up','warning','wechat','weibo','weixin','whatsapp','wheelchair','wheelchair-alt','wifi','wikipedia-w','window-close','window-close-o','window-maximize','window-minimize','window-restore','windows','won','wordpress','wpbeginner','wpexplorer','wpforms','wrench','xing','xing-square','y-combinator','y-combinator-square','yahoo','yc','yc-square','yelp','yen','yoast','youtube','youtube-play','youtube-square');
	}
}