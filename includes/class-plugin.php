<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://joineryhq.com
 * @since      1.0.0
 *
 * @package    Stepwise
 * @subpackage Stepwise/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Stepwise
 * @subpackage Stepwise/includes
 * @author     Allen Shaw <allen@joineryhq.com>
 */
class StepwisePlugin {

  /**
   * Run the loader to execute all of the hooks with WordPress.
   *
   * @since    1.0.0
   */
  public function run() {

    // Define the button shortcode.
    add_shortcode('stepwise-button', 'StepwiseShortcode::StepwiseButton');

    // Load button css/js if appropriate
    add_action('wp_enqueue_scripts', 'StepwiseShortcode::StepwiseButtonAssets');
  }
}
