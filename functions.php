<?php 
/**
 * @Packge 	   : Colorlib

 * @Author 	   : Colorlib
 * @Author URI : http://colorlib.com/wp/
 *
 */
 
	// Block direct access
	if( !defined( 'ABSPATH' ) ){
		exit( 'Direct script access denied.' );
	}

	/**
	 *
	 * Define constant
	 *
	 */
	
	 
	// Base URI
	if( !defined( 'ETRAIN_DIR_URI' ) )
		define( 'ETRAIN_DIR_URI', get_template_directory_uri().'/' );
	
	// assets URI
	if( !defined( 'ETRAIN_DIR_ASSETS_URI' ) )
		define( 'ETRAIN_DIR_ASSETS_URI', ETRAIN_DIR_URI.'assets/' );
	
	// Css File URI
	if( !defined( 'ETRAIN_DIR_CSS_URI' ) )
		define( 'ETRAIN_DIR_CSS_URI', ETRAIN_DIR_ASSETS_URI .'css/' );
	
	// Js File URI
	if( !defined( 'ETRAIN_DIR_JS_URI' ) )
		define( 'ETRAIN_DIR_JS_URI', ETRAIN_DIR_ASSETS_URI .'js/' );
	
	// Icon Images
	if( !defined('ETRAIN_DIR_ICON_IMG_URI') )
		define( 'ETRAIN_DIR_ICON_IMG_URI', ETRAIN_DIR_ASSETS_URI.'img/icon/' );
	
	//DIR inc
	if( !defined( 'ETRAIN_DIR_INC' ) )
		define( 'ETRAIN_DIR_INC', ETRAIN_DIR_URI.'inc/' );

	//Elementor Widgets Folder Directory
	if( !defined( 'ETRAIN_DIR_ELEMENTOR' ) )
		define( 'ETRAIN_DIR_ELEMENTOR', ETRAIN_DIR_INC.'elementor-widgets/' );

	// Base Directory
	if( !defined( 'ETRAIN_DIR_PATH' ) )
		define( 'ETRAIN_DIR_PATH', get_parent_theme_file_path().'/' );
	
	//Inc Folder Directory
	if( !defined( 'ETRAIN_DIR_PATH_INC' ) )
		define( 'ETRAIN_DIR_PATH_INC', ETRAIN_DIR_PATH.'inc/' );
	
	//Colorlib framework Folder Directory
	if( !defined( 'ETRAIN_DIR_PATH_LIB' ) )
		define( 'ETRAIN_DIR_PATH_LIB', ETRAIN_DIR_PATH_INC.'libraries/' );
	
	//Classes Folder Directory
	if( !defined( 'ETRAIN_DIR_PATH_CLASSES' ) )
		define( 'ETRAIN_DIR_PATH_CLASSES', ETRAIN_DIR_PATH_INC.'classes/' );

	
	//Widgets Folder Directory
	if( !defined( 'ETRAIN_DIR_PATH_WIDGET' ) )
		define( 'ETRAIN_DIR_PATH_WIDGET', ETRAIN_DIR_PATH_INC.'widgets/' );
		
	//Elementor Widgets Folder Directory
	if( !defined( 'ETRAIN_DIR_PATH_ELEMENTOR_WIDGETS' ) )
		define( 'ETRAIN_DIR_PATH_ELEMENTOR_WIDGETS', ETRAIN_DIR_PATH_INC.'elementor-widgets/' );
	

		
	/**
	 * Include File
	 *
	 */
	
	// Breadcrumbs file include
	require_once( ETRAIN_DIR_PATH_INC . 'etrain-breadcrumbs.php' );
	// Sidebar register file include
	require_once( ETRAIN_DIR_PATH_INC . 'widgets/etrain-widgets-reg.php' );
	// Post widget file include
	require_once( ETRAIN_DIR_PATH_INC . 'widgets/etrain-recent-post-thumb.php' );
	// News letter widget file include
	require_once( ETRAIN_DIR_PATH_INC . 'widgets/etrain-newsletter-widget.php' );
	//Social Links
	require_once( ETRAIN_DIR_PATH_INC . 'widgets/etrain-social-links.php' );
	// Instagram Widget
	require_once( ETRAIN_DIR_PATH_INC . 'widgets/etrain-instagram.php' );
	// Nav walker file include
	require_once( ETRAIN_DIR_PATH_INC . 'wp_bootstrap_navwalker.php' );
	// Theme function file include
	require_once( ETRAIN_DIR_PATH_INC . 'etrain-functions.php' );

	// Theme Demo file include
	require_once( ETRAIN_DIR_PATH_INC . 'demo/demo-import.php' );

	// Post Like
	require_once( ETRAIN_DIR_PATH_INC . 'post-like.php' );
	// Theme support function file include
	require_once( ETRAIN_DIR_PATH_INC . 'support-functions.php' );
	// Html helper file include
	require_once( ETRAIN_DIR_PATH_INC . 'wp-html-helper.php' );
	// Pagination file include
	require_once( ETRAIN_DIR_PATH_INC . 'wp_bootstrap_pagination.php' );
	// Elementor Widgets
	require_once( ETRAIN_DIR_PATH_ELEMENTOR_WIDGETS . 'elementor-widget.php' );
	//
	require_once( ETRAIN_DIR_PATH_CLASSES . 'Class-Enqueue.php' );
	
	require_once( ETRAIN_DIR_PATH_CLASSES . 'Class-Config.php' );
	// Customizer
	require_once( ETRAIN_DIR_PATH_INC . 'customizer/customizer.php' );
	// Class autoloader
	require_once( ETRAIN_DIR_PATH_INC . 'class-epsilon-dashboard-autoloader.php' );
	// Class etrain dashboard
	require_once( ETRAIN_DIR_PATH_INC . 'class-epsilon-init-dashboard.php' );
	// Load CMB2 meta
	require_once( ETRAIN_DIR_PATH_INC . 'CMB2/cmb2-functions.php' );
	// Common css
	require_once( ETRAIN_DIR_PATH_INC . 'etrain-commoncss.php' );

	// Admin Enqueue Script
	function etrain_admin_script(){
		wp_enqueue_style( 'etrain-admin', get_template_directory_uri().'/assets/css/etrain_admin.css', false, '1.0.0' );
		wp_enqueue_script( 'etrain_admin', get_template_directory_uri().'/assets/js/etrain_admin.js', false, '1.0.0' );
	}
	add_action( 'admin_enqueue_scripts', 'etrain_admin_script' );

	 
	// WooCommerce style desable
	add_filter( 'woocommerce_enqueue_styles', '__return_false' );


	/**
	 * Instantiate Etrain object
	 *
	 * Inside this object:
	 * Enqueue scripts, Google font, Theme support features, Etrain Dashboard .
	 *
	 */
	
	$Etrain = new Etrain();