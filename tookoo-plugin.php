<?php
/*
Plugin Name: Tookoo Companion Plugin
Plugin URI: http://github.com/hafizrahman/tookoo-plugin/
Description: A companion plugin for the Tookoo theme.
Version: 1.0
Author: Hafiz Rahman
Author URI: http://wplover.com/
License: GPL2 and above
*/

define( 'TOOKOO_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'TOOKOO_PLUGIN_PATH', dirname( __FILE__ ) );

/**
 * Flushes rewrite rules on plugin activation to ensure event posts don't 404
 * http://codex.wordpress.org/Function_Reference/flush_rewrite_rules
 */

function tookoo_plugin_flush_rewrite_rules() {
	tookoo_plugin_register_cpt();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'tookoo_plugin_flush_rewrite_rules' );

function tookoo_plugin_register_cpt() {

	/**
	 * Enable the event custom post type
	 * http://codex.wordpress.org/Function_Reference/register_post_type
	 */

	$labels = array(
		'name' => __( 'Products', 'tookoo' ),
		'singular_name' => __( 'Product', 'tookoo' ),
		'add_new' => __( 'Add New Product', 'tookoo' ),
		'add_new_item' => __( 'Add New Product', 'tookoo' ),
		'edit_item' => __( 'Edit Product', 'tookoo' ),
		'new_item' => __( 'Add New Product', 'tookoo' ),
		'view_item' => __( 'View Product', 'tookoo' ),
		'search_items' => __( 'Search Products', 'tookoo' ),
		'not_found' => __( 'No products found', 'tookoo' ),
		'not_found_in_trash' => __( 'No products found in trash', 'tookoo' )
	);

	$args = array(
    	'labels' => $labels,
    	'public' => true,
		'supports' => array( 'title', 'editor', 'thumbnail' ),
		'capability_type' => 'post',
		'rewrite' => array( 'slug' => 'product' ), // Permalinks format
		'menu_position' => 5,
		'taxonomies' => array( 'post_tag', 'category' ),
		'menu_icon' => plugin_dir_url( __FILE__ ) . '/images/tookoo_product.png',  // Icon Path
		'has_archive' => true
	); 

	register_post_type( 'tookoo_product', $args );
}

add_action( 'init', 'tookoo_plugin_register_cpt' );

include_once('inc/metabox_code/functions/add_meta_box.php');