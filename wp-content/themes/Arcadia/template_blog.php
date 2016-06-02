<?php
  // Set global more variable to 0 to display only content above the more tag
  global $more;
  $more = 0;
  
  get_header();
  
  if(!is_front_page()) {
    rvn_put_page_header(get_the_title(rvn_get_original_post_id()));
  }
?>

<div id="main-wrapper" class="wrapper">

  <section id="content">
    
    <?php
      $excluded_categories = explode('::', rvn_get_option('blog-excluded-categories'));
      $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
      $query_array = array(
        'post_status' => 'publish',
        'paged'       => $paged,
        'category__not_in' => $excluded_categories
      );
      $wp_query = new WP_Query($query_array);
      
      if($wp_query->have_posts()) {
        
        // Initialize Variables
        $style       = rvn_get_option('blog-entry-style');
        $list_layout = is_numeric(strrpos($style, 's2-'));
        $column_size = str_replace('s1-', '', $style);
        $column_size = str_replace('s2-', '', $column_size);
        $excerpt_method  = rvn_get_option('blog-entry-excerpt-method');
        $excerpt_length  = rvn_get_option('blog-entry-excerpt-length');
        $show_meta_infos = !rvn_get_option('blog-no-entry-meta-infos');
        $meta_infos = ($show_meta_infos) ? explode('::', rvn_get_option('blog-entry-meta-infos')) : array();
        
        // Loop
        while($wp_query->have_posts()) {
          $wp_query->the_post();
          echo rvn_get_entry(array(
            'post_id'               => $post->ID,
            'featured_content_type' => 'blog',
            'class'                 => array('preview', 'post'),
            'column_size'           => $column_size,
            'list_layout'           => $list_layout,
            'excerpt_length'        => ($excerpt_method == 'auto') ? (int)$excerpt_length : false,
            'meta_infos'            => $meta_infos,
            'show_headings'         => !rvn_get_option('blog-no-entry-headings'),
            'show_excerpts'         => !rvn_get_option('blog-no-entry-excerpts'),
            'show_buttons'          => !rvn_get_option('blog-no-entry-buttons'),
            'read_more_link_text'   => rvn_get_option('blog-entry-read-more-link-text'),
            'featured_image_link_method' => rvn_get_option('blog-featured-image-link-method')
          ));
        }
    	  
    	  echo do_shortcode('[divider]');
    	  
    	  rvn_get_paginator();
    	  wp_reset_query();
    	}
    	
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