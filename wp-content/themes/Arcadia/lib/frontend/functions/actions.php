<?php



/* Add Body Classes
------------------------------------------------------------ */

if(!function_exists('rvn_add_body_classes'))
{
  function rvn_add_body_classes() {
    // Featured Content
    if(is_front_page()) {
      if(rvn_get_option('frontpage-feature-method')) {
        rvn_add_body_class('with-featured-content');
      }
    }
    
  }
}

if(function_exists('rvn_add_body_classes'))
{
  if(!is_admin()) {
    add_action('wp', 'rvn_add_body_classes');
  }
}



/* Register Scripts and Styles
------------------------------------------------------------ */

if(!function_exists('rvn_register_scripts_and_styles'))
{
  function rvn_register_scripts_and_styles() {
    
    // jQuery & Custom Functions
    //wp_register_script('rvn_jquery', JAVASCRIPTS_URL.'/jquery.js', false, THEME_VERSION);
    wp_register_script('rvn_script', JAVASCRIPTS_URL.'/script.js', array('jquery'), THEME_VERSION);
    
    // Contact Form
    wp_register_script('rvn_validate', JAVASCRIPTS_URL.'/jquery.validate.pack.js', array('jquery'), THEME_VERSION, true);
    wp_register_script('rvn_form', JAVASCRIPTS_URL.'/jquery.form.js', array('jquery', 'rvn_validate'), THEME_VERSION, true);
    
    // prettyPhoto
    wp_register_script('rvn_prettyphoto', PLUGINS_URL.'/prettyphoto/js/jquery.prettyPhoto.js', array('jquery'), THEME_VERSION, true);
    wp_register_style('rvn_prettyphoto', PLUGINS_URL.'/prettyphoto/css/prettyPhoto.css', false, THEME_VERSION, 'all');
    
    // Nivo Slider
    wp_register_script('rvn_nivo_slider', PLUGINS_URL.'/nivo-slider/jquery.nivo.slider.pack.js', array('jquery'), THEME_VERSION);
    wp_register_style('rvn_nivo_slider', PLUGINS_URL.'/nivo-slider/nivo-slider.css', false, THEME_VERSION, 'all');
    
    // Cycle Slider
    wp_register_script('rvn_cycle_slider', PLUGINS_URL.'/cycle_slider/jquery.cycle.js', array('jquery'), THEME_VERSION);
  }
}

if(!is_admin() && function_exists('rvn_register_scripts_and_styles'))
{
  add_action('init', 'rvn_register_scripts_and_styles');
}



/* Enqueue Scripts and Styles
------------------------------------------------------------ */

if(!function_exists('rvn_enqueue_scripts_and_styles'))
{
  function rvn_enqueue_scripts_and_styles() {
    
    // jQuery & Custom Functions
    //wp_enqueue_script('rvn_jquery');
    //wp_enqueue_script('jquery');
    wp_enqueue_script('rvn_script');
    
    // prettyPhoto
    wp_enqueue_script('rvn_prettyphoto');
    wp_enqueue_style('rvn_prettyphoto');
    
    // Contact Form
    wp_enqueue_script('rvn_validate');
    wp_enqueue_script('rvn_form');
  }
}

if(!is_admin() && function_exists('rvn_enqueue_scripts_and_styles'))
{
  add_action('init', 'rvn_enqueue_scripts_and_styles');
}



/* Enqueue Nivo Slider Scripts and Styles
------------------------------------------------------------ */

if(!function_exists('rvn_enqueue_nivo_slider_scripts_and_styles'))
{
  function rvn_enqueue_nivo_slider_scripts_and_styles() {
    wp_enqueue_script('rvn_nivo_slider');
    wp_enqueue_style('rvn_nivo_slider');
  }
}

if(!is_admin() && function_exists('rvn_enqueue_nivo_slider_scripts_and_styles'))
{
  if('nivo-slider' == rvn_get_option('frontpage-feature-method')) {
    add_action('init', 'rvn_enqueue_nivo_slider_scripts_and_styles');
  }
}



