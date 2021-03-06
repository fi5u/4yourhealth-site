<?php
/**
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

if ( ! class_exists( 'Timber' ) ) {
    echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
    return;
}

$context = Timber::get_context();
$context['post'] = new TimberPost();
$context['sidebar'] = Timber::get_sidebar('sidebar.php');
$context['slides'] = Timber::get_posts('post_type=carousel_slide');
$context['products'] = Timber::get_posts('post_type=product&posts_per_page=6&orderby=name&order=ASC');
$sale_args = array(
    'post_type'      => 'product',
    'posts_per_page' => -1,
    'meta_query'     => array(
        'relation' => 'OR',
        array( // Simple products type
            'key'           => '_sale_price',
            'value'         => 0,
            'compare'       => '>',
            'type'          => 'numeric'
        ),
        array( // Variable products type
            'key'           => '_min_variation_sale_price',
            'value'         => 0,
            'compare'       => '>',
            'type'          => 'numeric'
        )
    )
);
$context['sale_products'] = Timber::get_posts($sale_args);
$context['currency_symbol'] = get_woocommerce_currency_symbol();
$context['sort'] = $_GET && $_GET['sort'] ? $_GET['sort'] : false;

if ($context['sort'] == 'latest') {
    $context['products'] = Timber::get_posts('post_type=product&posts_per_page=6&orderby=date');
}

if ($context['sort'] == 'bestseller' || !$context['sort']) {
    $args = array(
        'post_type'  => 'product',
        'posts_per_page' => 6,
        'meta_key'   => 'total_sales',
        'orderby'    => 'meta_value_num',
        'order'      => 'DESC',
        'meta_query' => array(
            array(
                'key'     => 'total_sales'
            ),
        ),
    );
    $context['products'] = Timber::get_posts($args);
}

if ($context['sort'] == 'all') {
    $context['products'] = Timber::get_posts('post_type=product&posts_per_page=6&orderby=name&order=ASC');
}

$templates = array( 'front-page.twig', 'index.twig' );

Timber::render( $templates, $context );
