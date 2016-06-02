<?php
  global $rvn;
  
  get_header();
  
  $multitable_data = $rvn['data']['portfolio-page-settings'];
  $options = array();
  
  //
  // Get portfolio page options
  //
  for($i = 1; $i <= count($multitable_data); $i++) {
    $options = $multitable_data[$i-1];
    if((int)$options['rvn_portfolio-page_'.$i] == $post->ID) {
      $portfolio_categories        = explode('::', $options['rvn_portfolio-categories_'.$i]);
      $style                       = $options['rvn_portfolio-entry-style_'.$i];
      $entries_per_page            = $options['rvn_portfolio-entries-per-page_'.$i];
      $featured_image_link_method  = $options['rvn_portfolio-featured-image-link-method_'.$i];
      $excerpt_method              = $options['rvn_portfolio-entry-excerpt-method_'.$i];
      $excerpt_length              = $options['rvn_portfolio-entry-excerpt-length_'.$i];
      $show_entry_headings         = !$options['rvn_portfolio-no-entry-headings_'.$i];
      //$show_meta_infos             = !$options['rvn_portfolio-no-entry-meta-infos_'.$i];
      $show_entry_excerpts         = !$options['rvn_portfolio-no-entry-excerpts_'.$i];
      $show_entry_buttons          = !$options['rvn_portfolio-no-entry-buttons_'.$i];
      //$meta_infos                  = $options['rvn_portfolio-entry-meta-infos_'.$i];
      $read_more_link_text         = $options['rvn_portfolio-entry-read-more-link-text_'.$i];
      $external_link_text          = $options['rvn_portfolio-external-link-text_'.$i];
      $external_link_opens_new_tab = $options['rvn_portfolio-external-link-opens-new-tab_'.$i];
      
      $list_layout = is_numeric(strrpos($style, 's2-'));
      //$meta_infos  = ($show_meta_infos) ? explode('::', $meta_infos) : array();
      $column_size = str_replace('s1-', '', $style);
      $column_size = str_replace('s2-', '', $column_size);
      
      // Get Featured Content Size ID
      $full_width_page = ('full' == rvn_get_page_content_size());
      $full = ($full_width_page) ? '-full' : '';
      $style_type = ($list_layout) ? 's2'    : 's1';
      $featured_content_size_id = 'portfolio'.$full.'-'.$style_type.'-'.$column_size;
      
      // Get Featured Content Size
      $featured_content_size[0] = $rvn['img_size'][$featured_content_size_id][0];
      $featured_content_size[1] = $options["rvn_{$featured_content_size_id}-img-height_{$i}"];
      
      break;
    }
  }
  
  //
  // Get Categories
  //
  $page_categories = array();
  $categories = get_categories(array('post_type' => 'portfolio', 'taxonomy' => 'portfolio_categories'));
  foreach($categories as $category) {
    if(in_array($category->cat_ID, $portfolio_categories)) {
      $page_categories[]= $category->slug;
    }
  }
  
  //
  // Get WP Query
  //
  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
  $query_array = array(
    'post_type'      => 'portfolio',
    'post_status'    => 'publish',
    'posts_per_page' => $entries_per_page,
    'paged'          => $paged,
    'portfolio_categories' => join(', ', $page_categories)
  );
  $wp_query = new WP_Query($query_array);
    
  if(!is_front_page()) {
    rvn_put_page_header(get_the_title(rvn_get_original_post_id()));
  }
?>

<div id="main-wrapper" class="wrapper">

  <section id="content">
    
    <?php
      
      //
      // Setup Page
      //
      if($wp_query->have_posts() && $page_categories) {
        
        // Output Content
        $post_id = rvn_get_original_post_id();
        $content = rvn_get_post_content($post_id);
        if(!empty($content)) {
          echo $content;
          echo do_shortcode('[spacer size="big"]');
        }
        
        //
        // Display entries
        //
        while($wp_query->have_posts()) {
          $wp_query->the_post();
          
          $external_link = rvn_get_post_meta($post->ID, 'portfolio-external-link');
          
          echo rvn_get_entry(array(
            'post_id'               => $post->ID,
            'featured_content_type' => 'portfolio',
            'featured_content_size' => $featured_content_size,
            'class'                 => array('preview', 'post'),
            'column_size'           => $column_size,
            'list_layout'           => $list_layout,
            'excerpt_length'        => ($excerpt_method == 'auto') ? (int)$excerpt_length : false,
            //'meta_infos'            => $meta_infos,
            'show_headings'         => $show_entry_headings,
            'show_excerpts'         => $show_entry_excerpts,
            'show_buttons'          => $show_entry_buttons,
            'read_more_link_text'   => $read_more_link_text,
            'featured_image_link_method' => $featured_image_link_method,
            'portfolio' => array('external_link' => $external_link,
                                 'external_link_text' => $external_link_text,
                                 'external_link_opens_new_tab' => $external_link_opens_new_tab)
          ));
        }
        
        echo do_shortcode('[divider]');
        rvn_get_paginator();
    	  wp_reset_query();
      }
      
      // If no posts are found
      else {
        rvn_put_no_entries_found();
      }
    ?>
    
  </section>
  <!-- END #content -->
  
  <?php get_sidebar(); ?>
  
</div>
<!-- END #main-wrapper -->

<?php get_footer(); ?>
