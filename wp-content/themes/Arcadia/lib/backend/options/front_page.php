<?php



/* Front Page
============================================================ */

$page_data = array(
  'title'   => 'Front Page',
  'id'      => 'front-page',
  'submenu' => true,
  'documentation_url' => ADMIN_DOCUMENTATION_URL
);










/* Content
============================================================ */

$fields[] = array('title' => 'Content', 'id' => 'content', 'type' => 'table_start');



/* Info
------------------------------------------------------------ */
/*
$fields[] = array(
  'title' => 'Select Content Page',
  'desc'  => 'Select which page to display as your front page go to <a href="'.admin_url().'options-reading.php">Settings / Reading</a>. By default the blog will be displayed.',
  'id'    => 'frontpage-content-info',
  'type'  => 'html'
);
*/



/* Info
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Select Content Page',
  'desc'  => 'The content of the selected page will be displayed below your slider/featured item.',
  'id'    => 'frontpage-content',
  'value' => '',
  'scope' => 'page',
  'type'  => 'select'
);



/* Table End
------------------------------------------------------------ */

$fields[] = array('type'  => 'table_end');










/* Slider / Feature
============================================================ */

$fields[] = array('title' => 'Slider / Feature', 'id' => 'slider-or-feature', 'type' => 'table_start');



/* Slider / Feature Method
------------------------------------------------------------ */

$options = array(
  'None'    => '',
  'Sliders' => array('Nivo Slider'       => 'nivo-slider',
                     'Cycle Slider'      => 'cycle-slider'/*,
                     'Cycle Slider (Two-Third)'       => 'cycle-alt-slider',
                     'Piecemaker Slider' => 'piecemaker-slider'*/),
  'Static Content' => array('Image' => 'featured-image',
                            //'Image (Two-Third)'  => 'featured-image-alt',
                            'Video' => 'featured-video'/*,
                            'Video (Two-Third)'  => 'featured-video-alt'*/)
);
$fields[] = array(
  'title'     => 'Method',
  'desc'      => 'Select which slider or feature method you want to display your featured items.',
  'id'        => 'frontpage-feature-method',
  'value'     => 'nivo-slider',
  'scope'     => $options,
  'no_prompt' => 'true',
  'type'      => 'select',
  'show'      => array('nivo-slider'        => 'nivo-slider-option-table',
                       'cycle-slider'       => 'cycle-slider-option-table',
                       'cycle-alt-slider'   => 'cycle-alt-slider-option-table',
                       'piecemaker-slider'  => 'piecemaker-slider-option-table',
                       'featured-image'     => 'featured-image-option-table',
                       'featured-image-alt' => 'featured-image-alt-option-table',
                       'featured-video'     => 'featured-video-option-table',
                       'featured-video-alt' => 'featured-video-alt-option-table')
);


/* Table End
------------------------------------------------------------ */

$fields[] = array('type'  => 'table_end');










/* Nivo Slider
============================================================ */

$fields[] = array('title' => 'Nivo Slider', 'id' => 'nivo-slider', 'type' => 'table_start');



/* Description
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Description',
	'desc'  => 'Nivo Slider is a jQuery slider that can display images with a whole bunch of awesome transition effects. It also has direction navigation arrows that lay over the image. Description captions can only be displayed on the bottom of the image.',
	'id'    => 'nivo-slider-info',
	'type'  => 'html'
);



/* Slider Height
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Slider Height (in Pixel)',
  'desc'  => '',
  'id'    => 'nivo-slider-img-height',
  'value' => '408',
  'size'  => '3',
  'type'  => 'text'
);



/* Max. Entries
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Max. Entries',
  'desc'  => '',
  'id'    => 'nivo-slider-max-entries',
  'value' => '7',
  'size'  => '3',
  'type'  => 'text'
);
  
  
  
/* Auto Play
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Auto Play',
  'desc'  => '',
  'id'    => 'nivo-slider-auto-play',
  'value' => 'true',
  'label' => 'Start slideshow automatically',
  'type'  => 'checkbox'
);



/* Transition Effect
------------------------------------------------------------ */

