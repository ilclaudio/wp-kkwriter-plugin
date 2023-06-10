<?php
/**
 * Plugin Name: WP KK Writer Plugin
 * Version: 0.0.1
 * Author: BatClaudio
 * Plugin URI: https://github.com/ilclaudio/wp-kkwriter-plugin.git
 * Description: A plugin
 * Author URI: https://www.wp-recipes.com
 * Text Domain: kkwdomain
 * Domain Path: /languages
 * @package WP_KK_Writer_Plugin
 */

/**
 * Load the library to build custom field types.
 */
require 'inc/vendor/CMB2/init.php';

/**
 * Load the library to link post types.
 */
require 'inc/vendor/cmb2-attached-posts/cmb2-attached-posts-field.php';

/**
 * The plugin configurations.
 */
require 'plugin-config.php';

/**
 * The plugin default data.
 */
require 'default-data.php';

/**
 * Utils functions.
 */
require 'inc/utils.php';


add_action( 'init', 'setup_the_plugin', 1 );

/**
 * Setup the writer plugin.
 *
 * @return void
 */
function setup_the_plugin() {
	global $lab_manager;
	include_once 'classes/plugin-manager.php';
	$plugin_manager = new PluginManager();
	$plugin_manager->plugin_setup();
}
