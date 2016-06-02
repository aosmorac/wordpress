<?php







/* Featured Content Replacement
============================================================ */

$box_data = array(
  'title'      => 'Featured Content Replacement', 
  'id'         => 'featured-content-replacement-box',
  'post_types' => array('page', 'post', 'portfolio'),
  'context'    => 'normal',
  'priority'   => 'core',
  'callback'   => ''
);



/* Group Start
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Overview',
  'desc'  => 'Overwrite the featured image for every overview page (e.g. Blog). Insert a link to an image or video embedding code. Write <i>none</i> if you don\'t want any featured content to occur on overview pages.',
  'id'    => 'featured-content-overview-replacent-group',
  'type'  => 'group_start'
);



    /* Overview
    ------------------------------------------------------------ */
    
    $fields[] = array(
      'title' => 'Overview',
    	'desc'  => '',
    	'id'    => 'featured-content-overview-replacent',
    	'value' => '',
    	'size'  => '42',
    	'label' => 'Set Content',
    	'type'  => 'media_link'
    );
    
    
    
    /* Overview Resize Method
    ------------------------------------------------------------ */
    
    $options = array(
      'Inherit Size from Image Options' => 'inherit',
      'Crop'            => 'crop',
      'Adaptive height' => 'adaptive-height',
      'Don\'t resize'   => 'no-resize'
    );
    $fields[] = array(
      'title' => 'Overview Resize Method',
      'desc'  => '',
      'id'    => 'featured-content-overview-replacent-resize-method',
      'value' => 'inherit',
    	'scope' => $options,
    	'no_prompt' => 'true',
    	'type'      => 'select'
    );



/* Group End
------------------------------------------------------------ */

$fields[] = array('type' => 'group_end');



/* Group Start
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Entry',
  'desc'  => 'Overwrite the featured image for this page. Insert a link to an image or video embedding code. Write <i>none</i> if you don\'t want any featured content to occur on this page.',
  'id'    => 'featured-content-entry-replacent-group',
  'type'  => 'group_start'
);



    /* Entry
    ------------------------------------------------------------ */
    
    $fields[] = array(
      'title' => 'Entry',
    	'desc'  => '',
    	'id'    => 'featured-content-entry-replacent',
    	'value' => '',
    	'size'  => '42',
    	'label' => 'Set Content',
    	'type'  => 'media_link'
    );
    
    
    
    /* Overview Resize Method
    ------------------------------------------------------------ */
    
    $options = array(
      'Inherit Size from Image Options' => 'inherit',
      'Crop'            => 'crop',
      'Adaptive height' => 'adaptive-height',
      'Don\'t resize'   => 'no-resize'
    );
    $fields[] = array(
      'title' => 'Entry Resize Method',
      'desc'  => '',
      'id'    => 'featured-content-entry-replacent-resize-method',
      'value' => 'inherit',
    	'scope' => $options,
    	'no_prompt' => 'true',
    	'type'      => 'select'
    );



/* Group End
------------------------------------------------------------ */

$fields[] = array('type' => 'group_end');



/* Lightbox
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Lightbox',
	'desc'  => 'Overwrite the lightbox content. Link to an image or video.',
	'id'    => 'featured-content-lightbox-replacent',
	'value' => '',
	'size'  => '42',
	'label' => 'Set Content',
	'type'  => 'media_link'
);


new meta_box($box_data, $fields);
$fields = array();






  
/* Template Options
============================================================ */

$box_data = array(
  'title'      => 'Template Options', 
  'id'         => 'template-options-box',
  'post_types' => array('page', 'post'),
  'context'    => 'side',
  'priority'   => 'low',
  'callback'   => ''
);



/* Page Content Size
------------------------------------------------------------ */

$options = array(
  'Two Third (with Sidebar)'     => 'two-third',
  'Full Width (without Sidebar)' => 'full'
);
$page_content_size_field = array(
  'title'   => 'Page Content Size',
	'desc'    => '',
	'id'      => 'page-content-size',
	'value'   => 'two-third',
	'options' => $options,
	'type'    => 'radio'
);



/* Sidebar Position
------------------------------------------------------------ */

$options = array(
  'Inherit from Layout Options' => 'inherit',
  'Left'  => 'left',
  'Right' => 'right'
);
$sidebar_position_field = array(
  'title'   => 'Sidebar Position',
	'desc'    => '',
	'id'      => 'sidebar-position',
	'value'   => 'inherit',
	'options' => $options,
	'type'    => 'radio'
);



/* Sidebar
------------------------------------------------------------ */

$custom_sidebars = explode('::', rvn_get_option('custom-sidebars'));
$options = array('Default' => '');   
foreach($custom_sidebars as $sidebar_title) {
  if($sidebar_title) {
    $sidebar_slug = rvn_get_slug($sidebar_title);
    $options[$sidebar_title] = $sidebar_slug;
  }
}
$sidebar_content_field = array(
  'title'   => 'Sidebar',
	'desc'    => 'Which Sidebar do you want to assign to this page?',
	'id'      => 'sidebar',
	'value'   => '',
	'scope'   => $options,
	'no_prompt' => 'true',
	'type'      => 'select'
);


$fields[] = $page_content_size_field;
$fields[] = $sidebar_position_field;
$fields[] = $sidebar_content_field;


new meta_box($box_data, $fields);
$fields = array();






  
/* Portfolio Options
============================================================ */

$box_data = array(
  'title'      => 'Template Options', 
  'id'         => 'template-options-box',
  'post_types' => array('portfolio'),
  'context'    => 'side',
  'priority'   => 'low',
  'callback'   => ''
);



$fields[] = $page_content_size_field;
$fields[] = $sidebar_position_field;
$fields[] = $sidebar_content_field;



/* Link to External Website
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Link to External Website',
  'desc'  => 'If you want this portfolio item to link to an external page from the overview, enter the URL here and visitors will be redirected.',
	'id'    => 'portfolio-external-link',
	'value' => '',
	'size'  => '30',
	'type'  => 'text'
);


new meta_box($box_data, $fields);
$fields = array();



?>