$options = array(
  'Random'                => 'random',
  'Fade'                  => 'fade',
  'Fold'                  => 'fold',
  'Slice Down'            => 'sliceDown',
  'Slice Down Left'       => 'sliceDownLeft',
  'Slice Up'              => 'sliceUp',
  'Slice Up Left'         => 'sliceUpLeft',
  'Slice Up Down'         => 'sliceUpDown',
  'Slice Up Down Left'    => 'sliceUpDownLeft',
  'Slide In Right'        => 'slideInRight',
  'Slide In Left'         => 'slideInLeft',
  'Box Random'            => 'boxRandom',
  'Box Rain'              => 'boxRain',
  'Box Rain Reverse'      => 'boxRainReverse',
  'Box Rain Grow'         => 'boxRainGrow',
  'Box Rain Grow Reverse' => 'boxRainGrowReverse'

);
$fields[] = array(
  'title'     => 'Transition Effect',
  'desc'      => '',
  'id'        => 'nivo-slider-transition-effect',
  'value'     => 'random',
  'no_prompt' => 'true',
	'scope'     => $options,
  'type'      => 'select'
);



/* Transition Speed
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Transition Speed (in Seconds)',
  'desc'  => '',
  'id'    => 'nivo-slider-transition-speed',
  'value' => '0.8',
  'size'  => '3',
  'type'  => 'text'
);



/* Pause Time
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Pause Time (in Seconds)',
  'desc'  => '',
  'id'    => 'nivo-slider-pause-time',
  'value' => '3',
  'size'  => '3',
  'type'  => 'text'
);



/* Slices
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Slices',
  'desc'  => 'Number of slices for slice animations',
  'id'    => 'nivo-slider-slices',
  'value' => '15',
  'size'  => '3',
  'type'  => 'text'
);



/* Box Columns
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Box Columns',
  'desc'  => 'Number of box columns for box animations',
  'id'    => 'nivo-slider-box-columns',
  'value' => '8',
  'size'  => '3',
  'type'  => 'text'
);



/* Box Rows
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Box Rows',
  'desc'  => 'Number of box rows for box animations',
  'id'    => 'nivo-slider-box-rows',
  'value' => '4',
  'size'  => '3',
  'type'  => 'text'
);



/* Caption
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Caption',
  'desc'  => '',
  'id'    => 'nivo-slider-show-item-desc',
  'value' => 'true',
  'label' => 'Show item description',
  'type'  => 'checkbox'
);



/* Direction Navigation
------------------------------------------------------------ */

$fields[] = array(
  'type'          => 'group_start',
  'title'         => 'Direction Navigation',
  'id'            => 'nivo-slider-direction-navigation',
  'desc'          => ''
);



    /* Show Direction Navigation
    ------------------------------------------------------------ */
    
    $fields[] = array(
      'title' => 'Show Direction Navigation',
      'desc'  => '',
      'id'    => 'nivo-slider-show-direction-nav',
      'value' => 'true',
      'label' => 'Show Direction Navigation',
      'type'  => 'checkbox',
      'show'  => array('nivo-slider-hide-direction-nav-wrapper')
    );
  
  
  
    /* Only Show Direction Navigation on Hover
    ------------------------------------------------------------ */
    
    $fields[] = array(
      'title' => 'Only Show Direction Navigation on Hover',
      'desc'  => '',
      'id'    => 'nivo-slider-hide-direction-nav',
      'value' => 'true',
      'label' => 'Only Show Direction Navigation on Hover',
      'type'  => 'checkbox'
    );



/* Group End
------------------------------------------------------------ */

$fields[] = array('type' => 'group_end');
  
  
  
/* Show Bullet Navigation
------------------------------------------------------------ */
/*
$fields[] = array(
  'title' => 'Bullet Navigation',
  'desc'  => '',
  'id'    => 'nivo-slider-show-bullet-nav',
  'value' => 'false',
  'label' => 'Show Bullet Navigation',
  'type'  => 'checkbox'
);
*/



/* Table End
------------------------------------------------------------ */

$fields[] = array('type'  => 'table_end');










