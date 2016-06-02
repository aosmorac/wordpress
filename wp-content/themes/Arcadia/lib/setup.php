<?php


/* Define Constants
============================================================ */


/* Paths
------------------------------------------------------------ */

define('LIB_PATH', TEMPLATEPATH.'/lib');

// Shared
define('SHARED_FUNCTIONS_PATH', LIB_PATH.'/shared/functions');
define('SHARED_WIDGETS_PATH',   LIB_PATH.'/shared/widgets');

// Backend
define('ADMIN_DOCUMENTATION_PATH',     LIB_PATH.'/backend/documentation');
define('ADMIN_FUNCTIONS_PATH',         LIB_PATH.'/backend/functions');
define('ADMIN_PLUGINS_PATH',           LIB_PATH.'/backend/plugins');
define('ADMIN_OPTIONS_PATH',           LIB_PATH.'/backend/options');
define('ADMIN_CUSTOM_POST_TYPES_PATH', LIB_PATH.'/backend/custom_post_types');
define('ADMIN_META_BOXES_PATH',        LIB_PATH.'/backend/meta_boxes');
define('ADMIN_WIDGETS_PATH',           LIB_PATH.'/backend/widgets');

// Frontend
define('FONTS_PATH',       LIB_PATH.'/frontend/fonts');
define('FUNCTIONS_PATH',   LIB_PATH.'/frontend/functions');
define('IMAGES_PATH',      LIB_PATH.'/frontend/images');
define('JAVASCRIPTS_PATH', LIB_PATH.'/frontend/javascripts');
define('STYLESHEETS_PATH', LIB_PATH.'/frontend/stylesheets');
define('PLUGINS_PATH',     LIB_PATH.'/frontend/plugins');
define('TEMPLATES_PATH',   LIB_PATH.'/frontend/templates');


/* URLs
------------------------------------------------------------ */

define('LIB_URL', TEMPLATEURL.'/lib');

// Shared
define('SHARED_FUNCTIONS_URL', LIB_URL.'/shared/functions');
define('SHARED_WIDGETS_URL',   LIB_URL.'/shared/widgets');

// Backend
define('ADMIN_DOCUMENTATION_URL',     LIB_URL.'/backend/documentation');
define('ADMIN_FUNCTIONS_URL',         LIB_URL.'/backend/functions');
define('ADMIN_PLUGINS_URL',           LIB_URL.'/backend/plugins');
define('ADMIN_OPTIONS_URL',           LIB_URL.'/backend/options');
define('ADMIN_CUSTOM_POST_TYPES_URL', LIB_URL.'/backend/custom_post_types');
define('ADMIN_META_BOXES_URL',        LIB_URL.'/backend/meta_boxes');
define('ADMIN_WIDGETS_URL',           LIB_URL.'/backend/widgets');

// Frontend
define('FONTS_URL',       LIB_URL.'/frontend/fonts');
define('FUNCTIONS_URL',   LIB_URL.'/frontend/functions');
define('IMAGES_URL',      LIB_URL.'/frontend/images');
define('JAVASCRIPTS_URL', LIB_URL.'/frontend/javascripts');
define('STYLESHEETS_URL', LIB_URL.'/frontend/stylesheets');
define('PLUGINS_URL',     LIB_URL.'/frontend/plugins');
define('TEMPLATES_URL',   LIB_URL.'/frontend/templates');





/* Global Variables
============================================================ */

global $rvn;



/* Initialize Global Data Variables
------------------------------------------------------------ */

$rvn['data']['portfolio-page-settings'] = '';



/* Initialize Global Image Variables
------------------------------------------------------------ */

// Content Width
if(!isset($content_width)) $content_width = 900;

// Nivo Slider
$rvn['img_size']['nivo-slider-full'] = array('962', rvn_get_option('nivo-slider-img-height'));

// Cycle Slider
$rvn['img_size']['cycle-slider-full'] = array('962', rvn_get_option('cycle-slider-img-height'));

// Cycle Slider (Alt. Layout)
$rvn['img_size']['cycle-alt-slider-two-third'] = array('625', rvn_get_option('cycle-alt-slider-img-height'));

// Featured Image (Full Width)
$rvn['img_size']['featured-image-full'] = array('962', rvn_get_option('featured-image-height'));

// Featured Image (Two-Third)
$rvn['img_size']['featured-image-alt-two-third'] = array('625', rvn_get_option('featured-image-alt-height'));