/* Enqueue Cycle Slider Scripts and Styles
------------------------------------------------------------ */

if(!function_exists('rvn_enqueue_cycle_slider_script'))
{
  function rvn_enqueue_cycle_slider_script() {
    wp_enqueue_script('rvn_cycle_slider');
  }
}

if(!is_admin() && function_exists('rvn_enqueue_cycle_slider_script'))
{
  if('cycle-slider' == rvn_get_option('frontpage-feature-method') ||
     'cycle-alt-slider' == rvn_get_option('frontpage-feature-method')) {
    add_action('init', 'rvn_enqueue_cycle_slider_script');
  }
}



/* Add Header Code
------------------------------------------------------------ */

if(!function_exists('rvn_put_header_code'))
{
  function rvn_put_header_code() {
    // RSS and Trackbacks 
    echo '<link href="'.get_bloginfo('rss2_url').'" rel="alternate" type="application/rss+xml" title="RSS 2.0" />';
    echo '<link href="'.get_bloginfo('pingback_url').'" rel="pingback" />';
    
    // Favicon
    $favicon = rvn_get_option('favicon', IMAGES_URL.'/dummy/favicon.jpg');
    echo '<link rel="shortcut icon" href="'.$favicon.'" />';
    
    // IE Fixes
    echo '<!--[if lte IE 8]>';
    echo   '<script src="'.JAVASCRIPTS_URL.'/ie.html5.js"></script>';
    echo '<![endif]-->';
    
    // Custom CSS Code
    echo '<style type="text/css" media="all">';
    echo rvn_get_option('custom-css-code');
    echo '</style>';
    
    // Header Code
    echo rvn_get_option('header-code');
  }
}

if(function_exists('rvn_put_header_code'))
{
  if(!is_admin()) {
    add_action('wp_head', 'rvn_put_header_code');
  }
}



/* Add Footer Code
------------------------------------------------------------ */

if(!function_exists('rvn_put_footer_code'))
{
  function rvn_put_footer_code() {
    echo rvn_get_option('footer-code');
  }
}

if(function_exists('rvn_put_footer_code'))
{
  if(!is_admin()) {
    add_action('wp_footer', 'rvn_put_footer_code');
  }
}



/* Set Page Content Size
------------------------------------------------------------ */

if(!function_exists('rvn_set_page_options'))
{
  function rvn_set_page_options() {
    // Initialize Variables
    global $post;
    $post_id = (is_object($post)) ? $post->ID : false;
    
    // If we are on the front page which includes another pages content
    $frontpage_content_id = rvn_get_option('frontpage-content');
    if($frontpage_content_id && is_front_page()) {
      $post_id = $frontpage_content_id;
      $post = get_post($post_id);
    }
    
    // If we are in an archive and the user wants to display it in blog style
    if(is_archive() && 'blog' == rvn_get_option('archive-layout')) {
      $post_id = (int)rvn_get_option('blog-page');
      $post = get_post($post_id);
    }
    
    $page_content_size = ($post_id) ? rvn_get_post_meta($post_id, 'page-content-size') : false;
    $sidebar_position  = ($post_id) ? rvn_get_post_meta($post_id, 'sidebar-position')  : false;
    
    // Page Content Size
    if($page_content_size == 'full') {
      rvn_set_fullwidth_page_size();
    }
    else {
      rvn_add_body_class('not-fullwidth');
    }
    
    // Sidebar Position
    if($sidebar_position && $sidebar_position != 'inherit') {
      rvn_add_body_class('sidebar-'.$sidebar_position);
    }
    else {
      rvn_set_body_class('sidebar-position', 'left',  'sidebar-left');
      rvn_set_body_class('sidebar-position', 'right', 'sidebar-right');
    }
  }
}

if(function_exists('rvn_set_page_options') && !is_front_page())
{
  add_action('wp', 'rvn_set_page_options');
}



?>