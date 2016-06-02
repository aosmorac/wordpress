<?php
  $show_bullet_nav = rvn_get_option('cycle-slider-show-bullet-nav');
  $bullet_nav_class = ($show_bullet_nav) ? 'with-bullet-nav' : 'no-bullet-nav';
?>

<section id="cycle-slider-area" class="featured-content <?php echo $bullet_nav_class; ?>">
    
  <div class="deco-loading-screen"></div>
  <div id="cycle-slider">
      
    <?php
      
      //
      // Initialize Loop Array and Variables
      //
      
      $query_array = array(
        'post_type'   => 'featured_item',
        'post_status' => 'publish',
        'numberposts' => rvn_get_option('cycle-slider-max-entries')
      );
      $rvn_posts = get_posts($query_array);
      
      if($rvn_posts) {
        
        $show_title          = rvn_get_option('cycle-slider-show-item-title');
        $show_desc           = rvn_get_option('cycle-slider-show-item-desc');
        $show_read_more_link = rvn_get_option('cycle-slider-show-read-more-link');
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
          $caption_pos  = rvn_get_post_meta($rvn_post->ID, 'cycle-slider-caption-pos', 'bottom-left');
          $show_caption = ($caption_pos == 'no-caption') ? false : true;
          $image        = rvn_get_featured_image($rvn_post->ID, "cycle-slider-full");
          
          //
          // Image
          //
          
          if($image) {
            echo '<div class="slide">';
            
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
            
            if($show_caption && ($show_title || $desc)) {
              echo "<div class='caption {$caption_pos}'>";
              echo '<div class="content">';
              if($show_title && $title) {
                echo "<h2 class='top'>{$title}</h2>";
              }
              if($show_desc && $desc) {
                echo '<p>'.nl2br($desc).'</p>';
                if($show_read_more_link && $link) {
                  $read_more_link_text = rvn_get_post_meta($rvn_post->ID, 'cycle-slider-read-more-link-text', 'Read more');
                  if($read_more_link_text && $read_more_link_text != 'none') {
                    echo "<p class='bottom'><a href='{$link}'>{$read_more_link_text} »</a></p>";
                  }
                }
              }
              echo '</div>';
              echo '</div>';
            }
            
            
            echo '</div><!-- END .slide -->';
          }
    	  }
    	}
    	
    	
    	//
    	// Dummy Content
    	//
    	
    	else {
    	  for($i = 1; $i <= 4; $i++) {
    	    $image = rvn_get_featured_image(0, 'cycle-slider-full', false, IMAGES_URL."/dummy/dummy_{$i}.png");
    	    ?>
      	  <div class="slide">
      	    <?php echo $image; ?>
      	    <div class="caption centered-bottom-full-width">
      	      <div class="content">
      	        This is a placeholder. Please set up some Featured Items to bring your website to life.
      	      </div>
      	    </div>
      	  </div>
      	  <?php
      	}
    	}
    ?>
    
  </div>
  <!-- END #cycle-slider -->
      
</section>

<?php
  $auto_play          = rvn_get_option('cycle-slider-auto-play');
  $pause_on_hover     = rvn_get_option('cycle-slider-pause-on-hover');
  $transition_effects = rvn_get_option('cycle-slider-transition-effects');
  $transition_speed   = rvn_get_option('cycle-slider-transition-speed');
  $pause_time         = rvn_get_option('cycle-slider-pause-time');
  $show_bullet_nav    = rvn_get_option('cycle-slider-show-bullet-nav');
  
  // Get Transition Effects
  $te_array = explode('::', $transition_effects);
  if(count($te_array) > 1) { array_unshift($te_array, array_pop($te_array)); }
  $transition_effects = implode(', ', $te_array);
  
  $pause_on_hover   = ($pause_on_hover)  ? 'true' : 'false';
  $bullet_nav       = ($show_bullet_nav) ? "'#cycle-slider-bullet-nav'" : 'null';
  $bullet_nav_code  = ($show_bullet_nav) ? 'jQuery("#cycle-slider").after("<div id=\'cycle-slider-bullet-nav\'>");' : '';
  $transition_speed = $transition_speed * 1000;
  $pause_time       = ($auto_play) ? ($pause_time * 1000) : 0;
?>

<script type="text/javascript">
  jQuery(document).ready(function() {
    
    if(jQuery.isFunction(jQuery.fn.cycle)) {
      <?php echo $bullet_nav_code; ?>
      jQuery("#cycle-slider").cycle({
        fx:      '<?php echo $transition_effects; ?>',
        speed:   <?php echo $transition_speed; ?>, 
        timeout: <?php echo $pause_time; ?>,
        pause:   <?php echo $pause_on_hover; ?>,
        pager:   <?php echo $bullet_nav; ?>,
        activePagerClass: 'current'
      });
    }
  
  });
</script>