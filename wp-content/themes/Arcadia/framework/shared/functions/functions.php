<?php



/* Get Post Slug
------------------------------------------------------------ */

if(!function_exists('rvn_get_post_slug'))
{
  function rvn_get_post_slug($rvn_post_id) {
    $rvn_post = get_post($rvn_post_id);
    if(is_object($rvn_post))
      return $rvn_post->post_name;
    return false;
  }
}



/* Get Slug
------------------------------------------------------------ */

if(!function_exists('rvn_get_slug'))
{
  function rvn_get_slug($str) {
  	$str = strtolower(trim($str));
  	$str = preg_replace('/[^a-z0-9-]/', '-', $str);
  	$str = preg_replace('/-+/', "-", $str);
  	$str = rtrim($str, '-');
  	return $str;
  }
}



?>