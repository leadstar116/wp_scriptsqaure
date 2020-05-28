(function($){
    "use strict";

    $(document).on( 'change', '.sort-by-select .orderby, #listeo_core-search-form.ajax-search select, .ajax-search input:not(#location_search,#_price_range,.bootstrap-range-slider)', function(e) {
        console.log('change test!!!');
    });

});