<?php




/* Contact Widget
============================================================ */

if(!class_exists('rvn_contact_widget'))
{
  class rvn_contact_widget extends WP_Widget {
    
    
    
    /* Constructor
    ------------------------------------------------------------ */
    
  	function __construct() {
  		$widget_ops = array('classname' => 'widget_contact', 'description' => __('Your Contact Data', 'ruventhemes'));
  		parent::__construct('contact', __('CUSTOM: Contact Data', 'ruventhemes'), $widget_ops);
  	}
    
    
    
    /* Widget
    ------------------------------------------------------------ */
    
  	function widget($args, $instance) {
  		extract($args);
  		
  		$title        = apply_filters('widget_title', (empty($instance['title']) ? __('Contact', 'ruventhemes') : $instance['title']), $instance, $this->id_base);
  		$company_name = $instance['company_name'];
  		$address      = $instance['address'];
  		$data_1       = $instance['data_1'];
  		$data_2       = $instance['data_2'];
  		$data_3       = $instance['data_3'];
  		$show_social_links = $instance['show_social_links'];
  		
  		echo $before_widget;
  		echo $before_title . $title . $after_title;
  		
  		echo '<div class="widget-content">';
  		if($company_name) echo '<div class="company-name"><strong>'.$company_name.'</strong></div>';
  		if($address)      echo '<div class="address">'.nl2br($address).'</div>';
  		echo do_shortcode('[spacer size="small"]');
  		if($data_1) echo '<div class="data-1">'.$data_1.'</div>';
  		if($data_2) echo '<div class="data-2">'.$data_2.'</div>';
  		if($data_3) echo '<div class="data-3">'.$data_3.'</div>';
  		
  		if($show_social_links) {
  		  $social_icons = rvn_get_social_icons();
        if(!empty($social_icons)) {
        	echo do_shortcode('[spacer size="small"]');
          echo '<ul class="social-icons">';
          foreach($social_icons as $title => $img_id) {
            echo rvn_get_social_icon_list_element($img_id, $title, 'grey_16');
          }
          echo '</ul>';
        }
  		}
  		echo '</div>';
  		
  		echo $after_widget;
  	}
    
    
    
    /* Update
    ------------------------------------------------------------ */
    
  	function update($new_instance, $old_instance) {
  		$instance = $old_instance;
  		
  		$instance['title']        = $new_instance['title'];
  		$instance['company_name'] = $new_instance['company_name'];
  		$instance['address']      = $new_instance['address']; // wp_filter_post_kses() expects slashed
  		$instance['data_1']       = $new_instance['data_1'];
  		$instance['data_2']       = $new_instance['data_2'];
  		$instance['data_3']       = $new_instance['data_3'];
  		$instance['show_social_links'] = isset($new_instance['show_social_links']);
  		
  		return $instance;
  	}
  
    
    
    /* Form
    ------------------------------------------------------------ */
    
  	function form($instance) {
  		$instance = wp_parse_args((array)$instance, array(
  		  'title'        => __('Contact', 'ruventhemes'),
  		  'company_name' => '',
  		  'address'      => '',
  		  'data_1'       => '',
  		  'data_2'       => '',
  		  'data_3'       => ''
  		));
  		
  		extract($instance);
      
      ?>
    		<p>
    		  <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ruventhemes'); ?></label>
    		  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
    		</p>
    		<p>
    		  <label for="<?php echo $this->get_field_id('company_name'); ?>"><?php _e('Company Name:', 'ruventhemes'); ?></label>
    		  <input class="widefat" id="<?php echo $this->get_field_id('company_name'); ?>" name="<?php echo $this->get_field_name('company_name'); ?>" type="text" value="<?php echo esc_attr($company_name); ?>" />
    		</p>
    		<p>
    		  <label for="<?php echo $this->get_field_id('address'); ?>"><?php _e('Address:', 'ruventhemes'); ?></label>
      		<textarea class="widefat" rows="3" cols="10" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>"><?php echo $address; ?></textarea>
      	</p>
    		<p>
    		  <label for="<?php echo $this->get_field_id('data_1'); ?>"><?php _e('Data Field 1:', 'ruventhemes'); ?></label>
    		  <input class="widefat" id="<?php echo $this->get_field_id('data_1'); ?>" name="<?php echo $this->get_field_name('data_1'); ?>" type="text" value="<?php echo esc_attr($data_1); ?>" />
    		</p>
    		<p>
    		  <label for="<?php echo $this->get_field_id('data_2'); ?>"><?php _e('Data Field 2:', 'ruventhemes'); ?></label>
    		  <input class="widefat" id="<?php echo $this->get_field_id('data_2'); ?>" name="<?php echo $this->get_field_name('data_2'); ?>" type="text" value="<?php echo esc_attr($data_2); ?>" />
    		</p>
    		<p>
    		  <label for="<?php echo $this->get_field_id('data_3'); ?>"><?php _e('Data Field 3:', 'ruventhemes'); ?></label>
    		  <input class="widefat" id="<?php echo $this->get_field_id('data_3'); ?>" name="<?php echo $this->get_field_name('data_3'); ?>" type="text" value="<?php echo esc_attr($data_3); ?>" />
    		</p>
    		<!--<p>
    		  <input id="<?php echo $this->get_field_id('show_social_links'); ?>" name="<?php echo $this->get_field_name('show_social_links'); ?>" type="checkbox" <?php checked(isset($instance['show_social_links']) ? $instance['show_social_links'] : 0); ?> />
    		  <label for="<?php echo $this->get_field_id('show_social_links'); ?>"><?php _e('Show Social Icons', 'ruventhemes'); ?></label>
    		</p>-->
      <?php
  	}
  	
  }
}







/* Register Widget
============================================================ */

if(class_exists('rvn_contact_widget'))
{
  add_action('widgets_init', 'register_contact_widget');
  
  function register_contact_widget() {
  	register_widget('rvn_contact_widget');
  }
}







?>