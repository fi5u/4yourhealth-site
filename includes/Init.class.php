<?php
if ( ! class_exists( 'Init') ) :

    class Init {

        public function __construct() {
            $this->custom_meta();
        }

        public function register_post_types() {
            $carousel_args = array(
                'public'    => false,
                'show_ui'   => true,
                'label'     => 'Carousel slides',
                'supports'  => array('title', 'editor', 'thumbnail')
            );
            register_post_type( 'carousel_slide', $carousel_args );

            $testimonials_args = array(
                'public'    => false,
                'show_ui'   => true,
                'label'     => 'Testimonials',
                'supports'  => array('title', 'editor', 'thumbnail')
            );

            register_post_type( 'testimonial', $testimonials_args );
        }

        public function custom_meta() {
            $prefix = 'yh_';

            $meta_carousel_config = array(
                'id'                => 'carousel_slide',
                'title'             => 'Carousel slide',
                'pages'             => array('carousel_slide'),
                'context'           => 'normal',
                'priority'          => 'high',
                'fields'            => array(),
                'local_images'      => false,
                'use_with_theme'    => false
            );

            $meta_carousel =  new AT_Meta_Box($meta_carousel_config);
            $meta_carousel->addText($prefix.'carousel_slide_link',array('name'=> 'Slide link'));
            $meta_carousel->addText($prefix.'carousel_slide_price',array('name'=> 'Slide price'));
            $meta_carousel->Finish();


            $meta_testimonials_config = array(
                'id'                => 'testimonial_details',
                'title'             => 'Testimonial details',
                'pages'             => array('testimonial'),
                'context'           => 'normal',
                'priority'          => 'high',
                'fields'            => array(),
                'local_images'      => false,
                'use_with_theme'    => false
            );

            $meta_testimonials =  new AT_Meta_Box($meta_testimonials_config);
            $meta_testimonials->addText($prefix.'testimonial_author',array('name'=> 'Testimonial author'));
            $meta_testimonials->Finish();
        }
    }

endif; // End Check Class Exists