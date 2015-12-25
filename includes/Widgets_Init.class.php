<?php
if ( ! class_exists( 'Widgets_Init') ) :

    class Widgets_Init {

        public function __construct() {

        }

        public function do_widgets_init() {

            register_sidebar( array(
                'name'          => 'Shop sidebar',
                'id'            => 'shop_sidebar',
                'before_widget' => '<div id="%1$s" class="widget woo-widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h2 class="woo-widget__title">',
                'after_title'   => '</h2>',
            ) );

            register_sidebar( array(
                'name'          => 'Shop cart',
                'id'            => 'shop_cart',
                'before_widget' => '<div id="%1$s" class="page-header__basket-list %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h5 class="page-header__basket-list-title">',
                'after_title'   => '</h5>',
            ) );

            register_sidebar( array(
                'name'          => 'Footer left',
                'id'            => 'footer_left',
                'before_widget' => '<div id="%1$s" class="page-footer__widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h2 class="page-footer__widget-title">',
                'after_title'   => '</h5>',
            ) );

            register_sidebar( array(
                'name'          => 'Footer right',
                'id'            => 'footer_right',
                'before_widget' => '<div id="%1$s" class="page-footer__widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h2 class="page-footer__widget-title">',
                'after_title'   => '</h5>',
            ) );

            register_sidebar( array(
                'name'          => 'Home side',
                'id'            => 'home_side',
                'before_widget' => '<div id="%1$s" class="page-footer__widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h2 class="page-footer__widget-title">',
                'after_title'   => '</h5>',
            ) );
        }

    }

endif; // End Check Class Exists
