<?php




/* Latest Work Widget
============================================================ */

if(!class_exists('rvn_latest_work'))
{
  class rvn_latest_work extends WP_Widget {
    
    
    
    /* Constructor
    ------------------------------------------------------------ */
  
  	function __construct() {
  		$widget_ops = array('classname' => 'widget_latest_work', 'description' => __("Shows your latest portfolio entries", 'ruventhemes'));
  		
  		parent::__construct('latest-work', __('CUSTOM: Latest Work', 'ruventhemes'), $widget_ops);
  		
  		add_action('save_post',    array(&$this, 'flush_widget_cache'));
  		add_action('deleted_post', array(&$this, 'flush_widget_cache'));
  		add_action('switch_theme', array(&$this, 'flush_widget_cache'));
  	}
    
    
    
    /* Widget
    ------------------------------------------------------------ */
  
  	function widget($args, $instance) {
  		$cache = wp_cache_get('widget_latest_work', 'widget');
  
  		if(!is_array($cache))
  			$cache = array();
  
  		if(isset($cache[$args['widget_id']])) {
  			echo $cache[$args['widget_id']];
  			return;
  		}
  
  		ob_start();
  		extract($args);
  
  		$title  = apply_filters('widget_title', empty($instance['title']) ? __('Latest Work', 'ruventhemes') : $instance['title'], $instance, $this->id_base);
  		$number = (int)$instance['number'];
  		$show_as_list = $instance['show_as_list'];
  		
  		if(!$number)         $number = 10;
  		elseif($number < 1)  $number = 1;
  		elseif($number > 15) $number = 15;
  
  		$r = new WP_Query(array(
  		  'post_type'   => 'portfolio',
  		  'showposts'   => $number,
  		  'nopaging'    => 0,
  		  'post_status' => 'publish'
  		));
  		
  		if($r->have_posts()):
    		echo $before_widget;
    		if($title) echo $before_title . $title . $after_title;
    		echo '<div class="widget-content">';
    		echo ($show_as_list) ? '<ul class="no-images">' : '<ul class="with-images">';
    		while($r->have_posts()) {
    		  $r->the_post();
    		  if($show_as_list) {
    		    echo '<li><a href="'.get_permalink().'">'. get_the_title() .'</a></li>';
    		  }
    		  else {
    		    echo '<li>';
    		    echo '<div class="post-image">';
    		    echo '<a href="'.get_permalink().'" class="small framed">';
    		    if(has_post_thumbnail())
      		    the_post_thumbnail();
      		  else
      		    echo '<img src="'.IMAGES_URL.'/thumbnail-placeholder.gif" />';
    		    echo '</a></div>';
    		    echo '<div class="post-content">';
    		    echo '<a href="'.get_permalink().'" class="post-title">'. get_the_title() .'</a>';
    		    echo '<a href="'.get_month_link(get_the_date('Y'), get_the_date('m')).'" class="post-date">';
            echo   '<time datetime="'.get_the_date('c').'" pubdate>'.get_the_date().'</time>';
            echo '</a>';
    		    echo '</div>';
    		    echo '</li>';
    		  }
    		}
    		echo '</ul>';
    		echo '</div>';
    		echo $after_widget;
      
  		// Reset the global $the_post as this query will have stomped on it
  		wp_reset_postdata();
  		endif;
      
  		$cache[$args['widget_id']] = ob_get_flush();
  		wp_cache_set('widget_latest_work', $cache, 'widget');
  	}
    
    
    
    /* Update
    ------------------------------------------------------------ */
  
  	function update($new_instance, $old_instance) {
  		$instance = $old_instance;
  		
  		$instance['title']  = $new_instance['title'];
  		$instance['number'] = (int)$new_instance['number'];
  		$instance['show_as_list'] = isset($new_instance['show_as_list']);
  		
  		$this->flush_widget_cache();
  
  		$alloptions = wp_cache_get('alloptions', 'options');
  		if(isset($alloptions['widget_latest_work']))
  			delete_option('widget_latest_work');
  
  		return $instance;
  	}
    
    
    
    /* Flush Widget Cache
    ------------------------------------------------------------ */
  	
  	function flush_widget_cache() {
  		wp_cache_delete('widget_latest_work', 'widget');
  	}
    
    
    
    /* Form
    ------------------------------------------------------------ */
  
  	function form($instance) {
  		$instance = wp_parse_args((array)$instance, array(
  		  'title'    => __('Latest Work', 'ruventhemes'),
  		  'number'   => 3
  		));
  		
  		extract($instance);
  		
  		if(!is_numeric($number)) $number = 3;
  			
      ?>
    		<p>
    		  <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ruventhemes'); ?></label>
    		  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
    		</p>
    		<p>
    		  <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of entries to show:', 'ruventhemes'); ?></label>
    		  <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
    		</p>
    		<p>
    		  <input id="<?php echo $this->get_field_id('show_as_list'); ?>" name="<?php echo $this->get_field_name('show_as_list'); ?>" type="checkbox" <?php checked(isset($instance['show_as_list']) ? $instance['show_as_list'] : 0); ?> />
    		  <label for="<?php echo $this->get_field_id('show_as_list'); ?>"><?php _e('Show as list', 'ruventhemes'); ?></label>
    		</p>
      <?php
  	}
  	
  }
}







/* Register Widget
============================================================ */

if(class_exists('rvn_latest_work'))
{
  add_action('widgets_init', 'register_latest_work_widget');
  
  function register_latest_work_widget() {
  	register_widget('rvn_latest_work');
  }
}







?>