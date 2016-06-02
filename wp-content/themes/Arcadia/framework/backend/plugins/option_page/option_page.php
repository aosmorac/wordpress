<?php

if(!class_exists( 'option_page' )) {

  class option_page extends option_page_elements {
    
    var $page_data;
    var $fields;
    var $group;
    var $group_options;
    var $non_wrapping_elements;
    
    
    
    /* Constructor
    ------------------------------------------------------------ */
    
    function option_page($page_data, $fields) {
      parent::form_elements();
      
      $this->page_data     = $page_data;
      $this->fields        = $fields;
      $this->group         = false;
      $this->group_options = array();
      $this->non_wrapping_elements = array('table_start', 'table_end',
                                           'group_start', 'group_end');
      
      add_action('wp', array(&$this, 'set_global_default_vars'));
      
  		add_action('admin_init', array(&$this, 'set_update_timestamp'));
      add_action('admin_init', array(&$this, 'register_settings'));
      add_action('admin_init', array(&$this, 'set_default_values'));
      add_action('admin_init', array(&$this, 'add_scripts_and_styles'));
  		add_action('admin_menu', array(&$this, 'add_admin_menu'));
    }
    
    
    
    
    
    
    
    /* Genaral Methods
    ============================================================ */
    
    
    
    /* Set Update Timestamp
    ------------------------------------------------------------ */
    
    // Set a timestamp when options are updated so we can chache 
    //   querys or options in the theme if necissary
    function set_update_timestamp() {
      if((isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true') ||
         (isset($_GET['reset-settings'])   && $_GET['reset-settings']   == 'true')) {
        rvn_update_option('theme-options-last-update', time());
      }
    }
    
    
    
    /* Set Global Default Variables
    ------------------------------------------------------------ */
    
    function set_global_default_vars() {
		  global $rvn;
      foreach($this->fields as $field) {
        if(isset($field['id']) && isset($field['value'])) {
  			  $rvn['default'][$field['id']] = $field['value'];
        }
      }
    }
    
    
    
    /* Register Settings
    ------------------------------------------------------------ */
    
    function register_settings() {
      foreach($this->fields as $field) {
        if(isset($field['id'])) {
      		register_setting(ID_PREFIX.$this->page_data['id'], OPTION_ID_PREFIX.$field['id']);
      	}
    	}
    }
    
    
    
    /* Set Default Values
    ------------------------------------------------------------ */
    
    function set_default_values() {
      foreach($this->fields as $field) {
        if(isset($field['id'])) {
          $option_not_set = '<<--option-not-set-->>';
          $option_id = OPTION_ID_PREFIX . $field['id'];
          $option = get_option($option_id, $option_not_set);
          
          // If option is not set and default value is defined (right after installation)
          if($option == $option_not_set && isset($field['value'])) {
            update_option($option_id, $field['value']);
          }
        }
      }
    }
    
    
    
    /* Add Admin Menu
    ------------------------------------------------------------ */
    
    function add_admin_menu() {
      static $parent_page_id;
      
  		if(!$this->page_data['submenu']) {
  			add_menu_page('Theme Options', 'Theme Options', 'administrator', $this->page_data['id'], array(&$this, 'make_option_page'), null);
  			$parent_page_id = $this->page_data['id'];
  		}
  		else {
  		  add_submenu_page($parent_page_id, $this->page_data['title'], $this->page_data['title'], 'administrator', $this->page_data['id'], array(&$this, 'make_option_page'));
  		}
    }  
    
    
    
    /* Make Option Page
    ------------------------------------------------------------ */
    
    function make_option_page() {
      $output = $this->option_page_start();
      
      foreach($this->fields as $field) {
  			if(method_exists($this, $field['type'])) {
  			  
  			  // Clean field attributes
  			  $field = $this->clean_field_attributes($field);
  			  
  			  // Store devault value
  			  $field['def_value'] = $field['value'];
  			
  			  if(in_array($field['type'], $this->non_wrapping_elements)) {
  			    $output.= $this->$field['type']($field);
  			  }
    			else {
    			  $field['id'] = OPTION_ID_PREFIX.$field['id'];
    			  
    			  // RESET Options
            if(isset($_GET['reset-settings']) && $_GET['reset-settings'] == 'true') {
    			    update_option($field['id'], $field['value']);
      			}
    			  // GET Options
    			  else {
      			  $field['value'] = get_option($field['id'], $field['value']);
      			}
    				$field_output = $this->$field['type']($field);
    				if($field['type'] == 'multitable')
    				  $output.= $field_output;
    			  else
      				$output.= $this->output_wrapper($field, $field_output);
    			}
  			}
      }
      
      $output.= $this->option_page_end();
      
      echo $output;
    }
    
    
  
  }
  
}
  
?>