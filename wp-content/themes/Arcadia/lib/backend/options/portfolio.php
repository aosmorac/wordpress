<?php



/* Option Page
============================================================ */

$page_data = array(
  'title'   => 'Portfolio',
  'id'      => 'portfolio',
  'submenu' => true,
  'documentation_url' => ADMIN_DOCUMENTATION_URL
);










/* Options for all Portfolio Pages
============================================================ */

$fields[] = array('title' => 'Options for all Portfolio Pages', 'id' => 'portfolio-generic', 'type' => 'table_start');



/* Text
------------------------------------------------------------ */

$fields[] = array(
  'title' => 'URL Slug',
  'desc'  => 'Define the URL Slug for portfolio items. E.g. if you enter <i>portfolio-item</i> the item URL would be <b>'.home_url().'/portfolio-item/post-name</b>.<br/>Please don\'t use this slug anywhere else and don\'t use charakters that are not allowed in URLs.',
  'id'    => 'portfolio-url-slug',
  'value' => 'portfolio-item',
  'size'  => '50',
  'type'  => 'text'
);



/* Table End
------------------------------------------------------------ */

$fields[] = array('type' => 'table_end');










/* Multitable Fields
============================================================ */



/* Select Portfolio Page
------------------------------------------------------------ */

$multi_fields[] = array(
  'title' => 'Select Portfolio Page',
  'desc'  => 'Select the page you want your portfolio entries to appear on.',
  'id'    => 'portfolio-page',
  'value' => '',
  'scope' => 'page',
  'type'  => 'select'
);



/* Select Categories
------------------------------------------------------------ */

$multi_fields[] = array(
  'title' => 'Select Categories',
  'desc'  => 'Select the portfolio categories whose entries should be displayed on this page.',
  'id'    => 'portfolio-categories',
  'value' => '',
  'scope' => 'portfolio_category',
  'max'   => 'inf',
  'type'  => 'multiselect'
);



/* Entry Style
------------------------------------------------------------ */

$select_options = array(
  'Grid Layout' => array('1 Column'   => 's1-full',
                         '2 Columns'  => 's1-one-half',
                         '3 Columns'  => 's1-one-third',
                         '4 Columns'  => 's1-one-fourth'),
  'List Layout' => array('Two Third'  => 's2-two-third',
                         'One Half'   => 's2-one-half',
                         'One Third'  => 's2-one-third',
                         'One Fourth' => 's2-one-fourth')
);
$multi_fields[] = array(
  'title'     => 'Entry Style',
  'desc'      => 'How should entries be displayed?',
  'id'        => 'portfolio-entry-style',
  'value'     => 's1-one-half',
  'scope'     => $select_options,
  'no_prompt' => 'true',
  'type'      => 'select',
  'show'      => array('s1-full'       => 'portfolio-s1-full-img-height_$i-tr,       portfolio-full-s1-full-img-height_$i-tr',
                       's1-one-half'   => 'portfolio-s1-one-half-img-height_$i-tr,   portfolio-full-s1-one-half-img-height_$i-tr',
                       's1-one-third'  => 'portfolio-s1-one-third-img-height_$i-tr,  portfolio-full-s1-one-third-img-height_$i-tr',
                       's1-one-fourth' => 'portfolio-s1-one-fourth-img-height_$i-tr, portfolio-full-s1-one-fourth-img-height_$i-tr',
                       's2-two-third'  => 'portfolio-s2-two-third-img-height_$i-tr,  portfolio-full-s2-two-third-img-height_$i-tr',
                       's2-one-half'   => 'portfolio-s2-one-half-img-height_$i-tr,   portfolio-full-s2-one-half-img-height_$i-tr',
                       's2-one-third'  => 'portfolio-s2-one-third-img-height_$i-tr,  portfolio-full-s2-one-third-img-height_$i-tr',
                       's2-one-fourth' => 'portfolio-s2-one-fourth-img-height_$i-tr, portfolio-full-s2-one-fourth-img-height_$i-tr')
);



/* Featured Image Sizes
------------------------------------------------------------ */
$def_title = 'Featured Image Size';
$def_desc  = 'If you\'ve selected on the options of your selected portfolio page that the page should have a sidebar, adjust the featured image size here.';
$fw_title = 'Featured Image Size (Full Width)';
$fw_desc  = 'If you\'ve selected on your page options of your selected portfolio page that the page should have no sidebar (full width), adjust the featured image size here.';

