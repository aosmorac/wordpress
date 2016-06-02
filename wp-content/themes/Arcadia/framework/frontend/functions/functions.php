<?php



/* Add Body Class
------------------------------------------------------------ */

if(!function_exists('rvn_add_body_class'))
{
  function rvn_add_body_class($class) {
    global $rvn;
    $rvn['layout']['body-class'][] = $class;
  }
}



/* Get Archive Headline
------------------------------------------------------------ */

if(!function_exists('rvn_get_archive_headline'))
{
  function rvn_get_archive_headline() {
    $headline = "Blog Archives";
    if(is_category())  $headline = sprintf(__('Archive for %s', 'ruventhemes'), single_cat_title('', false));
    elseif(is_day())   $headline = sprintf(__('Archive for %s', 'ruventhemes'), get_the_time('F jS, Y'));
    elseif(is_month()) $headline = sprintf(__('Archive for %s', 'ruventhemes'), get_the_time('F, Y'));
    elseif(is_year())  $headline = sprintf(__('Archive for %s', 'ruventhemes'), get_the_time('Y'));
    elseif(is_tag())   $headline = sprintf(__('Archive for %s', 'ruventhemes'), single_tag_title('', false));
    elseif(is_author()) {
      $author   = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
      $headline = sprintf(__('Author Archive for %s', 'ruventhemes'), $author->nickname);
    }
    elseif(is_tax()) {
      $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
      $headline = sprintf(__('Archive for %s', 'ruventhemes'), $term->name);
    }

    return $headline;
  }
}



/* Get Body Class
------------------------------------------------------------ */

if(!function_exists('rvn_get_body_class'))
{
  function rvn_get_body_class() {
    global $rvn;
    return $rvn['layout']['body-class'];
  }
}



/* Get Option
------------------------------------------------------------ */

if(!function_exists('rvn_get_option'))
{
  function rvn_get_option($option_id, $default = false) {
    $value = get_option(OPTION_ID_PREFIX.$option_id, $default);

    // If we can't get a value because it's either empty or not in the database but a default value is given, we pick the default value
    if(!$value) {
      return $default;
    }

    // Checkbox values
    if    ($value == 'true')  $value = true;
    elseif($value == 'false') $value = false;

    return $value;
  }
}



/* Update Option
------------------------------------------------------------ */

if(!function_exists('rvn_update_option'))
{
  function rvn_update_option($option_id, $new_value) {
    return update_option(OPTION_ID_PREFIX.$option_id, $new_value);
  }
}



/* Get Original Post ID
------------------------------------------------------------ */

if(!function_exists('rvn_get_original_post_id'))
{
  function rvn_get_original_post_id() {
    global $rvn;
    $original_post = $rvn['data']['original-post'];

    if(isset($original_post) && is_object($original_post))
      return $original_post->ID;

    return 0;
  }
}



/* Get Post
------------------------------------------------------------ */

if(!function_exists('rvn_get_post'))
{
  // Takes no value, an ID or an object and returns post object
  function rvn_get_post($rvn_post = false) {
    // If no value is given, return the global post object
    if(!$rvn_post) {
      global $post;
      return $post;
    }
    else {
      // If object is already given, return it
      if    (is_object($rvn_post))  return $rvn_post;
      // If ID number is given, get post object from ID and return it
      elseif(is_numeric($rvn_post)) return get_post($rvn_post);
      // If nothing works, return false
      return false;
    }
  }
}



/* Get Post Class
------------------------------------------------------------ */

if(!function_exists('rvn_get_post_class'))
{
  function rvn_get_post_class($class = '', $post_id = null) {
    return 'class="'. join(' ', get_post_class($class, $post_id)).'"';
  }
}



/* Get Post Content
------------------------------------------------------------ */

if(!function_exists('rvn_get_post_content'))
{
  function rvn_get_post_content($rvn_post_id = 0) {
    $rvn_post_id = rvn_get_post_id($rvn_post_id);
    $rvn_post = rvn_get_post($rvn_post_id);
    $content  = apply_filters('the_content', $rvn_post->post_content);
    //$content  = str_replace( ']]>', ']]>', $content ); // Bug fix
    $content  = str_replace(']]>', ']]&gt;', $content);
    return $content;
  }
}



/* Get Post ID
------------------------------------------------------------ */

if(!function_exists('rvn_get_post_id'))
{
  // Takes no value, an ID or an object and returns post object ID
  function rvn_get_post_id($rvn_post_id = false) {
    // If no value is given, return the global post object ID
    if(!$rvn_post_id) {
      global $post;
      return $post->ID;
    }
    else {
      // If ID is given just return it
      if    (is_numeric($rvn_post_id)) return $rvn_post_id;
      // If object is given, return its ID
      elseif(is_object($rvn_post_id))  return $rvn_post_id->ID;
      // If nothing works, return false
      return false;
    }
  }
}



/* Get Post Meta
------------------------------------------------------------ */

if(!function_exists('rvn_get_post_meta'))
{
  function rvn_get_post_meta($post_id, $key, $default = false) {
    $value = get_post_meta($post_id, POST_META_ID_PREFIX.$key, true);

    // If we can't get a value because it's either empty or not in the database but a default value is given, we pick the default value
    if(!$value) {
      return $default;
    }

    // Checkbox values
    if    ($value == 'true')  $value = true;
    elseif($value == 'false') $value = false;

    return $value;
  }
}



/* Get Shortcode UnAutop
------------------------------------------------------------ */

if(!function_exists("rvn_get_shortcode_unautop"))
{
	function rvn_get_shortcode_unautop($content) {
		$content = do_shortcode(shortcode_unautop($content));
		$content = preg_replace('#^<\/p>|^<br\s?\/?>|<p>$|<p>\s*(&nbsp;)?\s*<\/p>#', '', $content);
		return $content;
	}
}



/* Is Plugin Active
------------------------------------------------------------ */

if(!function_exists('rvn_is_plugin_active'))
{
  function rvn_is_plugin_active($plugin) {
    return in_array($plugin, apply_filters('active_plugins', get_option('active_plugins')));
  }
}



/* Put Title
------------------------------------------------------------ */

if(!function_exists('rvn_put_title'))
{
  function rvn_put_title() {
    if(is_home()) {
  		bloginfo('name');
  	}
  	elseif(is_category() || is_archive()) {
  		printf(__('Archive for %s', 'ruventhemes'), wp_title(' ', false, ''));
  	}
  	elseif(is_search()) {
  		printf(__('Search Results for %s', 'ruventhemes'), get_search_query());
  	}
  	elseif(is_404()) {
  		echo '404 - '.__('Page not found', 'ruventhemes');
  	}
  	else {
  		bloginfo('name');
  		wp_title('-', true, '');
  	}
  }
}



/* Remove Body Class
------------------------------------------------------------ */

if(!function_exists('rvn_remove_body_class'))
{
  function rvn_remove_body_class($class) {
    global $rvn;
    unset($rvn['layout']['body-class'][$class]);
  }
}



/* Set Body Class
------------------------------------------------------------ */

if(!function_exists('rvn_set_body_class'))
{
  function rvn_set_body_class($option, $trigger = true, $class = false) {
    if(rvn_get_option($option) == $trigger) {
      if(!$class) $class = $option;
      rvn_add_body_class($class);
    }
  }
}



/* Set Fullwidth Page Size
------------------------------------------------------------ */

if(!function_exists('rvn_set_fullwidth_page_size'))
{
  function rvn_set_fullwidth_page_size() {
    global $rvn;

    rvn_add_body_class('fullwidth');
    $rvn['layout']['fullwidth'] = true;
  }
}

?>