<?php



/* Option Page
============================================================ */

$page_data = array(
  'title'   => 'Social Links',
  'id'      => 'social-links',
  'submenu' => true,
  'documentation_url' => ADMIN_DOCUMENTATION_URL
);









/* Social URLs
============================================================ */

$fields[] = array('title' => 'Social URLs', 'id' => 'social-urls', 'type' => 'table_start');



/* Social Icons URLs
------------------------------------------------------------ */

$fields[] = array('type' => 'headline', 'title' => 'Social Icons URLs');

$fields[] = array(
  'title' => 'Info',
  'desc'  => 'Set the URL for your social profiles here. The URLs will be used in various locations to link to your profiles (e.g. widgets, shortcodes, footer bar).',
  'id'    => 'social-links-info',
  'type'  => 'html'
);

$field_id_suffixes = rvn_get_social_icons();

foreach($field_id_suffixes as $si_name => $si_id) {
  
  if    ($si_id == 'twitter')  $value = 'http://twitter.com/#!/_ruven';
  elseif($si_id == 'facebook') $value = 'http://www.facebook.com/pages/Ruven/115129975163761';
  elseif($si_id == 'google')   $value = 'https://plus.google.com/111592390543949169448/';
  else                         $value = '';
  
  $fields[] = array(
    'title' => $si_name,
    'desc'  => '',
    'id'    => 'social-link-'.$si_id,
    'value' => $value,
    'size'  => '70',
    'icon_url' => IMAGES_URL.'/social_icons/grey_16/'.$si_id.'.png',
    'type'  => 'social_icon_url'
  );
}



/* Table End
------------------------------------------------------------ */

$fields[] = array('type' => 'table_end');









  
new option_page($page_data, $fields);
$fields = array();



?>