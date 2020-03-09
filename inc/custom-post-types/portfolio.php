<?php

$custom_labels = array(
	'name'               => _x( 'Our Work', 'Portfolio general name', '_l7_theme' ),
	'singular_name'      => _x( 'Portfolio Item', 'Portfolio singular name', '_l7_theme' ),
	'menu_name'          => _x( 'Portfolio', 'Portfolio admin menu', '_l7_theme' ),
	'name_admin_bar'     => _x( 'Portfolio Item', 'Portfolio add new on admin bar', '_l7_theme' ),
	'add_new'            => _x( 'Add New', 'Portfolio Item', '_l7_theme' ),
	'add_new_item'       => __( 'Add New Portfolio Item', '_l7_theme' ),
	'new_item'           => __( 'New Portfolio Item', '_l7_theme' ),
	'edit_item'          => __( 'Edit Portfolio Item', '_l7_theme' ),
	'view_item'          => __( 'View Portfolio Item', '_l7_theme' ),
	'all_items'          => __( 'All Portfolio Items', '_l7_theme' ),
	'search_items'       => __( 'Search Portfolio Items', '_l7_theme' ),
	'parent_item_colon'  => __( 'Parent Portfolio Item:', '_l7_theme' ),
	'not_found'          => __( 'No Portfolio Items found.', '_l7_theme' ),
	'not_found_in_trash' => __( 'No Portfolio Items found in Trash.', '_l7_theme' )
);

$custom_args = array(
	'labels'             => $custom_labels,
	'description'        => __( 'Portfolio Pieces for the L7 theme.', '_l7_theme' ),
	'publicly_queryable' => true,
	'show_ui'            => true,
	'show_in_nav_menus'  => true,
	'show_in_menu'       => true,
	'query_var'          => true,
	'rewrite'            => array( 'slug' => 'our-work' ),
	'capability_type'    => 'post',
	'has_archive'        => false,
	'hierarchical'       => false,
	'menu_position'      => null,
	'menu_icon'          => 'dashicons-clipboard',
	'supports'           => array( 'title', 'author', 'revisions')
);

register_post_type( 'portfolio', $custom_args );