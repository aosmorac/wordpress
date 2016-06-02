<?php



/* General
============================================================ */

$page_data = array(
  'title'   => 'General',
  'id'      => 'main',
  'submenu' => false,
  'documentation_url' => ADMIN_DOCUMENTATION_URL
);










/* Options
============================================================ */

$fields[] = array('title' => 'Options', 'id' => 'options', 'type' => 'table_start');



/* Logo
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Logo',
	'desc'  => 'Set your logo here and edit its paddings in the <nobr><a href="'.admin_url().'admin.php?page=layout">Layout Settings</a></nobr>.',
	'id'    => 'logo',
	'value' => IMAGES_URL.'/dummy/logo.png',
	'size'  => '48',
	'label' => 'Set Logo',
	'type'  => 'media_link'
);



/* Favicon
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Favicon',
	'desc'  => 'Set a 16x16 pixel favicon that will appear in your addressbar and in your bookmarks.',
	'id'    => 'favicon',
	'value' => IMAGES_URL.'/dummy/favicon.ico',
	'size'  => '48',
	'label' => 'Set Favicon',
	'type'  => 'media_link'
);



/* Table End
------------------------------------------------------------ */

$fields[] = array('type' => 'table_end');










/* Codes
============================================================ */

$fields[] = array(
  'title' => 'Codes',
  'id'    => 'codes',
  'type'  => 'table_start'
);



/* Header Code
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Header Code',
  'desc'  => 'The code you paste in here will be included preceding to the <code>&lt;/head&gt;</code> tag of each page.<br/>You can paste in your tracking codes, script and/or style includes.',
  'id'    => 'header-code',
  'value' => '',
  'size'  => '12',
  'type'  => 'textarea'
);



/* Footer Code
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Footer Code',
  'desc'  => 'The code you paste in here will be included preceding to the <code>&lt;/body&gt;</code> tag of each page.<br/>You can paste in your tracking codes, script and/or style includes.',
  'id'    => 'footer-code',
  'value' => '',
  'size'  => '12',
  'type'  => 'textarea'
);



/* Table End
------------------------------------------------------------ */

$fields[] = array('type' => 'table_end');









  
new option_page($page_data, $fields);
$fields = array();



?>