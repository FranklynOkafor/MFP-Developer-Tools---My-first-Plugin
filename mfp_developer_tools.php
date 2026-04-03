<?php

/*
*Plugin Name: MFP Developers Tools
*Description: This plugin just gives a summary of somethings on your page
*Version: 1.0
*Author: Franklyn Okafor

*/

if (!defined('ABSPATH')){
  exit;
}

require_once plugin_dir_path(__FILE__) . 'admin/admin_functions.php';
require_once plugin_dir_path(__FILE__) . 'inc/hooks.php';
require_once plugin_dir_path(__FILE__) . 'inc/shortcode.php';
require_once plugin_dir_path(__FILE__) . 'public/public_functions.php';


// DECLARING MY GLOBAL VARIABLES
define('MFP_PLUGIN_FILE', __FILE__);