// Grid Layout
/* 1 Column  */ $multi_fields[] = array('title' => $def_title, 'id' => 'portfolio-s1-full-img-height',       'value' => '274', 'desc' => $def_desc, 'size' => '4', 'type' => 'img_height');
/* 2 Columns */ $multi_fields[] = array('title' => $def_title, 'id' => 'portfolio-s1-one-half-img-height',   'value' => '150', 'desc' => $def_desc, 'size' => '4', 'type' => 'img_height');
/* 3 Columns */ $multi_fields[] = array('title' => $def_title, 'id' => 'portfolio-s1-one-third-img-height',  'value' => '104', 'desc' => $def_desc, 'size' => '4', 'type' => 'img_height');
/* 4 Columns */ $multi_fields[] = array('title' => $def_title, 'id' => 'portfolio-s1-one-fourth-img-height', 'value' => '86',  'desc' => $def_desc, 'size' => '4', 'type' => 'img_height');

// List Layout
/* Two Third  */ $multi_fields[] = array('title' => $def_title, 'id' => 'portfolio-s2-two-third-img-height',  'value' => '273', 'desc' => $def_desc, 'size' => '4', 'type' => 'img_height');
/* One Half   */ $multi_fields[] = array('title' => $def_title, 'id' => 'portfolio-s2-one-half-img-height',   'value' => '188', 'desc' => $def_desc, 'size' => '4', 'type' => 'img_height');
/* One Third  */ $multi_fields[] = array('title' => $def_title, 'id' => 'portfolio-s2-one-third-img-height',  'value' => '169', 'desc' => $def_desc, 'size' => '4', 'type' => 'img_height');
/* Two Fourth */ $multi_fields[] = array('title' => $def_title, 'id' => 'portfolio-s2-one-fourth-img-height', 'value' => '118', 'desc' => $def_desc, 'size' => '4', 'type' => 'img_height');

// Full Width Grid Layout
/* 1 Column  */ $multi_fields[] = array('title' => $fw_title, 'id' => 'portfolio-full-s1-full-img-height',       'value' => '415', 'desc' => $fw_desc, 'size' => '4', 'type' => 'img_height');
/* 2 Columns */ $multi_fields[] = array('title' => $fw_title, 'id' => 'portfolio-full-s1-one-half-img-height',   'value' => '220', 'desc' => $fw_desc, 'size' => '4', 'type' => 'img_height');
/* 3 Columns */ $multi_fields[] = array('title' => $fw_title, 'id' => 'portfolio-full-s1-one-third-img-height',  'value' => '152', 'desc' => $fw_desc, 'size' => '4', 'type' => 'img_height');
/* 4 Columns */ $multi_fields[] = array('title' => $fw_title, 'id' => 'portfolio-full-s1-one-fourth-img-height', 'value' => '124', 'desc' => $fw_desc, 'size' => '4', 'type' => 'img_height');

// Full Width List Layout
/* Two Third  */ $multi_fields[] = array('title' => $fw_title, 'id' => 'portfolio-full-s2-two-third-img-height',  'value' => '274', 'desc' => $fw_desc, 'size' => '4', 'type' => 'img_height');
/* One Half   */ $multi_fields[] = array('title' => $fw_title, 'id' => 'portfolio-full-s2-one-half-img-height',   'value' => '220', 'desc' => $fw_desc, 'size' => '4', 'type' => 'img_height');
/* One Third  */ $multi_fields[] = array('title' => $fw_title, 'id' => 'portfolio-full-s2-one-third-img-height',  'value' => '261', 'desc' => $fw_desc, 'size' => '4', 'type' => 'img_height');
/* Two Fourth */ $multi_fields[] = array('title' => $fw_title, 'id' => 'portfolio-full-s2-one-fourth-img-height', 'value' => '184', 'desc' => $fw_desc, 'size' => '4', 'type' => 'img_height');



/* Entries per Page
------------------------------------------------------------ */

$multi_fields[] = array(
  'title' => 'Entries per Page',
  'desc'  => 'How many entries should appear per page?',
  'id'    => 'portfolio-entries-per-page',
  'value' => '9',
  'size'  => '2',
  'type'  => 'text'
);



/* Featured Image Link Method
------------------------------------------------------------ */

$options = array(
  'Open Lightbox'        => 'lightbox',
  'Open Portfolio Entry' => 'entry'
);
$multi_fields[] = array(
  'title'   => 'Featured Image Link Method',
  'desc'    => 'What should happen if you click on the featured image?',
  'id'      => 'portfolio-featured-image-link-method',
  'value'   => 'entry',
  'options' => $options,
  'type'    => 'radio'
);



/* Group Start
------------------------------------------------------------ */

