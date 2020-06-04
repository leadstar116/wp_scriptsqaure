;(function ($, window, document) {
    "use strict";

    $(window).on('load', function (e) {
        let documentBody = $('body');
        if (documentBody.hasClass('has-preloader'), documentBody.removeClass('has-preloader')) {
            $(".preloader-x").fadeOut('slow');
            $(document).trigger('preloader.hidden');
        } else {
            $(document).trigger('preloader.hidden');
        }
    });
})(jQuery, window, document);