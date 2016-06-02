<?php

if(!class_exists( 'form_elements' )) {

  class form_elements {

    var $field_attributes_to_clean;



    /* Constructor
    ------------------------------------------------------------ */

    function form_elements() {
      $this->field_attributes_to_clean = array('title', 'desc', 'id',
                                               'value', 'def_value', 'size',
                                               'show',  'hide', 'remove',
                                               'no_prompt', 'no_line_break',
                                               'class', 'divider', 'icon_url');

      add_action('admin_init', array(&$this, 'add_scripts_and_styles'));
    }



    /* Add Default Scripts and Styles
    ------------------------------------------------------------ */

    function add_scripts_and_styles() {
      // Farbtastic jQuery Plugin
  		wp_enqueue_script('fw_farbtastic_js', FW_ADMIN_PLUGINS_URL.'/form_elements/farbtastic/farbtastic.js');
  		wp_enqueue_style('fw_farbtastic_css', FW_ADMIN_PLUGINS_URL.'/form_elements/farbtastic/farbtastic.css');
  		// Shared
      wp_enqueue_script('fw_form_elements_js', FW_ADMIN_PLUGINS_URL.'/form_elements/form_elements.js');
  		wp_enqueue_style('fw_form_elements_css', FW_ADMIN_PLUGINS_URL.'/form_elements/form_elements.css');
    }



    /* Clean Options
    ------------------------------------------------------------ */

    function clean_field_attributes($options) {
      foreach($this->field_attributes_to_clean as $option_attr) {
        if(!isset($options[$option_attr])) {
          $options[$option_attr]  = '';
        }
      }

      return $options;
    }



    /* Get Field JavaScript
    ------------------------------------------------------------ */

    function get_field_javascript($options) {
      $output = '';

  	  //
  	  // Text, ColorPicker, Select (QuickPick)
  	  //
  	  if($options['type'] == 'color_picker' || $options['type'] == 'text' || $options['type'] == 'select') {
  	    if(!empty($options['quickpick'])) {
  	      $trigger_id = '#'.$options['id'];
  	      $output.= "quickpick_fields_by_text_or_select({'{$trigger_id}': '";
  	      $target_ids = array();
  	      foreach($options['quickpick'] as $target) {
  	        $target_ids[] = '#'.OPTION_ID_PREFIX.$target;
  	      }
  	      $output.= implode(',', $target_ids);
  	      $output.= "'});";
  	    }
  	  }

  	  //
  	  // Checkbox (Toggler)
  	  //
  	  if($options['type'] == 'checkbox') {
  	    $toggle_states = array('show', 'hide');
        foreach($toggle_states as $toggle_state) {
          if(!empty($options[$toggle_state])) {
            $hide = ($toggle_state == 'show') ? 'false' : 'true';
            foreach($options[$toggle_state] as $target_id) {
      	      $output.= "toggle_fields_by_checkbox($hide, '#".$options['id']."', jQuery('#".OPTION_ID_PREFIX.$target_id."'));\n";
      	    }
    	    }
    	  }
    	}

  	  //
  	  // Select & Radio (Toggler)
  	  //
  	  elseif($options['type'] == 'select' || $options['type'] == 'radio') {
  	    // Set toggle states
        $toggle_states = array('show', 'hide');
        foreach($toggle_states as $toggle_state) {
          // If toggle state is set
          if(!empty($options[$toggle_state])) {
            $target_counter = 0;
            $triggers_and_targets = '';

            // Go through triggers and targets
            foreach($options[$toggle_state] as $trigger => $target_ids) {
              // Get target IDs
              $target_ids = explode(',', $target_ids);
              $final_target_ids = array();
              // Prepare IDs for use in JavaScript function
              foreach($target_ids as $target_id) {
                $final_target_ids[] = '#'.OPTION_ID_PREFIX.trim($target_id);
      	      }
      	      $final_target_ids = implode(',', $final_target_ids);
      	      $triggers_and_targets.= ($target_counter > 0) ? ',' : '';
      	      $triggers_and_targets.= "'$trigger': '$final_target_ids'";
      	      $target_counter++;
      	    }

      	    // Output JavaScript functions
            $hide = ($toggle_state == 'show') ? 'false' : 'true';
    	      if($options['type'] == 'select') {
        	    $output.= "toggle_fields_by_select($hide, '#".$options['id']."', { $triggers_and_targets });\n";
        	  }
    	      elseif($options['type'] == 'radio') {
      	      $output.= "toggle_fields_by_radiobuttons($hide, 'input[name=".$options['id']."]', { $triggers_and_targets });\n";
      	    }
      	  }
      	}
    	}

  	  // Wrap functions
  	  if(!empty($output)) {
  	    $output = "<script>jQuery(document).ready(function() { " . $output;
    	  $output.= " });</script>";
    	}

      return $output;
    }



    /* HTML
    ------------------------------------------------------------ */

  	function html($options) {
  	  $output = '<div id="'.$options['id'].'">';
  		$output.= $options['desc'];
  	  $output.= '</div>';
  		return $output;
  	}



    /* Text
    ------------------------------------------------------------ */

  	function text($options) {
  		$output = '<input type="text" id="'.$options['id'].'" name="'.$options['id'].'" value="'.$options['value'].'" size="'.$options['size'].'" />';
  		return $output;
  	}



    /* Textarea
    ------------------------------------------------------------ */

  	function textarea($options) {
  		$output = '<textarea id="'.$options['id'].'" name="'.$options['id'].'" cols="55" rows="'.$options['size'].'">'.$options['value'].'</textarea>';
  		return $output;
  	}



    /* Checkbox
    ------------------------------------------------------------ */

  	function checkbox($options) {
  	  $output = $this->get_field_javascript($options);

  	  // If checked
  		$checked = ($options['value'] == 'true') ? 'checked="checked"' : '';

  		// Input field
  		$output.= '<div class="rvn_checkbox-field-wrapper">';
  		$output.= '<input type="checkbox" id="'.$options['id'].'" name="'.$options['id'].'" value="true" '.$checked.' /> ';
      $output.= '<label for="'.$options['id'].'">'.$options['label'].'</label>';
  		$output.= '</div>';

  		return $output;
  	}



    /* Radio Buttons
    ------------------------------------------------------------ */

  	function radio($options) {
  	  $output  = $this->get_field_javascript($options);
  	  $counter = 1;

  		foreach($options['options'] as $key => $value) {
  			$checked = '';
  			// If checked
  			if($value == $options['value'])
  				$checked = 'checked="checked"';

  			$id = $options['id'].'_'.$counter;
  			$counter++;

	  		$output.= '<div class="rvn_radio-field-wrapper">';
  			$output.= '<input type="radio" id="'.$id.'" name="'.$options['id'].'" value="'.$value.'" '.$checked.' /> ';
  			$output.= '<label for="'.$id.'">'.$key.'</label>';
	  		$output.= '</div>';
  		}

  		return $output;
  	}



    /* Select
    ------------------------------------------------------------ */

  	function select($options) {
  	  $output = $this->get_field_javascript($options);

  		if($options['scope'] == 'page') {
  			$prompt  = 'Select page';
  			$entries = get_pages('title_li=&sort_column=post_title');
  		}
  		elseif($options['scope'] == 'post') {
  			$prompt  = 'Select post';
  			$entries = get_posts('orderby=title&numberposts=-1&order=ASC');
  		}
  		elseif($options['scope'] == 'portfolio') {
  			$prompt  = 'Select portfolio entry';
  			$entries = get_posts('post_type=portfolio&title_li=&orderby=name&numberposts=-1&order=ASC');
  		}
  		elseif($options['scope'] == 'category') {
  			$prompt  = 'Select category';
  			$entries = get_categories('title_li=&orderby=name&hide_empty=0');
  		}
  		else {
  			$prompt  = 'Select';
  			$entries = $options['scope'];
  		}

  		$output.= '<select id="'.$options['id'].'" name="'.$options['id'].'">';

  		if(empty($options['no_prompt']))
    		$output.= '<option value="">'.$prompt.'</option>';

  		foreach($entries as $key => $entry) {
  			if($options['scope'] == 'page' ||
  			   $options['scope'] == 'post' ||
  			   $options['scope'] == 'portfolio')
  			  {
  				$value = $entry->ID;
  				$title = $entry->post_title;
  			}
  			elseif($options['scope'] == 'category') {
  				$value = $entry->term_id;
  				$title = $entry->name;
  			}
  			else {
  				$value = $entry;
  				$title = $key;
  			}

        // If option group should be displayed
        if(is_array($value)) {
          $output.= '<optgroup label="'.$title.'">';
          foreach($value as $optg_title => $optg_value) {
      			$selected = ($options['value'] == $optg_value) ? 'selected="selected"' : '';
      			$output.= '<option '.$selected.' value="'.$optg_value.'">'.$optg_title.'</option>';
          }
          $output.= '</optgroup>';
        }

        // If simple option should be displayed
        else {
    			$selected = ($options['value'] == $value) ? 'selected="selected"' : '';
    			$output.= '<option '.$selected.' value="'.$value.'">'.$title.'</option>';
    		}
  		}

  		$output.= '</select>';

  		return $output;
  	}



    /* Color Picker
    ------------------------------------------------------------ */

  	function color_picker($options) {
  	  if(empty($options['value']))
  	    $options['value'] = '#aaaaaa';

  	  $output = $this->get_field_javascript($options);

  	  $output.= '<span class="colorpicker-field">';
  		$output.= '<input type="text" id="'.$options['id'].'" name="'.$options['id'].'" value="'.$options['value'].'" size="'.$options['size'].'" /> ';
  		$output.= '<a href="#" class="button">'.$options['label'].'</a>';
  		$output.= '<div class="colorpicker"></div>';
  		$output.= '</span>';

  		return $output;
  	}



    /* Image Height
    ------------------------------------------------------------ */

  	function img_height($options) {
  	  global $rvn;

  	  $img_size_id = str_replace('-img-height', '', $options['id']);
  	  $img_size_id = str_replace('rvn_', '', $img_size_id);
	    $img_size_id = preg_replace('/_[0-9]+$/', '', $img_size_id);

  		$output = '<div class="img-height-field-wrapper">';
  		$output.= '<input type="hidden" id="'.$options['id'].'-def-value" name="'.$options['id'].'-def-value" class="img-height-def-value-field" value="'.$options['def_value'].'" /> ';
  		$output.= '<input type="hidden" id="'.$options['id'].'-temp-value" name="'.$options['id'].'-temp-value" class="img-height-temp-value-field" value="'.$options['def_value'].'" /> ';

  	  if(isset($rvn['img_size'][$img_size_id]) && is_array($rvn['img_size'][$img_size_id])) {
  	    $img_width = $rvn['img_size'][$img_size_id][0];
  	  }

  		if($img_width) {
  		  $output.= $img_width.' x ';
  		}

  		$output.= '<input type="text" id="'.$options['id'].'" name="'.$options['id'].'" class="img-height-field" value="'.$options['value'].'" size="'.$options['size'].'" /> ';
  		$output.= 'Pixel';

  	  // If checked
  		$checked = ($options['value'] == '*') ? 'checked="checked"' : '';

  		// Adaptive Height
  		$output.= '<span class="adaptive-img-height-field-wrapper">';
  		$output.= '<input type="checkbox" id="'.$options['id'].'-adaptive" name="'.$options['id'].'-dynamic" class="adaptive-img-height-field" value="true" '.$checked.' /> ';
      $output.= '<label for="'.$options['id'].'-adaptive">Adapt</label>';
  		$output.= '</span>';

  		$output.= '</div>';

  		return $output;
  	}



    /* Text
    ------------------------------------------------------------ */

  	function social_icon_url($options) {
  	  $output = ($options['icon_url']) ? '<label for="'.$options['id'].'" class="social-icon"><img src="'.$options['icon_url'].'" /></label>' : '';
  		$output.= '<input type="text" id="'.$options['id'].'" name="'.$options['id'].'" value="'.$options['value'].'" size="'.$options['size'].'" />';
  		return $output;
  	}



    /* Media Link
    ------------------------------------------------------------ */

  	function media_link($options) {
  		// Display valid preview picture
  		$image = '';
  		if($options['value'] != '') {
  		  $file_extension  = end(explode('.', $options['value']));
  			$file_extensions = array('gif', 'pdf', 'png', 'jpg', 'jpeg', 'tif');
  			if(in_array($file_extension, $file_extensions))
  				$image = '<img src="'.$options['value'].'" alt="" />';
  		}

  		$output = '<span class="media-link-field">';
  		$output.= '<span class="preview-picture block">'.$image.'</span>';
  		$output.= '<input type="text" id="'.$options['id'].'-input" name="'.$options['id'].'" value="'.$options['value'].'" size="'.$options['size'].'" /> ';

  		// Reference: wp_includes/media.php > function media_buttons()
  		global $post_ID, $temp_ID;
  		$uploading_iframe_ID = (int)($post_ID == 0 ? $temp_ID : $post_ID);
  		$media_upload_iframe_src = 'media-upload.php?post_id='.$uploading_iframe_ID;
  		$image_upload_iframe_src = apply_filters('image_upload_iframe_src', $media_upload_iframe_src.'&amp;type=image');

  		$output.= '<a href="'.$image_upload_iframe_src.'&amp;hijack_target='.$options['id'].'&amp;TB_iframe=true" id="'.$options['id'].'" class="button hijacker thickbox" title="" onclick="return false;" >'.$options['label'].'</a>';
      $output.= '</span>';

  		return $output;
  	}



    /* Select Link
    ------------------------------------------------------------ */

  	function select_link($options) {
  		$values = explode('::', $options['value']);

  		$output = '<span class="select-link-field">';
  		$output.= '<select class="select-link">';
  		$output.= '<option value="">Select linking method</option>';

  		//
  		// Linking Methods
  		//
  		$prompts['page']      = 'Link to page...';
  		$prompts['category']  = 'Link to category...';
  		$prompts['post']      = 'Link to post...';
  		$prompts['portfolio'] = 'Link to portfolio entry...';
  		$prompts['manually']  = 'Link manually...';

  		// Look for removed link methods
  		$removed_methods = array();
  		if(!empty($options['remove']))
  		  $removed_methods = $options['remove'];

  		// Create select options and remove options if given
  		foreach($prompts as $value => $prompt) {
  		  if(!in_array($value, $removed_methods)) {
    			$selected = ($value == $values[0]) ? 'selected="selected"' : '';
    			$output.= "<option $selected value='".$value."'>".$prompt."</option>";
    		}
  		}

  		$output.= '</select> ';

  		//
  		// Page
  		//
  		$entries = get_pages('title_li=&orderby=name');

  		$hidden = ($values[0] != 'page') ? 'hidden' : '';

  		$output.= '<select class="page '.$hidden.'">';
  		$output.= '<option value="">Select page</option>';

  		foreach($entries as $page) {
  		  $selected = '';
  			if($hidden == '' && $page->ID == $values[1])
  			  $selected = 'selected="selected"';

  			$output.= '<option '.$selected.' value="'.$page->ID.'">'.$page->post_title.'</option>';
  		}
  		$output.= '</select>';

  		//
  		// Category
  		//
  		$entries = get_categories('title_li=&orderby=name&hide_empty=0');

  		$hidden = ($values[0] != 'category') ? 'hidden' : '';

  		$output.= '<select class="category '.$hidden.'"> ';
  		$output.= '<option value="">Select category</option>';

  		foreach($entries as $category) {
  			$selected = '';
  			if($hidden == '' && $category->term_id == $values[1])
  			  $selected = 'selected="selected"';

  			$output.= '<option '.$selected.' value="'.$category->term_id.'">'.$category->name.'</option>';
  		}
  		$output.= '</select>';

  		//
  		// Post
  		//
  		$entries = get_posts('orderby=title&numberposts=-1&order=ASC');

  		$hidden = ($values[0] != 'post') ? 'hidden' : '';

  		$output.= '<select class="post '.$hidden.'"> ';
  		$output.= '<option value="">Select post</option>';

  		foreach($entries as $post) {
    	  $selected = '';
  			if($hidden == '' && $post->ID == $values[1])
  			  $selected = 'selected="selected"';

  			$output.= '<option '.$selected.' value="'.$post->ID.'">'.$post->post_title.'</option>';
  		}
  		$output.= '</select>';

  		//
  		// Postfolio
  		//
  		$entries = get_posts('post_type=portfolio&orderby=title&numberposts=-1&order=ASC');

  		$hidden = ($values[0] != 'portfolio') ? 'hidden' : '';

  		$output.= '<select class="portfolio '.$hidden.'"> ';
  		$output.= '<option value="">Select portfolio entry</option>';

  		foreach($entries as $entry) {
    	  $selected = '';
  			if($hidden == '' && $entry->ID == $values[1])
  			  $selected = 'selected="selected"';

  			$output.= '<option '.$selected.' value="'.$entry->ID.'">'.$entry->post_title.'</option>';
  		}
  		$output.= '</select>';

      //
  		// Manually
  		//
  		$hidden = '';
  		$setValue = '';
  		if($values[0] != 'manually')
  		  $hidden = 'hidden';
  		else
  		  $setValue = $values[1];

  		$output.= '<input type="text" class="manually '.$hidden.'" value="'.$setValue.'" size="'.$options['size'].'" />';

  		// Hidden real value
  		$output.= '<input type="hidden" id="'.$options['id'].'" name="'.$options['id'].'" class="value" value="'.$options['value'].'" />';
  		$output.= '</span>';

  		return $output;
  	}



    /* Multi-Select
    ------------------------------------------------------------ */

  	function multiselect($options) {
  		$values = explode('::', $options['value']);
      $value_count = ($values[0] != '') ? count($values)+1 : count($values);

      $output = '<span class="multiselect-field">';
    	$output.= '<input type="hidden" id="'.$options['id'].'" class="value" name="'.$options['id'].'" value="'.$options['value'].'" />';
      $output.= '<input type="hidden" id="'.$options['id'].'-max-fields" class="max-fields" name="'.$options['id'].'-max-fields" value="'.$options['max'].'" />';

  		if($options['scope'] == 'page') {
  			$prompt  = 'Select page';
  			$entries = get_pages('title_li=&orderby=name');
  		}
  		elseif($options['scope'] == 'post') {
  			$prompt  = 'Select post';
  			$entries = get_posts('orderby=title&numberposts=-1&order=ASC');
  		}
  		elseif($options['scope'] == 'portfolio') {
  			$prompt  = 'Select portfolio entry';
  			$entries = get_posts('post_type=portfolio&title_li=&orderby=name&numberposts=-1&order=ASC');
  		}
  		elseif($options['scope'] == 'portfolio_category') {
  			$prompt  = 'Select portfolio category';
  			$entries = get_categories('taxonomy=portfolio_categories&title_li=&orderby=name&hide_empty=0');
  		}
  		elseif($options['scope'] == 'category') {
  			$prompt  = 'Select category';
  			$entries = get_categories('title_li=&orderby=name&hide_empty=0');
  		}
  		else {
  			$prompt  = 'Select...';
  			$entries = $options['scope'];
  		}

      $options['max'] = ($options['max'] == 'inf') ? $value_count : $options['max'];

      for($i = 0; $i < $options['max']; $i++) {
        //$select_id = $options['id'].''.$i;
      	//$output.= '<select class="multiselect" name="'.$select_id.'" id="'.$select_id.'">';
      	$output.= '<select class="multiselect">';
      	if(empty($options['no_prompt']))
        	$output.= '<option value="">'.$prompt.'</option>';

    		foreach ($entries as $key => $entry) {
    			if($options['scope'] == 'page' ||
    			   $options['scope'] == 'post' ||
    			   $options['scope'] == 'portfolio')
    			  {
    				$value = $entry->ID;
    				$title = $entry->post_title;
    			}
    			elseif($options['scope'] == 'category' ||
    			       $options['scope'] == 'portfolio_category')
    			      {
    				$value = $entry->term_id;
    				$title = $entry->name;
    			}
    			else {
    				$value = $entry;
    				$title = $key;
    			}

    			$selected = '';
    			if(isset($values[$i]))
      			$selected = $values[$i] == $value ? "selected='selected'" : '';
    		  $output.= '<option '.$selected.' value="'.$value.'">'.$title.'</option>';
    		}

      	$output.= "</select> ";
      }

    	$output.= "</span>";

  		return $output;
    }



  }

}

?>