<?php
/**
 * Bootstrap Basic theme
 * 
 * @package la
 */


/**
 * Required WordPress variable.
 */
if (!isset($content_width)) {
	$content_width = 1170;
}


if (!function_exists('bootstrapBasicSetup')) {
	/**
	 * Setup theme and register support wp features.
	 */
	function bootstrapBasicSetup() 
	{
		/**
		 * Make theme available for translation
		 * Translations can be filed in the /languages/ directory
		 * 
		 * copy from underscores theme
		 */
		load_theme_textdomain('la', get_template_directory() . '/languages');

		// add theme support post and comment automatic feed links
		add_theme_support('automatic-feed-links');

		// enable support for post thumbnail or feature image on posts and pages
		add_theme_support('post-thumbnails');
		the_post_thumbnail('700x438');       // Thumbnail (default 150px x 150px max)
		add_image_size( '700x438', 700, 438, true );

		// allow the use of html5 markup
		// @link https://codex.wordpress.org/Theme_Markup
		add_theme_support('html5', array('caption', 'comment-form', 'comment-list', 'gallery', 'search-form'));

		// add support menu
		register_nav_menus(array(
			'primary' => __('Primary Menu', 'la'),
		));

		// add post formats support
		add_theme_support('post-formats', array('aside', 'image', 'video', 'quote', 'link'));

		// add support custom background
		add_theme_support(
			'custom-background', 
			apply_filters(
				'bootstrap_basic_custom_background_args', 
				array(
					'default-color' => 'ffffff', 
					'default-image' => ''
				)
			)
		);
	}// bootstrapBasicSetup
}
add_action('after_setup_theme', 'bootstrapBasicSetup');


if (!function_exists('bootstrapBasicWidgetsInit')) {
	/**
	 * Register widget areas
	 */
	function bootstrapBasicWidgetsInit() 
	{
		register_sidebar(array(
			'name'          => __('Header right', 'la'),
			'id'            => 'header-right',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h1 class="widget-title">',
			'after_title'   => '</h1>',
		));

		register_sidebar(array(
			'name'          => __('Navigation bar right', 'la'),
			'id'            => 'navbar-right',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		));

		register_sidebar(array(
			'name'          => __('Sidebar left', 'la'),
			'id'            => 'sidebar-left',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h1 class="widget-title">',
			'after_title'   => '</h1>',
		));

		register_sidebar(array(
			'name'          => __('Sidebar right', 'la'),
			'id'            => 'sidebar-right',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		));

		register_sidebar(array(
			'name'          => __('Footer left', 'la'),
			'id'            => 'footer-left',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h1 class="widget-title">',
			'after_title'   => '</h1>',
		));

		register_sidebar(array(
			'name'          => __('Footer right', 'la'),
			'id'            => 'footer-right',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		));
	}// bootstrapBasicWidgetsInit
}
add_action('widgets_init', 'bootstrapBasicWidgetsInit');


if (!function_exists('bootstrapBasicEnqueueScripts')) {
	/**
	 * Enqueue scripts & styles
	 */
	function bootstrapBasicEnqueueScripts() 
	{
		wp_enqueue_style('bootstrap-style', get_template_directory_uri() . '/css/bootstrap.min.css');
		wp_enqueue_style('bootstrap-theme-style', get_template_directory_uri() . '/css/bootstrap-theme.min.css');
		wp_enqueue_style('fontawesome-style', get_template_directory_uri() . '/css/font-awesome.min.css');
		wp_enqueue_style('main-style', get_template_directory_uri() . '/css/main.css');

		wp_enqueue_script('modernizr-script', get_template_directory_uri() . '/js/vendor/modernizr.min.js');
		wp_enqueue_script('respond-script', get_template_directory_uri() . '/js/vendor/respond.min.js');
		wp_enqueue_script('html5-shiv-script', get_template_directory_uri() . '/js/vendor/html5shiv.js');
		wp_enqueue_script('jquery');
		wp_enqueue_script('bootstrap-script', get_template_directory_uri() . '/js/vendor/bootstrap.min.js', array(), false, true);
		wp_enqueue_script('main-script', get_template_directory_uri() . '/js/main.js', array(), false, true);
		wp_enqueue_style('la-style', get_stylesheet_uri());
	}// bootstrapBasicEnqueueScripts
}
add_action('wp_enqueue_scripts', 'bootstrapBasicEnqueueScripts');


