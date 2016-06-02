<?php
  get_header();
  
  $blog_page_id = (int)rvn_get_option('blog-page');
  $heading      = $blog_page_id ? get_the_title($blog_page_id) : 'Blog';
  rvn_put_page_header($heading);
?>

<div id="main-wrapper" class="wrapper">

  <section id="content">
      
    <?php
      if(have_posts()) {
        
        while(have_posts()) {
          the_post();
          
          $show_meta_infos = !rvn_get_option('post-no-entry-meta-infos');
          $meta_infos = ($show_meta_infos) ? explode('::', rvn_get_option('blog-entry-meta-infos')) : array();
          
          echo rvn_get_entry(array(
            'post_id'               => $post->ID,
            'featured_content_type' => 'post',
            'class'                 => array('full-post', 'post'),
            'column_size'           => 'full',
            'meta_infos'            => $meta_infos,
            'show_tags'             => rvn_get_option('post-show-tags'),
            'featured_image_link_method' => rvn_get_option('post-featured-image-link-method')
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