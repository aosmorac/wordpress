<?php



/* Posts and Pages
============================================================ */

$page_data = array(
  'title'   => 'Posts and Pages',
  'id'      => 'posts-and-pages',
  'submenu' => true,
  'documentation_url' => ADMIN_DOCUMENTATION_URL
);










/* Single Posts
============================================================ */

$fields[] = array('title' => 'Single Posts', 'id' => 'posts', 'type' => 'table_start');



/* Group Start
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Entry Appearance',
  'desc'  => '',
  'id'    => 'post-entry-appearance',
  'type'  => 'group_start'
);



    /* Disable Meta Infos
    ------------------------------------------------------------ */
    
    $fields[] = array(
      'title' => 'Disable Meta Infos',
      'desc'  => '',
      'id'    => 'post-no-entry-meta-infos',
      'value' => '',
      'label' => 'Disable Meta Infos',
      'type'  => 'checkbox'
    );



/* Group End
------------------------------------------------------------ */

$fields[] = array(
  'type'  => 'group_end'
);



/* Featured Image Link Method
------------------------------------------------------------ */

$options = array(
  'Open Lightbox'      => 'lightbox',
  'Don\'t do anything' => 'none'
);
$fields[] = array(
  'title'   => 'Featured Image Link Method',
  'desc'    => 'What should happen if you click on a featured image?',
  'id'      => 'post-featured-image-link-method',
  'value'   => 'lightbox',
  'options' => $options,
  'type'    => 'radio'
);



/* Featured Image Sizes
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Featured Image Size',
  'id'    => 'post-s1-full-img-height',
  'value' => '274',
  'size'  => '4',
  'desc'  => 'Featured image size adjustment for pages with sidebar.',
  'type'  => 'img_height'
);

$fields[] = array(
  'title' => 'Featured Image Size (Full Width)',
  'id'    => 'post-full-s1-full-img-height',
  'value' => '415',
  'size'  => '4',
  'desc'  => 'Featured image size adjustment for pages without sidebar (full width).',
  'type'  => 'img_height'
);



/* Tags
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Tags',
  'desc'  => '',
  'id'    => 'post-show-tags',
  'value' => 'true',
  'label' => 'Show Tags below Post',
  'type'  => 'checkbox'
);



/* Table End
------------------------------------------------------------ */

$fields[] = array('type'  => 'table_end');










/* Single Pages
============================================================ */

$fields[] = array('title' => 'Single Pages', 'id' => 'pages', 'type' => 'table_start');



/* Featured Image Link Method
------------------------------------------------------------ */

$options = array(
  'Open Lightbox'      => 'lightbox',
  'Don\'t do anything' => 'none'
);
$fields[] = array(
  'title'   => 'Featured Image Link Method',
  'desc'    => 'What should happen if you click on a featured image?',
  'id'      => 'page-featured-image-link-method',
  'value'   => 'lightbox',
  'options' => $options,
  'type'    => 'radio'
);



/* Featured Image Sizes
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Featured Image Size',
  'id'    => 'page-s1-full-img-height',
  'value' => '274',
  'size'  => '4',
  'desc'  => 'Featured image size adjustment for pages with sidebar.',
  'type'  => 'img_height'
);

$fields[] = array(
  'title' => 'Featured Image Size (Full Width)',
  'id'    => 'page-full-s1-full-img-height',
  'value' => '415',
  'size'  => '4',
  'desc'  => 'Featured image size adjustment for pages without sidebar (full width).',
  'type'  => 'img_height'
);



/* Table End
------------------------------------------------------------ */

$fields[] = array('type'  => 'table_end');










/* Portfolio Pages
============================================================ */

$fields[] = array('title' => 'Portfolio Pages', 'id' => 'portfolio-pages', 'type' => 'table_start');



/* Group Start
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Entry Appearance',
  'desc'  => '',
  'id'    => 'portfolio-entry-appearance',
  'type'  => 'group_start'
);



    /* Disable Page Titles
    ------------------------------------------------------------ */
    
    $fields[] = array(
      'title' => 'Disable Page Titles',
      'desc'  => '',
      'id'    => 'portfolio-page-no-entry-headings',
      'value' => '',
      'label' => 'Disable Page Titles',
      'type'  => 'checkbox'
    );
    


/* Group End
------------------------------------------------------------ */

$fields[] = array(
  'type'  => 'group_end'
);



/* Featured Image Link Method
------------------------------------------------------------ */

$options = array(
  'Open Lightbox'      => 'lightbox',
  'Don\'t do anything' => 'none'
);
$fields[] = array(
  'title'   => 'Featured Image Link Method',
  'desc'    => 'What should happen if you click on a featured image?',
  'id'      => 'portfolio-page-featured-image-link-method',
  'value'   => 'lightbox',
  'options' => $options,
  'type'    => 'radio'
);



/* Featured Image Sizes
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Featured Image Size',
  'id'    => 'portfolio-page-s1-full-img-height',
  'value' => '274',
  'size'  => '4',
  'desc'  => 'Featured image size adjustment for portfolio pages with sidebar.',
  'type'  => 'img_height'
);

$fields[] = array(
  'title' => 'Featured Image Size (Full Width)',
  'id'    => 'portfolio-page-full-s1-full-img-height',
  'value' => '415',
  'size'  => '4',
  'desc'  => 'Featured image size adjustment for portfolio pages without sidebar (full width).',
  'type'  => 'img_height'
);



/* Table End
------------------------------------------------------------ */

$fields[] = array('type'  => 'table_end');










new option_page($page_data, $fields);
$fields = array();



?>