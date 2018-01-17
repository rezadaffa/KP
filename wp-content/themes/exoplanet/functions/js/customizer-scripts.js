jQuery(document).ready(function($) {
    "use strict";

    //FontAwesome Icon Dropdown
    $('body').on('click', '.icon-list li', function(){
        var icon_class = $(this).find('i').attr('class');
        $(this).addClass('icon-active').siblings().removeClass('icon-active');
        $(this).parent('.icon-list').prev('.selected-icon').children('i').attr('class','').addClass(icon_class);
        $(this).parent('.icon-list').next('input').val(icon_class).trigger('change');
    });

    $('body').on('click', '.selected-icon', function(){
        $(this).next().slideToggle();
    });

    //MultiCheck box area
    $('.customize-control-checkbox-multiple input[type="checkbox"]').on('change', function() {

            var checkbox_values = $( this ).parents('.customize-control').find('input[type="checkbox"]:checked').map(
                function() {
                    return $( this ).val();
                }
            ).get().join(',');

            $( this ).parents('.customize-control').find('input[type="hidden"]').val( checkbox_values ).trigger('change');
        
        }
    );

    //Chosen
    $(".hs-chosen-select").chosen({
        width: "100%"
    });

    $(".customize-control-multi-image").each(function() {
        new MultiImageControl($(this)).start();
    });

    // make the list items clickable
    jQuery('.customize-control-multi-image .thumbnails').on('click', '.thumbnail', function() {
        var li = jQuery(this),
            removeButton = li.closest('.customize-control-multi-image').find('.multi-images-remove').first();
        // toggle the selected class
        li.toggleClass('selected');
        // append or remove the icons from the item
        
        if (li.hasClass('selected')) {
            new RemoveAction(li);
        } else {
            li.empty();
        }
        // trigger the update of the remove button
        removeButton.trigger('updateLabelAndVisibility');
    });

});









/**
 * Alpha Color Picker JS
 */

/**
 * Override the stock color.js toString() method to add support for
 * outputting RGBa or Hex.
 */
Color.prototype.toString = function( flag ) {

    // If our no-alpha flag has been passed in, output RGBa value with 100% opacity.
    // This is used to set the background color on the opacity slider during color changes.
    if ( 'no-alpha' == flag ) {
        return this.toCSS( 'rgba', '1' ).replace( /\s+/g, '' );
    }

    // If we have a proper opacity value, output RGBa.
    if ( 1 > this._alpha ) {
        return this.toCSS( 'rgba', this._alpha ).replace( /\s+/g, '' );
    }

    // Proceed with stock color.js hex output.
    var hex = parseInt( this._color, 10 ).toString( 16 );
    if ( this.error ) { return ''; }
    if ( hex.length < 6 ) {
        for ( var i = 6 - hex.length - 1; i >= 0; i-- ) {
            hex = '0' + hex;
        }
    }

    return '#' + hex;
};

/**
 * Given an RGBa, RGB, or hex color value, return the alpha channel value.
 */
function acp_get_alpha_value_from_color( value ) {
    var alphaVal;

    // Remove all spaces from the passed in value to help our RGBa regex.
    value = value.replace( / /g, '' );

    if ( value.match( /rgba\(\d+\,\d+\,\d+\,([^\)]+)\)/ ) ) {
        alphaVal = parseFloat( value.match( /rgba\(\d+\,\d+\,\d+\,([^\)]+)\)/ )[1] ).toFixed(2) * 100;
        alphaVal = parseInt( alphaVal );
    } else {
        alphaVal = 100;
    }

    return alphaVal;
}

/**
 * Force update the alpha value of the color picker object and maybe the alpha slider.
 */
function acp_update_alpha_value_on_color_control( alpha, $control, $alphaSlider, update_slider ) {
    var iris, colorPicker, color;

    iris = $control.data( 'a8cIris' );
    colorPicker = $control.data( 'wpWpColorPicker' );

    // Set the alpha value on the Iris object.
    iris._color._alpha = alpha;

    // Store the new color value.
    color = iris._color.toString();

    // Set the value of the input.
    $control.val( color );

    // Update the background color of the color picker.
    colorPicker.toggler.css({
        'background-color': color
    });

    // Maybe update the alpha slider itself.
    if ( update_slider ) {
        acp_update_alpha_value_on_alpha_slider( alpha, $alphaSlider );
    }

    // Update the color value of the color picker object.
    $control.wpColorPicker( 'color', color );
}

