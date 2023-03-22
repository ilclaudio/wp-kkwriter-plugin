<?php
/**
 * Plugin Name: WP KK Writer Plugin
 * Version: 0.0.1
 * Author: BatClaudio
 * Plugin URI: https://www.claudiobattaglino.it/wp-kkwriter-plgin
 * Description: A plugin
 * Author URI: https://www.claudiobattaglino.it
 * Text Domain: kk_writer_plugin
 * Domain Path: /languages
 */

define( 'KKW_PLUGIN_NAME', 'wp-kkwriter-plugin' );

require 'plugin-config.php';


add_action( 'init', 'setup_the_plugin', 0 );

/**
 * Setup the writer plugin.
 *
 * @return void
 */
function setup_the_plugin() {
	global $lab_manager;
	include_once 'classes/plugin-manager.php';
	$plugin_manager = PluginManager::get_instance();
	$plugin_manager->plugin_setup();
}

