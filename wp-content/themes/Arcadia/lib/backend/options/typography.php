<?php



/* Typography
============================================================ */

$page_data = array(
  'title'   => 'Typography',
  'id'      => 'typography',
  'submenu' => true,
  'documentation_url' => ADMIN_DOCUMENTATION_URL
);

$font_options = rvn_get_fonts_for_select_menu();

$def_text_font    = $font_options['System Fonts']['Helvetica Neue'];
$def_heading_font = $font_options['Google Web Fonts']['Lato'];







/* QuickPicker
============================================================ */

$fields[] = array('title' => 'Info', 'id' => 'info', 'type' => 'table_start');

$fields[] = array(
  'title' => 'Fonts',
  'desc'  => 'You can see previews of the Google Web Fonts, which are included in the font selection menus, on the <nobr><a target="_blank" href="http://www.google.com/webfonts">Google Web Fonts Homepage</a></nobr>.',
  'id'    => 'info',
  'type'  => 'html'
);

$fields[] = array('type' => 'table_end');







/* QuickPicker
============================================================ */

$fields[] = array('title' => 'QuickPicker', 'id' => 'quickpicker', 'type' => 'table_start');

$fields[] = array(
  'title' => 'Text Fonts QuickPicker',
  'id'    => 'text-fonts-quickpicker',
  'value' => $def_text_font,
  'desc'  => 'What ever font you select through this menu will be applied to all text font menus below. This way you can pre select a font and then fine tune them after.',
  'scope' => $font_options,
  'no_prompt' => 'true',
  'type'      => 'select',
  'quickpick' => array('body-font',
                       'h5-font',
                       'h6-font',
                       'nav-font',
                       'sub-nav-font')
);

$fields[] = array(
  'title' => 'Heading Fonts QuickPicker',
  'id'    => 'heading-fonts-quickpicker',
  'value' => $def_heading_font,
  'desc'  => 'What ever font you select through this menu will be applied to all heading font menus below. This way you can pre select a font and then fine tune them after.',
  'scope' => $font_options,
  'no_prompt' => 'true',
  'type'      => 'select',
  'quickpick' => array('h1-font',
                       'h2-font',
                       'h3-font',
                       'h4-font')
);

$fields[] = array('type' => 'table_end');







/* Generic
============================================================ */

$fields[] = array('title' => 'Generic', 'id' => 'generic', 'type' => 'table_start');

$fields[] = array('type' => 'group_start', 'title' => 'Body Text', 'id' => 'body-text', 'no_line_break' => 'true', 'desc' => '');
  $fields[] = array('title' => 'Body Font', 'id' => 'body-font', 'value' => $def_text_font, 'desc' => '', 'scope' => $font_options, 'no_prompt' => 'true', 'type' => 'select');
  $fields[] = array('title' => 'Body Font Size', 'id' => 'body-font-size', 'value' => '13px', 'desc' => '', 'size' => '10', 'type' => 'text');
$fields[] = array('type' => 'group_end');

$fields[] = array('type' => 'group_start', 'title' => 'Heading 1', 'id' => 'h1', 'no_line_break' => 'true', 'desc' => '');
  $fields[] = array('title' => 'Heading 1 Font', 'id' => 'h1-font', 'value' => $def_heading_font, 'desc' => '', 'scope' => $font_options, 'no_prompt' => 'true', 'type' => 'select');
  $fields[] = array('title' => 'Heading 1 Font Size', 'id' => 'h1-font-size', 'value' => '2.4em', 'desc' => '', 'size' => '10', 'type' => 'text');
$fields[] = array('type' => 'group_end');

$fields[] = array('type' => 'group_start', 'title' => 'Heading 2', 'id' => 'h2', 'no_line_break' => 'true', 'desc' => '');
  $fields[] = array('title' => 'Heading 2 Font', 'id' => 'h2-font', 'value' => $def_heading_font, 'desc' => '', 'scope' => $font_options, 'no_prompt' => 'true', 'type' => 'select');
  $fields[] = array('title' => 'Heading 2 Font Size', 'id' => 'h2-font-size', 'value' => '1.8em', 'desc' => '', 'size' => '10', 'type' => 'text');
$fields[] = array('type' => 'group_end');

$fields[] = array('type' => 'group_start', 'title' => 'Heading 3', 'id' => 'h3', 'no_line_break' => 'true', 'desc' => '');
  $fields[] = array('title' => 'Heading 3 Font', 'id' => 'h3-font', 'value' => $def_heading_font, 'desc' => '', 'scope' => $font_options, 'no_prompt' => 'true', 'type' => 'select');
  $fields[] = array('title' => 'Heading 3 Font Size', 'id' => 'h3-font-size', 'value' => '1.4em', 'desc' => '', 'size' => '10', 'type' => 'text');
$fields[] = array('type' => 'group_end');

