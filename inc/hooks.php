<?php

// ACTIVATION
function mfp_devTools_activate(){
  error_log('MFP Dev tools activated');
}

register_activation_hook(__FILE__, 'mfp_devTools_activate');


// DEACTIVATION
function mfp_devTools_deactivate(){
  error_log('MFP Dev tools deactivated');
}

register_deactivation_hook(__FILE__, 'mfp_devTools_deactivate');


