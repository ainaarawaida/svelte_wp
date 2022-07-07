<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              luqvote
 * @since             1.0.0
 * @package           Luqvote
 *
 * @wordpress-plugin
 * Plugin Name:       luqvote
 * Plugin URI:        luqvote
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            luqvote
 * Author URI:        luqvote
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       luqvote
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'LUQVOTE_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-luqvote-activator.php
 */
function activate_luqvote() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-luqvote-activator.php';
	Luqvote_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-luqvote-deactivator.php
 */
function deactivate_luqvote() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-luqvote-deactivator.php';
	Luqvote_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_luqvote' );
register_deactivation_hook( __FILE__, 'deactivate_luqvote' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-luqvote.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_luqvote() {

	$plugin = new Luqvote();
	$plugin->run();

}
run_luqvote();

function deb($data){
	print_r("<pre>");
	print_r($data);
}
