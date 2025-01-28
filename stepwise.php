<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://joineryhq.com
 * @since             1.0.0
 * @package           Stepwise
 *
 * @wordpress-plugin
 * Plugin Name:       CiviCRM Stepwise
 * Plugin URI:        https://github.com/JoineryHQ/wp-stepwise/tree/v0.0.2
 * Description:       WordPress helper plugin in support of features provided by CiviCRM "Stepwise" extension.
 * Version:           0.0.1
 * Author:            Allen Shaw
 * Author URI:        https://joineryhq.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       stepwise
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define('STEPWISE_PLUGIN_URL', plugin_dir_url(__FILE__));

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-plugin.php';
require plugin_dir_path(__FILE__) . 'includes/class-shortcode.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_stepwise() {

	$plugin = new StepwisePlugin();
	$plugin->run();

}
run_stepwise();
