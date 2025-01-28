<?php

/**
 * Shortcode methods for stepwise plugin.
 */
class StepwiseShortcode {

  /**
   * Get array of plugin metadata.
   */
  public static function StepwiseButton($atts, $content, $shorcode_tag) {

    // FIXME: use real logic to get actual step and stepcount.
    $step = $_GET['stepwise-step'] ?? 1;
    $stepCount = $_GET['stepwise-step-count'] ?? 10;

    $percent = round(($step / $stepCount * 100));

    $ret = <<<END
      <div class="stepwise-button-wrapper">
        <button class="stepwise-button">
          <span class="stepsise-button-label">
            Next
          </span>
        </button>
      </div>
      <div class="stepwise-progress-wrapper">
        <div class="stepwise-progress-title">Step $step of $stepCount</div>
        <div class="stepwise-progress-bar">
          <div class="stepwise-progress-complete" style="width: {$percent}%">
            <div class="stepwise-progress-complete-label">
              {$percent}%
            </div>
          </div>
        </div>
      </div>
    END;

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
