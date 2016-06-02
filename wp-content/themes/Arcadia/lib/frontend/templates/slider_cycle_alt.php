<?php
  $show_bullet_nav = rvn_get_option('cycle-alt-slider-show-bullet-nav');
  $bullet_nav_class = ($show_bullet_nav) ? 'with-bullet-nav' : 'no-bullet-nav';
?>

<section id="cycle-alt-slider-area" class="featured-content <?php echo $bullet_nav_class; ?>">
    
  <div id="cycle-alt-slider">
      
      <?php
        
        //
        // Initialize Loop Array and Variables
        //
        
        $query_array = array(
          'post_type'   => 'featured_item',
          'post_status' => 'publish',
          'numberposts' => rvn_get_option('cycle-alt-slider-max-entries')
        );
        $rvn_posts = get_posts($query_array);
        
        if($rvn_posts) {
          
          $show_title          = rvn_get_option('cycle-alt-slider-show-item-title');
          $show_read_more_link = rvn_get_option('cycle-alt-slider-show-read-more-link');
          
          
          //
          // Loop
          //
          
          foreach($rvn_posts as $rvn_post) {
            setup_postdata($rvn_post);
            
            $link     = '';
            $link_val = rvn_get_post_meta($rvn_post->ID, 'featured-item-link');
            $title    = $rvn_post->post_title;
            $desc     = rvn_get_post_meta($rvn_post->ID, 'featured-item-desc');
            $desc_pos = rvn_get_post_meta($rvn_post->ID, 'cycle-alt-slider-desc-pos', 'right');
            $image    = rvn_get_featured_image($rvn_post->ID, "cycle-alt-slider-two-third");
            
            
            //
            // Image
            //
            
            if($image) {
              $last_img_code  = ($desc_pos == 'left') ? 'last' : '';
              $last_desc_code = ($desc_pos != 'left') ? 'last' : '';
              
              echo '<div class="slide">';
              
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
                  $read_more_link_text = rvn_get_post_meta($rvn_post->ID, 'cycle-alt-slider-read-more-link-text', 'Read more');
                  if($read_more_link_text && $read_more_link_text != 'none') {
                    $desc_code.= "<p class='bottom'><a href='{$link}'>{$read_more_link_text} »</a></p>";
                  }
                }
              }
              $desc_code.= '</div>';
              
              if($desc_pos == 'left') echo $desc_code . $img_code;
              else                    echo $img_code . $desc_code;
              
              echo '</div><!-- END .slide -->';
            }
          }
        }
      	
      	
      	//
      	// Dummy Content
      	//
      	
      	else {
      	  for($i = 1; $i <= 4; $i++) {
        	  $image = rvn_get_featured_image(0, 'cycle-alt-slider-two-third', false, IMAGES_URL."/dummy/dummy_{$i}.png");
        	  ?>
            <div class="slide">
              <div class='two-third'><?php echo $image; ?></div>
              <div class='one-third last'>
                <h2 class='top'>Placeholder Content</h2>
                <p>This is a placeholder. Please set up some Featured Items to bring your website to life.</p>
              </div>
            </div><!-- END .slide -->
            <?php
          }
      	}
      ?>
    
    
    
    
  </div>
  <!-- END #cycle-alt-slider -->
        
</section>

<?php
  $auto_play        = rvn_get_option('cycle-alt-slider-auto-play');
  $pause_on_hover   = rvn_get_option('cycle-alt-slider-pause-on-hover');
  $transition_speed = rvn_get_option('cycle-alt-slider-transition-speed');
  $pause_time       = rvn_get_option('cycle-alt-slider-pause-time');
  $show_bullet_nav  = rvn_get_option('cycle-alt-slider-show-bullet-nav');
  
  $pause_on_hover   = ($pause_on_hover)  ? 'true' : 'false';
  $bullet_nav       = ($show_bullet_nav) ? "'#cycle-alt-slider-bullet-nav'" : 'null';
  $bullet_nav_code  = ($show_bullet_nav) ? 'jQuery("#cycle-alt-slider").after("<div id=\'cycle-alt-slider-bullet-nav\'>");' : '';
  $transition_speed = $transition_speed * 1000;
  $pause_time       = ($auto_play) ? ($pause_time * 1000) : 0;
?>

<script type="text/javascript">
  jQuery(document).ready(function() {
    
    if(jQuery.isFunction(jQuery.fn.cycle)) {
      <?php echo $bullet_nav_code; ?>
      jQuery("#cycle-alt-slider").cycle({
        fx:      'fade',
        speed:   <?php echo $transition_speed; ?>, 
        timeout: <?php echo $pause_time; ?>, 
        pause:   <?php echo $pause_on_hover; ?>,
        pager:   <?php echo $bullet_nav; ?>,
        activePagerClass: 'current'
      });
    }
  
  });
</script>