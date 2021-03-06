<?php

/**
 * The plugin bootstrap file
 *
 * @wordpress-plugin
 * Plugin Name:       Core Functionality Plugin
 * Plugin URI:        https://www.secretstache.com/
 * Description:       [DO NOT DEACTIVATE] unless you know what you're doing.
 * Version:           1.0.0
 * Author:            Secret Stache Media
 * Author URI:        https://www.secretstache.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ssm
 * Domain Path:       /includes/languages
 */

// If this file is called directly, abort.
if ( ! defined( "WPINC" ) ) {
	die;
}

/**
 * Define plugin constants
 */
define( "SSMC_URL", trailingslashit ( plugin_dir_url( __FILE__ ) ) );
define( "SSMC_DIR", plugin_dir_path( __FILE__ ) );
define( "SSMC_THEME_DIR", trailingslashit ( get_template_directory() ) );
define(	"LOCALIZATION_ID", "ssm" );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/Activator.php
 *
 */
function activate_ssm() {
	SSM\Includes\Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/Deactivator.php
 */
function deactivate_ssm() {
	SSM\Includes\Deactivator::deactivate();
}

register_activation_hook( __FILE__, "activate_ssm" );
register_deactivation_hook( __FILE__, "deactivate_ssm" );

/**
 * Execution of the plugin.
 */
function run_ssm() {

	// Require composer"s autoload file
	require_once( plugin_dir_path( __FILE__ ) . "vendor/autoload.php" );

	$root = new SSM\Includes\Root();
	$root->run();

}

run_ssm();
