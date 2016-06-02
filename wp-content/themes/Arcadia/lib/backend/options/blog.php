<?php



/* Blog
============================================================ */

$page_data = array(
  'title'   => 'Blog',
  'id'      => 'blog',
  'submenu' => true,
  'documentation_url' => ADMIN_DOCUMENTATION_URL
);










/* Blog
============================================================ */

$fields[] = array('title' => 'Blog', 'id' => 'blog', 'type' => 'table_start');



/* Select Blog Page
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Select Blog Page',
  'desc'  => 'Select the page you want your blog entries to appear on.',
  'id'    => 'blog-page',
  'value' => '',
  'scope' => 'page',
  'type'  => 'select'
);



/* Entry Style
------------------------------------------------------------ */

$options = array(
  'Grid Layout' => array('1 Column'   => 's1-full',
                         '2 Columns'  => 's1-one-half',
                         '3 Columns'  => 's1-one-third',
                         '4 Columns'  => 's1-one-fourth'),
  'List Layout' => array('Two Third'  => 's2-two-third',
                         'One Half'   => 's2-one-half',
                         'One Third'  => 's2-one-third',
                         'One Fourth' => 's2-one-fourth')
);
$fields[] = array(
  'title'     => 'Entry Style',
  'desc'      => 'How should blog entries be displayed?',
  'id'        => 'blog-entry-style',
  'value'     => 's1-full',
  'scope'     => $options,
  'no_prompt' => 'true',
  'type'      => 'select',
  'show'      => array('s1-full'       => 'blog-s1-full-img-height-tr,       blog-full-s1-full-img-height-tr',
                       's1-one-half'   => 'blog-s1-one-half-img-height-tr,   blog-full-s1-one-half-img-height-tr',
                       's1-one-third'  => 'blog-s1-one-third-img-height-tr,  blog-full-s1-one-third-img-height-tr',
                       's1-one-fourth' => 'blog-s1-one-fourth-img-height-tr, blog-full-s1-one-fourth-img-height-tr',
                       's2-two-third'  => 'blog-s2-two-third-img-height-tr,  blog-full-s2-two-third-img-height-tr',
                       's2-one-half'   => 'blog-s2-one-half-img-height-tr,   blog-full-s2-one-half-img-height-tr',
                       's2-one-third'  => 'blog-s2-one-third-img-height-tr,  blog-full-s2-one-third-img-height-tr',
                       's2-one-fourth' => 'blog-s2-one-fourth-img-height-tr, blog-full-s2-one-fourth-img-height-tr')
);



/* Featured Image Sizes
------------------------------------------------------------ */
$def_title = 'Featured Image Size';
$def_desc  = 'If you\'ve selected on the options of your selected blog page that the page should have a sidebar, adjust the featured image size here.';
$fw_title = 'Featured Image Size (Full Width)';
$fw_desc  = 'If you\'ve selected on your page options of your selected blog page that the page should have no sidebar (full width), adjust the featured image size here.';

// Grid Layout
/* 1 Column  */ $fields[] = array('title' => $def_title, 'id' => 'blog-s1-full-img-height',       'value' => '274', 'desc' => $def_desc, 'size' => '4', 'type' => 'img_height');
/* 2 Columns */ $fields[] = array('title' => $def_title, 'id' => 'blog-s1-one-half-img-height',   'value' => '150', 'desc' => $def_desc, 'size' => '4', 'type' => 'img_height');
/* 3 Columns */ $fields[] = array('title' => $def_title, 'id' => 'blog-s1-one-third-img-height',  'value' => '104', 'desc' => $def_desc, 'size' => '4', 'type' => 'img_height');
/* 4 Columns */ $fields[] = array('title' => $def_title, 'id' => 'blog-s1-one-fourth-img-height', 'value' => '86',  'desc' => $def_desc, 'size' => '4', 'type' => 'img_height');

