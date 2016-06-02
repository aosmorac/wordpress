<?php




/* Sub Navigation Widget
============================================================ */

class rvn_sub_nav_walker extends Walker_Nav_Menu
{
	var $found_parents = array();



  /* Start Element
  ------------------------------------------------------------ */

	function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {
  	global $wp_query;

  	//this only works for second level sub navigations
  	$parent_item_id = 0;

  	$indent = ($depth) ? str_repeat("\t", $depth) : '';

  	$class_names = $value = '';
  	$classes = empty($item->classes) ? array() : (array)$item->classes;
  	$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item));
  	$class_names = ' class="'.esc_attr($class_names).'"';

    $item_output = '';

  	// Checks if the current element is in the current selection
  	if (strpos($class_names, 'current-menu-item') || strpos($class_names, 'current-menu-parent') || strpos($class_names, 'current-menu-ancestor') || (is_array($this->found_parents) && in_array($item->menu_item_parent, $this->found_parents))) {
  		// Keep track of all selected parents
  		$this->found_parents[] = $item->ID;
  		//check if the item_parent matches the current item_parent
  		if ($item->menu_item_parent != $parent_item_id) {
  			$output.= $indent.'<li'.$class_names.'>';

  			$attributes = !empty($item->attr_title) ? ' title="'.esc_attr($item->attr_title).'"' : '';
  			$attributes.= !empty($item->target)     ? ' target="'.esc_attr($item->target).'"' : '';
  			$attributes.= !empty($item->xfn)        ? ' rel="'.esc_attr($item->xfn).'"' : '';
  			$attributes.= !empty($item->url)        ? ' href="'.esc_attr($item->url).'"' : '';

  			$item_output = $args->before;
  			$item_output.= '<a'.$attributes.'><span>';
  			$item_output.= $args->link_before.apply_filters('the_title', $item->title, $item->ID).$args->link_after;
  			$item_output.= '</span></a>';
  			$item_output.= $args->after;
  		}
  		$output.= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  	}
  }



  /* End Element
  ------------------------------------------------------------ */

	function end_el(&$output, $item, $depth = 0, $args = array()) {
		$parent_item_id = 0;

		$class_names = '';
		$classes = empty($item->classes) ? array() : (array) $item->classes;
		$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item));
		$class_names = ' class="'.esc_attr($class_names).'"';

		if(strpos($class_names, 'current-menu-item') || strpos($class_names, 'current-menu-parent') || strpos($class_names, 'current-menu-ancestor') || (is_array($this->found_parents) && in_array($item->menu_item_parent, $this->found_parents))) {
			// Closes only the opened li
			if(is_array($this->found_parents) && in_array($item->ID, $this->found_parents) && $item->menu_item_parent != $parent_item_id) {
				$output .= "</li>\n";
			}
		}
	}



  /* End Level
  ------------------------------------------------------------ */

	function end_lvl(&$output, $depth = 0, $args = array()) {
		$indent = str_repeat("\t", $depth);
		// If the sub-menu is empty, strip the opening tag, else closes it
		if(substr($output, -22) == "<ul class=\"sub-menu\">\n") {
			$output = substr($output, 0, strlen($output) - 23);
		}
		else {
			$output .= "$indent</ul>\n";
		}
	}



}

?>