<?php

if (!defined('ABSPATH')){
  exit;
}

require_once ABSPATH . 'wp-admin/includes/plugin.php';

function mfp_details_shortcode()
{
  // Plugin details
  $plugin_data = get_plugin_data(MFP_PLUGIN_FILE);

  // WP Details
  $wp_version = get_bloginfo("version");

  // Theme Details
  $theme = wp_get_theme();

  // Posts Details
  $counts = wp_count_posts();

  // Pages Details
  $page_counts = wp_count_posts('page');

  ob_start();
  ?>
  
  <div class="mfp-container">
    <h2>MFP Developer Tools</h2>
    <p><strong>Plugin Version:</strong> <?php echo $plugin_data['Version']; ?></p>
    <p><strong>WP Version:</strong> <?php echo $wp_version; ?></p>
    <p><strong>Active Theme:</strong> <?php echo $theme->get('Name'); ?></p>
    <p><strong>Total Posts:</strong> <?php echo $counts->publish; ?></p>
    <p><strong>Total Pages:</strong> <?php echo $page_counts->publish; ?></p>
  </div>
  
  <?php
  return ob_get_clean();

}

add_shortcode('mfp_site_info', 'mfp_details_shortcode');