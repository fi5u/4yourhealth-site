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
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );

		add_filter('woocommerce_sale_flash', 'woo_custom_hide_sales_flash');

		function woo_custom_hide_sales_flash() {
			echo '<div class="card__badge">' . __( 'Sale', 'woocommerce' ) . '</div>';
		}

		function override_woo_related_widgets() {
		    if ( class_exists( 'YITH_WCAN_Navigation_Widget' ) ) {
		        unregister_widget( 'YITH_WCAN_Navigation_Widget' );
		        include_once( 'includes/woo/class.yith-wcan-navigation-widget.php' );
		        register_widget( 'CUSTOM_YITH_WCAN_Navigation_Widget' );
		    }
		}
		add_action( 'widgets_init', 'override_woo_related_widgets', 15 );


		function override_woocommerce_widgets() {
		    if ( class_exists( 'WC_Widget_Product_Categories' ) ) {
		        unregister_widget( 'WC_Widget_Product_Categories' );
		        unregister_widget( 'WC_Widget_Price_Filter' );

		        include_once( 'includes/woo/custom-class-wc-widget-product-categories.php' );
		        include_once( 'includes/woo/custom-class-wc-widget-price-filter.php' );

		        register_widget( 'custom_WC_Widget_Product_Categories' );
		        register_widget( 'custom_WC_Widget_Price_Filter' );
		    }
		}
		add_action( 'widgets_init', 'override_woocommerce_widgets', 16 );
		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

		parent::__construct();
	}

	function add_to_context( $context ) {
		$context['menu'] = new TimberMenu();
		$context['super_menu'] = new TimberMenu('super-menu');
		$context['site'] = $this;
		$context['site']->logo = get_theme_mod( 'yourhealth_logo' ) ? '<img src="' . esc_url( get_theme_mod( 'yourhealth_logo' ) ) . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" class="page-header__logo">' : $context['site']->name;
		$context['lang_current'] = qtranxf_getLanguage();
		$context['cart'] = Timber::get_widgets('shop_cart');
		$context['cart_count'] = WC()->cart->cart_contents_count;
		$context['cart_total'] = WC()->cart->get_cart_total();
		$context['search_query'] = get_search_query();
		$context['sidebar_footer_left'] = Timber::get_widgets('footer_left');
		$context['sidebar_footer_right'] = Timber::get_widgets('footer_right');

		return $context;
	}

	function add_to_twig( $twig ) {
		/* this is where you can add your own fuctions to twig */
		$twig->addExtension( new Twig_Extension_StringLoader() );
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

