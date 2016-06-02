<?php



/* Setup Featured Items
============================================================ */

if(!function_exists('rvn_setup_featured_items'))
{
  function rvn_setup_featured_items() {
    
    $labels = array(
      'name'               => _x('Featured Items', 'post type name', 'ruventhemes'),
      'singular_name'      => _x('Featured Item', 'singular post type name', 'ruventhemes'),
      'add_new'            => _x('Add New', 'slideshow', 'ruventhemes'),
      'add_new_item'       => __('Add New Featured Item', 'ruventhemes'),
      'edit_item'          => __('Edit Featured Item', 'ruventhemes'),
      'new_item'           => __('New Featured Item', 'ruventhemes'),
      'view_item'          => __('View Featured Item', 'ruventhemes'),
      'search_items'       => __('Search Featured Items', 'ruventhemes'),
      'not_found'          => __('No Featured Items Found', 'ruventhemes'),
      'not_found_in_trash' => __('No Featured Items Found in Trash', 'ruventhemes'),
      'parent_item_colon'  => ''
    );
    
  	$args = array(
    	'labels'              => $labels,
    	'public'              => true,
    	'query_var'           => true,
    	'capability_type'     => 'post',
    	'show_in_nav_menus'   => false,
    	'exclude_from_search' => true,
    	'rewrite'             => true,
    	'menu_position'       => 5,
    	'supports'            => array('title', 'thumbnail')
    );
    
  	register_post_type('featured_item', $args);
  }
}



if(function_exists('rvn_setup_featured_items'))
{
  add_action('init', 'rvn_setup_featured_items');
}
  


?>