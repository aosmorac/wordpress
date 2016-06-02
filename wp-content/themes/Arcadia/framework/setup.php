<?php


/* Define Constants
============================================================ */


/* Theme Constants
------------------------------------------------------------ */

if(function_exists('wp_get_theme')) {
  $theme_data    = wp_get_theme();
  $theme_title   = trim($theme_data->title);
  $theme_version = trim($theme_data->version);
}
else {
  $theme_data    = get_theme_data(TEMPLATEPATH.'/style.css');
  $theme_title   = trim($theme_data['Title']);
  $theme_version = trim($theme_data['Version']);
}

$theme_id = strtolower(str_replace(' ', '_', $theme_title));

if(!$theme_version) $theme_version = '1.0';

define('FW_VERSION',    '2.2');
define('THEME_NAME',    $theme_title);
define('THEME_ID',      $theme_id);
define('THEME_VERSION', $theme_version);


/* ID Prefix
------------------------------------------------------------ */

define('ID_PREFIX',           'rvn_');
define('POST_META_ID_PREFIX', '_'.ID_PREFIX); // prefix underscore, so the options won't show up as Custom Field
define('OPTION_ID_PREFIX',    ID_PREFIX);


/* Paths
------------------------------------------------------------ */

define('FW_PATH', TEMPLATEPATH.'/framework');

// Shared
define('FW_SHARED_FUNCTIONS_PATH', FW_PATH.'/shared/functions');

// Backend
define('FW_ADMIN_FUNCTIONS_PATH', FW_PATH.'/backend/functions');
define('FW_ADMIN_PLUGINS_PATH',   FW_PATH.'/backend/plugins');

// Frontend
define('FW_FUNCTIONS_PATH', FW_PATH.'/frontend/functions');


/* URLs
------------------------------------------------------------ */

define('TEMPLATEURL', get_template_directory_uri());
define('FW_URL',      TEMPLATEURL.'/framework');

// Shared
define('FW_SHARED_FUNCTIONS_URL', FW_URL.'/shared/functions');

// Backend
define('FW_ADMIN_FUNCTIONS_URL', FW_URL.'/backend/functions');
define('FW_ADMIN_PLUGINS_URL',   FW_URL.'/backend/plugins');

// Frontend
define('FW_FUNCTIONS_URL', FW_URL.'/frontend/functions');





/* Global Variables
============================================================ */

global $rvn;


/* Initialize Global Data Variables
------------------------------------------------------------ */

// Will be set by the action function "rvn_set_original_post()" 
//  in the file "/framework/frontend/functions/actions.php"
$rvn['data']['original-post'] = '';


/* Initialize Global Layout Variables
------------------------------------------------------------ */

$rvn['layout']['body-class'] = array();
$rvn['layout']['fullwidth']  = false;


/* Initialize Global Image Size Variables
------------------------------------------------------------ */

$rvn['img_size'][] = array();


/* Initialize Global Default Variables
------------------------------------------------------------ */

$rvn['default'][] = array();





/* Theme Options
============================================================ */

// Timestamp of the last time theme options were updated (for caching purpose)
add_option('theme-options-last-update', time());





/* Includes
============================================================ */


/* Shared
------------------------------------------------------------ */

// Functions
require_once(FW_SHARED_FUNCTIONS_PATH.'/functions.php');


/* Backend
------------------------------------------------------------ */

// Functions
require_once(FW_ADMIN_FUNCTIONS_PATH.'/functions.php');

// Functions
require_once(FW_ADMIN_FUNCTIONS_PATH.'/functions.php');
require_once(FW_ADMIN_FUNCTIONS_PATH.'/actions.php');

// Plugins
require_once(FW_ADMIN_PLUGINS_PATH.'/form_elements/form_elements.php');
require_once(FW_ADMIN_PLUGINS_PATH.'/meta_box/meta_box.php');
require_once(FW_ADMIN_PLUGINS_PATH.'/option_page/option_page_elements/option_page_elements.php');
require_once(FW_ADMIN_PLUGINS_PATH.'/option_page/option_page.php');


/* Frontend
------------------------------------------------------------ */

// Functions
require_once(FW_FUNCTIONS_PATH.'/actions.php');
require_once(FW_FUNCTIONS_PATH.'/functions.php');





/* Theme Setup
============================================================ */


/* Theme Support
------------------------------------------------------------ */

load_theme_textdomain('ruventhemes', TEMPLATEPATH.'/languages' );

add_theme_support('menus');
add_theme_support('post-thumbnails');

?>