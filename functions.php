<?php

if ( ! class_exists( 'Timber' ) ) {
	add_action( 'admin_notices', function() {
			echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
		} );
	return;
}

Timber::$dirname = array('templates', 'views');

class StarterSite extends TimberSite {

	function __construct() {
		include('includes/vendor/meta-box-class/my-meta-box-class.php');
		include('includes/Init.class.php');
		include('includes/Wp_Enqueue_Scripts.class.php');
		include('includes/Customize_Register.class.php');
		include('includes/After_Setup_Theme.class.php');
		include('includes/Widgets_Init.class.php');

		add_theme_support( 'post-formats' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
		add_theme_support( 'site-logo' );
		add_theme_support( 'woocommerce' );

		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		add_filter( 'get_twig', array( $this, 'add_to_twig' ) );

		add_action( 'init', array( new Init, 'register_post_types' ) );
        add_action( 'wp_enqueue_scripts', array( new Wp_Enqueue_Scripts, 'enqueue_scripts') );
        add_action( 'customize_register', array( new Customize_Register, 'yourhealth_theme_customizer' ) );
        add_action( 'after_setup_theme', array( new After_Setup_Theme, 'add_image_sizes' ) );
        add_action( 'widgets_init', array( new Widgets_Init, 'do_widgets_init' ) );

        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
		remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail' );
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );

		parent::__construct();
	}

	function add_to_context( $context ) {
		$context['foo'] = 'bar';
		$context['stuff'] = 'I am a value set in your functions.php file';
		$context['notes'] = 'These values are available everytime you call Timber::get_context();';
		$context['menu'] = new TimberMenu();
		$context['super_menu'] = new TimberMenu('super-menu');
		$context['site'] = $this;
		$context['site']->logo = get_theme_mod( 'yourhealth_logo' ) ? '<img src="' . esc_url( get_theme_mod( 'yourhealth_logo' ) ) . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" class="page-header__logo">' : $context['site']->name;
		$context['lang_current'] = qtranxf_getLanguage();
		return $context;
	}

	function add_to_twig( $twig ) {
		/* this is where you can add your own fuctions to twig */
		$twig->addExtension( new Twig_Extension_StringLoader() );
		$twig->addFilter( 'myfoo', new Twig_Filter_Function( 'myfoo' ) );
		return $twig;
	}

}

new StarterSite();


function timber_set_product( $post ) {
    global $product;
    if ( is_woocommerce() ) {
        $product = get_product($post->ID);
    }
}