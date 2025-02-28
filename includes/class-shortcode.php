<?php

/**
 * Shortcode methods for stepwise plugin.
 */
class StepwiseShortcode {

  /**
   * Get array of plugin metadata.
   */
  public static function StepwiseButton($atts, $content, $shorcode_tag) {
    if (!self::isCivicrmAndExtensionInitialize()) {
      // If we don't have BOTH civicrm and the stepw extension, return empty.
      return '';
    }

    try {
    $ret = CRM_Stepw_Utils_WpShortcode::getStepwiseButtonHtml()
      . CRM_Stepw_Utils_WpShortcode::getProgressBarHtml();
    }
    catch (CRM_Stepw_Exception $e) {
      // Although civicrm has been initialized, we're not actually IN civicrm now,
      // so our hook_civicrm_unhandled_exception won't be invoked. Call it
      // specifically here.
      stepw_civicrm_unhandled_exception($e);
    }

    return $ret;
  }

  public static function StepwiseButtonAssets() {
    global $post;
    if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'stepwise-button')) {
      if (!self::isCivicrmAndExtensionInitialize()) {
        // If we don't have BOTH civicrm and the stepw extension, there's nothing to do here.
        return;
      }
      $assets = CRM_Stepw_Utils_WpShortcode::getPageAssets();
      foreach ($assets as $asset) {
        $assetHandle = $asset['handle'];
        $assetSrc = ($asset['src'] ?? '');
        switch ($asset['type']) {
          case 'style':
            wp_enqueue_style($assetHandle, $assetSrc);
            break;
          case 'script':
            wp_enqueue_script($assetHandle, $assetSrc);
            break;
        }
      }
    }
  }
  
  /**
   * Initialize civicrm if possible, and tell whether both civicrm is activated AND
   * the stepw extension is enabled in civicrm.
   * 
   * @return bool
   */
  private static function isCivicrmAndExtensionInitialize() {
    static $ret;
    if (!isset($ret)) {
      $ret = FALSE;
      if (function_exists('civicrm_initialize')) {
        // CiviCRM is activated; initialize it.
        civicrm_initialize();

        $extMgr = CRM_Extension_System::singleton()->getManager();
        if ($extMgr->isEnabled('com.joineryhq.stepw')) {
          // stepw extension is enabled. That's everything we need.
          $ret = TRUE;
        }
      }
    }
    return $ret;
  }
}
