<?php




/* Flickr Widget
============================================================ */

if(!class_exists('rvn_flickr_widget'))
{
  class rvn_flickr_widget extends WP_Widget {
    
    
    
    /* Constructor
    ------------------------------------------------------------ */
    
  	function __construct() {
  		$widget_ops = array('classname' => 'widget_flickr', 'description' => __('Flickr Picture Stream', 'ruventhemes'));
  		parent::__construct('flickr', __('CUSTOM: Flickr', 'ruventhemes'), $widget_ops);
  	}
    
    
    
    /* Widget
    ------------------------------------------------------------ */
    
  	function widget($args, $instance) {
  		extract($args);
  		
  		$title     = apply_filters('widget_title', (empty($instance['title']) ? __('Flickr Stream', 'ruventhemes') : $instance['title']), $instance, $this->id_base);
  		$flickr_id = $instance['flickr_id'];
  		$source    = $instance['source'];
  		$display   = $instance['display'];
  		$number    = $instance['number'];
  		
  		echo $before_widget;
  		echo $before_title . $title . $after_title;
  		
  		echo '<div class="widget-content">';
      
      echo '<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?';
        echo $source.'='.$flickr_id.'&amp;';
        echo 'count='.$number.'&amp;';
        echo 'display='.$display.'&amp;';
        echo 'layout=x&amp;';
        echo 'source='.$source.'&amp;';
        echo 'size=s&amp;';
      echo '"></script>';
  		
  		echo '</div>';
  		
  		echo $after_widget;
  	}
    
    
    
    /* Update
    ------------------------------------------------------------ */
    
  	function update($new_instance, $old_instance) {
  		$instance = $old_instance;
  		
  		$instance['title']     = $new_instance['title'];
  		$instance['flickr_id'] = $new_instance['flickr_id'];
  		$instance['source']    = $new_instance['source'];
  		$instance['display']   = $new_instance['display'];
  		$instance['number']    = $new_instance['number'];
  		
  		return $instance;
  	}
  
    
    
    /* Form
    ------------------------------------------------------------ */
    
  	function form($instance) {
  		$instance = wp_parse_args((array)$instance, array(
  		  'title'     => __('Flickr Stream', 'ruventhemes'),
  		  'flickr_id' => '65393447@N00',
  		  'source'    => 'user',
  		  'display'   => 'latest',
  		  'number'    => '9'
  		));
  		
  		extract($instance);
      
      ?>
    		<p>
    		  <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ruventhemes'); ?></label>
    		  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
    		</p>
    		<p>
    		  <label for="<?php echo $this->get_field_id('flickr_id'); ?>"><?php _e('Flickr ID (<a href="http://idgettr.com/">get ID here</a>):', 'ruventhemes'); ?></label>
    		  <input class="widefat" id="<?php echo $this->get_field_id('flickr_id'); ?>" name="<?php echo $this->get_field_name('flickr_id'); ?>" type="text" value="<?php echo $flickr_id; ?>" />
    		</p>
    		<p>
    		  <label>Source:</label>
    		  <br/>
    		  <input id="<?php echo $this->get_field_id('source'); ?>_1" name="<?php echo $this->get_field_name('source'); ?>" type="radio" value="user" <?php if($source == 'user') echo 'checked="checked"'; ?> />
    		  <label for="<?php echo $this->get_field_id('source'); ?>_1"><?php _e('User', 'ruventhemes'); ?></label>
    		  <br/>
    		  <input id="<?php echo $this->get_field_id('source'); ?>_2" name="<?php echo $this->get_field_name('source'); ?>" type="radio" value="group" <?php if($source == 'group') echo 'checked="checked"'; ?> />
    		  <label for="<?php echo $this->get_field_id('source'); ?>_2"><?php _e('Group', 'ruventhemes'); ?></label>
    		</p>
    		<p>
    		  <label>Display:</label>
    		  <br/>
    		  <input id="<?php echo $this->get_field_id('display'); ?>_1" name="<?php echo $this->get_field_name('display'); ?>" type="radio" value="latest" <?php if($display == 'latest') echo 'checked="checked"'; ?> />
    		  <label for="<?php echo $this->get_field_id('display'); ?>_1"><?php _e('Latest Pictures', 'ruventhemes'); ?></label>
    		  <br/>
    		  <input id="<?php echo $this->get_field_id('display'); ?>_2" name="<?php echo $this->get_field_name('display'); ?>" type="radio" value="random" <?php if($display == 'random') echo 'checked="checked"'; ?> />
    		  <label for="<?php echo $this->get_field_id('display'); ?>_2"><?php _e('Random Pictures', 'ruventhemes'); ?></label>
    		</p>
    		<p>
    		  <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of pictures to show:', 'ruventhemes'); ?></label>
      		<select id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>">
      		  <option <?php if($number == '3') echo 'selected="selected"'; ?> value="3">3</option>
      		  <option <?php if($number == '6') echo 'selected="selected"'; ?> value="6">6</option>
      		  <option <?php if($number == '9') echo 'selected="selected"'; ?> value="9">9</option>
      		</select>
      	</p>
      <?php
  	}
  	
  }
}







/* Register Widget
============================================================ */

if(class_exists('rvn_flickr_widget'))
{
  add_action('widgets_init', 'register_flickr_widget');
  
  function register_flickr_widget() {
  	register_widget('rvn_flickr_widget');
  }
}







?>