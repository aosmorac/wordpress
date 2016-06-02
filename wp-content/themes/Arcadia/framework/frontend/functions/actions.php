<?php



/* Put Tracking IDs
------------------------------------------------------------ */

if(!function_exists('rvn_put_tracking_ids'))
{
  function rvn_put_tracking_ids() {
    // Theme ID
    $theme_id = ID_PREFIX.THEME_ID.'_theme';
    // Theme Version ID
    $theme_version_id = $theme_id.'_tv_'.str_replace('.', '_', THEME_VERSION);
    // Framework Version ID
    $fw_version_id = $theme_id.'_fwv_'.str_replace('.', '_', FW_VERSION);
    
    echo '<div style="display: none;"><p>';
    echo $theme_id.' '.$theme_version_id.' '.$fw_version_id;
    echo '</p></div>';
  }
}

if(function_exists('rvn_put_tracking_ids'))
{
  add_action('wp_footer', 'rvn_put_tracking_ids');
}



/* Set Original Post
------------------------------------------------------------ */

if(!function_exists('rvn_set_original_post'))
{
  function rvn_set_original_post() {
    global $rvn;
    global $post;
    
    $rvn['data']['original-post'] = $post;
  }
}

if(function_exists('rvn_set_original_post'))
{
  add_action('wp', 'rvn_set_original_post');
}



?>