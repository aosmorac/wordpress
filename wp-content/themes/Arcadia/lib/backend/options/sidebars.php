<?php



/* Option Page
============================================================ */


$page_data = array(
  'title'   => 'Sidebars',
  'id'      => 'sidebars',
  'submenu' => true,
  'documentation_url' => ADMIN_DOCUMENTATION_URL
);







/* Table Start
------------------------------------------------------------ */

$fields[] = array('title' => 'Custom Sidebar Creator', 'id' => 'custom-sidebar-creator', 'type' => 'table_start');



/* Text
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Sidebars',
  'desc'  => 'Add a custom sidebar, fill it with <a href="'.admin_url().'widgets.php">widgets</a> and then assign the sidebar to your pages and posts.',
  'id'    => 'custom-sidebars',
  'value' => '',
  'size'  => '30',
  'label' => 'Add Sidebar »',
  'type'  => 'items'
);



/* Table End
------------------------------------------------------------ */

$fields[] = array('type' => 'table_end');






  
new option_page($page_data, $fields);
$fields = array();



?>