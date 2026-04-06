<?php

if (!defined('ABSPATH')){
  exit;
}


// ACTIVATION
function mfp_devTools_activate(){
  error_log('MFP Dev tools activated');
}

register_activation_hook(MFP_PLUGIN_FILE, 'mfp_devTools_activate');


// DEACTIVATION
function mfp_devTools_deactivate(){
  error_log('MFP Dev tools deactivated');
}

register_deactivation_hook(MFP_PLUGIN_FILE, 'mfp_devTools_deactivate');