/* Cycle Slider
============================================================ */

$fields[] = array('title' => 'Cycle Slider', 'id' => 'cycle-slider', 'type' => 'table_start');



/* Description
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Description',
	'desc'  => 'Cycle Slider is a jQuery slider that is able to display your images with captions that can lay over the image in every position you want. You can also set more than one transition effect and display a bullet navigation.',
	'id'    => 'cycle-slider-info',
	'type'  => 'html'
);



/* Slider Height
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Slider Height (in Pixel)',
  'desc'  => '',
  'id'    => 'cycle-slider-img-height',
  'value' => '408',
  'size'  => '3',
  'type'  => 'text'
);



/* Max. Entries
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Max. Entries',
  'desc'  => '',
  'id'    => 'cycle-slider-max-entries',
  'value' => '7',
  'size'  => '3',
  'type'  => 'text'
);



/* Auto Play
------------------------------------------------------------ */

$fields[] = array(
  'type'          => 'group_start',
  'title'         => 'Auto Play',
  'id'            => 'cycle-slider-auto-play',
  'desc'          => ''
);
  
  
  
    /* Auto Play
    ------------------------------------------------------------ */
    
    $fields[] = array(
      'title' => 'Auto Play',
      'desc'  => '',
      'id'    => 'cycle-slider-auto-play',
      'value' => 'true',
      'label' => 'Start slideshow automatically',
      'type'  => 'checkbox',
      'show'  => array('cycle-slider-pause-on-hover-wrapper')
    );
      
      
      
    /* Pause on Hover
    ------------------------------------------------------------ */
    
    $fields[] = array(
      'title' => 'Pause on Hover',
      'desc'  => '',
      'id'    => 'cycle-slider-pause-on-hover',
      'value' => 'true',
      'label' => 'Stop slideshow on hover',
      'type'  => 'checkbox'
    );



/* Group End
------------------------------------------------------------ */

$fields[] = array('type' => 'group_end');



/* Transition Effect
------------------------------------------------------------ */

$options = array(
  'Fade'         => 'fade',
  'Toss'         => 'toss',
  'Uncover'      => 'uncover',
  'Scroll Up'    => 'scrollUp',
  'Scroll Down'  => 'scrollDown',
  'Scroll Left'  => 'scrollLeft',
  'Scroll Right' => 'scrollRight',
);
$fields[] = array(
  'title'     => 'Transition Effect',
  'desc'      => 'You can select more than one transition effect. They will be invoked the the chosen order.',
  'id'        => 'cycle-slider-transition-effects',
  'value'     => 'fade',
  'max'       => 'inf',
  'type'      => 'multiselect',
  'scope'     => $options
);



/* Transition Speed
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Transition Speed (in Seconds)',
  'desc'  => '',
  'id'    => 'cycle-slider-transition-speed',
  'value' => '1.0',
  'size'  => '3',
  'type'  => 'text'
);



/* Pause Time
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Pause Time (in Seconds)',
  'desc'  => '',
  'id'    => 'cycle-slider-pause-time',
  'value' => '3.0',
  'size'  => '3',
  'type'  => 'text'
);



/* Caption
------------------------------------------------------------ */

$fields[] = array(
  'type'          => 'group_start',
  'title'         => 'Caption',
  'id'            => 'cycle-slider-caption',
  'desc'          => ''
);



    /* Item Title
    ------------------------------------------------------------ */
    
    $fields[] = array(
      'title' => 'Item Title',
      'desc'  => '',
      'id'    => 'cycle-slider-show-item-title',
      'value' => 'true',
      'label' => 'Show item title',
      'type'  => 'checkbox'
    );



    /* Item Description
    ------------------------------------------------------------ */
    
    $fields[] = array(
      'title' => 'Item Description',
      'desc'  => '',
      'id'    => 'cycle-slider-show-item-desc',
      'value' => 'true',
      'label' => 'Show item description',
      'type'  => 'checkbox',
      'show'  => array('cycle-slider-show-read-more-link-wrapper')
    );



    /* Read More Link
    ------------------------------------------------------------ */
    
    $fields[] = array(
      'title' => 'Read More Link',
      'desc'  => '',
      'id'    => 'cycle-slider-show-read-more-link',
      'value' => 'true',
      'label' => 'Show a "Read more" link below the item description if item is linked to a page',
      'type'  => 'checkbox'
    );



