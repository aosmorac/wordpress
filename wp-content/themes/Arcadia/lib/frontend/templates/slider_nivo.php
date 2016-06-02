<section id="nivo-slider-area" class="featured-content">
  
  <div class="deco-loading-screen">
    <div id="nivo-slider">
      
      <?php
        
        //
        // Initialize Loop Array and Variables
        //
        
        $query_array = array(
          'post_type'   => 'featured_item',
          'post_status' => 'publish',
          'numberposts' => rvn_get_option('nivo-slider-max-entries')
        );
        $rvn_posts = get_posts($query_array);
        
        if($rvn_posts) {
          
          $show_desc = rvn_get_option('nivo-slider-show-item-desc');
          
          
          //
          // Loop
          //
          
          foreach($rvn_posts as $rvn_post) {
            setup_postdata($rvn_post);
            
            // Get Description
            $desc = rvn_get_post_meta($rvn_post->ID, 'featured-item-desc');
            $desc = ($show_desc) ? $desc : '';
            
            // Get Image
            $link_val = rvn_get_post_meta($rvn_post->ID, 'featured-item-link');
            $image    = rvn_get_featured_image($rvn_post->ID, 'nivo-slider-full', false, false, array('title' => $desc));
            
            // Display Image
            if($image) {
              if($link_val) {
                $link_val = explode('::', $link_val);
                $link_id  = $link_val[1];
                if($link_val[0] == 'manually') {
                  echo '<a href="'.$link_val[1].'">'.$image.'</a>';
                }
                else {
                  echo '<a href="'.get_permalink((int)$link_id).'">'.$image.'</a>';
                }
              }
              else {
                echo $image;
              }
            }
            
      	  }
      	}
      	
      	
      	//
      	// Dummy Content
      	//
      	
      	else {
      	  $desc = 'This is a placeholder. Please set up some Featured Items to bring your website to life.';
      	  for($i = 1; $i <= 4; $i++) {
        	  echo rvn_get_featured_image(0, 'nivo-slider-full', false, IMAGES_URL."/dummy/dummy_{$i}.png", array('title' => $desc));
        	}
      	}
      ?>
      
    </div>
    <!-- END #nivo-slider -->

  </div>
  <!-- .deco-loading-screen -->
  
</section>

<?php
  $auto_play          = rvn_get_option('nivo-slider-auto-play');
  $transition_effect  = rvn_get_option('nivo-slider-transition-effect');
  $transition_speed   = rvn_get_option('nivo-slider-transition-speed');
  $pause_time         = rvn_get_option('nivo-slider-pause-time');
  $slices             = rvn_get_option('nivo-slider-slices');
  $box_columns        = rvn_get_option('nivo-slider-box-columns');
  $box_rows           = rvn_get_option('nivo-slider-box-rows');
  $show_direction_nav = rvn_get_option('nivo-slider-show-direction-nav');
  $hide_direction_nav = rvn_get_option('nivo-slider-hide-direction-nav');

  $no_auto_play       = ($auto_play) ? 'false' : 'true';
  $transition_speed   = $transition_speed * 1000;
  $pause_time         = $pause_time * 1000;
  $show_direction_nav = ($show_direction_nav) ? 'true' : 'false';
  $hide_direction_nav = ($hide_direction_nav) ? 'true' : 'false';
?>

<script type="text/javascript">
  jQuery(document).ready(function() {
  
    if(jQuery.isFunction(jQuery.fn.nivoSlider)) {
      jQuery(window).load(function() {
        jQuery('#nivo-slider').nivoSlider({
          effect:   '<?php echo $transition_effect; ?>', // Specify sets like: 'fold,fade,sliceDown'
          slices:    <?php echo $slices; ?>,             // For slice animations
          boxCols:   <?php echo $box_columns; ?>,        // For box animations
          boxRows:   <?php echo $box_rows; ?>,           // For box animations
          animSpeed: <?php echo $transition_speed; ?>,   // Slide transition speed
          pauseTime: <?php echo $pause_time; ?>,         // How long each slide will show
          startSlide:   0, // Set starting Slide (0 index)
          directionNav:     <?php echo $show_direction_nav; ?>, // Next & Prev navigation
          directionNavHide: <?php echo $hide_direction_nav; ?>, // Only show on hover
          controlNav:              false,  // 1,2,3... navigation
          controlNavThumbs:        false,  // Use thumbnails for Control Nav
          controlNavThumbsFromRel: false,  // Use image rel for thumbs
          controlNavThumbsSearch:  '.jpg', // Replace this with...
          controlNavThumbsReplace: '_thumb.jpg', // ...this in thumb Image src
          keyboardNav:    true,  // Use left & right arrows
          pauseOnHover:   true,  // Stop animation while hovering
          manualAdvance:  <?php echo $no_auto_play; ?>, // Force manual transitions
          captionOpacity: 0.8,   // Universal caption opacity
          prevText: 'Prev', // Prev directionNav text
          nextText: 'Next'  // Next directionNav text
         });
      });
    }
  
  });
</script>