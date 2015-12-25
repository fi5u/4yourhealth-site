<?php
/**
 * The Template for displaying all single posts
 *
 *
 * @package  WordPress
 * @subpackage  Timber
 */

$context = array();
$context['sidebar_home_side'] = Timber::get_widgets('home_side');
$testimonials_args = array(
    'post_type'      => 'testimonial',
    'posts_per_page' => -1
);
$context['testimonials'] = Timber::get_posts($testimonials_args);

Timber::render( array( 'sidebar.twig' ), $context );