/**
 * Update the slider handle position and label.
 */
function acp_update_alpha_value_on_alpha_slider( alpha, $alphaSlider ) {
    $alphaSlider.slider( 'value', alpha );
    $alphaSlider.find( '.ui-slider-handle' ).text( alpha.toString() );
}

/**
 * Initialization trigger.
 */
jQuery( document ).ready( function( $ ) {

    // Loop over each control and transform it into our color picker.
    $( '.alpha-color-control' ).each( function() {

        // Scope the vars.
        var $control, startingColor, paletteInput, showOpacity, defaultColor, palette,
            colorPickerOptions, $container, $alphaSlider, alphaVal, sliderOptions;

        // Store the control instance.
        $control = $( this );

        // Get a clean starting value for the option.
        startingColor = $control.val().replace( /\s+/g, '' );

        // Get some data off the control.
        paletteInput = $control.attr( 'data-palette' );
        showOpacity  = $control.attr( 'data-show-opacity' );
        defaultColor = $control.attr( 'data-default-color' );

        // Process the palette.
        if ( paletteInput.indexOf( '|' ) !== -1 ) {
            palette = paletteInput.split( '|' );
        } else if ( 'false' == paletteInput ) {
            palette = false;
        } else {
            palette = true;
        }

        // Set up the options that we'll pass to wpColorPicker().
        colorPickerOptions = {
            change: function( event, ui ) {
                var key, value, alpha, $transparency;

                key = $control.attr( 'data-customize-setting-link' );
                value = $control.wpColorPicker( 'color' );

                // Set the opacity value on the slider handle when the default color button is clicked.
                if ( defaultColor == value ) {
                    alpha = acp_get_alpha_value_from_color( value );
                    $alphaSlider.find( '.ui-slider-handle' ).text( alpha );
                }

                // Send ajax request to wp.customize to trigger the Save action.
                wp.customize( key, function( obj ) {
                    obj.set( value );
                });

                $transparency = $container.find( '.transparency' );

                // Always show the background color of the opacity slider at 100% opacity.
                $transparency.css( 'background-color', ui.color.toString( 'no-alpha' ) );
            },
            palettes: palette // Use the passed in palette.
        };

        // Create the colorpicker.
        $control.wpColorPicker( colorPickerOptions );

        $container = $control.parents( '.wp-picker-container:first' );

        // Insert our opacity slider.
        $( '<div class="alpha-color-picker-container">' +
                '<div class="min-click-zone click-zone"></div>' +
                '<div class="max-click-zone click-zone"></div>' +
                '<div class="alpha-slider"></div>' +
                '<div class="transparency"></div>' +
            '</div>' ).appendTo( $container.find( '.wp-picker-holder' ) );

        $alphaSlider = $container.find( '.alpha-slider' );

        // If starting value is in format RGBa, grab the alpha channel.
        alphaVal = acp_get_alpha_value_from_color( startingColor );

        // Set up jQuery UI slider() options.
        sliderOptions = {
            create: function( event, ui ) {
                var value = $( this ).slider( 'value' );

                // Set up initial values.
                $( this ).find( '.ui-slider-handle' ).text( value );
                $( this ).siblings( '.transparency ').css( 'background-color', startingColor );
            },
            value: alphaVal,
            range: 'max',
            step: 1,
            min: 0,
            max: 100,
            animate: 300
        };

        // Initialize jQuery UI slider with our options.
        $alphaSlider.slider( sliderOptions );

        // Maybe show the opacity on the handle.
        if ( 'true' == showOpacity ) {
            $alphaSlider.find( '.ui-slider-handle' ).addClass( 'show-opacity' );
        }

        // Bind event handlers for the click zones.
        $container.find( '.min-click-zone' ).on( 'click', function() {
            acp_update_alpha_value_on_color_control( 0, $control, $alphaSlider, true );
        });
        $container.find( '.max-click-zone' ).on( 'click', function() {
            acp_update_alpha_value_on_color_control( 100, $control, $alphaSlider, true );
        });

        // Bind event handler for clicking on a palette color.
        $container.find( '.iris-palette' ).on( 'click', function() {
            var color, alpha;

            color = $( this ).css( 'background-color' );
            alpha = acp_get_alpha_value_from_color( color );

            acp_update_alpha_value_on_alpha_slider( alpha, $alphaSlider );

            // Sometimes Iris doesn't set a perfect background-color on the palette,
            // for example rgba(20, 80, 100, 0.3) becomes rgba(20, 80, 100, 0.298039).
            // To compensante for this we round the opacity value on RGBa colors here
            // and save it a second time to the color picker object.
            if ( alpha != 100 ) {
                color = color.replace( /[^,]+(?=\))/, ( alpha / 100 ).toFixed( 2 ) );
            }

            $control.wpColorPicker( 'color', color );
        });

        // Bind event handler for clicking on the 'Clear' button.
        $container.find( '.button.wp-picker-clear' ).on( 'click', function() {
            var key = $control.attr( 'data-customize-setting-link' );

            // The #fff color is delibrate here. This sets the color picker to white instead of the
            // defult black, which puts the color picker in a better place to visually represent empty.
            $control.wpColorPicker( 'color', '#ffffff' );

            // Set the actual option value to empty string.
            wp.customize( key, function( obj ) {
                obj.set( '' );
            });

            acp_update_alpha_value_on_alpha_slider( 100, $alphaSlider );
        });

        // Bind event handler for clicking on the 'Default' button.
        $container.find( '.button.wp-picker-default' ).on( 'click', function() {
            var alpha = acp_get_alpha_value_from_color( defaultColor );

            acp_update_alpha_value_on_alpha_slider( alpha, $alphaSlider );
        });

        // Bind event handler for typing or pasting into the input.
        $control.on( 'input', function() {
            var value = $( this ).val();
            var alpha = acp_get_alpha_value_from_color( value );

            acp_update_alpha_value_on_alpha_slider( alpha, $alphaSlider );
        });

        // Update all the things when the slider is interacted with.
        $alphaSlider.slider().on( 'slide', function( event, ui ) {
            var alpha = parseFloat( ui.value ) / 100.0;

            acp_update_alpha_value_on_color_control( alpha, $control, $alphaSlider, false );

            // Change value shown on slider handle.
            $( this ).find( '.ui-slider-handle' ).text( ui.value );
        });

    });
});














