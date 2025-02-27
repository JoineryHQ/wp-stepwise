<?php

/**
 * Shortcode methods for stepwise plugin.
 */
class StepwiseShortcode {

  /**
   * Get array of plugin metadata.
   */
  public static function StepwiseButton($atts, $content, $shorcode_tag) {
    if (!function_exists('civicrm_initialize')) {
      // CiviCRM is not installed; print nothing.
      return '';
    }
    
    civicrm_initialize();

    $ret = CRM_Stepw_Utils_WpShortcode::getStepwiseButtonHtml()
      . CRM_Stepw_Utils_WpShortcode::getProgressBarHtml();
                  
    // fixme3: if this is a video page, append video-validating JS.

    return $ret;
  }

  public static function StepwiseButtonAssets() {
    global $post;
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'stepwise-button')) {
      wp_enqueue_style('stepwise-button-css', STEPWISE_PLUGIN_URL . '/css/stepwise-button.css');
      wp_enqueue_script('jquery');
      wp_enqueue_script('stepwise-button-js', STEPWISE_PLUGIN_URL . '/js/stepwise-button.js');
    }
  }
}
