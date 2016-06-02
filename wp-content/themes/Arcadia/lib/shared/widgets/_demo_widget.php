<?php




/* Demo Widget
============================================================ */

if(!class_exists('rvn_demo_widget'))
{
  class rvn_demo_widget extends WP_Widget {
    
    
    
    /* Constructor
    ------------------------------------------------------------ */
    
  	function __construct() {
  		$widget_ops = array('classname' => 'widget_demo', 'description' => __('Your demo widget', 'ruventhemes'));
  		parent::__construct('demo', __('CUSTOM: Demo Widget', 'ruventhemes'), $widget_ops);
  	}
    
    
    
    /* Widget
    ------------------------------------------------------------ */
    
  	function widget($args, $instance) {
  		extract($args);
  		
  		$title    = apply_filters('widget_title', (empty($instance['title']) ? __('Default Title', 'ruventhemes') : $instance['title']), $instance, $this->id_base);
  		$text     = $instance['text'];
  		$textarea = $instance['textarea'];
  		$check    = $instance['check'];
  		$select   = $instance['select'];
  		$radio    = $instance['radio'];
  		
  		echo $before_widget;
  		echo $before_title . $title . $after_title;
  		
  		echo '<div class="widget-content">';
      
      // Widget output here
  		
  		echo '</div>';
  		
  		echo $after_widget;
  	}
    
    
    
    /* Update
    ------------------------------------------------------------ */
    
  	function update($new_instance, $old_instance) {
  		$instance = $old_instance;
  		
  		$instance['title']    = $new_instance['title'];
  		$instance['text']     = $new_instance['text'];
  		$instance['textarea'] = $new_instance['textarea'];
  		$instance['check']    = isset($new_instance['check']);
  		$instance['select']   = $new_instance['select'];
  		$instance['radio']    = $new_instance['radio'];
  		
  		return $instance;
  	}
  
    
    
    /* Form
    ------------------------------------------------------------ */
    
  	function form($instance) {
  		$instance = wp_parse_args((array)$instance, array(
  		  'title'    => __('Default Title', 'ruventhemes'),
  		  'text'     => '',
  		  'textarea' => '',
  		  'check'    => true,
  		  'select'   => 'option_1',
  		  'radio'    => 'option_1'
  		));
  		
  		extract($instance);
      
      ?>
    		<p>
    		  <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ruventhemes'); ?></label>
    		  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
    		</p>
    		<p>
    		  <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Text:', 'ruventhemes'); ?></label>
    		  <input class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" type="text" value="<?php echo $text; ?>" />
    		</p>
    		<p>
    		  <label for="<?php echo $this->get_field_id('textarea'); ?>"><?php _e('Textarea:', 'ruventhemes'); ?></label>
      		<textarea class="widefat" rows="3" cols="10" id="<?php echo $this->get_field_id('textarea'); ?>" name="<?php echo $this->get_field_name('textarea'); ?>"><?php echo $textarea; ?></textarea>
      	</p>
    		<p>
    		  <input id="<?php echo $this->get_field_id('check'); ?>" name="<?php echo $this->get_field_name('check'); ?>" type="checkbox" <?php checked(isset($check) ? $check : 0); ?> />
    		  <label for="<?php echo $this->get_field_id('check'); ?>"><?php _e('Check', 'ruventhemes'); ?></label>
    		</p>
    		<p>
    		  <label for="<?php echo $this->get_field_id('select'); ?>"><?php _e('Select:', 'ruventhemes'); ?></label>
      		<select class="widefat" id="<?php echo $this->get_field_id('select'); ?>" name="<?php echo $this->get_field_name('select'); ?>">
      		  <option <?php if($select == 'option_1') echo 'selected="selected"'; ?> value="option_1">Option 1</option>
      		  <option <?php if($select == 'option_2') echo 'selected="selected"'; ?> value="option_2">Option 2</option>
      		  <option <?php if($select == 'option_3') echo 'selected="selected"'; ?> value="option_3">Option 3</option>
      		</select>
      	</p>
    		<p>
    		  <label>Radio:</label>
    		  <br/>
    		  <input id="<?php echo $this->get_field_id('radio'); ?>_1" name="<?php echo $this->get_field_name('radio'); ?>" type="radio" value="option_1" <?php if($radio == 'option_1') echo 'checked="checked"'; ?> />
    		  <label for="<?php echo $this->get_field_id('radio'); ?>_1"><?php _e('Option 1', 'ruventhemes'); ?></label>
    		  <br/>
    		  <input id="<?php echo $this->get_field_id('radio'); ?>_2" name="<?php echo $this->get_field_name('radio'); ?>" type="radio" value="option_2" <?php if($radio == 'option_2') echo 'checked="checked"'; ?> />
    		  <label for="<?php echo $this->get_field_id('radio'); ?>_2"><?php _e('Option 2', 'ruventhemes'); ?></label>
    		  <br/>
    		  <input id="<?php echo $this->get_field_id('radio'); ?>_3" name="<?php echo $this->get_field_name('radio'); ?>" type="radio" value="option_3" <?php if($radio == 'option_3') echo 'checked="checked"'; ?> />
    		  <label for="<?php echo $this->get_field_id('radio'); ?>_3"><?php _e('Option 3', 'ruventhemes'); ?></label>
    		</p>
      <?php
  	}
  	
  }
}







/* Register Widget
============================================================ */

if(class_exists('rvn_demo_widget'))
{
  add_action('widgets_init', 'register_demo_widget');
  
  function register_demo_widget() {
  	register_widget('rvn_demo_widget');
  }
}







?>