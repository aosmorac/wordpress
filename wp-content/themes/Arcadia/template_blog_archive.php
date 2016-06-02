<?php
  $blog_page_id = (int)rvn_get_option('blog-page');

  get_header();

  // Output Title
  $archive_title_source = rvn_get_option('archive-title-source');
  if($archive_title_source == 'blog') {
    $blog_page_id = (int)rvn_get_option('blog-page');
    $heading      = $blog_page_id ? get_the_title($blog_page_id) : 'Blog';
  }
  else {
    $heading = rvn_get_archive_headline();
  }

  rvn_put_page_header($heading);


  global $post;
  $post = get_post($blog_page_id);
?>

<div id="main-wrapper" class="wrapper">

  <section id="content">

    <?php

      if($wp_query->have_posts()) {

        // Setup Variables
        $style       = rvn_get_option('blog-entry-style');
        $list_layout = is_numeric(strrpos($style, 's2-'));
        $column_size = str_replace('s1-', '', $style);
        $column_size = str_replace('s2-', '', $column_size);
        $excerpt_method = rvn_get_option('blog-entry-excerpt-method');
        $excerpt_length = rvn_get_option('blog-entry-excerpt-length');
        $show_meta_infos = !rvn_get_option('blog-no-entry-meta-infos');
        $meta_infos  = ($show_meta_infos) ? explode('::', rvn_get_option('blog-entry-meta-infos')) : array();

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