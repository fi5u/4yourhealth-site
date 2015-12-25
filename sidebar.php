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

Timber::render( array( 'sidebar.twig' ), $context );
