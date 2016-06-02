<?php

class meta_box extends form_elements {
  
  var $box_data;
  var $fields;
  var $group;
  
  
  
  /* Constructor
  ------------------------------------------------------------ */
  
  function meta_box($box_data, $fields) {
    parent::form_elements();
		$this->box_data = $box_data;
		$this->fields   = $fields;
    $this->group    = false;
		
		add_action('admin_menu', array(&$this, 'add_scripts_and_styles'));
		add_action('admin_menu', array(&$this, 'create_meta_box'));
		add_action('save_post',  array(&$this, 'save_data'));
  }
  
  
  
  /* Add Scripts and Styles
  ------------------------------------------------------------ */
  
  function add_scripts_and_styles() {
    $current_file_name = basename($_SERVER['PHP_SELF']);
    if($current_file_name == "page.php" || 
  		 $current_file_name == "page-new.php" ||  
  		 $current_file_name == "post-new.php" || 
  		 $current_file_name == "post.php" || 
  		 $current_file_name == "media-upload.php") {
      parent::add_scripts_and_styles();
      wp_enqueue_style('fw_meta_box_css', FW_ADMIN_PLUGINS_URL.'/meta_box/meta_box.css');
		}
  }
  
  
  
  /* Create Meta Box
  ------------------------------------------------------------ */
  
  function create_meta_box() {
		foreach($this->box_data['post_types'] as $post_type) {
			add_meta_box( 	
				$this->box_data['id'], 
				$this->box_data['title'],
				array(&$this, 'make_fields'),
				$post_type,
				$this->box_data['context'], 
				$this->box_data['priority']
			);
		}
  }
  
  
  
  /* Make Fields
  ------------------------------------------------------------ */
  
  function make_fields() {
    global $post;
    $output = '';

		foreach($this->fields as $field) {				
			if(method_exists($this, $field['type'])) {
			  $field = $this->clean_field_attributes($field);
				$field_value = rvn_get_post_meta($post->ID, $field['id']);
        if(!empty($field_value))
				  $field['value'] = $field_value;
				$field_output = $this->$field['type']($field);
				if($field['type'] == 'group_start' || $field['type'] == 'group_end')
				  $output.= $field_output;
				else
  				$output.= $this->output_wrapper($field, $field_output);
			}
		}
		
		$output.='<input type="hidden" name="'.$this->box_data['id'].'_noncename" id="'.$this->box_data['id'].'_noncename" value="'.wp_create_nonce(plugin_basename(__FILE__)).'" />';  
		echo $output;
  }
  
  
  
  /* Save Meta Box Data
  ------------------------------------------------------------ */
  
  function save_data() {
		$post_id   = isset($_POST['post_ID']) ? $_POST['post_ID'] : false;
		$post_type = isset($_POST['post_type']) ? $_POST['post_type'] : false;
		
    // Reject on "New Page" or during Auto Save    
    if((!$post_id || defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) ||
       !in_array($post_type, $this->box_data['post_types']))
      return $post_id;
		
		foreach($this->fields as $field) {
		  if($field['type'] != 'html' && $field['type'] != 'group_start' && $field['type'] != 'group_end') {
    		$field_id = POST_META_ID_PREFIX.$field['id'];
    		
  			if((isset($_POST[$this->box_data['id'].'_noncename']) && !wp_verify_nonce($_POST[$this->box_data['id'].'_noncename'], plugin_basename(__FILE__)))
  			   || ($post_type == 'page' && !current_user_can('edit_page', $post_id))
  			   || (!current_user_can('edit_post', $post_id))) {
  				return $post_id;
  			}
  			
  			// To avoid the deletion of checkbox data which causes notice of undefined index
  			if(($field['type'] == 'checkbox' || $field['type'] == 'radio') && !isset($_POST[$field['id']]))
  			  $data = 'false';
  			else
  			  $data = htmlspecialchars($_POST[$field['id']], ENT_QUOTES, 'UTF-8');
  			
  			if(get_post_meta($post_id, $field_id) == "")
  			  add_post_meta($post_id, $field_id, $data, true);
  			
  			elseif($data != get_post_meta($post_id, $field_id, true))
  			  update_post_meta($post_id, $field_id, $data);
  			
  			elseif($data == "")
  			  delete_post_meta($post_id, $field_id, get_post_meta($post_id, $field_id, true));			
  		}
		}
	}
  
  
  
  /* Output Wrapper
  ------------------------------------------------------------ */
  
  function output_wrapper($options, $content) {
    $output = '';
    
    if(!$this->group)
      $output.= '<div id="'.$options['id'].'-meta-field" class="rvn_meta-field">';
    
    if(!empty($options['title']) && !$this->group) {
      $output.= '<div class="rvn_meta-field-title">';
    	$output.= '<label for="'.$options['id'].'">'.$options['title'].'</label>';
    	$output.= '</div>';
    }
		
    if(!empty($options['desc']) && !$this->group && $options['type'] != 'html')
    	$output.= '<div class="rvn_meta-field-description">'.$options['desc'].'</div>';
		
    // When grouped
    if($this->group)
      $output.= '<div id="'.$options['id'].'-wrapper" class="rvn_meta-field-content-wrapper rvn_meta-group-field-content-wrapper">';
    // On default
    else
      $output.= '<div id="'.$options['id'].'-wrapper" class="rvn_meta-field-content-wrapper">';
		
		$output.= $content;
		
  	$output.= '</div><!-- END .rvn_meta-field-content-wrapper -->';
  	
    if(!$this->group)
  	  $output.= '</div><!-- END .rvn_meta-field -->';
  	
	  return $output;
  }
    
    
    
  /* Group Start
  ------------------------------------------------------------ */
  
  function group_start($options) {
    $this->group = true;
    
    $output = '<div id="'.$options['id'].'-meta-field" class="rvn_meta-field rvn_meta-field-group">';
    
    // Output title
    if(!empty($options['title'])) {
      $output.= '<div class="rvn_meta-field-title">';
    	$output.= '<label for="'.$options['id'].'">'.$options['title'].'</label>';
    	$output.= '</div>';
    }
    
    // Output description
    if(!empty($options['desc']))
    	$output.= '<div class="rvn_meta-field-description">'.$options['desc'].'</div>';
    
  	return $output;
  }
  
  
  
  /* Group End
  ------------------------------------------------------------ */
  
  function group_end() {
    $this->group = false;
    return '</div><!-- END .rvn_meta-field-group --> ';
  }
  
}

?>