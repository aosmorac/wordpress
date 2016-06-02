


/* Setup
============================================================ */

jQuery(document).ready(function() {
	setup_colorpicker();
	setup_media_library();
	setup_media_link();
	setup_select_link();
	setup_img_height();
	setup_items();
	setup_multiselect();
	setup_multitable();
});







/* Functions
============================================================ */



/* Setup Colorpicker 
------------------------------------------------------------ */

function setup_colorpicker() {
  if(jQuery.isFunction(jQuery.fn.farbtastic)) {
  	jQuery('.colorpicker-field').each(function() {
  	  var input       = jQuery(this).find('input');
  	  var colorpicker = jQuery(this).find('.colorpicker');
  	  var button      = jQuery(this).find('a.button');
  	  
  	  jQuery('body').bind('click', function() { colorpicker.hide(); });
  	  button.click(function() { colorpicker.toggle(); return false; });
      colorpicker.click(function(event){ event.stopPropagation(); });
  	  colorpicker.farbtastic(input);
  	});
	}
}



/* Setup Media Link 
------------------------------------------------------------ */

function setup_media_library() {
  // Thank's to John Hoff for this piece of code.
  // http://www.braindonor.net/coding-blog/hijack-the-wordpress-media-gallery/228/#comment-139
  
	var custom_buttons  = jQuery('.media-link-field a.button');
	window.custom_input = false;
	
	custom_buttons.click(function() {
		window.custom_input = jQuery('#'+jQuery(this).attr('id')+'-input');
	});

	window.original_send_to_editor = window.send_to_editor;
	
	window.send_to_editor = function(html) {
		if(window.custom_input) {
			var media_link = jQuery(html).attr('src') || 
			                 jQuery(html).find('img').attr('src') ||
			                 jQuery(html).attr('href');
			window.custom_input.val(media_link).trigger('media_link_trigger');
			window.custom_input = false;
			window.tb_remove();
		}
		else {
			window.original_send_to_editor(html);
		}
	};
}



/* Setup Media Link 
------------------------------------------------------------ */

function setup_media_link() {
	jQuery('.media-link-field').each(function() {
	  var wrapper         = jQuery(this);
	  var input           = wrapper.find('input');
	  var preview_picture = wrapper.find('.preview-picture');
	  var button          = wrapper.find('a.button');
	  
		//input.bind('change focus blur media_link_trigger', function() {
		input.bind('media_link_trigger', function() {
			var value = input.val();
			var image = '<img src ="'+value+'" alt="" />';
			preview_picture.html('').append(image);
		});
	});
}



/* Setup Select Link 
------------------------------------------------------------ */

function setup_select_link() {
  var value_separator = '::';
  
	jQuery('.select-link-field').each(function() {
    var wrapper          = jQuery(this);
		var select_field     = wrapper.find('.select-link');
		var sub_select_field = wrapper.find('.page, .post, .portfolio, .category, .manually');
		var combo_value      = wrapper.find('.value');
		var base_value       = select_field.val() + value_separator;
    
		select_field.bind('change', function() {	
			var current_value = select_field.val();
			sub_select_field.hide();
			if(current_value != '') {
				wrapper.find('.'+current_value).fadeIn('slow');
				current_value = current_value + value_separator;
			}
			combo_value.val(current_value);
			base_value = current_value;
		});
		
		sub_select_field.bind('change keyup', function() {
		  var current_value = jQuery(this).val();
		  combo_value.val(base_value + current_value);
		});
		
	});
}



/* Setup Image Height
------------------------------------------------------------ */

function setup_img_height() {
	jQuery('.img-height-field-wrapper').each(function() {
	  var img_height_field            = jQuery(this).find('.img-height-field');
	  var img_height_dynamic_field    = jQuery(this).find('.adaptive-img-height-field');
	  var img_height_temp_value_field = jQuery(this).find('.img-height-temp-value-field');
	  	  
	  img_height_dynamic_field.bind('keyup change', function() {
	    var img_height_field_id = img_height_field.attr('id');

	    if(jQuery(this).is(':checked')) {
  	    if(img_height_field.val() != '*')
  	      img_height_temp_value_field.val(img_height_field.val());
  	      
  	    img_height_field.val('*');
  	      
  	  }
  	  else {
	      img_height_field.val(img_height_temp_value_field.val());
  	  }
	  });
	});
}



/* Setup Items 
------------------------------------------------------------ */