$multi_fields[] = array(
  'title' => 'Entry Appearance',
  'desc'  => '',
  'id'    => 'portflio-entry-appearance',
  'type'  => 'group_start'
);

    
    
    /* Disable Page Titles
    ------------------------------------------------------------ */
    
    $multi_fields[] = array(
      'title' => 'Disable Page Titles',
      'desc'  => '',
      'id'    => 'portfolio-no-entry-headings',
      'value' => '',
      'label' => 'Disable Page Titles',
      'type'  => 'checkbox'
    );
    
    
    
    /* Disable Meta Infos
    ------------------------------------------------------------ */
    /*
    $multi_fields[] = array(
      'title' => 'Disable Meta Infos',
      'desc'  => '',
      'id'    => 'portfolio-no-entry-meta-infos',
      'value' => 'true',
      'label' => 'Disable Meta Infos',
      'type'  => 'checkbox',
      'hide'  => array('portfolio-meta-infos_$i-tr')
    );
    */
    
    
    
    /* Disable Excerpt
    ------------------------------------------------------------ */
    
    $multi_fields[] = array(
      'title' => 'Disable Excerpt',
      'desc'  => '',
      'id'    => 'portfolio-no-entry-excerpts',
      'value' => '',
      'label' => 'Disable Excerpts',
      'type'  => 'checkbox'
    );
    
    
    
    /* Disable "Read More" Buttons
    ------------------------------------------------------------ */
    
    $multi_fields[] = array(
      'title' => 'Disable "Read More" Buttons',
      'desc'  => '',
      'id'    => 'portfolio-no-entry-buttons',
      'value' => '',
      'label' => 'Disable "Read More" Buttons',
      'type'  => 'checkbox',
      'hide'  => array('portfolio-entry-read-more-link-text_$i-tr',
                       'portfolio-external-link-text_$i-tr',
                       'portfolio-external-link-opens-new-tab_$i-tr')
    );
    


/* Group End
------------------------------------------------------------ */

$multi_fields[] = array(
  'type'  => 'group_end'
);



/* Meta Info
------------------------------------------------------------ */
/*
$options = array(
  'Date'       => 'date',
  'Categories' => 'categories',
  'Comments'   => 'comments',
  'Author'     => 'author'
);
$multi_fields[] = array(
  'title'     => 'Meta Infos',
  'desc'      => 'Set what meta infos and in which order they should be displayed.',
  'id'        => 'portfolio-entry-meta-infos',
  'value'     => 'date::categories::comments',
  'max'       => '3',
  'type'      => 'multiselect',
  'no_prompt' => 'true',
  'scope'     => $options
);
*/



/* Overview Excerpt
------------------------------------------------------------ */

$options = array(
  'Manually insert More Tag or Excerpt field' => 'manual',
  'Auto Excpert' => 'auto'
);
$multi_fields[] = array(
  'title'   => 'Overview Excerpt',
  'desc'    => 'Do you want the text excerpt on the portfolio overview page to end automatically or according to the More Tag or Excerpt field, which can be set manually by you when you edit a post?',
  'id'      => 'portfolio-entry-excerpt-method',
  'value'   => 'manual',
  'options' => $options,
  'type'    => 'radio',
  'show'    => array('auto' => 'portfolio-entry-excerpt-length_$i-tr')
);



/* Excerpt Length
------------------------------------------------------------ */

$multi_fields[] = array(
  'title' => 'Excerpt Length (in words)',
  'desc'  => 'How many words should the auto excerpt show on the portfolio overview page?',
  'id'    => 'portfolio-entry-excerpt-length',
  'value' => '55',
  'size'  => '3',
  'type'  => 'text'
);



/* "Read More" Link
------------------------------------------------------------ */

$multi_fields[] = array(
  'title' => '"Read more" Link',
  'desc'  => 'You can change the text of the "Read more" link.',
  'id'    => 'portfolio-entry-read-more-link-text',
  'value' => 'Read more',
  'size'  => '50',
  'type'  => 'text'
);



/* External Link
------------------------------------------------------------ */

$multi_fields[] = array(
  'title' => 'External Link',
  'desc'  => 'You can change the text of the link. This link shows up in the overview, when you have an external site linked to your portfolio entry.',
  'id'    => 'portfolio-external-link-text',
  'value' => 'Visit site',
  'size'  => '50',
  'type'  => 'text'
);



/* External Link Method
----------------------------------------------------------- */

$multi_fields[] = array(
  'title' => 'External Link Method',
  'desc'  => 'Should a new tab be opened when an external link is clicked?',
  'id'    => 'portfolio-external-link-opens-new-tab',
  'value' => '',
  'label' => 'Open link in a new window/tab',
  'type'  => 'checkbox'
);










/* Multitable
============================================================ */

$fields[] = array(
  'title'  => 'Portfolio Page',
  'id'     => 'portfolio-multitable',
  'value'  => '',
  'type'   => 'multitable',
  'fields' => $multi_fields
);









  
new option_page($page_data, $fields);
$fields = array();



?>