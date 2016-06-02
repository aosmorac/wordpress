<section id="featured-video-area" class="featured-content">
    
  <div class="deco-loading-screen"></div>
  
  <div id="featured-video">
      
    <?php
      
      $embedding_code = rvn_get_option('featured-video-embedding-code');
      $video = rvn_get_featured_video(0, $embedding_code, "featured-video-full");
      
      if($video) {
        echo "<div class='video-wrapper'>{$video}</div>";
      }
    	
    	
    	//
    	// Dummy Content
    	//
    	
    	else {
        $embedding_code = '<iframe src="http://player.vimeo.com/video/10988919?title=0&amp;byline=0&amp;portrait=0" width="400" height="225" frameborder="0"></iframe>';
        $video = rvn_get_featured_video(0, $embedding_code, "featured-video-full");
        echo "<div class='video-wrapper'>{$video}</div>";
    	}
    	
    ?>
    
  </div>
  <!-- END #featured-video -->
    
</section>