/**
 * admin page displaying help.
 */
if (is_admin()) {
	require get_template_directory() . '/inc/BootstrapBasicAdminHelp.php';
	$bbsc_adminhelp = new BootstrapBasicAdminHelp();
	add_action('admin_menu', array($bbsc_adminhelp, 'themeHelpMenu'));
	unset($bbsc_adminhelp);
}


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';


/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';


/**
 * Custom dropdown menu and navbar in walker class
 */
require get_template_directory() . '/inc/BootstrapBasicMyWalkerNavMenu.php';


/**
 * Template functions
 */
require get_template_directory() . '/inc/template-functions.php';


/**
 * --------------------------------------------------------------
 * Theme widget & widget hooks
 * --------------------------------------------------------------
 */
require get_template_directory() . '/inc/widgets/BootstrapBasicSearchWidget.php';
require get_template_directory() . '/inc/template-widgets-hook.php';

register_nav_menus( array(
		'primary' => __( 'Primary Menu',      'la' ),
		'social'  => __( 'Social Links Menu', 'la' ),
	) );


// Register Custom Post Type
function portfolio() {

	$labels = array(
		'name'                  => _x( 'Portfolio Entries', 'Post Type General Name', 'la' ),
		'singular_name'         => _x( 'Portfolio', 'Post Type Singular Name', 'la' ),
		'menu_name'             => __( 'Portfolio', 'la' ),
		'name_admin_bar'        => __( 'Portfolio', 'la' ),
		'parent_item_colon'     => __( 'Parent Item:', 'la' ),
		'all_items'             => __( 'All Items', 'la' ),
		'add_new_item'          => __( 'Add New Item', 'la' ),
		'add_new'               => __( 'Add New', 'la' ),
		'new_item'              => __( 'New Item', 'la' ),
		'edit_item'             => __( 'Edit Item', 'la' ),
		'update_item'           => __( 'Update Item', 'la' ),
		'view_item'             => __( 'View Item', 'la' ),
		'search_items'          => __( 'Search Item', 'la' ),
		'not_found'             => __( 'Not found', 'la' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'la' ),
		'items_list'            => __( 'Items list', 'la' ),
		'items_list_navigation' => __( 'Items list navigation', 'la' ),
		'filter_items_list'     => __( 'Filter items list', 'la' ),
	);
	$args = array(
		'label'                 => __( 'Portfolio', 'la' ),
		'description'           => __( 'Portfolio', 'la' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'portfolio', $args );

}
add_action( 'init', 'portfolio', 0 );


// Register Custom Post Type
function case_study() {

	$labels = array(
		'name'                  => _x( 'Case Studies', 'Post Type General Name', 'la' ),
		'singular_name'         => _x( 'Case Study', 'Post Type Singular Name', 'la' ),
		'menu_name'             => __( 'Case Study', 'la' ),
		'name_admin_bar'        => __( 'Case Study', 'la' ),
		'parent_item_colon'     => __( 'Parent Item:', 'la' ),
		'all_items'             => __( 'All Items', 'la' ),
		'add_new_item'          => __( 'Add New Item', 'la' ),
		'add_new'               => __( 'Add New', 'la' ),
		'new_item'              => __( 'New Item', 'la' ),
		'edit_item'             => __( 'Edit Item', 'la' ),
		'update_item'           => __( 'Update Item', 'la' ),
		'view_item'             => __( 'View Item', 'la' ),
		'search_items'          => __( 'Search Item', 'la' ),
		'not_found'             => __( 'Not found', 'la' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'la' ),
		'items_list'            => __( 'Items list', 'la' ),
		'items_list_navigation' => __( 'Items list navigation', 'la' ),
		'filter_items_list'     => __( 'Filter items list', 'la' ),
	);
	$args = array(
		'label'                 => __( 'Case Study', 'la' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'case_study', $args );

}
add_action( 'init', 'case_study', 0 );