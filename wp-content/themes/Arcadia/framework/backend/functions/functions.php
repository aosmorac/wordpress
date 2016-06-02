<?php



/* Get Multitable Data
------------------------------------------------------------ */

if(!function_exists('rvn_get_multitable_data'))
{
  function rvn_get_multitable_data($data) {
    $pages    = array();
    $settings = array();
    $pages_array = array_filter(explode('$$$', $data));
    
    foreach($pages_array as $key => $value) {
      $page_settings_pairs_array = explode('&', $value);
      
      foreach($page_settings_pairs_array as $key => $value) {
        $value = str_replace('&', '', $value);
        $page_settings_array = explode('=', $value);
        if(!empty($page_settings_array[0])) {
          $value = $page_settings_array[1];
          
          // Checkbox string values
          if    ($value == 'true')  $value = true;
          elseif($value == 'false') $value = false;
          $settings[$page_settings_array[0]] = $value;
        }
        
      }
      
      $pages[] = $settings;
    }
    
    return $pages;
  }
}



/* Remove Tags
------------------------------------------------------------ */

if(!function_exists('rvn_remove_tags'))
{
  function rvn_remove_tags($str, $tags) {
    foreach($tags as $tag)
    	$str = preg_replace('#^<\/'.$tag.'>|<'.$tag.'>$#', '', trim($str));
    
    return $str;
  }
}



?>