/**
 * Exoplanet Custom JS
 *
 * @package Exoplanet
 *
 * Distributed under the MIT license - http://opensource.org/licenses/MIT
 */
jQuery(document).ready(function($){
 // Defining a function to set size for .slide and page title padding if we have a very large primary menu
    function fullscreen(){
        var exoplanetwidth = jQuery(window).width();
        var exoplanetheight = jQuery(window).height();
        exoplanetwidth = parseInt(exoplanetwidth);
        exoplanetheight = parseInt(exoplanetheight);

        if ( exoplanetheight > 460 ) {
            var exoplanetheight2 = exoplanetheight;
        } else {
            var exoplanetheight2 = 460;
        }

        var masthead = $('#masthead').height();
        var headertitle = $('.header-title').height();
        masthead = parseInt(masthead);
        headertitle = parseInt(headertitle);

        var headerheight = masthead + headertitle + 135;

        jQuery('.slide').css({
            width: exoplanetwidth + 'px',
            height: exoplanetheight2 + 'px'
        });

        if( $('.main-header').length ) {
            jQuery('.main-header').css({
                'padding-top' : masthead + 'px',
                'min-height' : headerheight + 'px'
            });
        } else {
            if ( $('#home-slider-section').length ) {

            } else {
                jQuery('.custom-post-type-header').css({
                    'padding-top' : masthead + 'px',
                    'display' : 'block'
                });
            }
        }

    }
  
    fullscreen();

  // Run the function in case of window resize
  jQuery(window).resize(function() {
       fullscreen();         
    });

});


jQuery(function($){

	$('#bx-slider').bxSlider({
		'pager':false,
		'auto' : true,
		'mode' : 'fade',
		'pause' : 5000,
		'prevText' : '<i class="fa fa-angle-left"></i>',
		'nextText' : '<i class="fa fa-angle-right"></i>',
		'adaptiveHeight' : true
	});

    $(window).scroll(function(){
    	var scrollTop = $(window).scrollTop();
    	if( scrollTop > 0 ){
    		$('#masthead').addClass('scrolled');
    	}else{
    		$('#masthead').removeClass('scrolled');
    	}
        $('.main-header').css('background-position', 'center ' + (scrollTop / 2) + 'px');
        $('#bx-slider').css({top: (scrollTop / 2.6)});
        if ( scrollTop > $(window).height() ) {
            $('#bx-slider').addClass('sticky');
        } else {
            $('#bx-slider').removeClass('sticky');
        }
    });

    $('.menu > ul').superfish({
		delay:       500,                            
		animation:   {opacity:'show',height:'show'},  
		speed:       'fast'                         
	});

    $('.toggle-nav').click(function(){
    	$('#site-navigation').slideToggle();
    });

});