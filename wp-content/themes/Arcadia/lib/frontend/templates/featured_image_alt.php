<section id="featured-image-alt-area" class="featured-content">

  <div id="featured-image-alt">
      
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
          
          $show_title          = rvn_get_option('featured-image-alt-show-item-title');
          $show_read_more_link = rvn_get_option('featured-image-alt-show-read-more-link');
          
          
          //
          // Loop
          //
          
          foreach($rvn_posts as $rvn_post) {
            setup_postdata($rvn_post);
            
            $link     = '';
            $link_val = rvn_get_post_meta($rvn_post->ID, 'featured-item-link');
            $title    = $rvn_post->post_title;
            $desc     = rvn_get_post_meta($rvn_post->ID, 'featured-item-desc');
            $desc_pos = rvn_get_post_meta($rvn_post->ID, 'featured-image-alt-desc-pos', 'right');
            $image    = rvn_get_featured_image($rvn_post->ID, "featured-image-alt-two-third");
            
            
            //
            // Image
            //
            
            if($image) {
              $last_img_code  = ($desc_pos == 'left') ? 'last' : '';
              $last_desc_code = ($desc_pos != 'left') ? 'last' : '';
              
              echo '<div class="content-wrapper">';
              
              // Image Column
              
              if($link_val) {
                $link_val = explode('::', $link_val);
                $link = ($link_val[0] == 'manually') ? $link_val[1] : get_permalink((int)$link_val[1]);
                $image = "<a href='{$link}'>{$image}</a>";
              }
              
              $img_code = "<div class='two-third {$last_img_code}'>{$image}</div>";
              
              // Description Column
              
              $desc_code = "<div class='one-third {$last_desc_code}'>";
              if($show_title && $title) {
                $desc_code.= "<h2 class='top'>{$title}</h2>";
              }
              if($desc) {
                $desc_code.= '<p>'.nl2br($desc).'</p>';
                if($show_read_more_link && $link) {
                  $read_more_link_text = rvn_get_post_meta($rvn_post->ID, 'featured-image-alt-read-more-link-text', 'Read more');
                  if($read_more_link_text && $read_more_link_text != 'none') {
                    $desc_code.= "<p class='bottom'><a href='{$link}'>{$read_more_link_text} »</a></p>";
                  }
                }
              }
              $desc_code.= '</div>';
              
              if($desc_pos == 'left') echo $desc_code . $img_code;
              else                    echo $img_code . $desc_code;
              
              echo '</div><!-- END .content-wrapper -->';
            }
          }
        }
      	
      	
      	//
      	// Dummy Content
      	//
      	
      	else {
      	  $image = rvn_get_featured_image(0, 'featured-image-alt-two-third', false, IMAGES_URL."/dummy/dummy_1.png");
      	  
      	  ?>
          <div class="content-wrapper">
            <div class='two-third'><?php echo $image; ?></div>
            <div class='one-third last'>
              <h2 class='top'>Placeholder Content</h2>
              <p>This is a placeholder. Please set up some Featured Items to bring your website to life.</p>
            </div>
          </div><!-- END .content-wrapper -->
          <?php
      	}
      ?>
    
    
    
    
  </div>
  <!-- END #featured-image-alt -->

</section>