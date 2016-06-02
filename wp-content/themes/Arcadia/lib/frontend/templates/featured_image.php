<section id="featured-image-area" class="featured-content">
  
  <div class="deco-loading-screen"></div>
  <div id="featured-image">
    <div class="image-wrapper">
      
      <?php
        
        //
        // Initialize Loop Array and Variables
        //
        
        $query_array = array(
          'post_type'   => 'featured_item',
          'post_status' => 'publish',
          'numberposts' => 1
        );
        $rvn_posts = get_posts($query_array);
        
        if($rvn_posts) {
          
          $show_title          = rvn_get_option('featured-image-show-item-title');
          $show_desc           = rvn_get_option('featured-image-show-item-desc');
          $show_read_more_link = rvn_get_option('featured-image-show-read-more-link');
          $show_caption        = ($show_desc || $show_title);
          
          
          //
          // Loop
          //
          
          foreach($rvn_posts as $rvn_post) {
            setup_postdata($rvn_post);
            
            $link         = '';
            $link_val     = rvn_get_post_meta($rvn_post->ID, 'featured-item-link');
            $title        = $rvn_post->post_title;
            $desc         = rvn_get_post_meta($rvn_post->ID, 'featured-item-desc');
            $caption_pos  = rvn_get_post_meta($rvn_post->ID, 'featured-image-caption-pos', 'bottom-left');
            $show_caption = ($caption_pos == 'no-caption') ? false : $show_caption;
            $image        = rvn_get_featured_image($rvn_post->ID, "featured-image-full");
            
            
            //
            // Image
            //
            
            if($image) {
              
              if($link_val) {
                $link_val = explode('::', $link_val);
                $link = ($link_val[0] == 'manually') ? $link_val[1] : get_permalink((int)$link_val[1]);
                echo "<a href='{$link}' class='img-link-wrapper'>{$image}</a>";
              }
              else {
                echo $image;
              }
              
            
              //
              // Caption
              //
              
              if($show_caption && ($title || $desc)) {
                echo "<div class='caption {$caption_pos}'>";
                echo '<div class="content">';
                if($show_title && $title) {
                  echo "<h2 class='top'>{$title}</h2>";
                }
                if($show_desc && $desc) {
                  echo '<p>'.nl2br($desc).'</p>';
                  if($show_read_more_link && $link) {
                    $read_more_link_text = rvn_get_post_meta($rvn_post->ID, 'featured-image-read-more-link-text', 'Read more');
                    if($read_more_link_text && $read_more_link_text != 'none') {
                      echo "<p class='bottom'><a href='{$link}'>{$read_more_link_text} »</a></p>";
                    }
                  }
                }
                echo '</div>';
                echo '</div>';
              }
              
              
            }
      	  }
      	}
      	
      	
      	//
      	// Dummy Content
      	//
      	
      	else {
      	  echo rvn_get_featured_image(0, 'featured-image-full', false, IMAGES_URL."/dummy/dummy_1.png");
      	  
      	  ?>
    	    <div class="caption centered-bottom-full-width">
    	      <div class="content">
    	        This is a placeholder. Please set up some Featured Items to bring your website to life.
    	      </div>
    	    </div>
    	    <?php
      	}
      ?>
              
    </div><!-- END .image-wrapper -->
    
  </div>
  <!-- END #featured-image -->
        
</section>