(function (window, document, $) {

    init();

    // Called on page load
    function init() {
        var select2Opts = {
            minimumResultsForSearch: Infinity // Remove search box (may need to make this conditional)
        };

        if ($('#select-super-header-lang').length) {
            $('#select-super-header-lang').select2(select2Opts);
        }

        $('.page-header__basket-btn').click(function() {
            $('.page-header__basket').toggleClass('page-header__basket--open');
        });

        $('#select-super-header-lang').change(function() {
            var url = data.currentUrl;
            var lang = data.currentLang;
            var targetLang = $('#select-super-header-lang').val();
            var targetUrl;
            if (url.indexOf('/' + lang + '/') === -1) {
                targetUrl = targetLang + url;
            } else {
                targetUrl = url.replace('/' + lang + '/', targetLang);
            }
            window.location = targetUrl;
        });

        $('select.orderby').select2();

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
                mode: 'fade',
                auto: true,
                autoHover: true,
                pager: false,
                controls: true,
                nextText: '>',
                prevText: '<',
                minSlides: 1,
                maxSlides: 1,
                slideWidth: 357,
                adaptiveHeight: true
            });

            $('#carousel-news').bxSlider({
                mode: 'fade',
                auto: false,
                autoHover: true,
                pager: false,
                controls: true,
                nextText: '>',
                prevText: '<',
                minSlides: 1,
                maxSlides: 1,
                slideWidth: 357,
                adaptiveHeight: true
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
            });
            $('#mini-cart-count').text(count);
            $('#mini-cart-total').text($('.page-header__basket-list .total .amount').html());
        }, 1000);
    });

})(window, document, jQuery);