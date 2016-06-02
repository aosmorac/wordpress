<?php



/* Footer
============================================================ */


$page_data = array(
  'title'   => 'Info Bars',
  'id'      => 'info-bars',
  'submenu' => true,
  'documentation_url' => ADMIN_DOCUMENTATION_URL
);










/* Page Header
============================================================ */

$fields[] = array('title' => 'Page Header', 'id' => 'page-header', 'type'  => 'table_start');



/* Right Content
------------------------------------------------------------ */

$options = array(
  'None'         => 'none',
  'Search Form'  => 'search-form',
  'Social Icons' => 'social-icons'
);
$fields[] = array(
  'title'   => 'Right Content',
  'desc'    => '',
  'id'      => 'page-header-right-content-type',
  'value'   => 'social-icons',
  'options' => $options,
  'type'    => 'radio'
);



/* Table End
------------------------------------------------------------ */

$fields[] = array('type' => 'table_end');










/* Header Bar
============================================================ */

$fields[] = array('title' => 'Header Bar', 'id' => 'header-bar', 'type' => 'table_start');



/* Info
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Info',
  'desc'  => 'The Header Bar is located on the very top of your page and can be enabled in the <a href="'.admin_url().'admin.php?page=layout">Layout Settings.</a><br/><b>Choose what kind of content you want to display in the header bar:</b></br></br><ul><li>Select <b>Text</b> to include the content of the text box below.</li><li>Select <b>Social Icons</b> to dislay the icon links you\'ve set in the <a href="'.admin_url().'admin.php?page=social-links">Social Link Settings</a>.</li><li>Select <b>Navigation Menu</b> to show the menu you\'ve set up in the <a href="'.admin_url().'nav-menus.php">Menu Manager</a></li><ul>',
  'id'    => 'header-bar-info',
  'type'  => 'html'
);



/* Left Content
------------------------------------------------------------ */

$options = array(
  'None'            => '',
  'Text'            => 'text',
  'Social Icons'    => 'social-icons',
  'Navigation Menu' => 'menu'
);
$fields[] = array(
  'title'     => 'Left Content',
  'desc'      => '',
  'id'        => 'header-bar-left-content-type',
  'value'     => 'menu',
  'scope'     => $options,
  'no_prompt' => 'true',
  'type'      => 'select',
  //'show'      => array('text' => 'header-bar-text-tr')
);



/* Right Content
------------------------------------------------------------ */

$fields[] = array(
  'title'     => 'Right Content',
  'desc'      => '',
  'id'        => 'header-bar-right-content-type',
  'value'     => 'text',
  'scope'     => $options,
  'no_prompt' => 'true',
  'type'      => 'select',
  //'show'      => array('text' => 'header-bar-text-tr')
);



/* Text
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Text',
  'desc'  => '',
  'id'    => 'header-bar-text',
  'value' => 'Call Us Today! <b>158.321.1234</b>',
  'size'  => '5',
  'type'  => 'textarea'
);



/* Table End
------------------------------------------------------------ */

$fields[] = array('type'  => 'table_end');










/* Footer Bar
============================================================ */

$fields[] = array('title' => 'Footer Bar', 'id' => 'footer-bar', 'type' => 'table_start');



/* Info
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Info',
  'desc'  => 'The Footer Bar is located on the very bottom of your page and can be enabled in the <a href="'.admin_url().'admin.php?page=layout#rvn_footer-bar-option-table">Layout Settings.</a><br/><b>Choose what kind of content you want to display in the footer bar:</b></br></br><ul><li>Select <b>Text</b> to include the content of the text box below.</li><li>Select <b>Social Icons</b> to dislay the icon links you\'ve set in the <a href="'.admin_url().'admin.php?page=social-links">Social Link Settings</a>.</li><li>Select <b>Navigation Menu</b> to show the menu you\'ve set up in the <a href="'.admin_url().'nav-menus.php">Menu Manager</a></li><ul>',
  'id'    => 'footer-bar-info',
  'type'  => 'html'
);



/* Left Content
------------------------------------------------------------ */

$options = array(
  'None'            => '',
  'Text'            => 'text',
  'Social Icons'    => 'social-icons',
  'Navigation Menu' => 'menu'
);
$fields[] = array(
  'title'     => 'Left Content',
  'desc'      => '',
  'id'        => 'footer-bar-left-content-type',
  'value'     => 'text',
  'scope'     => $options,
  'no_prompt' => 'true',
  'type'      => 'select',
  //'show'      => array('text' => 'footer-bar-text-tr')
);



/* Right Content
------------------------------------------------------------ */

$fields[] = array(
  'title'     => 'Right Content',
  'desc'      => '',
  'id'        => 'footer-bar-right-content-type',
  'value'     => 'social-icons',
  'scope'     => $options,
  'no_prompt' => 'true',
  'type'      => 'select',
  //'show'      => array('text' => 'footer-bar-text-tr')
);



/* Text
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Text',
  'desc'  => '',
  'id'    => 'footer-bar-text',
  'value' => 'This is an WordPress Theme by Ruven. You can purchase it on <a href="http://themeforest.net/user/RuvenThemes/portfolio/?ref=RuvenThemes">themeforest.net</a>.',
  'size'  => '5',
  'type'  => 'textarea'
);



/* Table End
------------------------------------------------------------ */

$fields[] = array('type'  => 'table_end');









  
new option_page($page_data, $fields);
$fields = array();



?>