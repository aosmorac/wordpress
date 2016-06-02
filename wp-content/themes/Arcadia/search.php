<?php
  // Set global more variable to 0 to display only content above the more tag
  global $more;
  $more = 0;
  
  get_header();
  
  rvn_put_page_header(sprintf(__("Search Results for &#8220;%s&#8221;", 'ruventhemes'), get_search_query()));
?>

<div id="main-wrapper" class="wrapper">
        
  <section id="content">
    
    <?php
      if(have_posts()) {
        while(have_posts()) {
          the_post();
          echo rvn_get_entry(array(
            'post_id'               => $post->ID,
            'class'                 => array('small-bottom-padding', 'preview'),
            'column_size'           => 'full',
            'show_featured_content' => false,
            'meta_infos'            => array('date', 'categories', 'comments'),
            'read_more_link_text'   => rvn_get_option('blog-entry-read-more-link-text'),
            'featured_image_link_method' => rvn_get_option('blog-featured-image-link-method')
          ));
    	  }
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
