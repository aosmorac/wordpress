<?php




/* Contact Widget
============================================================ */

if(!class_exists('rvn_social_widget'))
{
  class rvn_social_widget extends WP_Widget {
    
    
    
    /* Constructor
    ------------------------------------------------------------ */
    
  	function __construct() {
  		$widget_ops  = array('classname' => 'widget_social', 'description' => __('Show your social links', 'ruventhemes'));
  		parent::__construct('social', __('CUSTOM: Social Links', 'ruventhemes'), $widget_ops);
  	}
    
    
    
    /* Widget
    ------------------------------------------------------------ */
    
  	function widget($args, $instance) {
  		extract($args);
  		
  		$title = apply_filters('widget_title', (empty($instance['title']) ? __('Social Links', 'ruventhemes') : $instance['title']), $instance, $this->id_base);
  		$number = (int)$instance['number'];
  		
  		if(!$number || $number < 1)
  			$number = 5;
  		
  		echo $before_widget;
  		echo $before_title . $title . $after_title;
  		
  		echo '<div class="widget-content">';
  		
  	  $social_icons = rvn_get_social_icons();
      if(!empty($social_icons)) {
        echo '<ul>';
        $i = 0;
        foreach($social_icons as $title => $img_id) {
          $url = rvn_get_option('social-link-'.$img_id);
          if($url) {
            if($i++ == $number) break;
            echo "<li class='$img_id'><a href='$url' target='_blank'>$title</a></li>";
          }
        }
        echo '</ul>';
      }
  		
  		echo '</div>';
  		
  		echo $after_widget;
  	}
    
    
    
    /* Update
    ------------------------------------------------------------ */
    
  	function update($new_instance, $old_instance) {
  		$instance = $old_instance;
  		
  		$instance['title']  = $new_instance['title'];
  		$instance['number'] = (int)$new_instance['number'];
  		
  		return $instance;
  	}
  
    
    
    /* Form
    ------------------------------------------------------------ */
    
  	function form($instance) {
  		$instance = wp_parse_args((array)$instance, array(
  		  'title'  => __('Social Links', 'ruventhemes'),
  		  'number' => 5
  		));
  		
  		extract($instance);
  		
  		if(!is_numeric($number)) $number = 5;
  		
      ?>
    		<p>
    		  <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ruventhemes'); ?></label>
    		  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
    		</p>
    		<p>
    		  <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of links to show:', 'ruventhemes'); ?></label>
    		  <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
    		</p>
      <?php
  	}
  	
  }
}







/* Register Widget
============================================================ */

if(class_exists('rvn_social_widget'))
{
  add_action('widgets_init', 'register_social_widget');
  
  function register_social_widget() {
  	register_widget('rvn_social_widget');
  }
}







?>