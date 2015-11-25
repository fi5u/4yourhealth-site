<?php
if ( ! class_exists( 'After_Setup_Theme') ) :

    class After_Setup_Theme {

        public function __construct() {

        }

        public function add_image_sizes() {
            add_image_size( 'carousel_slide', 1170, 600, true );
            add_image_size( 'card', 228, 228, true );
        }
    }

endif; // End Check Class Exists