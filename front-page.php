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

$templates = array( 'front-page.twig', 'index.twig' );

Timber::render( $templates, $context );
