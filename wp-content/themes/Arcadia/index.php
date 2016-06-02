<?php
  $content_id = rvn_get_option('frontpage-content');
  
  if(!$content_id || rvn_is_blog_page($content_id)):
    get_template_part('template_blog');
    
  elseif(rvn_is_portfolio_page($content_id)):
    rvn_set_original_post();
    get_template_part('template_portfolio');
    
  elseif($content_id):
    get_header();
?>
  
<div id="main-wrapper" class="wrapper">

    <section id="content">
      
      <?php
        setup_postdata(get_post($content_id));
        echo rvn_get_entry(array(
          'post_id'               => $content_id,
          'featured_content_type' => 'post',
          'class'                 => array(),
          'column_size'           => 'full',
          'show_full_post'        => true,
          'featured_image_link_method' => rvn_get_option('page-featured-image-link-method')
        ));
      ?>
      
    </section>
    <!-- END #content -->
    
    <?php get_sidebar(); ?>
    
  </div>
  <!-- END #main-wrapper -->
  
  <?php get_footer(); ?>

<?php endif; ?>