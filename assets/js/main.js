(function (window, document, $) {

    init();

    // Called on page load
    function init() {
        var select2Opts = {
            minimumResultsForSearch: Infinity // Remove search box (may need to make this conditional)
        };

        if ($('select').length) {
            $('select').select2(select2Opts);
        }

        $(document).ready(function() {

        });

        $(window).smartresize(function(){

        });
    }

})(window, document, jQuery);