// Featured Video (Full Width)
$rvn['img_size']['featured-video-full'] = array('962', rvn_get_option('featured-video-height'));

// Featured Video (Two-Third)
$rvn['img_size']['featured-video-alt-two-third'] = array('625', rvn_get_option('featured-video-alt-height'));

// Piecemaker Slider
$rvn['img_size']['piecemaker-slider-full'] = array('962', rvn_get_option('piecemaker-slider-img-height'));

// Post
$rvn['img_size']['post-full-s1-full'] = array('886', rvn_get_option('post-full-s1-full-img-height'));
$rvn['img_size']['post-s1-full']      = array('586', rvn_get_option('post-s1-full-img-height'));

// Page
$rvn['img_size']['page-full-s1-full'] = array('886', rvn_get_option('page-full-s1-full-img-height'));
$rvn['img_size']['page-s1-full']      = array('586', rvn_get_option('page-s1-full-img-height'));

// Portfolio
$rvn['img_size']['portfolio-page-full-s1-full'] = array('886', rvn_get_option('portfolio-page-full-s1-full-img-height'));
$rvn['img_size']['portfolio-page-s1-full']      = array('586', rvn_get_option('portfolio-page-s1-full-img-height'));

// Blog
$rvn['img_size']['blog-s1-full']       = array('586', rvn_get_option('blog-s1-full-img-height'));
$rvn['img_size']['blog-s1-one-half']   = array('274', rvn_get_option('blog-s1-one-half-img-height'));
$rvn['img_size']['blog-s1-one-third']  = array('169', rvn_get_option('blog-s1-one-third-img-height'));
$rvn['img_size']['blog-s1-one-fourth'] = array('118', rvn_get_option('blog-s1-one-fourth-img-height'));

$rvn['img_size']['blog-s2-two-third']  = array('377', rvn_get_option('blog-s2-two-third-img-height'));
$rvn['img_size']['blog-s2-one-half']   = array('274', rvn_get_option('blog-s2-one-half-img-height'));
$rvn['img_size']['blog-s2-one-third']  = array('169', rvn_get_option('blog-s2-one-third-img-height'));
$rvn['img_size']['blog-s2-one-fourth'] = array('118', rvn_get_option('blog-s2-one-fourth-img-height'));

$rvn['img_size']['blog-full-s1-full']       = array('886', rvn_get_option('blog-full-s1-full-img-height'));
$rvn['img_size']['blog-full-s1-one-half']   = array('418', rvn_get_option('blog-full-s1-one-half-img-height'));
$rvn['img_size']['blog-full-s1-one-third']  = array('261', rvn_get_option('blog-full-s1-one-third-img-height'));
$rvn['img_size']['blog-full-s1-one-fourth'] = array('184', rvn_get_option('blog-full-s1-one-fourth-img-height'));

$rvn['img_size']['blog-full-s2-two-third']  = array('586', rvn_get_option('blog-full-s2-two-third-img-height'));
$rvn['img_size']['blog-full-s2-one-half']   = array('418', rvn_get_option('blog-full-s2-one-half-img-height'));
$rvn['img_size']['blog-full-s2-one-third']  = array('261', rvn_get_option('blog-full-s2-one-third-img-height'));
$rvn['img_size']['blog-full-s2-one-fourth'] = array('184', rvn_get_option('blog-full-s2-one-fourth-img-height'));

// Portfolio
$rvn['img_size']['portfolio-s1-full']       = array('586', '274');
$rvn['img_size']['portfolio-s1-one-half']   = array('274', '150');
$rvn['img_size']['portfolio-s1-one-third']  = array('169', '104');
$rvn['img_size']['portfolio-s1-one-fourth'] = array('118', '86');

$rvn['img_size']['portfolio-s2-two-third']  = array('377', '273');
$rvn['img_size']['portfolio-s2-one-half']   = array('274', '188');
$rvn['img_size']['portfolio-s2-one-third']  = array('169', '169');
$rvn['img_size']['portfolio-s2-one-fourth'] = array('118', '118');

$rvn['img_size']['portfolio-full-s1-full']       = array('886', '415');
$rvn['img_size']['portfolio-full-s1-one-half']   = array('418', '220');
$rvn['img_size']['portfolio-full-s1-one-third']  = array('261', '152');
$rvn['img_size']['portfolio-full-s1-one-fourth'] = array('184', '124');

