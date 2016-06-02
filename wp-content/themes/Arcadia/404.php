<?php
  get_header();
  rvn_put_page_header(__('Page not found', 'ruventhemes'));
?>

  <div id="main-wrapper" class="wrapper">

    <section id="content">
      
      <?php rvn_put_no_entries_found(false, __('Sorry, the page you\'re looking for is not here! Either keep looking, or try to search for it.', 'ruventhemes')); ?>
        
    </section>
    <!-- END #content -->
    
    <?php get_sidebar(); ?>

  </div>
  <!-- END #main-wrapper -->
  
<?php get_footer(); ?>