function setup_items() {
  var val_separator = '::';
  
	jQuery('.items-field').each(function() {
	  var wrapper        = jQuery(this);
	  var value_field    = wrapper.find('.value');
		var text_field     = wrapper.find('.item-creator-textfield');
		var button         = wrapper.find('.item-creator-button');
		var showcase       = wrapper.find('.item-showcase ul');
		var remove_links   = wrapper.find('.item-showcase ul li a.remove-link');
		
		var vals = value_field.val().split(val_separator);
		
		//
		// When Pressing Enter
		//
		
		text_field.bind('keypress', function(e) {
		  var code = (e.keyCode ? e.keyCode : e.which);
      if(code == 13) {
        button.click();
        return false;
      }
		});
		
		//
		// Button Click
		//
		
		button.unbind('click').bind('click', function() {
		  var val = text_field.val();
		  
		  // Only add item if name is unique
		  if(value_field.val().toLowerCase().indexOf(val.toLowerCase()) == -1) {
		    // Add new item to array
		    vals.unshift(val);
  		  // Add values to value field
    		value_field.val(vals.join(val_separator));
    		// Add item to showcase
  		  jQuery('<li><span class="value">'+val+'</span> (<a href="#" class="remove-link">Remove</a>)</li>').prependTo(showcase);
  		  // Apply function to newly created item
  		  setup_items();
  		  // Empty text field and focus
  		  text_field.val('').focus();
  		}
		});
		
		//
		// Remove Item
		//
		
		remove_links.unbind('click').bind('click', function() {
		  var item = jQuery(this).parent();
		  var val  = item.find('.value').text();
		  
		  // Remove item from showcase list
		  item.remove();
		  // Remove item from array
		  vals = jQuery.grep(vals, function(array_el) { return array_el != val; });
		  // Remove empty elements from array
		  vals = jQuery.grep(vals, function(array_el) { return array_el != ''; });
		  // Add values to value field
		  value_field.val(vals.join(val_separator));
		});
	});
}



/* Setup Multiselect 
------------------------------------------------------------ */

function setup_multiselect() {	
  var value_separator = '::';
  
	jQuery('.multiselect-field').each(function() {			
	  var wrapper        = jQuery(this);
	  var wrapper_id     = wrapper.attr('id');
	  var value_field    = wrapper.find('.value');
		var select_fields  = wrapper.find('.multiselect');
		var max_fields     = wrapper.find('.max-fields').val();
		var values = '';
		
		select_fields.each(function(i, selected) {
			var value = jQuery(selected).val();
  		values+= (values != '' && value) ? value_separator+value : value;
  		value_field.val(values);
  		
			jQuery(this).unbind('change').bind('change', function() {	
			  if(max_fields == 'inf') {
  				if(jQuery(this).val() && select_fields.length == i+1) {
    				jQuery(this).clone().appendTo(wrapper);
  				}
  				else if(!(jQuery(this).val()) && !(select_fields.length == i+1)) {
      			jQuery(this).remove();
  			  }
  			}
  			setup_multiselect();
		  });
	  });
	});
}



/* Setup Multitable
------------------------------------------------------------ */

function setup_multitable() {
  var clone_link  = jQuery('.clone-link');
  var remove_link = jQuery('.remove-link');
  
  // Show/Hide Remove Link
  if(jQuery('.multitable').size() == 1) remove_link.hide();
  else                                  remove_link.show();
  
  // Clone Table
  clone_link.unbind('click').bind('click', function() {	
    var new_multitable = jQuery('#default-multitable').clone().insertAfter(jQuery('.multitable:last'));
    new_multitable.removeAttr('id').addClass('multitable');
    setup_multitable();
    setup_multiselect();
    set_multitable_numbers();
    jQuery(document).trigger('add_multitable');
    jQuery('input[type=submit]').click();
    return false;
  });
  
  // Remove Table
  remove_link.bind('click', function() {
    jQuery(this).parents('.multitable').remove();
    setup_multitable();
    set_multitable_numbers();
    jQuery(document).trigger('remove_multitable');
    return false;
  });
  
  // Collect Data on Submit
  jQuery('#theme-options-form').submit(function() {
  	collect_multitable_data();
  });
}



/* Set Multitable Numbers
------------------------------------------------------------ */