/* Group End
------------------------------------------------------------ */

$fields[] = array('type' => 'group_end');
  
  
  
/* Show Bullet Navigation
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Bullet Navigation',
  'desc'  => '',
  'id'    => 'cycle-slider-show-bullet-nav',
  'value' => 'false',
  'label' => 'Show Bullet Navigation',
  'type'  => 'checkbox'
);



/* Table End
------------------------------------------------------------ */

$fields[] = array('type'  => 'table_end');










/* Cycle Slider (Two-Third)
============================================================ */

$fields[] = array('title' => 'Cycle Slider (Two-Third)', 'id' => 'cycle-alt-slider', 'type' => 'table_start');



/* Description
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Description',
	'desc'  => 'Cycle Slider is a jQuery slider that is best suited to display your images with a description on the left or right side. A bullet navigation can be displayed optonally.',
	'id'    => 'cycle-alt-slider-info',
	'type'  => 'html'
);



/* Slider Height
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Slider Height (in Pixel)',
  'desc'  => '',
  'id'    => 'cycle-alt-slider-img-height',
  'value' => '289',
  'size'  => '3',
  'type'  => 'text'
);



/* Max. Entries
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Max. Entries',
  'desc'  => '',
  'id'    => 'cycle-alt-slider-max-entries',
  'value' => '7',
  'size'  => '3',
  'type'  => 'text'
);



/* Auto Play
------------------------------------------------------------ */

$fields[] = array(
  'type'          => 'group_start',
  'title'         => 'Auto Play',
  'id'            => 'cycle-alt-slider-auto-play',
  'desc'          => ''
);
  
  
  
    /* Auto Play
    ------------------------------------------------------------ */
    
    $fields[] = array(
      'title' => 'Auto Play',
      'desc'  => '',
      'id'    => 'cycle-alt-slider-auto-play',
      'value' => 'true',
      'label' => 'Start slideshow automatically',
      'type'  => 'checkbox',
      'show'  => array('cycle-alt-slider-pause-on-hover-wrapper')
    );
      
      
      
    /* Pause on Hover
    ------------------------------------------------------------ */
    
    $fields[] = array(
      'title' => 'Pause on Hover',
      'desc'  => '',
      'id'    => 'cycle-alt-slider-pause-on-hover',
      'value' => 'true',
      'label' => 'Stop slideshow on hover',
      'type'  => 'checkbox'
    );



/* Group End
------------------------------------------------------------ */

$fields[] = array('type' => 'group_end');



/* Transition Speed
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Transition Speed (in Seconds)',
  'desc'  => '',
  'id'    => 'cycle-alt-slider-transition-speed',
  'value' => '1.0',
  'size'  => '3',
  'type'  => 'text'
);



/* Pause Time
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Pause Time (in Seconds)',
  'desc'  => '',
  'id'    => 'cycle-alt-slider-pause-time',
  'value' => '3.0',
  'size'  => '3',
  'type'  => 'text'
);



/* Description
------------------------------------------------------------ */

$fields[] = array(
  'type'          => 'group_start',
  'title'         => 'Description',
  'id'            => 'cycle-alt-slider-desc',
  'desc'          => ''
);



    /* Item Title
    ------------------------------------------------------------ */
    
    $fields[] = array(
      'title' => 'Item Title',
      'desc'  => '',
      'id'    => 'cycle-alt-slider-show-item-title',
      'value' => 'true',
      'label' => 'Show item title',
      'type'  => 'checkbox'
    );



    /* Read More Link
    ------------------------------------------------------------ */
    
    $fields[] = array(
      'title' => 'Read More Link',
      'desc'  => '',
      'id'    => 'cycle-alt-slider-show-read-more-link',
      'value' => 'true',
      'label' => 'Show a "Read more" link below the item description if item is linked to a page',
      'type'  => 'checkbox'
    );