$rvn['img_size']['portfolio-full-s2-two-third']  = array('586', '274');
$rvn['img_size']['portfolio-full-s2-one-half']   = array('418', '220');
$rvn['img_size']['portfolio-full-s2-one-third']  = array('261', '261');
$rvn['img_size']['portfolio-full-s2-one-fourth'] = array('184', '184');

// Preview (Entry) Shortcode
$rvn['img_size']['preview-s1-full']       = array('586', '274');
$rvn['img_size']['preview-s1-one-half']   = array('274', '150');
$rvn['img_size']['preview-s1-one-third']  = array('169', '104');
$rvn['img_size']['preview-s1-one-fourth'] = array('118', '86');

$rvn['img_size']['preview-s2-two-third']  = array('377', '273');
$rvn['img_size']['preview-s2-one-half']   = array('274', '188');
$rvn['img_size']['preview-s2-one-third']  = array('169', '169');
$rvn['img_size']['preview-s2-one-fourth'] = array('118', '118');

$rvn['img_size']['preview-full-s1-full']       = array('886', '415');
$rvn['img_size']['preview-full-s1-one-half']   = array('418', '220');
$rvn['img_size']['preview-full-s1-one-third']  = array('261', '152');
$rvn['img_size']['preview-full-s1-one-fourth'] = array('184', '124');

$rvn['img_size']['preview-full-s2-two-third']  = array('586', '274');
$rvn['img_size']['preview-full-s2-one-half']   = array('418', '220');
$rvn['img_size']['preview-full-s2-one-third']  = array('261', '261');
$rvn['img_size']['preview-full-s2-one-fourth'] = array('184', '184');

// Gallery Shortcode
$rvn['img_size']['gallery-full']       = array('586', '274');
$rvn['img_size']['gallery-two-third']  = array('377', '217');
$rvn['img_size']['gallery-one-half']   = array('274', '150');
$rvn['img_size']['gallery-one-third']  = array('169', '104');
$rvn['img_size']['gallery-one-fourth'] = array('118', '86');

$rvn['img_size']['gallery-full-full']       = array('886', '415');
$rvn['img_size']['gallery-full-two-third']  = array('586', '338');
$rvn['img_size']['gallery-full-one-half']   = array('418', '220');
$rvn['img_size']['gallery-full-one-third']  = array('261', '152');
$rvn['img_size']['gallery-full-one-fourth'] = array('184', '124');





/* Includes
============================================================ */


/* Shared
------------------------------------------------------------ */

// Functions
require_once(SHARED_FUNCTIONS_PATH.'/functions.php');

// Widgets
require_once(SHARED_WIDGETS_PATH.'/contact.php');
require_once(SHARED_WIDGETS_PATH.'/flickr.php');
require_once(SHARED_WIDGETS_PATH.'/latest_posts.php');
require_once(SHARED_WIDGETS_PATH.'/latest_work.php');
require_once(SHARED_WIDGETS_PATH.'/social.php');
require_once(SHARED_WIDGETS_PATH.'/sub_nav.php');
require_once(SHARED_WIDGETS_PATH.'/twitter.php');


/* Backend
------------------------------------------------------------ */

// Functions
//require_once(ADMIN_FUNCTIONS_PATH.'/functions.php');

// Plugins
require_once(ADMIN_PLUGINS_PATH.'/shortcode_editor/shortcode_editor.php');

// Custom Post Types
require_once(ADMIN_CUSTOM_POST_TYPES_PATH.'/featured_items.php');
require_once(ADMIN_CUSTOM_POST_TYPES_PATH.'/portfolio.php');

// Option Pages
require_once(ADMIN_OPTIONS_PATH.'/main.php');
require_once(ADMIN_OPTIONS_PATH.'/layout.php');
require_once(ADMIN_OPTIONS_PATH.'/typography.php');
require_once(ADMIN_OPTIONS_PATH.'/front_page.php');
require_once(ADMIN_OPTIONS_PATH.'/blog.php');
require_once(ADMIN_OPTIONS_PATH.'/posts_and_pages.php');
require_once(ADMIN_OPTIONS_PATH.'/portfolio.php');
require_once(ADMIN_OPTIONS_PATH.'/social.php');
require_once(ADMIN_OPTIONS_PATH.'/info_bars.php');
require_once(ADMIN_OPTIONS_PATH.'/sidebars.php');
//require_once(ADMIN_OPTIONS_PATH.'/_demo_fields.php');
//require_once(ADMIN_OPTIONS_PATH.'/_demo_toggle_fields.php');
//require_once(ADMIN_OPTIONS_PATH.'/_demo_multitable.php');

