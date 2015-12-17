<?php
if ( ! class_exists( 'Wp_Enqueue_Scripts') ) :

    class Wp_Enqueue_Scripts {

        public function __construct() {

        }

        public function enqueue_scripts() {
            global $wp_query;

            // STYLES
            wp_enqueue_style( 'main-style', get_stylesheet_directory_uri() . '/style.css', array(), '03112015' );


            // VENDOR SCRIPTS
            wp_enqueue_script( 'yh_select2',  get_stylesheet_directory_uri() . '/node_modules/select2/dist/js/select2.js', array( 'jquery' ), '17122015', false );
            wp_enqueue_script( 'smart-resize',  get_stylesheet_directory_uri() . '/assets/js/vendor/jquery.smartresize.js', array( 'jquery' ), '03112015', true );
            wp_enqueue_script( 'bxslider',  get_stylesheet_directory_uri() . '/assets/js/vendor/jquery.bxslider.js', array( 'jquery' ), '10112015', true );


            // CUSTOM SCRIPTS
            $main_dependencies = array(
                'jquery',
                'yh_select2',
                'smart-resize',
                'bxslider'
            );
            wp_enqueue_script( 'main',  get_stylesheet_directory_uri() . '/assets/js/main.js', $main_dependencies, '03112015', true );

            if ( class_exists( 'woocommerce' ) ) {
                wp_dequeue_style( 'select2' );
                wp_deregister_style( 'select2' );

                wp_dequeue_script( 'select2');
                wp_deregister_script('select2');
            }

        }

    }

endif; // End Check Class Exists