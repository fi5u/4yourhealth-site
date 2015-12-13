(function (window, document, $) {

    init();

    // Called on page load
    function init() {
        var select2Opts = {
            minimumResultsForSearch: Infinity // Remove search box (may need to make this conditional)
        };

        if ($('#select-super-header-lang').length) {
            $('select').select2(select2Opts);
        }

        $('.page-header__basket-btn').click(function() {
            $('.page-header__basket').toggleClass('page-header__basket--open');
        });

        $('#select-super-header-lang').change(function() {
            window.location = $('#select-super-header-lang').val();
        });

        $('.woo-widget').not('.widget_product_categories').addClass('woo-widget--is-closed');

        $(document).ready(function() {
            $('#carousel-hero').bxSlider({
                auto: true,
                autoHover: true,
                controls: false,
                nextText: '>',
                prevText: '<'
            });

            $('#carousel-product').bxSlider({
                auto: false,
                pager: false,
                controls: true,
                nextText: '>',
                prevText: '<'
            });

            $('#carousel-testimonials').bxSlider({
                auto: true,
                autoHover: true,
                pager: false,
                controls: true,
                nextText: '>',
                prevText: '<',
                minSlides: 1,
                maxSlides: 1,
            });

            $('#carousel-news').bxSlider({
                auto: false,
                autoHover: true,
                pager: false,
                controls: true,
                nextText: '>',
                prevText: '<',
                minSlides: 1,
                maxSlides: 1,
            });
        });

        $(window).smartresize(function() {

        });
    }

    $('.woo-widget__title').click(function() {
        $(this).parent('.woo-widget').toggleClass('woo-widget--is-closed');
    });

    $( document ).on( 'click', '.add_to_cart_button', function() {
        var count = 0;
        window.setTimeout(function() {
            $('.mini_cart_item').each(function() {
                count = count + parseInt($(this).find('.quantity').html());
                console.log(count);
            });
            $('#mini-cart-count').text(count);
            $('#mini-cart-total').text($('.page-header__basket-list .total .amount').html());
        }, 1000);
    });

})(window, document, jQuery);