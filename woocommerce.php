<?php

if (!class_exists('Timber')){
    echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
    return;
}

function woocommerce_remove_breadcrumb() {
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
}
add_action('woocommerce_before_main_content', 'woocommerce_remove_breadcrumb');


function woocommerce_custom_breadcrumb() {
    $breadcrumb_args = array(
        'wrap_before'   => '<div class="woocommerce-breadcrumb-wrap"><div class="woocommerce-breadcrumb">',
        'wrap_after'    => '</div></div>',
        'delimiter'     => ' > '
    );
    woocommerce_breadcrumb($breadcrumb_args);
}
add_action( 'woo_custom_breadcrumb', 'woocommerce_custom_breadcrumb' );


if (is_shop() || is_product_category()) {
    remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail' );
}

$context            = Timber::get_context();
$context['sidebar'] = Timber::get_widgets('shop-sidebar');
$context['currency_symbol'] = get_woocommerce_currency_symbol();

if (is_singular('product')) {
    $context['post']    = Timber::get_post();
    $product            = get_product( $context['post']->ID );
    $context['product'] = $product;
    $context['sidebar'] = false;

    Timber::render('templates/woo/single-product.twig', $context);

} else {

    $posts = Timber::get_posts();
    $context['products'] = $posts;

    if ( is_product_category() ) {
        $queried_object = get_queried_object();
        $term_id = $queried_object->term_id;
        $context['category'] = get_term( $term_id, 'product_cat' );
        $context['title'] = single_term_title('', false);
    }

    Timber::render('templates/woo/archive.twig', $context);

}