function RemoveAction(parent) {
    this.parent = parent;
    this.removeButton = jQuery('<span></span>');
    this.removeButton.attr('class', 'removeIcon');
    this.removeButton.append(jQuery('<a>x</a>'));

    this.removeButton.on('click', function(event) {
        event.preventDefault();
        var item = jQuery(this).parent(),
            root = item.closest('.customize-control-multi-image'),
            input = root.find('input.multi-images-control-input'),
            urls = [],
            image_ids = [];
        item.remove();
        jQuery(root).find('.thumbnail').each(function(index, el) {
            urls.push(jQuery(this).data('src'));
            image_ids.push(jQuery(this).data('id'));
        });
        input.val(image_ids.reverse()).trigger('change');
        input.trigger('updateThumbnails', {
            urls: urls,
            image_ids: image_ids
        });
    });

    this.parent.append(this.removeButton);
}

function MultiImageControl(root) {
    /**
     * The jQuery object that references a single multi imagec control
     *
     * @type {jQuery object}
     */
    this.root = root;
    /**
     * The hidden input that will store the images urls, that's linked to
     * the Backbone
     *
     * @type {jQuery object}
     */
    this.store = root.find('input.multi-images-control-input');
    this.uploadButtton = root.find('.multi-images-upload');
    this.removeButton = root.find('.multi-images-remove');
    this.thumbnails = root.find('ul.thumbnails');

    this.start = function() {
        // clicking the upload button will open the media frame
        // and update the input field value
        this.uploadButtton.on('click', function(evt) {
            var file_frame, 
            store = jQuery(this).closest('.customize-control-multi-image').find('input.multi-images-control-input');

            evt.preventDefault();

            // file frame already created, return
            if (file_frame) {
                file_frame.open();
                return;
            }

            // create the file frame
            file_frame = wp.media.frames.file_frame = wp.media({
                title: 'Select Images',
                button: {
                    text: 'Use Selected Images',
                },
                multiple: 'add',
                library: {
                    type: 'image'
                }
            });

            // get the selected attachments when user selects
            file_frame.on('select', function(evt) {
                var selected = file_frame.state().get('selection').toJSON(),
                    urls = [];
                    image_ids = [];
                for (var i = selected.length - 1; i >= 0; i--) {
                    urls.push(selected[i].url);
                    image_ids.push(selected[i].id);
                }
                store.val(image_ids).trigger('change');
                store.trigger('updateThumbnails', {
                    urls: urls,
                    image_ids: image_ids
                });
            });
            // open the file frame
            file_frame.open();
        });

        // remove all images when the remove images button is pressed
        this.removeButton.on('click', function(evt) {
            var root, thumbnails, store, selected, urls = [], image_ids = [];

            root = jQuery(this).closest('.customize-control-multi-image');
            thumbnails = root.find('.thumbnails');
            store = root.find('input.multi-images-control-input');

            evt.preventDefault();

            selected = thumbnails.find('.thumbnail.selected');

            if (selected.length === 0) {
                image_ids = '';
            } else {
                thumbnails.find('.thumbnail:not(.selected)').each(function() {
                    image_ids.push(jQuery(this).data('id'));
                    urls.push(jQuery(this).data('src'));
                });
            }
            store.val(image_ids).trigger('change');
            store.trigger('updateThumbnails', {
                urls: urls,
                image_ids: image_ids
            });
        });

        this.removeButton.on('updateLabelAndVisibility', function(evt) {
            var button, thumbnails, thumbs, selected, count;
            button = jQuery(this);
            thumbnails = button.closest('.customize-control-multi-image').find('.thumbnails');
            thumbs = thumbnails.find('.thumbnail');
            if (thumbs.length === 0) {
                button.hide();
                return;
            }
            button.show();
            selected = thumbnails.find('.thumbnail.selected');
            count = selected.length;
            if (count === 0) {
                button.text('Remove all images');
            } else if (count === 1) {
                button.text('Remove the image');
            } else if (count >= 2) {
                button.text('Remove ' + count + ' images');
            }
        });

        // update the images when the input value changes
        this.store.on('updateThumbnails', function(evt, args) {
            var root, thumbnails, urls = args.urls, image_ids = args.image_ids;
            root = jQuery(this).closest('.customize-control-multi-image');
            thumbnails = root.find('.thumbnails');
            // remove old images
            thumbnails.empty();
            // for each image url in the value create and append an image element to the list
            for (var i = urls.length - 1; i >= 0; i--) {
                var li = jQuery('<li/>');
                li.attr('style', 'background-image:url(' + urls[i] + ');');
                li.attr('class', 'thumbnail');
                li.attr('data-src', urls[i]);
                li.attr('data-id', image_ids[i]);
                thumbnails.append(li);
            }
            // update or hide the remove images button
            root.find('.multi-images-remove').trigger('updateLabelAndVisibility');
        });

        // make the images sortable
        this.thumbnails.sortable({
            items: '> li',
            axis: 'y',
            opacity: 0.6,
            distance: 3,
            cursor: 'move',
            delay: 150,
            tolerance: 'pointer',
            update: function(evt, ui) {
                var t = jQuery(this),
                    urls = [],
                    image_ids = [],
                    input;
                jQuery(t.find('li')).each(function() {
                    var li = jQuery(this);
                    urls.push(li.data('src'));
                    image_ids.push(li.data('id'));
                    li.removeClass('no-list');
                });
                input = t.closest('.customize-control-multi-image').find('input.multi-images-control-input');
                input.val(image_ids).trigger('change');
                t.sortable('refreshPositions');
            },
            start: function(evt, ui) {
                var thumbnails = jQuery(this);
                thumbnails.find('li').each(function() {
                    jQuery(this).addClass('no-list');
                    jQuery(this).removeClass('selected');
                });
                // trigger the remove button label refresh
                thumbnails.closest('.customize-control-multi-image').find('.multi-images-remove').trigger('updateLabelAndVisibility');
            }
        }).disableSelection();

        // bootstrap the remove button label and visibility
        this.removeButton.trigger('updateLabelAndVisibility');
    };
}