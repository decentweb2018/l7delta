<?php
/**
 * _l7_theme Theme Options
 * @version 0.1.0
 */
class _l7_Custom_Data {
	/**
	 * Hidden meta prefix
	 * @var string
	 */
	private static $prefix = '__l7_';

	/**
	 * Constructor
	 * @since 0.1.0
	 */
	public function __construct() {
		$this->hooks();
	}

	/**
	 * Initiate our hooks
	 * @since 0.1.0
	 */
	public function hooks() {
		$this->add_options_page();

		add_action( 'init', array( $this, 'create_post_types' ) );

		add_filter( 'upload_mimes', array( $this, 'addAddtlMimeType' ) );
	}


	/**
	 * Add menu options page
	 * @since 0.1.0
	 */
	public function add_options_page() {
		if( function_exists('acf_add_options_page') ) {

			acf_add_options_page(array(
				'page_title' 	=> 'Theme General Settings',
				'menu_title'	=> 'Theme Settings',
				'menu_slug' 	=> 'theme-general-settings',
				'capability'	=> 'edit_posts',
				'redirect'		=> false
			));

		}
	}

	/**
	 * Create custom post types
	 */
	public function create_post_types() {
		// Template - uncomment and reuse as necessary
		// $custom_labels = array(
		// 	'name'					=> _x( 'Customer Service Centers', 'post type general name', '_l7_theme' ),
		// 	'singular_name'			=> _x( 'Customer Service Center', 'post type singular name', '_l7_theme' ),
		// 	'menu_name'				=> _x( 'Customer Service', 'admin menu', '_l7_theme' ),
		// 	'name_admin_bar'		=> _x( 'Customer Service Center', 'add new on admin bar', '_l7_theme' ),
		// 	'add_new'				=> _x( 'Add New', 'Customer Service Center', '_l7_theme' ),
		// 	'add_new_item'			=> __( 'Add New Customer Service Center', '_l7_theme' ),
		// 	'new_item'				=> __( 'New Customer Service Center', '_l7_theme' ),
		// 	'edit_item'				=> __( 'Edit Customer Service Center', '_l7_theme' ),
		// 	'view_item'				=> __( 'View Customer Service Center', '_l7_theme' ),
		// 	'all_items'				=> __( 'All Customer Service Centers', '_l7_theme' ),
		// 	'search_items'			=> __( 'Search Customer Service Centers', '_l7_theme' ),
		// 	'parent_item_colon'		=> __( 'Parent Customer Service Center:', '_l7_theme' ),
		// 	'not_found'				=> __( 'No Customer Service Centers found.', '_l7_theme' ),
		// 	'not_found_in_trash'	=> __( 'No Customer Service Centers found in Trash.', '_l7_theme' )
		// );

		// $custom_args = array(
		// 	'labels'				=> $custom_labels,
		// 	'description'			=> __( 'Description.', '_l7_theme' ),
		// 	'publicly_queryable'	=> true,
		// 	'show_ui'				=> true,
		// 	'show_in_nav_menus'		=> true,
		// 	'show_in_menu'			=> true,
		// 	'query_var'				=> true,
		// 	'rewrite'				=> array( 'slug' => 'custom-slug' ),
		// 	'capability_type'		=> 'post',
		// 	'has_archive'			=> false,
		// 	'hierarchical'			=> false,
		// 	'menu_position'			=> null,
		// 	'menu_icon'				=> 'dashicons-location-alt',
		// 	'supports'				=> array( 'title' )
		// );

		// register_post_type( 'custom_post_name', $custom_args );

		include( 'custom-post-types/portfolio.php' );
	}
	
	function addAddtlMimeType( $mimes ) {
		$new_mimes = array(
			'eps'	=> 'application/eps',
			'ai'	=> 'application/ai'
		);

		return array_merge( $mimes, $new_mimes );
	}
}


// Get it started
$_l7_custom_data = new _l7_Custom_Data();