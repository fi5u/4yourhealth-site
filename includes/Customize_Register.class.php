<?php
if ( ! class_exists( 'Customize_Register') ) :

    class Customize_Register {

        public function __construct() {

        }

        public function yourhealth_theme_customizer($wp_customize) {
            $wp_customize->add_section( 'yourhealth_logo_section' , array(
                'title'       => __( 'Logo', '4yourhealth-2015' ),
                'priority'    => 30,
                'description' => 'Upload a logo to replace the default site name and description in the header',
            ) );

            $wp_customize->add_setting( 'yourhealth_logo' );

            $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'yourhealth_logo', array(
                'label'    => __( 'Logo', '4yourhealth-2015' ),
                'section'  => 'yourhealth_logo_section',
                'settings' => 'yourhealth_logo',
            ) ) );
        }

    }

endif; // End Check Class Exists