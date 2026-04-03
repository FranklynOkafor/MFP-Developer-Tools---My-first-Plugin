<?php
if (!defined('ABSPATH')) {
  exit;
}


function admin_note()
{
?>
  <div class="notice notice-success is-dismissible">
    <p>MFP Dev Tools Activated</p>
  </div>
<?php
}

add_action('admin_notices', 'admin_note');


// ADMIN PAGES

function mfp_dev_menu()
{
  add_menu_page(
    'MFP Dev Tools', //PAGE TITLE
    'MFP Dev Tools', //Menu Title
    'manage_options', //Capability
    'mfp-dev-tools', //Slug
    'mfp_dev_page', //Callable function
    'dashicons-admin-tools', //Dashicons
    // 
  );
}

add_action('admin_menu', 'mfp_dev_menu');


// ============================
// DASHBOARD PAGE
// ===========================

function mfp_dev_page()
{
  // Plugin details
  $plugin_data = get_plugin_data(MFP_PLUGIN_FILE);

  // Theme Details
  $theme = wp_get_theme();

  // Posts Details
  $counts = wp_count_posts();

  // Pages Details
  $page_counts = wp_count_posts('page');
?>

  <div class="container">
    <h1>MFD Developer Tools</h1>
    <p><strong>Plugin Version</strong>: <?php echo $plugin_data['Version']; ?></p>
    <p><strong>WP Version</strong>: <?php echo get_bloginfo('version') ?></p>
    <p><strong> Active Theme </strong>: <?php echo $theme->get('Name') ?></p>
    <p><strong> Total Posts </strong>: <?= $counts->publish ?> </p>
    <p><strong> Total Pages </strong>: <?= $page_counts->publish ?> </p>

  </div>


<?php
}

// SUB MENUS

function mfp_dev_subMenus()
{
  add_submenu_page(
    'mfp-dev-tools', //PARENT SLUG
    'Dashboard', //Page Title
    'Dashboard', //Menu Title
    'manage_options', //Capability
    'mfp-dev-dashboard', //Slug
    'mfp_dev_page', //Callable
    1, //Position
  );

  add_submenu_page(
    'mfp-dev-tools', //PARENT SLUG
    'Settings', //Page Title
    'Settings', //Menu Title
    'manage_options', //Capability
    'mfp_settings', //Slug
    'mfp_settings_page', //Callable
    2, //Position
  );
}

add_action('admin_menu', 'mfp_dev_subMenus');




// =================================
// SETTINGS API
// =================================



// SETTINGS PAGE
function mfp_settings_page()
{ ?>
  <div class="wrap">
    <h1>MFP Settings</h1>

    <form action="options.php" method="post">

      <?php
        settings_fields('mfp_settigs_group');
        do_settings_sections('mfp_settings_page');
        submit_button();

      ?>

    </form>

  </div>
<?php }


// Register the Settings
function mfp_register_settings(){
  register_setting(
    'mfp_settigs_group', //Options Group
    'mfp_footer_credit' //Option Name
  );

  // Add section
  add_settings_section(
    'mfp_main_section',
    'Plugin Settings ',
    null,
    'mfp_settings_page'
  );

  // Add Checkbox section
  add_settings_field(
    'mfp_footer_credit',
    'Enable Footer Credit',
    'mfp_footer_credit_callback',
    'mfp_settings_page',
    'mfp_main_section'
  );
}

add_action('admin_init', 'mfp_register_settings');

// Checkbox Function

function mfp_footer_credit_callback(){
  $value = get_option('mfp_footer_credit');

  echo '<input type="checkbox" name="mfp_footer_credit" value="1"' . checked(1, $value, false) . '/>';
}
?>

