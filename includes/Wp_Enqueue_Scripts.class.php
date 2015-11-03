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
            wp_enqueue_script( 'select2',  get_stylesheet_directory_uri() . '/node_modules/select2/dist/js/select2.js', array( 'jquery' ), '03112015', false );
            wp_enqueue_script( 'smart-resize',  get_stylesheet_directory_uri() . '/assets/js/vendor/jquery.smartresize.js', array( 'jquery' ), '03112015', true );


            // CUSTOM SCRIPTS
            $main_dependencies = array(
                'jquery',
                'select2',
                'smart-resize'
            );
            wp_enqueue_script( 'main',  get_stylesheet_directory_uri() . '/assets/js/main.js', $main_dependencies, '03112015', true );

        }

    }

endif; // End Check Class Exists