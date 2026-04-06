<?php
function mfp_add_to_footer()
{
  $enabled = get_option('mfp_footer_credit');
  if ($enabled){
    $message = get_option('mfp_footer_message');
    echo "<p> $message </p>";
  }
}

add_action('wp_footer', 'mfp_add_to_footer');
 