<?php



/* Layout
============================================================ */

$page_data = array(
  'title'   => 'Layout',
  'id'      => 'layout',
  'submenu' => true,
  'documentation_url' => ADMIN_DOCUMENTATION_URL
);










/* Generic
============================================================ */

$fields[] = array('title' => 'Generic', 'id' => 'generic', 'type' => 'table_start');



/* Color Scheme
------------------------------------------------------------ */

$options = array(
  'Black'      => 'black',
  'Grey'       => 'grey',
  'Green Grey' => 'green-grey',
  'Silver'     => 'silver',
  'Blue Grey'  => 'blue-grey',
  'Dark Blue'  => 'dark-blue',
  'Royal Blue' => 'royal-blue',
  'Teal'       => 'teal',
  'Green'      => 'green',
  'Purple'     => 'purple',
  'Pink'       => 'pink',
  'Gold'       => 'gold',
  'Orange'     => 'orange',
  'Dark Red'   => 'dark-red',
  'Cherry Red' => 'cherry-red'
);
$fields[] = array(
  'title'     => 'Color Scheme',
  'desc'      => '',
  'id'        => 'color-scheme',
  'value'     => 'black',
  'scope'     => $options,
  'no_prompt' => 'true',
  'type'      => 'select'
);



/* Default Sidebar Position
------------------------------------------------------------ */

$options = array(
  'Left'  => 'left',
  'Right' => 'right'
);
$fields[] = array(
  'title'   => 'Default Sidebar Position',
  'desc'    => 'Set the default position of the sidebar. You can also set the sidebar position for single posts and pages separately.',
  'id'      => 'sidebar-position',
  'value'   => 'right',
  'options' => $options,
  'type'    => 'radio'
);



/* Sliding Links
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Sliding Links',
  'desc'  => '',
  'id'    => 'show-sliding-links',
  'value' => 'true',
  'label' => 'Activate animated sliding links in the sidebar and in the footer',
  'type'  => 'checkbox'
);



/* Background Texture
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Background Texture',
  'desc'  => '',
  'id'    => 'show-bg-texture',
  'value' => 'true',
  'label' => 'Show background texture in header and footer',
  'type'  => 'checkbox'
);



/* Table End
------------------------------------------------------------ */

$fields[] = array('type' => 'table_end');










/* Header Bar
============================================================ */

$fields[] = array('title' => 'Header Bar', 'id' => 'header-bar', 'type' => 'table_start');



/* Show Header Bar
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Visibility',
  'desc'  => 'The header bar can display a menu, text or social icons. You can set its content in the <nobr><a href="'.admin_url().'admin.php?page=info-bars">Info Bar Settings</a></nobr>.',
  'id'    => 'show-header-bar',
  'value' => 'true',
  'label' => 'Show Header Bar',
  'type'  => 'checkbox'
);



/* Table End
------------------------------------------------------------ */

$fields[] = array('type' => 'table_end');










/* Header
============================================================ */

$fields[] = array('title' => 'Header', 'id' => 'header', 'type'  => 'table_start');



/* Header Style
------------------------------------------------------------ */

$options = array(
  'Left Aligned Logo' => 'header-style-left',
  'Centered Logo'     => 'header-style-center'
);
$fields[] = array(
  'title'   => 'Header Style',
  'desc'    => '',
  'id'      => 'header-style',
  'value'   => 'header-style-left',
  'options' => $options,
  'type'    => 'radio',
  'show'    => array('header-style-left'   => 'left-logo-top-padding-tr',
                     'header-style-center' => 'centered-logo-top-padding-tr, centered-logo-bottom-padding-tr, header-shine-height-tr')
);



/* Left Logo Top Padding
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Logo Top Padding (in pixel)',
  'desc'  => '',
  'id'    => 'left-logo-top-padding',
  'value' => '62',
  'size'  => '5',
  'type'  => 'text'
);



/* Centered Logo Top Padding
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Logo Top Padding (in pixel)',
  'desc'  => '',
  'id'    => 'centered-logo-top-padding',
  'value' => '12',
  'size'  => '5',
  'type'  => 'text'
);



/* Centered Logo Bottom Padding
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Logo Bottom Padding (in pixel)',
  'desc'  => '',
  'id'    => 'centered-logo-bottom-padding',
  'value' => '28',
  'size'  => '5',
  'type'  => 'text'
);



/* Show Light Shine
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Light Shine',
  'desc'  => '',
  'id'    => 'show-header-light',
  'value' => 'true',
  'label' => 'Show Light Shine',
  'type'  => 'checkbox'
);



/* Show Glass Shine
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Glass Shine',
  'desc'  => '',
  'id'    => 'show-header-shine',
  'value' => '',
  'label' => 'Show Glass Shine',
  'type'  => 'checkbox'
);



/* Glass Shine Height
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Glass Shine Height (in pixel)',
  'desc'  => '',
  'id'    => 'header-shine-height',
  'value' => '45',
  'size'  => '5',
  'type'  => 'text'
);



/* Table End
------------------------------------------------------------ */

$fields[] = array('type' => 'table_end');










/* Footer
============================================================ */

$fields[] = array('title' => 'Footer Widget Area', 'id' => 'footer', 'type' => 'table_start');



/* Columns
------------------------------------------------------------ */

$column_options = array(
  '25% 25% 25% 25%' => 'one-fourth::one-fourth::one-fourth::one-fourth',
  '50% 25% 25%'     => 'one-half::one-fourth::one-fourth',
  '25% 50% 25%'     => 'one-fourth::one-half::one-fourth',
  '25% 25% 50%'     => 'one-fourth::one-fourth::one-half',
  '33% 33% 33%'     => 'one-third::one-third::one-third',
  '50% 50%'         => 'one-half::one-half'
);
$fields[] = array(
  'title'     => 'Columns',
  'desc'      => 'Select the amount and the size of your footer columns. You can fill them with content by using <a href="'.get_option('siteurl').'/wp-admin/widgets.php">Widgets</a>.',
  'id'        => 'footer-columns',
  'value'     => 'one-fourth::one-fourth::one-fourth::one-fourth',
  'scope'     => $column_options,
  'no_prompt' => 'true',
  'type'      => 'select'
);



/* Table End
------------------------------------------------------------ */

$fields[] = array('type' => 'table_end');










/* Footer Bar
============================================================ */

$fields[] = array('title' => 'Footer Bar', 'id' => 'footer-bar', 'type' => 'table_start');



/* Show Footer Bar
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Visibility',
  'desc'  => 'The footer bar can display a menu, text or social icons. You can set its content in the <nobr><a href="'.admin_url().'admin.php?page=info-bars">Info Bar Settings</a></nobr>.',
  'id'    => 'show-footer-bar',
  'value' => 'true',
  'label' => 'Show Footer Bar',
  'type'  => 'checkbox'
);



/* Table End
------------------------------------------------------------ */

$fields[] = array('type' => 'table_end');










/* Advanced
============================================================ */

$fields[] = array('title' => 'Advanced', 'id' => 'advanced', 'type' => 'table_start');



/* Custom CSS Code
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Custom CSS Code',
  'desc'  => 'To make some quick CSS changes, write the code in here and it will apply to the theme.',
  'id'    => 'custom-css-code',
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