/**
 * Admin Scripts
 */

;(function ($, window, document) {
    "use strict";

    $(document).on('change', 'input[name="preloader_active_id"]', function () {

        let dependencies,preloaderSelector = $(this),
            dependency = preloaderSelector.parent().parent().find('input[name=preloader_active_id]:checked').parent().find('img').attr('dependency'),
            bgColorWrap = $('#bg_color').parent().parent().parent().parent().parent(),
            primaryColorWrap = $('#primary_color').parent().parent().parent().parent().parent(),
            secondaryColorWrap = $('#secondary_color').parent().parent().parent().parent().parent();

        dependency = typeof dependency === 'undefined' || dependency.length === 0 ? '' : dependency;
        dependencies = dependency.split(' ');
        dependencies = dependencies.filter(function (el) {
            return el != null && el !== "";
        });

        if ($.inArray('bg_color', dependencies) !== -1) {
            bgColorWrap.addClass('field-hide').fadeIn(50);
        } else {
            bgColorWrap.removeClass('field-hide').fadeOut(50);
        }

        if ($.inArray('primary_color', dependencies) !== -1) {
            primaryColorWrap.addClass('field-hide').fadeIn(50);
        } else {
            primaryColorWrap.removeClass('field-hide').fadeOut(50);
        }

        if ($.inArray('secondary_color', dependencies) !== -1) {
            secondaryColorWrap.addClass('field-hide').fadeIn(50);
        } else {
            secondaryColorWrap.removeClass('field-hide').fadeOut(50);
        }
    });


    $(window).on('load', function () {

        let dependencies,preloaderSelector = $('input[name="preloader_active_id"]'),
            dependency = preloaderSelector.parent().parent().find('input[name=preloader_active_id]:checked').parent().find('img').attr('dependency'),
            bgColorWrap = $('#bg_color').parent().parent().parent().parent().parent(),
            primaryColorWrap = $('#primary_color').parent().parent().parent().parent().parent(),
            secondaryColorWrap = $('#secondary_color').parent().parent().parent().parent().parent();

        dependency = typeof dependency === 'undefined' || dependency.length === 0 ? '' : dependency;
        dependencies = dependency.split(' ');
        dependencies = dependencies.filter(function (el) {
            return el != null && el !== "";
        });

        if ($.inArray('bg_color', dependencies) !== -1) {
            bgColorWrap.addClass('field-hide').fadeIn(50);
        } else {
            bgColorWrap.removeClass('field-hide').fadeOut(50);
        }

        if ($.inArray('primary_color', dependencies) !== -1) {
            primaryColorWrap.addClass('field-hide').fadeIn(50);
        } else {
            primaryColorWrap.removeClass('field-hide').fadeOut(50);
        }

        if ($.inArray('secondary_color', dependencies) !== -1) {
            secondaryColorWrap.addClass('field-hide').fadeIn(50);
        } else {
            secondaryColorWrap.removeClass('field-hide').fadeOut(50);
        }

        /**
         * Backend Preloader
         */

        if ($('body').hasClass('has-preloader'), $('body').removeClass('has-preloader')) {
            $(".preloader-x").fadeOut('slow');
            $(document).trigger('preloader.hidden');
        } else {
            $(document).trigger('preloader.hidden');
        }
    });


})(jQuery, window, document);