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

        $('.page-header__basket-btn').click(function() {
            $('.page-header__basket').toggleClass('page-header__basket--open');
        });

        $('#select-super-header-lang').change(function() {
            window.location = $('#select-super-header-lang').val();
        });

        $(document).ready(function() {

        });

        $(window).smartresize(function() {

        });
    }

})(window, document, jQuery);