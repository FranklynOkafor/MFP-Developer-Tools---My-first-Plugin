<?php
function mfp_add_to_footer(){

$message = 'Site optimized with MFP Developer Tools';

echo '<p class="mfp-footer-credit">' . esc_html($message) . '</p>';

}

add_action('wp_footer', 'mfp_add_to_footer');