function set_multitable_numbers() {
	jQuery('.multitable').each(function(i) {
	  jQuery(this).find('.multitable-number').html(i+1);
	  
    jQuery(this).find('div.rvn_option-wrapper, tbody tr, input, select:not(.multiselect)').each(function() {
      var old_id = jQuery(this).attr('id');
      var new_id = jQuery(this).attr('id').replace(/_\d+/, '_'+(i+1));
      jQuery(this).attr('id', new_id);
      
      if(jQuery(this).attr('name')) {
        var new_name = jQuery(this).attr('name').replace(/_\d+/, '_'+(i+1));
        jQuery(this).attr('name', new_name);
      }
      
      jQuery('label[for='+old_id+']').attr('for', new_id);
    });
  });
}



/* Collect Multitable Data
------------------------------------------------------------ */

function collect_multitable_data() {
  var multitable   = jQuery('.multitable');
  var data_field   = jQuery('.multitable-data');
  var input_fields = 'input, select:not(.multiselect)';
  var new_data_field_value = '';
  var val      = '';
  var no_value = '<<<-no-value->>>';
  var id_attr  = '';
  var page_sep = '$$$';
  var sep      = '&';
  var glue     = '=';
  
  // Serialize Data
  multitable.each(function() {
    jQuery(this).find(input_fields).each(function() {
      id_attr = 'id';
      val = '';
      
      // Checkbox
      if(jQuery(this).is(':checkbox')) {
        val = jQuery(this).is(":checked") ? 'true' : 'false';
      }
      
      // Radiobuttons
      else if(jQuery(this).is(':radio')) {
        val = no_value;
        if(jQuery(this).is(':checked')) {
          val = jQuery(this).val();
          id_attr = 'name';
        }
      }
      
      // Input
      else {
        val = jQuery(this).val();
      }
      
      if(val != no_value) {
        new_data_field_value += jQuery(this).attr(id_attr)+glue+val+sep;
      }
    });
    new_data_field_value += page_sep;
  });

  data_field.val(new_data_field_value);
}



/* Toggle Fields from Hash Array
------------------------------------------------------------ */

function toggle_fields_from_hash_array(hide, triggers_and_targets, current_field_value) {
  var active_trigger = '';
  var active_targets = '';
  
  // Get active trigger and its targets
  jQuery.each(triggers_and_targets, function(trigger, targets) {
    if(current_field_value == trigger) {
      active_trigger = trigger;
      active_targets = jQuery(targets);
      return(false); // break
    }
  });
  
  jQuery.each(triggers_and_targets, function(trigger, targets) {
    // If we loop through a trigger that is not active
    if(trigger != active_trigger) {
      // Show all targets that are not assigned to the trigger
      if(hide) jQuery(targets).show();
      // Hide all targets that are not assigned to the trigger
      else     jQuery(targets).hide();
    }
  });
  
  // Show or hide active targets
  if(active_targets != '') {
    if(hide) active_targets.hide();
    else     active_targets.show();
  }
}



/* Toggle Fields by Select
------------------------------------------------------------ */

function toggle_fields_by_select(hide, select, triggers_and_targets) {
  var select = jQuery(select);
  
  select.bind('click change keyup', function() {
    var current_value  = select.val();
    toggle_fields_from_hash_array(hide, triggers_and_targets, current_value);
  });
  
  // Invoke click event after page is loaded
  select.keyup();
}



/* Toggle Fields by Radiobutton
------------------------------------------------------------ */

function toggle_fields_by_radiobuttons(hide, radiobuttons, triggers_and_targets) {
  var radiobuttons = jQuery(radiobuttons);
  
  radiobuttons.bind('click change keyup', function() {
    var current_value = jQuery('input[name='+radiobuttons.attr('name')+']:checked').val();
    toggle_fields_from_hash_array(hide, triggers_and_targets, current_value);
  });
  
  // Invoke click event after page is loaded
  radiobuttons.keyup();
}



/* Toggle Fields by Checkbox
------------------------------------------------------------ */

function toggle_fields_by_checkbox(hide, checkbox, targets) {
  var checkbox = jQuery(checkbox);
  var targets  = jQuery(targets);
  
  checkbox.bind('click change keyup', function() {
    if(jQuery(this).is(":checked")) {
      if(hide) targets.hide();
      else     targets.show();
    }
    else {
      if(hide) targets.show();
      else     targets.hide();
    }
  });
  
  // Invoke click event after page is loaded
  checkbox.keyup();
}



/* QuickPick Fields by Text or Select
------------------------------------------------------------ */

function quickpick_fields_by_text_or_select(triggers_and_targets) {
  jQuery.each(triggers_and_targets, function(trigger, targets) {
    trigger = jQuery(trigger);
    targets = jQuery(targets);
    
    trigger.bind('click change keyup', function() {
      targets.val(jQuery(this).val()).keyup();
    });
  });
}


