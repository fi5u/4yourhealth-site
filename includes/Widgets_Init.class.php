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

        }

    }

endif; // End Check Class Exists
