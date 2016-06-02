<section id="featured-video-alt-area" class="featured-content">
      
  <div id="featured-video-alt">
      
    <?php
      
      $embedding_code = rvn_get_option('featured-video-alt-embedding-code');
      $video          = rvn_get_featured_video(0, $embedding_code, 'featured-video-alt-two-third');
      $title    = rvn_get_option('featured-video-alt-title');
      $desc     = rvn_get_option('featured-video-alt-desc');
      $desc_pos = rvn_get_option('featured-video-alt-desc-pos', 'right');
      $link_val = rvn_get_option('featured-video-alt-link');
      $read_more_link_text = rvn_get_option('featured-video-alt-read-more-link-text');
      
      
      //
      // Video
      //
      
      if($video) {
        $last_img_code  = ($desc_pos == 'left') ? 'last' : '';
        $last_desc_code = ($desc_pos != 'left') ? 'last' : '';
        
        echo '<div class="content-wrapper">';
        
        // Image Column
        
        if($link_val) {
          $link_val = explode('::', $link_val);
          $link = ($link_val[0] == 'manually') ? $link_val[1] : get_permalink((int)$link_val[1]);
        }
        
        $video_code = "<div class='two-third {$last_img_code}'><div class='video-wrapper'>{$video}</div></div>";
        
        // Description Column
        
        $desc_code = "<div class='one-third {$last_desc_code}'>";
        if($title) {
          $desc_code.= "<h2 class='top'>{$title}</h2>";
        }
        if($desc) {
          $desc_code.= '<p>'.nl2br($desc).'</p>';
          if($read_more_link_text && $read_more_link_text != 'none') {
            $desc_code.= "<p class='bottom'><a href='{$link}'>{$read_more_link_text} »</a></p>";
          }
        }
        $desc_code.= '</div>';
        
        if($desc_pos == 'left') echo $desc_code . $video_code;
        else                    echo $video_code . $desc_code;
        
        echo '</div><!-- END .content-wrapper -->';
      }
      	
      	
    	//
    	// Dummy Content
    	//
    	
    	else {
        $embedding_code = '<iframe src="http://player.vimeo.com/video/10988919?title=0&amp;byline=0&amp;portrait=0" width="400" height="225" frameborder="0"></iframe>';
        $video = rvn_get_featured_video(0, $embedding_code, "featured-video-alt-two-third");
    	  
    	  ?>
        <div class="content-wrapper">
          <div class='two-third'><div class='video-wrapper'><?php echo $video; ?></div></div>
          <div class='one-third last'>
            <h2 class='top'>Placeholder Content</h2>
            <p>This is a placeholder. Please set up some a front page video to bring your website to life.</p>
          </div>
        </div><!-- END .content-wrapper -->
        <?php
    	}
    	
    ?>
    
  </div>
  <!-- END .cycle-alt-slider -->
      
</section>