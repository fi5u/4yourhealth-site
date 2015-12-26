<?php
/**
 * The Template for displaying sidebar
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

$news_args = array(
    'post_type'      => 'post',
    'posts_per_page' => 6
);
$context['news'] = Timber::get_posts($news_args);

Timber::render( array( 'sidebar.twig' ), $context );