// Meta Boxes
require_once(ADMIN_META_BOXES_PATH.'/featured_items.php');
require_once(ADMIN_META_BOXES_PATH.'/entries.php');


/* Frontend
------------------------------------------------------------ */

require_once(FUNCTIONS_PATH.'/actions.php');
require_once(FUNCTIONS_PATH.'/filters.php');
require_once(FUNCTIONS_PATH.'/functions.php');
require_once(FUNCTIONS_PATH.'/entry.php');
require_once(FUNCTIONS_PATH.'/option_css_code.php');
require_once(FUNCTIONS_PATH.'/shortcodes.php');
require_once(FUNCTIONS_PATH.'/sub_nav_walker.php');





/* Theme Setup
============================================================ */


/* Theme Support
------------------------------------------------------------ */

add_theme_support('automatic-feed-links');
add_post_type_support('page', 'excerpt');
//add_theme_support('post-formats', array('aside', 'gallery'));
//add_post_type_support('post', 'post-formats');
//add_editor_style('lib/backend/stylesheets/editor-style.css');
//add_custom_background('rvn_put_custom_background');


/* Image Sizes
------------------------------------------------------------ */

set_post_thumbnail_size(60, 60, true); // Thumbnail


/* Register Navigation Menus
------------------------------------------------------------ */

register_nav_menus(array(
  'main'       => 'Main Menu',
  'header-bar' => 'Header Bar Menu',
  'footer-bar' => 'Footer Bar Menu'
));


/* Register Sidebars
------------------------------------------------------------ */

rvn_register_sidebar('Default Sidebar',                     '', 'Will be displayed on everywhere when no page specific sidebar is set up.');
rvn_register_sidebar('Default Sidebar for Blog',            '', 'Will be displayed on the blog page and on every post when no page or post specific sidebar is set up. If left empty the default sidebar will show up.');
rvn_register_sidebar('Default Sidebar for Posts',           '', 'Will be displayed on every post when no post specific sidebar is set up. If left empty the blog sidebar will show up.');
rvn_register_sidebar('Default Sidebar for Pages',           '', 'Will be displayed on every page when no page specific sidebar is set up. If left empty the default sidebar will show up.');
rvn_register_sidebar('Default Sidebar for Portfolio',       '', 'Will be displayed on every portfolio overview or portfolio page when no page specific sidebar is set up. If left empty the default sidebar will show up.');
rvn_register_sidebar('Default Sidebar for Portfolio Pages', '', 'Will be displayed on every portfolio page when no portfolio page specific sidebar is set up. If left empty the portfolio sidebar will show up.');

rvn_register_sidebar('Front Page', '', 'Will be displayed on on the front page. If left empty the default sidebar will show up.');
rvn_register_sidebar('Category',   '', 'Will be displayed on every category archive page. If left empty the archive sidebar will show up.');
rvn_register_sidebar('Archive',    '', 'Will be displayed on every archive page. If left empty the default sidebar will show up.');
rvn_register_sidebar('Search',     '', 'Will be displayed on every search page. If left empty the default sidebar will show up.');
rvn_register_sidebar('404 - Page not Found', '', 'Will be displayed on every 404 page. If left empty the default sidebar will show up.');

rvn_register_footer_widget_areas();
rvn_register_page_widget_areas();





/* Set Body Classes
============================================================ */


/* Layout Options
------------------------------------------------------------ */

rvn_set_body_class('show-sliding-links', false, 'no-sliding-links');
rvn_set_body_class('show-bg-texture', false, 'no-bg-texture');

rvn_set_body_class('show-header-bar', false, 'no-header-bar');

rvn_set_body_class('header-style', 'header-style-left', 'header-style-left');
rvn_set_body_class('header-style', 'header-style-center', 'header-style-center');

rvn_set_body_class('show-header-light', false, 'no-header-light');
rvn_set_body_class('show-header-shine', false, 'no-header-shine');

rvn_set_body_class('archive-layout', 'default', 'default-archive-layout');

rvn_set_body_class('show-footer-bar', false, 'no-footer-bar');


/* Front Page
------------------------------------------------------------ */

rvn_set_body_class('show-welcome-bar', false, 'no-welcome-bar');
rvn_set_body_class('show-welcome-bar', true, 'with-welcome-bar');
rvn_set_body_class('show-frontpage-content-title', false, 'no-frontpage-content-title');



?>