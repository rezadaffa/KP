/**
 * Theme Customizer enhancements for a better user experience
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously
 */

( function( $ ) {

	wp.customize( 'hi_color', function( value ) {
		value.bind( function( to ) {
			var style;
			style = '<style>button,input[type="button"],input[type="reset"],input[type="submit"],.widget-area .widget-title:before,.widget-area .widget-title:after,h3#reply-title:after,h3.comments-title:after,.comment-navigation .nav-previous a,.comment-navigation .nav-next a,.section-title:after,.menu > ul > li > a:hover:before,.menu > ul > li.current_page_item > a:before,.menu > ul > li.current-menu-item > a:before,.slide-cap-title:after,.slide-button-right,#home-slider-section .bx-wrapper .bx-controls-direction a:hover,.featured-post h4:before,.featured-post h4:after,.featured-readmore,#cta-section,.woocommerce ul.products li.product .button.add_to_cart_button,.woocommerce a.added_to_cart,.woocommerce #respond input#submit.alt,.woocommerce a.button.alt,.woocommerce button.button.alt,.woocommerce input.button.alt,.woocommerce #respond input#submit.alt:hover,.woocommerce a.button.alt:hover,.woocommerce button.button.alt:hover,.woocommerce input.button.alt:hover,.woocommerce #respond input#submit:hover,.woocommerce a.button:hover,.woocommerce button.button:hover,.woocommerce input.button:hover,.woocommerce #respond input#submit.alt.disabled,.woocommerce #respond input#submit.alt.disabled:hover,.woocommerce #respond input#submit.alt:disabled,.woocommerce #respond input#submit.alt:disabled:hover,.woocommerce #respond input#submit.alt:disabled[disabled],.woocommerce #respond input#submit.alt:disabled[disabled]:hover,.woocommerce a.button.alt.disabled, .woocommerce a.button.alt.disabled:hover,.woocommerce a.button.alt:disabled, .woocommerce a.button.alt:disabled:hover,.woocommerce a.button.alt:disabled[disabled],.woocommerce a.button.alt:disabled[disabled]:hover,.woocommerce button.button.alt.disabled,.woocommerce button.button.alt.disabled:hover,.woocommerce button.button.alt:disabled,.woocommerce button.button.alt:disabled:hover,.woocommerce button.button.alt:disabled[disabled],.woocommerce button.button.alt:disabled[disabled]:hover,.woocommerce input.button.alt.disabled,.woocommerce input.button.alt.disabled:hover,.woocommerce input.button.alt:disabled,.woocommerce input.button.alt:disabled:hover,.woocommerce input.button.alt:disabled[disabled],.woocommerce input.button.alt:disabled[disabled]:hover,.woocommerce #respond input#submit,.woocommerce a.button,.woocommerce button.button,.woocommerce input.button,.woocommerce div.product .woocommerce-tabs ul.tabs li.active:after,.woocommerce .widget_price_filter .ui-slider .ui-slider-range,.woocommerce .widget_price_filter .ui-slider .ui-slider-handle{background:' + to + ' !important;}a,a:hover,a:focus,a:active,.single-entry-content a,.single-entry-content a:hover,.widget-area a:hover,.comment-list a:hover,.main-navigation a:hover,.main-navigation .current_page_item > a,.main-navigation .current-menu-item > a,.main-navigation .current_page_ancestor > a,.slide-button-left:hover,a:hover.slide-button-left,.featured-post .featured-icon,.featured-post h4 a:hover,#cta-section .cta-right a:hover,.pagination a:hover,.pagination .current,.woocommerce .woocommerce-breadcrumb a:hover,.woocommerce nav.woocommerce-pagination ul li a:focus,.woocommerce nav.woocommerce-pagination ul li a:hover,.woocommerce nav.woocommerce-pagination ul li span.current,.woocommerce ul.products li.product h3 a:hover,.woocommerce ul.products li.product .price,.woocommerce div.product p.price,.woocommerce div.product span.price,.woocommerce .woocommerce-message:before,.woocommerce .woocommerce-info:before{color:' + to + ';}.featured-post .featured-icon,.pagination a:hover,.pagination span,.woocommerce nav.woocommerce-pagination ul li a:focus,.woocommerce nav.woocommerce-pagination ul li a:hover,.woocommerce nav.woocommerce-pagination ul li span.current{border: 1px solid ' + to + ' !important;}.comment-navigation .nav-next a:after{border-left: 11px solid ' + to + ' !important;}.comment-navigation .nav-previous a:after{border-right: 11px solid ' + to + ' !important;}.slide-button-right{border: 2px solid ' + to + ' !important;}.woo-title-price{border-top: 1px dashed ' + to + ' !important;}</style>';
			$( 'head' ).append( style );
		} );
	} );

	// Site title and description.
	wp.customize('blogname', function( value ) {
		value.bind( function( to ) {
			$('.site-title a').text( to );
		} );
	} );
	wp.customize('blogdescription', function( value ) {
		value.bind( function( to ) {
			$('.site-description').text( to );
		} );
	} );
	wp.customize('site_title_font_size', function( value ) {
		value.bind( function( to ) {
			$('.site-title').css( {'font-size': to + 'px'} );
		} );
	} );
	wp.customize('tagline_font_size', function( value ) {
		value.bind( function( to ) {
			$('.site-description').css( {'font-size': to + 'px'} );
		} );
	} );

	// Header text color.
	wp.customize('header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ('blank' === to ) {
				$('.site-title a, .site-description').css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$('.site-title a, .site-description').css( {
					'clip': 'auto',
					'color': to,
					'position': 'relative'
				} );
				$('.slide-cap-title, .slide-cap-desc, a.slide-button-left').css( {
					'color': to,
				} );
				$('.slide-button-left').css( {
					'border-color': to,
				} );
			}
		} );
	} );

	// Header background color
	wp.customize('header_bg', function( value ) {
		value.bind( function( to ) {
			$( '#masthead' ).css( 'background', to );
			$( '.slide-caption' ).css( 'background', to );
		} );
	} );

	wp.customize('header_bg_scr', function( value ) {
		value.bind( function( to ) {
			var style;
			style = '<style>#masthead:hover { box-shadow: inset 0 -260px 0 ' + to + ' !important;} #masthead.scrolled { background: ' + to + ' !important;}</style>';
			$( 'head' ).append( style );
		} );
	} );

	// Menu
	wp.customize('menu_item_color', function( value ) {
		value.bind( function( to ) {
			$( '.menu > ul > li > a' ).css( 'color', to );
			var style;
			style = '<style>.sf-arrows .sf-with-ul:after{border-top-color: ' + to + ';}</style>';
			$( 'head' ).append( style );
		} );
	} );

	wp.customize('menu_height', function( value ) {
		value.bind( function( to ) {
			$( '.main-navigation li' ).css( {'line-height': to + 'px'} );
		} );
	} );

	wp.customize('menu_uppercase', function( value ) {
		value.bind( function( to ) {
			if (to) {
				$( '.main-navigation a' ).css( {'text-transform': 'uppercase'} );
			} else {
				$( '.main-navigation a' ).css( {'text-transform': 'none'} );
			}
		} );
	} );	

	// Page title
	wp.customize('page_header_bgcolor', function( value ) {
		value.bind( function( to ) {
			$( '.main-header' ).css( 'background-color', to );
		} );
	} );

	wp.customize('page_header_titlecolor', function( value ) {
		value.bind( function( to ) {
			$( '.main-title' ).css( 'color', to );
			$( '.breadcrumbs' ).css( 'color', to );
			$( '.breadcrumbs a' ).css( 'color', to );
		} );
	} );

	// Post meta
	wp.customize('blog_meta_layout', function( value ) {
		value.bind( function( to ) {
			$( '.entry-header' ).css( 'text-align', to );
		} );
	} );

	wp.customize('disable_blog_date', function( value ) {
		value.bind( function( to ) {
			if (to) {
				$( '.posted-on' ).css( {'display': 'none'} );
			} else {
				$( '.posted-on' ).css( {'display': 'inline-block'} );
			}
		} );
	} );

	wp.customize('disable_blog_author', function( value ) {
		value.bind( function( to ) {
			if (to) {
				$( '.byline' ).css( {'display': 'none'} );
			} else {
				$( '.byline' ).css( {'display': 'inline-block'} );
			}
		} );
	} );

	// Extra colors
	wp.customize('body_text_color', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).css( 'color', to );
			$( '.sticky .post-wrapper' ).css( 'border-color', to );
			$( '.title-header .taxonomy-description' ).css( 'color', to );
			$( '.title-header .breadcrumbs' ).css( 'color', to );
			$( '.title-header .breadcrumbs a' ).css( 'color', to );
			$( '.title-header .term-description' ).css( 'color', to );
		} );
	} );

	wp.customize('background_color', function( value ) {
		value.bind( function( to ) {
			$( '.featured-section-title span' ).css( 'background', to );
		} );
	} );

	wp.customize('heading_color', function( value ) {
		value.bind( function( to ) {
			$( 'h1' ).css( 'color', to );
			$( 'h2' ).css( 'color', to );
			$( 'h3' ).css( 'color', to );
			$( 'h4' ).css( 'color', to );
			$( 'h5' ).css( 'color', to );
			$( 'h6' ).css( 'color', to );
			$( '.entry-header .entry-title a' ).css( 'color', to );
			$( '.featured-section-title span' ).css( 'color', to );
			$( '.title-header .main-title, .featured-post h4 a' ).css( 'color', to );
			$( '#colophon h5.widget-title' ).css( {'color': '#fff'} );
		} );
	} );

	wp.customize('post_bgcolor', function( value ) {
		value.bind( function( to ) {
			$( '.post-wrapper' ).css( 'background', to );
		} );
	} );

	wp.customize('sidebar_bgcolor', function( value ) {
		value.bind( function( to ) {
			$( '#secondary' ).css( 'background', to );
		} );
	} );

	wp.customize('sidebar_linkcolor', function( value ) {
		value.bind( function( to ) {
			$( '.widget a' ).css( 'color', to );
			$( '.site-footer a' ).css( {'color': '#fff'} );
		} );
	} );

	wp.customize('page_footertop_color', function( value ) {
		value.bind( function( to ) {
			$( '#top-footer' ).css( 'background', to );
		} );
	} );

	wp.customize('page_footermid_color', function( value ) {
		value.bind( function( to ) {
			$( '#middle-footer' ).css( 'background', to );
		} );
	} );

	wp.customize('page_footerbot_color', function( value ) {
		value.bind( function( to ) {
			$( '#bottom-footer' ).css( 'background', to );
		} );
	} );

	// Google fonts
	wp.customize('font_header', function( value ) {
		value.bind( function( to ) {
			var googlefont = encodeURI(to.replace(" ", "+"));
			$( 'head' ).append( '<link href="//fonts.googleapis.com/css?family=' + googlefont + '" type="text/css" media="all" rel="stylesheet">' );
			to = to.substr(0, to.indexOf(':'));
			to = "'" + to + "'";
			$( '#masthead,.site-title' ).css({
				fontFamily: to
			});
		} );
	} );
	wp.customize('font_nav', function( value ) {
		value.bind( function( to ) {
			var googlefont = encodeURI(to);
			$( 'head' ).append( '<link href="//fonts.googleapis.com/css?family=' + googlefont + '" type="text/css" media="all" rel="stylesheet">' );
			to = to.substr(0, to.indexOf(':'));
			to = "'" + to + "'";
			$( '#site-navigation' ).css({
				fontFamily: to
			});
		} );
	} );
	wp.customize('font_page_title', function( value ) {
		value.bind( function( to ) {
			var googlefont = encodeURI(to.replace(" ", "+"));
			$( 'head' ).append( '<link href="//fonts.googleapis.com/css?family=' + googlefont + '" type="text/css" media="all" rel="stylesheet">' );
			to = to.substr(0, to.indexOf(':'));
			to = "'" + to + "'";
			$( '.main-title' ).css({
				fontFamily: to
			});
		} );
	} );
	wp.customize('font_content', function( value ) {
		value.bind( function( to ) {
			var googlefont = encodeURI(to);
			$( 'head' ).append( '<link href="//fonts.googleapis.com/css?family=' + googlefont + '" type="text/css" media="all" rel="stylesheet">' );
			to = to.substr(0, to.indexOf(':'));
			to = "'" + to + "'";
			$( 'body,button,input,select,textarea' ).css({
				fontFamily: to
			});
		} );
	} );
	wp.customize('font_headings', function( value ) {
		value.bind( function( to ) {
			var googlefont = encodeURI(to.replace(" ", "+"));
			var to = to.substr(0, to.indexOf(':'));
			to = "'" + to + "'";
			$( 'head' ).append( '<link href="//fonts.googleapis.com/css?family=' + googlefont + '" type="text/css" media="all" rel="stylesheet"><style>h1:not(.site-title){font-family:' + to +'}</style>' );
			$( 'h2,h3,h4,h5,h6,.featured-section-title span,#cta-section .cta-left .leadin' ).css({
				fontFamily: to
			});
			/*$( '#masthead,.site-title' ).css({
				fontFamily: ''
			});*/
		} );
	} );
	wp.customize('font_footer', function( value ) {
		value.bind( function( to ) {
			var googlefont = encodeURI(to);
			$( 'head' ).append( '<link href="//fonts.googleapis.com/css?family=' + googlefont + '" type="text/css" media="all" rel="stylesheet">' );
			to = to.substr(0, to.indexOf(':'));
			to = "'" + to + "'";
			$( '#colophon' ).css({
				fontFamily: to
			});
		} );
	} );

	// Featured Page icons
	wp.customize('featured_page_icon1', function( value ) {
		value.bind( function( to ) {
			$('.featured-post1 i').removeClass().addClass(''+to);
		} );
	} );
	wp.customize('featured_page_icon2', function( value ) {
		value.bind( function( to ) {
			$('.featured-post2 i').removeClass().addClass(''+to);
		} );
	} );
	wp.customize('featured_page_icon3', function( value ) {
		value.bind( function( to ) {
			$('.featured-post3 i').removeClass().addClass(''+to);
		} );
	} );
	wp.customize('featured_page_icon4', function( value ) {
		value.bind( function( to ) {
			$('.featured-post4 i').removeClass().addClass(''+to);
		} );
	} );
	
} )( jQuery );
