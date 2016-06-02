<?php

if(!class_exists( 'option_page_elements' )) {

  class option_page_elements extends form_elements {
    
    
    
    /* Constructor
    ------------------------------------------------------------ */
    
    function option_page_elements() {
      add_action('admin_init', array(&$this, 'add_scripts_and_styles'));
    }
    
    
    
    /* Add Scripts and Styles
    ------------------------------------------------------------ */
    
    function add_scripts_and_styles() {
      $current_file_name = basename($_SERVER['PHP_SELF']);
      if($current_file_name == "admin.php") {
        parent::add_scripts_and_styles();
        add_thickbox();
      	wp_enqueue_script('media-upload');
    		wp_enqueue_style('fw_option_page_elements_css', FW_ADMIN_PLUGINS_URL.'/option_page/option_page_elements/option_page_elements.css');
    	}
    }
    
    
    
    
    /* Output Wrapper
    ------------------------------------------------------------ */
    
    function output_wrapper($options, $content) {
      $output = '';
      
      // On default
      if(!$this->group) {
        $output.= '<tr valign="top" id="'.$options['id'].'-tr"><th scope="row">';
        $output.= '<label for="'.$options['id'].'">'.$options['title'].'</label>';
        $output.= '</th><td>';
      }
      
      // When grouped
      if($this->group && !($options['type'] == 'group_start' || $options['type'] == 'group_end')) {
        $no_line_break = '';
        if($this->group_options['no_line_break'])
          $no_line_break = 'style="float:left; margin-right: 10px;"';
        $output.= '<div id="'.$options['id'].'-wrapper" class="rvn_option-wrapper rvn_group-option-wrapper" '.$no_line_break.'>';
      }
      // On default
      else {
        $output.= '<div id="'.$options['id'].'-wrapper" class="rvn_option-wrapper">';
      }
      
      // Output description if not grouped
      if(!empty($options['desc']) && !$this->group && $options['type'] != 'html')
    	  $output.= '<div class="rvn_option-description">'.$options['desc'].'</div>';
      
      // Output content
      $output.= $content;
        
      $output.= '</div><!-- .rvn_option-wrapper -->';
    	
    	// On default close wrapper and table row
    	if(!$this->group)
        $output.= '</td></tr>';
      
      return $output;
    }
    
    
    
    /* Items
    ------------------------------------------------------------ */
    
  	function items($options) {
  	  $vals = explode('::', $options['value']);
  	  
  	  $output = '<span class="items-field">';
  	  $output.= '<input type="hidden" id="'.$options['id'].'" class="value" name="'.$options['id'].'" value="'.$options['value'].'" /> ';
  	  $output.= '<input type="text" id="'.$options['id'].'-creator" class="item-creator-textfield" name="'.$options['id'].'_creator" size="'.$options['size'].'" /> ';
  	  $output.= '<a href="#" class="item-creator-button button">'.$options['label'].'</a>';
  	  $output.= '<br/><br/>';
  	  $output.= '<div id="'.$options['id'].'-showcase" class="item-showcase"><ul>';
  	  foreach($vals as $val) {
  	    if($val) {
    	    $output.= "<li><span class='value'>{$val}</span> (<a href='#' class='remove-link'>Remove</a>)</li>";
    	  }
  	  }
  	  $output.= '</ul></div>';
  	  $output.= '</span>';
  	    	  
  		return $output;
  	}
    
    
    
    /* Option Page Start
    ------------------------------------------------------------ */
    
    function option_page_start() {
      $documentation_url = isset($this->page_data['documentation_url']) ? $this->page_data['documentation_url'] : false;
      
      $output = '<div id="rvn_option-page" class="wrap '.$this->page_data['id'].'-options-page">';
      $output.= '<div class="header">';
      if($documentation_url) {
        $output.= "<a href='$documentation_url' target='_blank' id='documentation-link'>Documentation</a>";
      }
      $output.= '<div id="icon-options-general" class="icon32"><br/></div>';
      $output.= '<h2>'.$this->page_data['title'].'</h2>';
      $output.= '</div>';
      
      $update_msg = '';
      if(isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true') {
        $update_msg = 'Settings saved.';
        unset($_GET['reset-settings']);
      }
      elseif(isset($_GET['reset-settings']) && $_GET['reset-settings'] == 'true') {
        $update_msg = 'Settings reset.';
      }
        
      if($update_msg) {
        $output.= '<div id="setting-error-settings_updated" class="updated settings-error"><p><strong>'.$update_msg.'</strong></p></div>';
      }
      
      $output.= '<form id="theme-options-form" action="options.php" method="post">';
      
      ob_start();
      settings_fields(ID_PREFIX.$this->page_data['id']);
      $output.= ob_get_contents();
      ob_end_clean();
      
      return $output;
    }
    
    
    
    /* Option Page End
    ------------------------------------------------------------ */
    
    function option_page_end() {
      $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?page='.$_GET['page'];
      
      $output = '<p class="submit">';
      $output.= '<input type="submit" name="Submit" class="button-primary" value="Save Changes" /> ';
      $output.= '<a href="'.$url.'&reset-settings=true" onclick="return(confirm(\'Do you really want to reset all settings on this page to their default state?\'));" title="Reset all settings of this page to their default state" class="reset-link">Reset Settings</a>';
      $output.= '</p>';
      $output.= '</form>';
      $output.= '</div><!-- END .wrap -->';
      
      return $output;
    }
    
    
    
    /* Table Start
    ------------------------------------------------------------ */
    
    function table_start($options) {
      if(empty($options['id']))    $options['id']    = $this->page_data['id'];
      if(empty($options['title'])) $options['title'] = $this->page_data['title'];
      
      $table_id = ID_PREFIX.$options['id'].'-option-table';
      
      $output = '<div id="'.$table_id.'-wrapper" class="rvn_option-table-wrapper '.$options['class'].'">';
      $output.= '  <table id="'.$table_id.'" class="widefat rvn_option-table">';
      $output.= '    <thead>';
      $output.= '      <tr><th colspan="2">'.$options['title'].'</th></tr>';
      $output.= '    </thead>';
      $output.= '    <tbody>';
      
      return $output;
    }
    
    
    
    /* Table End
    ------------------------------------------------------------ */
    
    function table_end($options) {
      $output = '</tbody></table></div>';
      $output.= ($options['divider']) ? '<div class="rvn_divider"></div>' : '';
      return $output;
    }
    
    
    
    /* Group Start
    ------------------------------------------------------------ */
    
    function group_start($options) {
      $this->group = true;
      $this->group_options['no_line_break'] = $options['no_line_break'];
      
      $output = '<tr valign="top" id="rvn_'.$options['id'].'-tr"><th scope="row">'.$options['title'].'</th><td>';
      
      // Output description
      if(!empty($options['desc'])) {
      	$output.= '<div class="rvn_option-description">'.$options['desc'].'</div>';
      }
      
    	return $output;
    }
    
    
    
    /* Group End
    ------------------------------------------------------------ */
    
    function group_end() {
      $this->group = false;
      return '</td></tr>';
    }
    
    
    
    /* Multitable Start
    ------------------------------------------------------------ */
    
    function multitable($options) {
      $output = '';
      $output.= '<input type="hidden" id="'.$options['id'].'" class="multitable-data" name="'.$options['id'].'" value="'.$options['value'].'" />';
      
      $data = $this->get_multitable_data($options['value']);
      $page_counter = (count($data) == 0 ? 1 : count($data));
  
      for($i = 0; $i <= $page_counter; $i++) {
        $settings = empty($data[$i-1]) ? '' : $data[$i-1];
        $default_multitable = ($i == 0) ? true : false;
        
        if($default_multitable)
          $output.= '<table id="default-multitable" class="widefat rvn_option-table">';
        else
          $output.= '<table class="widefat multitable rvn_option-table">';
        
        $output.= '<thead>';
        $output.= '<tr><th colspan="2">'.$options['title'].' <span class="multitable-number">'.$i.'</span></th></tr>';
        $output.= '</thead>';
        
        $output.= '<tfoot>';
        $output.= '<tr><th colspan="2">';
        $output.= '<a href="#" class="clone-link">+ Add '.$options['title'].'</a> ';
        $output.= '<a href="#" class="remove-link">- Remove '.$options['title'].'</a>';
        $output.= '</th></tr>';
        $output.= '</tfoot>';
        
        $output.= '<tbody>';
        
        foreach($options['fields'] as $field) {
          if(method_exists($this, $field['type'])) {
            $field = $this->clean_field_attributes($field);
            if(!$default_multitable && $settings) {
              $field['def_value'] = $field['value'];
              $field['value'] = $this->get_multitable_value($settings, $field['id'], $i);
            }
            $field['id'] = OPTION_ID_PREFIX.$field['id'].'_'.$i;
            
            $toggle_states = array('show', 'hide');
            foreach($toggle_states as $toggle_state) {
              // If toggle state is set
              if(!empty($field[$toggle_state])) {
                foreach($field[$toggle_state] as $trigger => $target_ids) {
                  $target_ids = str_replace('$i', $i, $target_ids);
                  $field[$toggle_state][$trigger] = $target_ids;
                }
              }
            }
            
            $field_output = $this->$field['type']($field);
            if($field['type'] != 'group_end')
        			$output.= $this->output_wrapper($field, $field_output);
        		else
        		  $output.= $field_output;
          }
  		  }
        
        $output.= '</tbody>';
        $output.= '</table>';
      }
      
      return $output;
    }
    
    
    
    /* Get Multitable Value
    ------------------------------------------------------------ */
    
    function get_multitable_value($settings, $id, $i) {
      if(isset($settings[OPTION_ID_PREFIX.$id.'_'.$i])) {
        return $settings[OPTION_ID_PREFIX.$id.'_'.$i];
      }
      elseif(isset($rvn['default'][$id])) {
        global $rvn;
        return $rvn['default'][$id];
      }
      else {
        return '';
      }
    }
    
    
    
    /* Get Multitable Data
    ------------------------------------------------------------ */
    
    function get_multitable_data($data) {
      $pages    = array();
      $settings = array();
      $pages_array = array_filter(explode('$$$', $data));
      foreach($pages_array as $key => $value) {
        $page_settings_pairs_array = explode('&', $value);
        foreach($page_settings_pairs_array as $key => $value) {
          $value = str_replace('&', '', $value);
          $page_settings_array = explode('=', $value);
          if(!empty($page_settings_array[0])) {
            $settings[$page_settings_array[0]] = $page_settings_array[1];
          }
        }
        
        $pages[] = $settings;
      }
      
      return $pages;
    }
    
    
    
  }
  
}

?>