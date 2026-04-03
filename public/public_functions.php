<?php
function mfp_add_to_footer()
{
  $enabled = get_option('mfp_footer_credit');
  if ($enabled){
    echo '<p>Site Optimized by MFP Developer Tools</p>';
  }
}

add_action('wp_footer', 'mfp_add_to_footer');
 