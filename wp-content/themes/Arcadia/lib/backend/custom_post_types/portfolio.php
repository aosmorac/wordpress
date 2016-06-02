<?php



/* Setup Portfolio
============================================================ */

if(!function_exists('rvn_setup_portfolio'))
{
  function rvn_setup_portfolio() {
    $labels = array(
      'name'               => _x('Portfolio Items', 'post type name', 'ruventhemes'),
      'singular_name'      => _x('Portfolio Item', 'singular post type name', 'ruventhemes'),
      'add_new'            => _x('Add New', 'portfolio', 'ruventhemes'),
      'add_new_item'       => __('Add New Portfolio Item', 'ruventhemes'),
      'edit_item'          => __('Edit Portfolio Item', 'ruventhemes'),
      'new_item'           => __('New Portfolio Item', 'ruventhemes'),
      'view_item'          => __('View Portfolio Item', 'ruventhemes'),
      'search_items'       => __('Search Portfolio Items', 'ruventhemes'),
      'not_found'          => __('No Portfolio Items found', 'ruventhemes'),
      'not_found_in_trash' => __('No Portfolio Items found in Trash', 'ruventhemes'),
      'parent_item_colon'  => ''
    );
    
    $rewrite = array(
      'slug'       => rvn_get_option('portfolio-url-slug'),
      'with_front' => true
    );
    
    $args = array(
    	'labels'              => $labels,
    	'public'              => true,
    	'query_var'           => true,
    	'capability_type'     => 'post',
    	'show_in_nav_menus'   => false,
    	'exclude_from_search' => true,
      'rewrite'             => $rewrite,
    	'menu_position'       => 5,
    	'supports'            => array('title', 'thumbnail', 'excerpt', 'editor', 'comments')
    );
  	
    register_post_type('portfolio', $args);
    
    register_taxonomy(
      'portfolio_categories', 
    	'portfolio', 
    	array(
    	  'hierarchical'   => true, 
  			'label'          => __('Portfolio Categories', 'ruventhemes'),
  			'singular_label' => __('Portfolio Category', 'ruventhemes'), 
  			'rewrite'        => true,
  			'query_var'      => true
   	  )
   	);
   	
   	// Flush rewrite rules to get permalinks to work
   	flush_rewrite_rules();
  
  }
}



if(function_exists('rvn_setup_portfolio'))
{
  add_action('init', 'rvn_setup_portfolio');
}



?>