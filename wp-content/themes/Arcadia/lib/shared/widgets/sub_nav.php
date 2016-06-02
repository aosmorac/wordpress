<?php




/* Sub Navigation Widget
============================================================ */

if(!class_exists('rvn_sub_nav_widget'))
{
  class rvn_sub_nav_widget extends WP_Widget {
    
    
    
    /* Constructor
    ------------------------------------------------------------ */
    
  	function __construct() {
  		$widget_ops = array('classname' => 'widget_sub_nav', 'description' => __('A sub navigation of all child pages', 'ruventhemes'));
  		parent::__construct('sub_nav', __('CUSTOM: Sub Navigation', 'ruventhemes'), $widget_ops);
  	}
    
    
    
    /* Widget
    ------------------------------------------------------------ */
    
  	function widget($args, $instance) {
  		extract($args);
  		
  		$title = apply_filters('widget_title', (empty($instance['title']) ? __('Sub Navigation', 'ruventhemes') : $instance['title']), $instance, $this->id_base);
  		$depth = $instance['depth'];
  		
      $sub_nav = wp_nav_menu(array(
        'walker'     => new rvn_sub_nav_walker(),
        'echo'       => 0,
        'depth'      => $depth,
        'items_wrap' => '%3$s', // Remove wrapping ul
        'container'  => false
      ));
  		
  		$sub_nav_is_not_empty = (strpos($sub_nav, '<li ') !== false);
  		
  		if($sub_nav_is_not_empty) {
    		echo $before_widget;
    		echo $before_title . $title . $after_title;
    		echo '<div class="widget-content">';
        
        echo $sub_nav;
        
  		  echo '</div>';
        echo $after_widget;
    	}
  	}
    
    
    
    /* Update
    ------------------------------------------------------------ */
    
  	function update($new_instance, $old_instance) {
  		$instance = $old_instance;
  		
  		$instance['title'] = $new_instance['title'];
  		$instance['depth'] = $new_instance['depth'];
  		
  		return $instance;
  	}
  
    
    
    /* Form
    ------------------------------------------------------------ */
    
  	function form($instance) {
  		$instance = wp_parse_args((array)$instance, array(
  		  'title' => __('Sub Navigation', 'ruventhemes'),
  		  'depth' => '2'
  		));
  		
  		extract($instance);
      
      ?>
    		<p>
    		  <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ruventhemes'); ?></label>
    		  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
    		</p>
    		<p>
    		  <label for="<?php echo $this->get_field_id('depth'); ?>"><?php _e('Menu Level Depth:', 'ruventhemes'); ?></label>
      		<select class="widefat" id="<?php echo $this->get_field_id('depth'); ?>" name="<?php echo $this->get_field_name('depth'); ?>">
      		  <option <?php if($depth == '2') echo 'selected="selected"'; ?> value="2">1 Level</option>
      		  <option <?php if($depth == '3') echo 'selected="selected"'; ?> value="3">2 Levels</option>
      		  <option <?php if($depth == '4') echo 'selected="selected"'; ?> value="4">3 Levels</option>
      		</select>
      	</p>
      <?php
  	}
  	
  }
}







/* Register Widget
============================================================ */

if(class_exists('rvn_sub_nav_widget'))
{
  add_action('widgets_init', 'register_sub_nav_widget');
  
  function register_sub_nav_widget() {
  	register_widget('rvn_sub_nav_widget');
  }
}







?>