<?php
/**
 * Plugin Name: WP KK Writer Plugin
 * Version: 0.0.2
 * Author: BatClaudio
 * Plugin URI: https://github.com/ilclaudio/wp-kkwriter-plugin.git
 * Description: A plugin
 * Author URI: https://www.wp-recipes.com
 * Text Domain: kkwdomain
 * Domain Path: /languages
 * @package WP_KK_Writer_Plugin
 */

/**
 * Load the library CMB2 to build custom field types.
 */
require 'inc/vendor/CMB2/init.php';

/**
 * Load the library CMB2 Attached Post.
 */
require 'inc/vendor/cmb2-attached-posts/cmb2-attached-posts-field.php';

/**
 * Load the library CMB2 Post Search.
 */
require 'inc/vendor/CMB2-Post-Search-field/cmb2_post_search_field.php';

/**
 * The plugin configurations.
 */
require 'plugin-config.php';

/**
 * The plugin default data.
 */
require 'example-data.php';

/**
 * Utils functions.
 */
require 'inc/utils.php';



/**
 * Setup the writer plugin.
 *
 * @return void
 */
function setup_the_plugin() {
	global $kkw_plugin_manager;
	include_once 'classes/plugin-manager.php';
	$kkw_plugin_manager = new KKW_PluginManager();
	$kkw_plugin_manager->plugin_setup();
}
add_action( 'init', 'setup_the_plugin', 1 );
