<?php
  if(rvn_is_blog_page($post->ID)):
    get_template_part('template_blog');
  elseif(rvn_is_portfolio_page($post->ID)):
    get_template_part('template_portfolio');
  else:
    get_header();
    rvn_put_page_header();
?>
  
  <div id="main-wrapper" class="wrapper">
    
    <section id="content">
      
      <?php
        if(have_posts()) {
          
          while(have_posts()) {
            the_post();
            echo rvn_get_entry(array(
              'post_id'               => $post->ID,
              'featured_content_type' => 'page',
              'class'                 => array('full-post'),
              'column_size'           => 'full',
              'show_headings'         => !rvn_get_option('page-no-entry-headings'),
              'featured_image_link_method' => rvn_get_option('page-featured-image-link-method')
            ));
      	  }
      	  
      	  comments_template();
      	}
      ?>
      
    </section>
    <!-- END #content -->
    
    <?php get_sidebar(); ?>
    
  </div>
  <!-- END #main-wrapper -->
    
  <?php get_footer(); ?>

<?php endif; ?>