<?php

$feature_method = rvn_get_option('frontpage-feature-method');







/* Item Settings
============================================================ */

$box_data = array(
  'title'      => 'Item Settings', 
  'id'         => 'featured-settings-box',
  'post_types' => array('featured_item'),
  'context'    => 'normal',
  'priority'   => 'high',
  'callback'   => ''
);

if('piecemaker-slider' != $feature_method) {
  $fields[] = array(
    'title' => 'Description Text',
    'desc'  => '',
    'id'    => 'featured-item-desc',
    'value' => '',
    'size'  => '3',
    'type'  => 'textarea'
  );
}

$fields[] = array(
  'title' => 'Featured Item Link',
	'desc'  => '',
	'id'    => 'featured-item-link',
	'value' => '',
	'size'  => '50',
	'type'  => 'select_link'
);

new meta_box($box_data, $fields);
$fields = array();







/* Cycle Slider (Full Width)
============================================================ */

if('cycle-slider' == $feature_method)
{
  $box_data = array(
    'title'      => 'Cycle Slider (Full Width)', 
    'id'         => 'cycle-slider-box',
    'post_types' => array('featured_item'),
    'context'    => 'normal',
    'priority'   => 'high',
    'callback'   => ''
  );

  $options = array(
    'No Caption'        => 'no-caption',
    'Top Left'          => 'top-left',
    'Top Right'         => 'top-right',
    'Bottom Left'       => 'bottom-left',
    'Bottom Right'      => 'bottom-right',
    'Left Full Height'  => 'left-full-height',
    'Right Full Height' => 'right-full-height',
    'Top Full Width'    => 'top-full-width',
    'Bottom Full Width' => 'bottom-full-width',
    'Centered Top Full Width'    => 'centered-top-full-width',
    'Centered Bottom Full Width' => 'centered-bottom-full-width'
  );
  $fields[] = array(
    'title'     => 'Caption Position',
    'desc'      => '',
    'id'        => 'cycle-slider-caption-pos',
    'value'     => 'bottom-left',
    'scope'     => $options,
    'no_prompt' => 'true',
    'type'      => 'select'
  );
  
  if(rvn_get_option('cycle-slider-show-item-desc') && rvn_get_option('cycle-slider-show-read-more-link'))
  {
    $fields[] = array(
      'title'     => '"Read More" Link',
      'desc'      => 'You can change the text of the "Read more" link under the description text. Write "none" if you don\'t want the link to appear.',
      'id'        => 'cycle-slider-read-more-link-text',
      'value'     => 'Read more',
      'size'      => '25',
      'type'      => 'text'
    );
  }
  
  new meta_box($box_data, $fields);
  $fields = array();
}







/* Cycle Slider (Two-Third)
============================================================ */

if('cycle-alt-slider' == $feature_method)
{
  $box_data = array(
    'title'      => 'Cycle Slider (Two-Third)', 
    'id'         => 'cycle-alt-slider-box',
    'post_types' => array('featured_item'),
    'context'    => 'normal',
    'priority'   => 'high',
    'callback'   => ''
  );
  
  $options = array(
    'Left'  => 'left',
    'Right' => 'right'
  );
  $fields[] = array(
    'title'     => 'Description Position',
    'desc'      => '',
    'id'        => 'cycle-alt-slider-desc-pos',
    'value'     => 'right',
    'options'   => $options,
    'type'      => 'radio'
  );
  
  if(rvn_get_option('cycle-slider-show-read-more-link'))
  {
    $fields[] = array(
      'title'     => '"Read More" Link',
      'desc'      => 'You can change the text of the "Read more" link under the description text. Write "none" if you don\'t want the link to appear.',
      'id'        => 'cycle-alt-slider-read-more-link-text',
      'value'     => 'Read more',
      'size'      => '25',
      'type'      => 'text'
    );
  }
  
  new meta_box($box_data, $fields);
  $fields = array();
}







/* Image (Full Width)
============================================================ */

if('featured-image' == $feature_method)
{
  $box_data = array(
    'title'      => 'Image (Full Width)', 
    'id'         => 'featured-image-box',
    'post_types' => array('featured_item'),
    'context'    => 'normal',
    'priority'   => 'high',
    'callback'   => ''
  );

  $options = array(
    'No Caption'        => 'no-caption',
    'Top Left'          => 'top-left',
    'Top Right'         => 'top-right',
    'Bottom Left'       => 'bottom-left',
    'Bottom Right'      => 'bottom-right',
    'Left Full Height'  => 'left-full-height',
    'Right Full Height' => 'right-full-height',
    'Top Full Width'    => 'top-full-width',
    'Bottom Full Width' => 'bottom-full-width',
    'Centered Top Full Width'    => 'centered-top-full-width',
    'Centered Bottom Full Width' => 'centered-bottom-full-width'
  );
  $fields[] = array(
    'title'     => 'Caption Position',
    'desc'      => '',
    'id'        => 'featured-image-caption-pos',
    'value'     => 'bottom-left',
    'scope'     => $options,
    'no_prompt' => 'true',
    'type'      => 'select'
  );
  
  if(rvn_get_option('featured-image-show-item-desc') && rvn_get_option('featured-image-show-read-more-link'))
  {
    $fields[] = array(
      'title'     => '"Read More" Link',
      'desc'      => 'You can change the text of the "Read more" link under the description text. Write "none" if you don\'t want the link to appear.',
      'id'        => 'featured-image-read-more-link-text',
      'value'     => 'Read more',
      'size'      => '25',
      'type'      => 'text'
    );
  }
  
  new meta_box($box_data, $fields);
  $fields = array();
}







/* Image (Two-Third)
============================================================ */

if('featured-image-alt' == $feature_method)
{
  $box_data = array(
    'title'      => 'Image (Two-Third)', 
    'id'         => 'featured-image-alt-box',
    'post_types' => array('featured_item'),
    'context'    => 'normal',
    'priority'   => 'high',
    'callback'   => ''
  );
  
  $options = array(
    'Left'  => 'left',
    'Right' => 'right'
  );
  $fields[] = array(
    'title'     => 'Description Position',
    'desc'      => '',
    'id'        => 'featured-image-alt-desc-pos',
    'value'     => 'right',
    'options'   => $options,
    'type'      => 'radio'
  );
  
  if(rvn_get_option('featured-image-alt-show-read-more-link'))
  {
    $fields[] = array(
      'title'     => '"Read More" Link',
      'desc'      => 'You can change the text of the "Read more" link under the description text. Write "none" if you don\'t want the link to appear.',
      'id'        => 'featured-image-alt-read-more-link-text',
      'value'     => 'Read more',
      'size'      => '25',
      'type'      => 'text'
    );
  }
  
  new meta_box($box_data, $fields);
  $fields = array();
}



?>