/* Group End
------------------------------------------------------------ */

$fields[] = array('type' => 'group_end');
  
  
  
/* Show Bullet Navigation
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Bullet Navigation',
  'desc'  => '',
  'id'    => 'cycle-alt-slider-show-bullet-nav',
  'value' => 'false',
  'label' => 'Show Bullet Navigation',
  'type'  => 'checkbox'
);



/* Table End
------------------------------------------------------------ */

$fields[] = array('type'  => 'table_end');










/* Piecemaker Slider
============================================================ */

$fields[] = array('title' => 'Piecemaker Slider', 'id' => 'piecemaker-slider', 'type' => 'table_start');



/* Description
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Description',
	'desc'  => 'Piecemaker Slider is a Flash slider that renders your images in 3D with lots of awesome transition effects. Bullet Navigation is auto enabled.',
	'id'    => 'piecemaker-slider-info',
	'type'  => 'html'
);



/* Slider Height
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Slider Height (in Pixel)',
  'desc'  => '',
  'id'    => 'piecemaker-slider-img-height',
  'value' => '408',
  'size'  => '3',
  'type'  => 'text'
);



/* Max. Entries
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Max. Entries',
  'desc'  => '',
  'id'    => 'piecemaker-slider-max-entries',
  'value' => '7',
  'size'  => '3',
  'type'  => 'text'
);



/* Auto Play
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Auto Play',
  'desc'  => '',
  'id'    => 'piecemaker-slider-auto-play',
  'value' => 'true',
  'label' => 'Start slideshow automatically',
  'type'  => 'checkbox'
);



/* Pieces
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Pieces',
  'desc'  => 'Number of pieces to which the image is sliced (between 3 and 15)',
  'id'    => 'piecemaker-slider-pieces',
  'value' => '9',
  'size'  => '3',
  'type'  => 'text'
);



/* Transition Effect
------------------------------------------------------------ */

$options = array(
  'Ease In Out Cubic'   => 'easeInOutCubic',
  'Ease In Out Back'    => 'easeInOutBack',
  'Ease In Out Elastic' => 'easeInOutElastic',
  'Ease In Out Bounce'  => 'easeInOutBounce',
  'Ease In Cubic'       => 'easeInCubic',
  'Ease In Back'        => 'easeInBack',
  'Ease In Elastic'     => 'easeInElastic',
  'Ease In Bounce'      => 'easeInBounce',
  'Ease Out Cubic'      => 'easeOutCubic',
  'Ease Out Back'       => 'easeOutBack',
  'Ease Out Elastic'    => 'easeOutElastic',
  'Ease Out Bounce'     => 'easeOutBounce',
  'Linear'              => 'linear'
);

$fields[] = array(
  'title'     => 'Transition Effect',
  'desc'      => '',
  'id'        => 'piecemaker-slider-transition-effect',
  'value'     => 'easeInOutCubic',
  'no_prompt' => 'true',
	'scope'     => $options,
  'type'      => 'select'
);



/* Transition Speed
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Transition Speed (in Seconds)',
  'desc'  => '',
  'id'    => 'piecemaker-slider-transition-speed',
  'value' => '1.2',
  'size'  => '3',
  'type'  => 'text'
);



/* Pause Time
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Pause Time (in Seconds)',
  'desc'  => '',
  'id'    => 'piecemaker-slider-pause-time',
  'value' => '3',
  'size'  => '3',
  'type'  => 'text'
);



/* Drop Shadow Opacity
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Drop Shadow Opacity',
  'desc'  => 'Adjust the drop shadow opacity (0 is invisible, 100 is black)',
  'id'    => 'piecemaker-slider-drop-shadow-opacity',
  'value' => '35',
  'size'  => '3',
  'type'  => 'text'
);



/* Table End
------------------------------------------------------------ */

$fields[] = array('type'  => 'table_end');










/* Image
============================================================ */

$fields[] = array('title' => 'Image', 'id' => 'featured-image', 'type' => 'table_start');