$fields[] = array('type' => 'group_start', 'title' => 'Heading 4', 'id' => 'h4', 'no_line_break' => 'true', 'desc' => '');
  $fields[] = array('title' => 'Heading 4 Font', 'id' => 'h4-font', 'value' => $def_heading_font, 'desc' => '', 'scope' => $font_options, 'no_prompt' => 'true', 'type' => 'select');
  $fields[] = array('title' => 'Heading 4 Font Size', 'id' => 'h4-font-size', 'value' => '1.2em', 'desc' => '', 'size' => '10', 'type' => 'text');
$fields[] = array('type' => 'group_end');

$fields[] = array('type' => 'group_start', 'title' => 'Heading 5', 'id' => 'h5', 'no_line_break' => 'true', 'desc' => '');
  $fields[] = array('title' => 'Heading 5 Font', 'id' => 'h5-font', 'value' => $def_text_font, 'desc' => '', 'scope' => $font_options, 'no_prompt' => 'true', 'type' => 'select');
  $fields[] = array('title' => 'Heading 5 Font Size', 'id' => 'h5-font-size', 'value' => '1.0em', 'desc' => '', 'size' => '10', 'type' => 'text');
$fields[] = array('type' => 'group_end');

$fields[] = array('type' => 'group_start', 'title' => 'Heading 6', 'id' => 'h6', 'no_line_break' => 'true', 'desc' => '');
  $fields[] = array('title' => 'Heading 6 Font', 'id' => 'h6-font', 'value' => $def_text_font, 'desc' => '', 'scope' => $font_options, 'no_prompt' => 'true', 'type' => 'select');
  $fields[] = array('title' => 'Heading 6 Font Size', 'id' => 'h6-font-size', 'value' => '0.8em', 'desc' => '', 'size' => '10', 'type' => 'text');
$fields[] = array('type' => 'group_end');

$fields[] = array('type' => 'table_end');







/* Header Bar
============================================================ */

$fields[] = array('title' => 'Header Bar', 'id' => 'header-bar', 'type' => 'table_start');

$fields[] = array('title' => 'Text Size', 'id' => 'header-bar-font-size', 'value' => '0.93em', 'desc' => '', 'size' => '10', 'type' => 'text');

$fields[] = array('type' => 'table_end');







/* Header
============================================================ */

$fields[] = array('title' => 'Header', 'id' => 'header', 'type' => 'table_start');

$fields[] = array('type' => 'group_start', 'title' => 'Main Navigation', 'id' => 'main-nav', 'no_line_break' => 'true', 'desc' => '');
  $fields[] = array('title' => 'Main Navigation Font', 'id' => 'nav-font', 'value' => $def_text_font, 'desc' => '', 'scope' => $font_options, 'no_prompt' => 'true', 'type' => 'select');
  $fields[] = array('title' => 'Main Navigation Font Size', 'id' => 'nav-font-size', 'value' => '1.0em', 'desc' => '', 'size' => '10', 'type' => 'text');
$fields[] = array('type' => 'group_end');

$fields[] = array('type' => 'group_start', 'title' => 'Drop Down Menu', 'id' => 'main-nav', 'no_line_break' => 'true', 'desc' => '');
  $fields[] = array('title' => 'Drop Down Menu Font', 'id' => 'sub-nav-font', 'value' => $def_text_font, 'desc' => '', 'scope' => $font_options, 'no_prompt' => 'true', 'type' => 'select');
  $fields[] = array('title' => 'Drop Down Menu Font Size', 'id' => 'sub-nav-font-size', 'value' => '1.0em', 'desc' => '', 'size' => '10', 'type' => 'text');
$fields[] = array('type' => 'group_end');

$fields[] = array('type' => 'table_end');







/* Sidebar
============================================================ */

$fields[] = array('title' => 'Sidebar', 'id' => 'sidebar', 'type' => 'table_start');

$fields[] = array('title' => 'Text Size', 'id' => 'sidebar-font-size', 'value' => '0.9em', 'desc' => '', 'size' => '10', 'type' => 'text');
$fields[] = array('title' => 'Heading Size', 'id' => 'sidebar-heading-font-size', 'value' => '1.0em', 'desc' => '', 'size' => '10', 'type' => 'text');

$fields[] = array('type' => 'table_end');







/* Footer
============================================================ */

$fields[] = array('title' => 'Footer Widget Area', 'id' => 'footer', 'type' => 'table_start');

$fields[] = array('title' => 'Text Size', 'id' => 'footer-font-size', 'value' => '0.9em', 'desc' => '', 'size' => '10', 'type' => 'text');
$fields[] = array('title' => 'Heading Size', 'id' => 'footer-heading-font-size', 'value' => '1.0em', 'desc' => '', 'size' => '10', 'type' => 'text');

$fields[] = array('type' => 'table_end');







/* Footer Bar
============================================================ */

$fields[] = array('title' => 'Footer Bar', 'id' => 'footer-bar', 'type' => 'table_start');

$fields[] = array('title' => 'Text Size', 'id' => 'footer-bar-font-size', 'value' => '0.9em', 'desc' => '', 'size' => '10', 'type' => 'text');

$fields[] = array('type' => 'table_end');






  
new option_page($page_data, $fields);
$fields = array();



?>