// List Layout
/* Two Third  */ $fields[] = array('title' => $def_title, 'id' => 'blog-s2-two-third-img-height',  'value' => '273', 'desc' => $def_desc, 'size' => '4', 'type' => 'img_height');
/* One Half   */ $fields[] = array('title' => $def_title, 'id' => 'blog-s2-one-half-img-height',   'value' => '188', 'desc' => $def_desc, 'size' => '4', 'type' => 'img_height');
/* One Third  */ $fields[] = array('title' => $def_title, 'id' => 'blog-s2-one-third-img-height',  'value' => '169', 'desc' => $def_desc, 'size' => '4', 'type' => 'img_height');
/* Two Fourth */ $fields[] = array('title' => $def_title, 'id' => 'blog-s2-one-fourth-img-height', 'value' => '118', 'desc' => $def_desc, 'size' => '4', 'type' => 'img_height');

// Full Width Grid Layout
/* 1 Column  */ $fields[] = array('title' => $fw_title, 'id' => 'blog-full-s1-full-img-height',       'value' => '415', 'desc' => $fw_desc, 'size' => '4', 'type' => 'img_height');
/* 2 Columns */ $fields[] = array('title' => $fw_title, 'id' => 'blog-full-s1-one-half-img-height',   'value' => '220', 'desc' => $fw_desc, 'size' => '4', 'type' => 'img_height');
/* 3 Columns */ $fields[] = array('title' => $fw_title, 'id' => 'blog-full-s1-one-third-img-height',  'value' => '152', 'desc' => $fw_desc, 'size' => '4', 'type' => 'img_height');
/* 4 Columns */ $fields[] = array('title' => $fw_title, 'id' => 'blog-full-s1-one-fourth-img-height', 'value' => '124', 'desc' => $fw_desc, 'size' => '4', 'type' => 'img_height');

// Full Width List Layout
/* Two Third  */ $fields[] = array('title' => $fw_title, 'id' => 'blog-full-s2-two-third-img-height',  'value' => '274', 'desc' => $fw_desc, 'size' => '4', 'type' => 'img_height');
/* One Half   */ $fields[] = array('title' => $fw_title, 'id' => 'blog-full-s2-one-half-img-height',   'value' => '220', 'desc' => $fw_desc, 'size' => '4', 'type' => 'img_height');
/* One Third  */ $fields[] = array('title' => $fw_title, 'id' => 'blog-full-s2-one-third-img-height',  'value' => '261', 'desc' => $fw_desc, 'size' => '4', 'type' => 'img_height');
/* Two Fourth */ $fields[] = array('title' => $fw_title, 'id' => 'blog-full-s2-one-fourth-img-height', 'value' => '184', 'desc' => $fw_desc, 'size' => '4', 'type' => 'img_height');



/* Entry Style
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Exclude Categories',
  'desc'  => '',
  'id'    => 'blog-excluded-categories',
  'value' => '',
  'scope' => 'category',
  'max'   => 'inf',
  'type'  => 'multiselect'
);



/* Featured Image Link Method
------------------------------------------------------------ */

$options = array(
  'Open Lightbox'   => 'lightbox',
  'Open Post Entry' => 'entry'
);
$fields[] = array(
  'title'   => 'Featured Image Link Method',
  'desc'    => 'What should happen if you click on a featured image?',
  'id'      => 'blog-featured-image-link-method',
  'value'   => 'entry',
  'options' => $options,
  'type'    => 'radio'
);



