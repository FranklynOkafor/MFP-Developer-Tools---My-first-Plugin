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

// ENQUEUE SCRIPTS AND STYLES
function mfp_admin_enqueue_scripts($hook) {
  // Only load on our plugin's admin pages
  $allowed_hooks = [
    'toplevel_page_mfp-dev-tools',
    'mfp-dev-tools_page_mfp-dev-dashboard',
    'mfp-dev-tools_page_mfp_settings'
  ];

  if (!in_array($hook, $allowed_hooks)) {
    return;
  }

  // Enqueue Admin CSS
  wp_enqueue_style(
    'mfp-admin-css',
    plugin_dir_url(MFP_PLUGIN_FILE) . 'assets/css/admin.css',
    [],
    '1.0.0'
  );

  // Enqueue Admin JS
  wp_enqueue_script(
    'mfp-admin-js',
    plugin_dir_url(MFP_PLUGIN_FILE) . 'assets/js/admin.js',
    ['jquery'], // Dependency on jQuery
    '1.0.0',
    true // Load in footer
  );
}

add_action('admin_enqueue_scripts', 'mfp_admin_enqueue_scripts');


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

  <div class="wrap mfp-admin-wrap">
    <h1>MFP Developer Tools</h1>
    <div class="mfp-dashboard-cards">
      <div class="mfp-card">
        <h3>Plugin Info</h3>
        <p><strong>Version:</strong> <?php echo esc_html($plugin_data['Version']); ?></p>
      </div>
      <div class="mfp-card">
        <h3>WordPress Info</h3>
        <p><strong>Version:</strong> <?php echo esc_html(get_bloginfo('version')); ?></p>
      </div>
      <div class="mfp-card">
        <h3>Active Theme</h3>
        <p><strong>Name:</strong> <?php echo esc_html($theme->get('Name')); ?></p>
      </div>
      <div class="mfp-card">
        <h3>Content Stats</h3>
        <p><strong>Total Posts:</strong> <?php echo esc_html($counts->publish ?? 0); ?></p>
        <p><strong>Total Pages:</strong> <?php echo esc_html($page_counts->publish ?? 0); ?></p>
      </div>
    </div>
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
      settings_fields('mfp_settings_group');
      do_settings_sections('mfp_settings_page');
      submit_button();

      ?>

    </form>

  </div>
<?php }


// Register the Settings
function mfp_register_settings()
{
  register_setting(
    'mfp_settings_group', //Options Group
    'mfp_footer_credit', //Option Name
    ['sanitize_text_field']
  );

  // register the footer text
  register_setting(
    'mfp_settings_group',
    'mfp_footer_message',
    ['sanitize_text_field']
    
   );

  // Add section
  add_settings_section(
    'mfp_main_section',
    'Plugin Settings ',
    '__return_empty_string',
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

  // Add Text Input
  add_settings_field(
    'mfp_footer_message',
    'Footer Message',
    'mfp_footer_message_callback',
    'mfp_settings_page',
    'mfp_main_section'
  );
}

add_action('admin_init', 'mfp_register_settings');

// Checkbox Function

function mfp_footer_credit_callback()
{
  $value = get_option('mfp_footer_credit');

  echo '<input type="checkbox" name="mfp_footer_credit" value="1"' . checked(1, $value, false) . '/>';
}


// Text function
function mfp_footer_message_callback()
{

  $value = get_option('mfp_footer_message');

  echo '<input type="text" name="mfp_footer_message" value="' . esc_attr($value) . '" class="regular-text" />';
}