/* Description
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Description',
  'desc'  => 'This method is best suited to display a single image/banner. The first item that is set in <nobr><a href="'.admin_url().'edit.php?post_type=featured_item">Featured Items</a></nobr> will be displayed. Caption overlays can be positioned where ever you want.',
  'id'    => 'featured-image-info',
  'type'  => 'html'
);



/* Image Height
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Image Height (in Pixel)',
  'desc'  => '',
  'id'    => 'featured-image-height',
  'value' => '408',
  'size'  => '3',
  'type'  => 'text'
);



/* Caption
------------------------------------------------------------ */

$fields[] = array(
  'type'          => 'group_start',
  'title'         => 'Caption',
  'id'            => 'featured-image-caption',
  'desc'          => ''
);



    /* Item Title
    ------------------------------------------------------------ */
    
    $fields[] = array(
      'title' => 'Item Title',
      'desc'  => '',
      'id'    => 'featured-image-show-item-title',
      'value' => 'true',
      'label' => 'Show item title',
      'type'  => 'checkbox'
    );



    /* Item Description
    ------------------------------------------------------------ */
    
    $fields[] = array(
      'title' => 'Item Description',
      'desc'  => '',
      'id'    => 'featured-image-show-item-desc',
      'value' => 'true',
      'label' => 'Show item description',
      'type'  => 'checkbox',
      'show'  => array('featured-image-show-read-more-link-wrapper')
    );



    /* Read More Link
    ------------------------------------------------------------ */
    
    $fields[] = array(
      'title' => 'Read More Link',
      'desc'  => '',
      'id'    => 'featured-image-show-read-more-link',
      'value' => 'true',
      'label' => 'Show a "Read more" link below the item description if item is linked to a page',
      'type'  => 'checkbox',
      'show'  => array('featured-image-read-more-link-text-tr')
    );



/* Group End
------------------------------------------------------------ */

$fields[] = array('type' => 'group_end');



/* Table End
------------------------------------------------------------ */

$fields[] = array('type'  => 'table_end');










/* Image (Two-Third)
============================================================ */

$fields[] = array('title' => 'Image (Two-Third)', 'id' => 'featured-image-alt', 'type' => 'table_start');



/* Description
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Description',
  'desc'  => 'This method is best suited to display a single image with a description on the left or right side. The first item that is set in <nobr><a href="'.admin_url().'edit.php?post_type=featured_item">Feature Items</a></nobr> will be displayed.',
  'id'    => 'featured-image-alt-info',
  'type'  => 'html'
);



/* Image Height
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Image Height (in Pixel)',
  'desc'  => '',
  'id'    => 'featured-image-alt-height',
  'value' => '289',
  'size'  => '3',
  'type'  => 'text'
);



/* Description
------------------------------------------------------------ */

$fields[] = array(
  'type'  => 'group_start',
  'title' => 'Description',
  'id'    => 'featured-image-alt-desc',
  'desc'  => ''
);



    /* Item Title
    ------------------------------------------------------------ */
    
    $fields[] = array(
      'title' => 'Item Title',
      'desc'  => '',
      'id'    => 'featured-image-alt-show-item-title',
      'value' => 'true',
      'label' => 'Show item title above description',
      'type'  => 'checkbox'
    );



    /* Read More Link
    ------------------------------------------------------------ */
    
    $fields[] = array(
      'title' => 'Read More Link',
      'desc'  => '',
      'id'    => 'featured-image-alt-show-read-more-link',
      'value' => 'true',
      'label' => 'Show a "Read more" link below the item description if item is linked to a page',
      'type'  => 'checkbox'
    );



/* Group End
------------------------------------------------------------ */

$fields[] = array('type' => 'group_end');



/* Table End
------------------------------------------------------------ */

$fields[] = array('type'  => 'table_end');










/* Video
============================================================ */

$fields[] = array('title' => 'Video', 'id' => 'featured-video', 'type' => 'table_start');