/* Group Start
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Entry Appearance',
  'desc'  => '',
  'id'    => 'blog-entry-appearance',
  'type'  => 'group_start'
);



    /* Disable Headings
    ------------------------------------------------------------ */
    
    $fields[] = array(
      'title' => 'Disable Headings',
      'desc'  => '',
      'id'    => 'blog-no-entry-headings',
      'value' => '',
      'label' => 'Disable Headings',
      'type'  => 'checkbox'
    );
    
    
    
    /* Disable Meta Infos
    ------------------------------------------------------------ */
    
    $fields[] = array(
      'title' => 'Disable Meta Infos',
      'desc'  => '',
      'id'    => 'blog-no-entry-meta-infos',
      'value' => '',
      'label' => 'Disable Meta Infos',
      'type'  => 'checkbox',
      'hide'  => array('blog-meta-infos-tr')
    );
    
    
    
    /* Disable Excerpt
    ------------------------------------------------------------ */
    
    $fields[] = array(
      'title' => 'Disable Excerpt',
      'desc'  => '',
      'id'    => 'blog-no-entry-excerpts',
      'value' => '',
      'label' => 'Disable Excerpts',
      'type'  => 'checkbox',
      'hide'  => array('blog-entry-excerpt-method-tr', 'blog-entry-excerpt-length-tr')
    );
    
    
    
    /* Disable "Read More" Buttons
    ------------------------------------------------------------ */
    
    $fields[] = array(
      'title' => 'Disable "Read More" Buttons',
      'desc'  => '',
      'id'    => 'blog-no-entry-buttons',
      'value' => '',
      'label' => 'Disable "Read More" Buttons',
      'type'  => 'checkbox',
      'hide'  => array('blog-entry-read-more-link-text-tr')
    );



/* Group End
------------------------------------------------------------ */

$fields[] = array('type' => 'group_end');



/* Meto Info
------------------------------------------------------------ */

$options = array(
  'Date'       => 'date',
  'Categories' => 'categories',
  'Comments'   => 'comments',
  'Author'     => 'author'
);
$fields[] = array(
  'title'     => 'Meta Infos',
  'desc'      => 'Set what meta infos should be displayed and in which order they should appear.',
  'id'        => 'blog-entry-meta-infos',
  'value'     => 'date::categories::comments',
  'max'       => '3',
  'type'      => 'multiselect',
  'no_prompt' => 'true',
  'scope'     => $options
);



/* Overview Excerpt
------------------------------------------------------------ */

$options = array(
  'Manually insert More Tag or Excerpt field' => 'manual',
  'Auto Excpert' => 'auto'
);
$fields[] = array(
  'title'   => 'Overview Excerpt',
  'desc'    => 'Do you want the text excerpt on the blog page to end automatically or according to the More Tag or Excerpt field, which can be set manually by you when you edit a post?',
  'id'      => 'blog-entry-excerpt-method',
  'value'   => 'manual',
  'options' => $options,
  'type'    => 'radio',
  'show'    => array('auto' => 'blog-entry-excerpt-length-tr')
);



/* Excerpt Length
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'Excerpt Length (in words)',
  'desc'  => 'How many words should the auto excerpt show on the blog page (overview)?',
  'id'    => 'blog-entry-excerpt-length',
  'value' => '55',
  'size'  => '3',
  'type'  => 'text'
);



/* "Read More" Link
------------------------------------------------------------ */

$fields[] = array(
  'title' => '"Read more" Link',
  'desc'  => 'You can change the text of the "Read more" link.',
  'id'    => 'blog-entry-read-more-link-text',
  'value' => 'Read more',
  'size'  => '50',
  'type'  => 'text'
);



/* Table End
------------------------------------------------------------ */

$fields[] = array('type'  => 'table_end');










/* Archive
============================================================ */

$fields[] = array('title' => 'Archive', 'id' => 'archive', 'type' => 'table_start');



/* Layout
------------------------------------------------------------ */

$options = array(
  'Default Archive Layout'     => 'default',
  'Adapt Blog Layout Settings' => 'blog'
);
$fields[] = array(
  'title'   => 'Layout',
  'desc'    => '',
  'id'      => 'archive-layout',
  'value'   => 'default',
  'options' => $options,
  'type'    => 'radio',
  'show'    => array('blog' => 'archive-title-source-tr')
);



/* Archive Title
------------------------------------------------------------ */

$options = array(
  'Use Archive Title' => 'archive',
  'Use Blog Title'    => 'blog'
);
$fields[] = array(
  'title'   => 'Archive Title',
  'desc'    => '',
  'id'      => 'archive-title-source',
  'value'   => 'archive',
  'options' => $options,
  'type'    => 'radio'
);



/* Table End
------------------------------------------------------------ */

$fields[] = array('type'  => 'table_end');










new option_page($page_data, $fields);
$fields = array();



?>