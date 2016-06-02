<?php



/* Option Page
============================================================ */

$page_data = array(
  'title'   => 'Colors',
  'id'      => 'colors',
  'submenu' => true,
  'documentation_url' => ADMIN_DOCUMENTATION_URL
);







/* Generic
============================================================ */

$fields[] = array('title' => 'Generic', 'id' => 'generic', 'type' => 'table_start');

$fields[] = array('title' => 'Text', 'id' => 'text-color', 'value' => '#666666', 'desc' => '', 'size'  => '30', 'label' => 'Set Color', 'type' => 'color_picker');

$fields[] = array('type' => 'group_start', 'title' => 'Links', 'id' => 'links', 'desc' => '');
  $fields[] = array('title' => 'Links',       'id' => 'link-color',       'value' => '#000000', 'desc' => '', 'size'  => '30', 'label' => 'Set Color', 'type' => 'color_picker');
  $fields[] = array('title' => 'Links Hover', 'id' => 'link-hover-color', 'value' => '#000000', 'desc' => '', 'size'  => '30', 'label' => 'Set Hover Color', 'type' => 'color_picker');
$fields[] = array('type' => 'group_end');

$fields[] = array('type' => 'group_start', 'title' => 'Buttons', 'id' => 'links', 'desc' => '');
  $fields[] = array('title' => 'Buttons',       'id' => 'button-color',       'value' => '#404040', 'desc' => '', 'size'  => '30', 'label' => 'Set Color', 'type' => 'color_picker');
  $fields[] = array('title' => 'Buttons Hover', 'id' => 'button-hover-color', 'value' => '#000000', 'desc' => '', 'size'  => '30', 'label' => 'Set Hover Color', 'type' => 'color_picker');
$fields[] = array('type' => 'group_end');

$fields[] = array('type' => 'group_start', 'title' => 'Headings', 'id' => 'headings', 'desc' => '');
  $fields[] = array('title' => 'Heading 1', 'id' => 'h1-color', 'value' => '#404040', 'desc' => '', 'size'  => '30', 'label' => 'Set H1 Color', 'type' => 'color_picker');
  $fields[] = array('title' => 'Heading 2', 'id' => 'h2-color', 'value' => '#404040', 'desc' => '', 'size'  => '30', 'label' => 'Set H2 Color', 'type' => 'color_picker');
  $fields[] = array('title' => 'Heading 3', 'id' => 'h3-color', 'value' => '#404040', 'desc' => '', 'size'  => '30', 'label' => 'Set H3 Color', 'type' => 'color_picker');
  $fields[] = array('title' => 'Heading 4', 'id' => 'h4-color', 'value' => '#404040', 'desc' => '', 'size'  => '30', 'label' => 'Set H4 Color', 'type' => 'color_picker');
  $fields[] = array('title' => 'Heading 5', 'id' => 'h5-color', 'value' => '#404040', 'desc' => '', 'size'  => '30', 'label' => 'Set H5 Color', 'type' => 'color_picker');
  $fields[] = array('title' => 'Heading 6', 'id' => 'h6-color', 'value' => '#404040', 'desc' => '', 'size'  => '30', 'label' => 'Set H6 Color', 'type' => 'color_picker');
$fields[] = array('type' => 'group_end');

$fields[] = array('type' => 'group_start', 'title' => 'Entry Headings', 'id' => 'entry-headings', 'desc' => '');
  $fields[] = array('title' => 'Entry Headings',       'id' => 'entry-heading-color',       'value' => '#404040', 'desc' => '', 'size'  => '30', 'label' => 'Set Color', 'type' => 'color_picker');
  $fields[] = array('title' => 'Entry Headings Hover', 'id' => 'entry-heading-hover-color', 'value' => '#000000', 'desc' => '', 'size'  => '30', 'label' => 'Set Hover Color', 'type' => 'color_picker');
$fields[] = array('type' => 'group_end');

$fields[] = array('type' => 'table_end');







/* Front Page
============================================================ */

$fields[] = array('title' => 'Front Page', 'id' => 'front-page', 'type' => 'table_start');

$fields[] = array('title' => 'Welcome Bar Heading', 'id' => 'welcome-bar-heading-color', 'value' => '#3f3f3f', 'desc' => '', 'size'  => '30', 'label' => 'Set Color', 'type' => 'color_picker');
$fields[] = array('title' => 'Welcome Bar Text',    'id' => 'welcome-bar-text-color',    'value' => '#3f3f3f', 'desc' => '', 'size'  => '30', 'label' => 'Set Color', 'type' => 'color_picker');

$fields[] = array('type' => 'table_end');







/* Sidebar
============================================================ */

$fields[] = array('title' => 'Sidebar', 'id' => 'sidebar', 'type' => 'table_start');

$fields[] = array('title' => 'Headings', 'id' => 'sidebar-heading-color', 'value' => '#404040', 'desc' => '', 'size'  => '30', 'label' => 'Set Color', 'type' => 'color_picker');
$fields[] = array('title' => 'Text',     'id' => 'sidebar-text-color',    'value' => '#666666', 'desc' => '', 'size'  => '30', 'label' => 'Set Color', 'type' => 'color_picker');

$fields[] = array('type' => 'group_start', 'title' => 'Links', 'id' => 'sidebar-links', 'desc' => '');
  $fields[] = array('title' => 'Links',       'id' => 'sidebar-link-color',       'value' => '#000000', 'desc' => '', 'size'  => '30', 'label' => 'Set Color', 'type' => 'color_picker');
  $fields[] = array('title' => 'Links Hover', 'id' => 'sidebar-link-hover-color', 'value' => '#000000', 'desc' => '', 'size'  => '30', 'label' => 'Set Hover Color', 'type' => 'color_picker');
$fields[] = array('type' => 'group_end');

$fields[] = array('type' => 'table_end');



  
new option_page($page_data, $fields);
$fields = array();



?>