/* Description
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Description',
	'desc'  => 'This method is best suited to display a single Flash video. You need to have the embedding code, which can be pasted in the textfield below.',
	'id'    => 'featured-video-slider-info',
	'type'  => 'html'
);



/* Embedding Code
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Embedding Code',
  'desc'  => '',
  'id'    => 'featured-video-embedding-code',
  'value' => '',
  'size'  => '3',
  'type'  => 'textarea'
);



/* Video Height
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Video Height (in Pixel)',
  'desc'  => '',
  'id'    => 'featured-video-height',
  'value' => '408',
  'size'  => '3',
  'type'  => 'text'
);



/* Table End
------------------------------------------------------------ */

$fields[] = array('type'  => 'table_end');










/* Video (Two-Third)
============================================================ */

$fields[] = array('title' => 'Video (Two-Third)', 'id' => 'featured-video-alt', 'type' => 'table_start');



/* Description
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Description',
	'desc'  => 'This method is best suited to display a single Flash video with a description on the left or right side. You need to have the embedding code, which can be pasted in the textfield below.',
	'id'    => 'featured-video-alt-info',
	'type'  => 'html'
);



/* Embedding Code
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Embedding Code',
  'desc'  => '',
  'id'    => 'featured-video-alt-embedding-code',
  'value' => '',
  'size'  => '3',
  'type'  => 'textarea'
);



/* Video Height
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Video Height (in Pixel)',
  'desc'  => '',
  'id'    => 'featured-video-alt-height',
  'value' => '289',
  'size'  => '3',
  'type'  => 'text'
);



/* Description Title
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Description Title',
  'desc'  => '',
  'id'    => 'featured-video-alt-title',
  'value' => 'Your Title',
  'size'  => '50',
  'type'  => 'text'
);



/* Description Text
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Description Text',
  'desc'  => '',
  'id'    => 'featured-video-alt-desc',
  'value' => 'Your description text.',
  'size'  => '7',
  'type'  => 'textarea'
);



/* Description Position
------------------------------------------------------------ */

$options = array(
  'Left'  => 'left',
  'Right' => 'right'
);
$fields[] = array(
  'title'     => 'Description Position',
  'desc'      => '',
  'id'        => 'featured-video-alt-desc-pos',
  'value'     => 'right',
  'options'   => $options,
  'type'      => 'radio'
);



/* Link
------------------------------------------------------------ */

$fields[] = array(
  'title' => '"Read More" Link',
	'desc'  => '',
	'id'    => 'featured-video-alt-link',
	'value' => '',
	'size'  => '50',
	'type'  => 'select_link'
);



/* "Read More" Link Text
------------------------------------------------------------ */

$fields[] = array(
  'title'     => '"Read More" Link Text',
  'desc'      => 'You can change the text of the "Read more" link below the description text. Write "none" if you don\'t want the link to appear.',
  'id'        => 'featured-video-alt-read-more-link-text',
  'value'     => 'Read more',
  'size'      => '25',
  'type'      => 'text'
);



/* Table End
------------------------------------------------------------ */

$fields[] = array('type'  => 'table_end');










/* Welcome Bar
============================================================ */

$fields[] = array('title' => 'Welcome Bar', 'id' => 'welcome-bar', 'type' => 'table_start');



/* Welcome Bar
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Visibility',
  'desc'  => 'The Welcome Bar is located below the slider/feature item and can hold a title and a welcome text.',
  'id'    => 'show-welcome-bar',
  'value' => 'true',
  'label' => 'Show Welcome Bar',
  'type'  => 'checkbox',
  'show'  => array('welcome-bar-title-tr', 'welcome-bar-text-tr')
);



/* Welcome Bar Title
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Title',
  'desc'  => '',
  'id'    => 'welcome-bar-title',
  'value' => 'A Modern Premium WordPress Theme',
  'size'  => '45',
  'type'  => 'text'
);



/* Welcome Bar Text
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Text',
  'desc'  => '',
  'id'    => 'welcome-bar-text',
  'value' => 'Put a cool and catchy slogan in here to make your newly purchased theme more interesting!',
  'size'  => '3',
  'type'  => 'textarea'
);



/* Table End
------------------------------------------------------------ */

$fields[] = array('type'  => 'table_end');










new option_page($page_data, $fields);
$fields = array();


?>