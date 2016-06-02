<?php



/* AJAX Contact Form
------------------------------------------------------------ */

if(!function_exists('sc_ajax_contact_form'))
{
  function sc_ajax_contact_form($atts, $content = null, $sc_name = '') {
    extract(shortcode_atts(array(
      'email'           => get_option('admin_email'),
      'email_signature' => sprintf(__("This E-Mail was sent through the contact form on your website %s.", 'ruventhemes'), get_option('blogname')),
      'success_msg'     => __('The message was sent successfully.', 'ruventhemes'),
      'error_msg'       => __('Please fill in all fields correctly.', 'ruventhemes')
    ), $atts));
    
    if(!$email) $email = get_option('admin_email');
    $email = str_replace('@', '[at]', $email);
    
    return '
    
      <form id="contactform" class="three-column-form" method="post" action="'.TEMPLATEURL.'/contact_form_mailer.php">
      	<input type="hidden" id="receiver" name="cf_receiver" value="'.$email.'" />
      	<input type="hidden" id="email_signature" name="cf_email_signature" value="'.$email_signature.'" />
      	<input type="hidden" id="success_msg" name="cf_success_msg" value="'.$success_msg.'" />
      	<input type="hidden" id="error_msg" name="cf_error_msg" value="'.$error_msg.'" />
      	
      	<p class="one-third">
      	  <label for="subject">'.__('Subject', 'ruventhemes').'</label><br/>
      	  <input id="subject" name="cf_subject" class="required" type="text" />
      	</p>
      	
      	<p class="one-third">
      	  <label for="name">'.__('Name', 'ruventhemes').'</label><br/>
      	  <input id="name" name="cf_name" class="required" type="text" />
      	</p>
      	
      	<p class="one-third last">
      	  <label for="email">'.__('E-Mail', 'ruventhemes').'</label><br/>
      	  <input id="email" name="email" class="required" type="text" />
      	</p>
                	
      	<div class="spacer"></div>
      	
    	  <textarea id="message" name="cf_message" class="required" cols="40" rows="8"></textarea>
      	
        <div class="message"></div>
        
      	<p>
  				<input type="submit" name="submit" value="'.__('Send Message', 'ruventhemes').'" />
          <span class="spinner"><span>Please wait...</span></span>
      	</p>
      </form>
    
    ';
  }
}

if(function_exists('sc_ajax_contact_form'))
{
  add_shortcode('ajax_contact_form', 'sc_ajax_contact_form');
}



/* Blockquote
------------------------------------------------------------ */

if(!function_exists('sc_blockquote'))
{
  function sc_blockquote($atts, $content = null, $sc_name = '') {
    extract(shortcode_atts(array(
      'source' => '',
      'align'  => ''
    ), $atts));
    
    $class = '';
    if($source) $source = "<p class='source'>&mdash; $source</p>";
    else        $class .= "no-source ";
    if($align)  $class .= "align{$align} ";
    else        $class .= "no-align ";
    
  	return "<blockquote class='{$class}'><p>".do_shortcode($content)."</p>$source</blockquote>";
  }
}

if(function_exists('sc_blockquote'))
{
  add_shortcode('blockquote', 'sc_blockquote');
}



/* Box
------------------------------------------------------------ */

if(!function_exists('sc_box'))
{
  function sc_box($atts, $content = null, $sc_name = '') {
    extract(shortcode_atts(array(
      'title'          => '',
      'inner_padding'  => '',
      'with_bg'        => '',
      'centered_title' => ''
    ), $atts));
    
    $box_class = '';
    $box_header_class = '';
    
    if($inner_padding)     $box_class.= $inner_padding.'-inner-padding ';
    if($with_bg == 'true') $box_class.= 'with-bg ';
    $box_class.= ($title) ? 'with-header ' : 'no-header ';
    
    if($centered_title == 'true') $box_header_class.= 'center ';
    
    $output = "<div class='box $box_class'>";
    if($title)
      $output.= "<div class='box-header $box_header_class'><strong>$title</strong></div>";
    
    $output.= "<div class='box-content'>".wpautop(rvn_get_shortcode_unautop($content))."</div>";
    $output.= '</div>';
    
    return $output;
  }
}

if(function_exists('sc_box'))
{
  add_shortcode('box', 'sc_box');
}



/* Button
------------------------------------------------------------ */

if(!function_exists('sc_button'))
{
  function sc_button($atts, $content = null, $sc_name = '') {
    extract(shortcode_atts(array(
      'size'  => '',
      'link'  => '',
      'class' => '',
      'open_new_tab' => ''
    ), $atts));
    
    $link = ($link) ? "href='$link'" : '';
    $open_new_tab = ($open_new_tab == 'true') ? 'target="_blank"' : '';
    
    $output = "<a class='button $size $class' $link $open_new_tab>";
    $output.= rvn_get_shortcode_unautop($content);
    $output.= '</a>';
    
    return $output;
  }
}

if(function_exists('sc_button'))
{
  add_shortcode('button', 'sc_button');
}



/* Column
------------------------------------------------------------ */

if(!function_exists('sc_column'))
{
  function sc_column($atts, $content = null, $sc_name = '') {
    $last = '';
  	if(isset($atts[0]) && trim($atts[0]) == 'last')
  	  $last = 'last';
  	
    $class  = str_replace('_', '-', $sc_name);
    $output = '<div class="'.$class.' '.$last.'">'.wpautop(rvn_get_shortcode_unautop($content)).'</div>';
    
    if(!empty($last))
      $output.= do_shortcode('[divider]');
    
    return $output;
  }
}

if(function_exists('sc_column'))
{
  $column_shortcodes = array('one_half',   'one_third', 'two_third', 'three_fourth',
                             'one_fourth', 'one_fifth', 'two_fifth', 'three_fifth',
                             'four_fifth', 'one_sixth', 'two_sixth', 'three_sixth',
                             'four_sixth', 'five_sixth');
  
  foreach($column_shortcodes as $column_shortcode) {
    add_shortcode($column_shortcode, 'sc_column');
  }
}




/* Dividers / Spacers
------------------------------------------------------------ */

if(!function_exists('sc_divider'))
{
  function sc_divider($atts, $content = null, $sc_name = '') {
    extract(shortcode_atts(array('size' => ''), $atts));
    return rvn_get_shortcode_unautop("<span class='{$sc_name} {$size}'></span>");
  }
}

if(function_exists('sc_divider'))
{
  add_shortcode('divider', 'sc_divider');
  add_shortcode('spacer',  'sc_divider');
}



/* Dropcap
------------------------------------------------------------ */

if(!function_exists('sc_dropcap'))
{
  function sc_dropcap($atts, $content = null, $sc_name = '') {
    extract(shortcode_atts(array(
      'style'   => '',
      'colored' => ''
    ), $atts));
    
    if($style) $style = "-$style";
    $colored = ($colored == 'true') ? 'colored' : '';
    
  	return "<span class='dropcap{$style} {$colored}'>".do_shortcode($content).'</span>';
  }
}

if(function_exists('sc_dropcap'))
{
  add_shortcode('dropcap', 'sc_dropcap');
}



/* Entries
------------------------------------------------------------ */

if(!function_exists('sc_entries'))
{
  function sc_entries($atts, $content = null, $sc_name = '') {
    global $post;
    
    extract(shortcode_atts(array(
      'type'                    => 'post',
      'category'                => '',
      'count'                   => '',
      'ids'                     => '',
      'id'                      => '',
      'column_size'             => 'one-third',
      'list_layout'             => 'false',
      'featured_content_height' => '',
      'excerpt_length'          => '',
      'bottom_padding'          => '',
      'meta_infos'              => 'date, categories, comments',
      'show_featured_content'   => 'true',
      'show_headings'           => 'true',
      'show_meta_infos'         => 'false',
      'show_excerpts'           => 'true',
      'show_buttons'            => 'true',
      'read_more_link_text'     => 'Read more',
      'external_link_text'      => 'Visit site',
      'external_link_opens_new_tab' => 'false',
      'featured_image_link_method'  => 'entry',
      'last' => 'false'
    ), $atts));
    
    
    //
    // Determine Divider Position
    //
    
    switch($column_size) {
      case 'one-fourth': $divider_pos = 4; break;
      case 'one-third':  $divider_pos = 3; break;
      case 'one-half':   $divider_pos = 2; break;
      default:           $divider_pos = 1; // full
    }
    
    
    //
    // Initialize Variables
    //
    
    $output = '';
    $class  = array('preview', 'post');
    $no_auto_divider = false;
    
    $featured_content_size = array();
    if($featured_content_height) {
      $featured_content_size = array('width' => '', 'height' => $featured_content_height);
    }
    
    if($show_meta_infos == 'true') $meta_infos = explode(',', str_replace(' ', '', $meta_infos));
    else                           $meta_infos = array();
    
    if($bottom_padding) {
      if($bottom_padding == 'none') $bottom_padding = 'no';
      $class[] = $bottom_padding.'-bottom-padding ';
    }
    
    
    //
    // Initialize WP Query
    //
    
    $wp_querys = array();
    $def_query_attr = array('numberposts' => -1, 'post_type' => $type);
    
    // If only a single post should be displayed
    if($id) {
      $wp_querys[0] = $def_query_attr;
      $wp_querys[0]['post__in']  = array($id);
      $wp_querys[0]['post_type'] = get_post_type($id);
    }
    // If multiple posts of specific IDs should be displayed
    elseif($ids) {
       $post_ids = explode(',', str_replace(' ', '', $ids));
       for($i = 0; $i < count($post_ids); $i++) {
         $wp_querys[$i] = $def_query_attr;
         $wp_querys[$i]['post__in']  = array($post_ids[$i]);
         $wp_querys[$i]['post_type'] = get_post_type($post_ids[$i]);
       }
    }
    // If latest posts should be displayed
    else {
      // If latest posts should be displayed, but no post count is given
      if(!$count) {
        if($list_layout != 'true' && $column_size == 'one-fourth')   $count = 4;
        elseif($list_layout != 'true' && $column_size == 'one-half') $count = 2;
        else                                                         $count = 3;
      }
      $wp_querys[0] = $def_query_attr;
      $wp_querys[0]['numberposts']   = $count;
      if($category) {
        if('portfolio' == $type) $wp_querys[0]['portfolio_categories'] = $category;
        else                     $wp_querys[0]['category_name'] = $category;
      }
    }
    
    
    //
    // Get Entries
    //
    
    $i = 0;
    foreach($wp_querys as $wp_query) {
    
      $rvn_posts = get_posts($wp_query);
      
      if($rvn_posts) {
        
        foreach($rvn_posts as $rvn_post) {
          $i++;
          // If this is not a single entry call, check if divider should be set
          if(!$id) $last = ($divider_pos == $i) ? 'true' : 'false';
          // Reset index
          if($last == 'true') $i = 0;

          setup_postdata($rvn_post);
          
          $external_link = rvn_get_post_meta($rvn_post->ID, 'portfolio-external-link');
          
          $output.= rvn_get_entry(array(
            'post_id'               => $rvn_post->ID,
            'featured_content_type' => 'preview',
            'featured_content_size' => $featured_content_size,
            'class'                 => $class,
            'column_size'           => $column_size,
            'list_layout'           => ($list_layout == 'true') ? true : false,
            'excerpt_length'        => is_numeric($excerpt_length) ? (int)$excerpt_length : false,
            'meta_infos'            => $meta_infos,
            'show_featured_content' => ($show_featured_content == 'false') ? false : true,
            'show_headings'         => ($show_headings == 'false') ? false : true,
            'show_excerpts'         => ($show_excerpts == 'false') ? false : true,
            'show_buttons'          => ($show_buttons  == 'false') ? false : true,
            'read_more_link_text'   => $read_more_link_text,
            'last'                  => $last,
            'featured_image_link_method' => $featured_image_link_method,
            'portfolio' => array('external_link' => $external_link,
                                 'external_link_text' => $external_link_text,
                                 'external_link_opens_new_tab' => ($list_layout == 'true') ? true : false)
          ));
        }
        
      }
    }
      
    // Set divider if number of posts was given
    if(is_numeric($count) || $ids) {
      $output.= do_shortcode('[divider]');
    }
    
    return $output;
  }
}

if(function_exists('sc_entries'))
{
  add_shortcode('entries', 'sc_entries');
  add_shortcode('entry',   'sc_entries');
}



/* Gallery
------------------------------------------------------------ */

if(!function_exists('sc_gallery'))
{
  function sc_gallery($atts, $content = null, $sc_name = '') {
    extract(shortcode_atts(array(
      'size'        => 'one-third',
      'height'      => '',
      'no_lightbox' => '',
      'fancy'       => ''
    ), $atts));
    
    
    //
    // Determine Divider Position
    //
    
    switch($size) {
      case 'one-fourth': $divider_pos = 4; break;
      case 'one-third':  $divider_pos = 3; break;
      case 'one-half':   $divider_pos = 2; break;
      default:           $divider_pos = 1; // full
    }
    
    
    //
    // Set Vaiables
    //
    
    $size        = str_replace('_', '-', $size);
    $size        = "size='{$size}'";
    $no_lightbox = "no_lightbox='{$no_lightbox}'";
    $fancy       = "fancy='{$fancy}'";
    $height      = "height='{$height}'";
    
    
    //
    // Set Dividers
    //
    
    $split_content = explode('[image', $content);
    // Delete first empty array element
    unset($split_content[0]);
    
    $i = 1;
    $row_i = 1;
    
    foreach($split_content as $img_sc) {
      // Set image size and style
      $img_sc = ' '.$size.' '.$height.' '.$no_lightbox.' '.$fancy.' '.$img_sc;
      // If last row element is reached
      if($row_i == $divider_pos) {
        $split_content[$i] = '[image in_gallery="true" last="true" '.$img_sc;
        // Only put spacer when e haven't reached last picture. Else we would've a big space on the end of the gallery.
        if($i != count($split_content)) {
          if('full' == rvn_get_page_content_size()) {
            $split_content[$i].= ' [spacer size="bigger"]';
          }
          else {
            $split_content[$i].= ' [spacer size="big"]';
          }
        }
        $row_i = 0;
      }
      else {
        $split_content[$i] = '[image in_gallery="true" '.$img_sc;
      }
      
      // Increment
      $i++;
      $row_i++;
    }
    
    $content = implode(' ', $split_content);
    
    
    //
    // Output
    //
    
    $output = '<div class="gallery-wrapper">'."\n";
    $output.= rvn_get_shortcode_unautop($content);
    $output.= '</div>';
    
    // Get rid of bug that puts a </p> after the first image
    $output = str_replace('<p>', '', $output);
    $output = str_replace('</p>', '', $output);
    
    return $output;
  }
}

if(function_exists('sc_gallery'))
{
  add_shortcode('media_gallery', 'sc_gallery');
  add_shortcode('image_gallery', 'sc_gallery');
  add_shortcode('fancy_gallery', 'sc_gallery');
}



/* Heading
------------------------------------------------------------ */

if(!function_exists('sc_heading'))
{
  function sc_heading($atts, $content = null, $sc_name = '') {
    extract(shortcode_atts(array(
      'type'              => 'h2',
      'underlined'        => '',
      'no_top_padding'    => '',
      'no_bottom_padding' => ''
    ), $atts));
    
    if(!$type) $type = 'h2';
    
    $class = ($underlined        == 'true') ? 'underlined ' : '';
    $class.= ($no_top_padding    == 'true') ? 'top '        : '';
    $class.= ($no_bottom_padding == 'true') ? 'bottom '     : '';
    
  	return "<$type class='$class'>".do_shortcode($content)."</$type>";
  }
}

if(function_exists('sc_heading'))
{
  add_shortcode('heading', 'sc_heading');
}



/* Hightlight
------------------------------------------------------------ */

if(!function_exists('sc_highlight'))
{
  function sc_highlight($atts, $content = null, $sc_name = '') {
    extract(shortcode_atts(array('style' => ''), $atts));
    return "<span class='highlight $style'>".do_shortcode($content)."</span>";
  }
}

if(function_exists('sc_highlight'))
{
  add_shortcode('highlight', 'sc_highlight');
}




/* Horizontal Ruler
------------------------------------------------------------ */

if(!function_exists('sc_hr'))
{
  function sc_hr($atts, $content = null, $sc_name = '') {
    extract(shortcode_atts(array('size' => ''), $atts));
    return rvn_get_shortcode_unautop("<span class='hr-wrapper {$size}'><span class='hr'></span></span>");
  }
}

if(function_exists('sc_hr'))
{
  add_shortcode('hr', 'sc_hr');
}



/* Icon Text
------------------------------------------------------------ */

if(!function_exists('sc_icon_text'))
{
  function sc_icon_text($atts, $content = null, $sc_name = '') {
    extract(shortcode_atts(array(
      'icon' => '',
      'custom_icon' => '',
      'icon_position' => 'left',
      'box' => ''
    ), $atts));
    
    $icon_url = ($custom_icon) ? $custom_icon : IMAGES_URL."/text_icons/{$icon}";
    $icon_position = 'icon-'.$icon_position;
    $box = ($box == 'true') ? true : false;
    
    $output = "<div class='icon-text {$icon_position}'>";
    if($icon_position == 'icon-top') {
      $output.= "<div class='icon' style='background-image: url({$icon_url});'></div>";
    }
    else {
      $output.= "<span class='icon'><img src='{$icon_url}' alt='' /></span>";
    }
    $output.= '<div class="content">'.do_shortcode($content).'</div>';
    $output.= '</div>';
    
    if($box) {
      $output = do_shortcode('[box inner_padding="smaller"]'.$output.'[/box]');
    }
    
    return $output;
  }
}

if(function_exists('sc_icon_text'))
{
  add_shortcode('icon_text', 'sc_icon_text');
}



/* Image
------------------------------------------------------------ */

if(!function_exists('sc_image'))
{
  function sc_image($atts, $content = null, $sc_name = '') {
    extract(shortcode_atts(array(
      'size'         => 'one-third',
      'width'        => '',
      'height'       => '',
      'lightbox_url' => '',
      'no_lightbox'  => '',
      'link'         => '',
      'open_new_tab' => '',
      'caption'      => '',
      'title'        => '',
      'alt'          => '',
      'align'        => '',
      'fancy'        => '',
      'last'         => '', // Will be auto-assigned if image is in gallery
      'in_gallery'   => ''  // Will be auto-assigned if image is in gallery
    ), $atts));
    
    $size   = str_replace('_', '-', $size);
    $fancy  = ($fancy  == 'true') ? 'fancy'  : '';
    $last   = ($last   == 'true') ? 'last'   : '';
    $align  = ($align && !$in_gallery) ? 'align'.$align : '';
    $custom_width  = $width;
    $custom_height = $height;
    $open_new_tab = ($open_new_tab == 'true') ? 'target="_blank"' : '';
    
    $link_url = ($lightbox_url) ? $lightbox_url : rvn_get_shortcode_unautop($content);
    
    
    //
    // Resize Image
    //
    
    // Is page full width?
    $content_column_size = rvn_get_page_content_size();
    $full_width_page = ($content_column_size == 'full');
    $full = ($full_width_page) ? '-full' : '';
    
    // Create image size ID
    $img_size_id = 'gallery'.$full.'-'.$size;
    
    // Get width and height from backend
    global $rvn;
    list($width, $height) = (isset($rvn['img_size'][$img_size_id])) ? $rvn['img_size'][$img_size_id] : false;
    
    // Get custom width and height
    if($custom_width) {
      if(is_numeric((int)$custom_width)) $width = (int)$custom_width;
      else                               $width = '*';
    }
    if($custom_height) {
      if(is_numeric((int)$custom_height)) $height = (int)$custom_height;
      else                                $height = '*';
    }
    
    // Should image be cropped or adapt the height?
    $crop = true;
    if(!(int)$height) {
      $crop   = false;
      $height = 9999;
    }
    if(!(int)$width) {
      $width = 9999;
    }
    
    // Resize the image
    $img_attr = rvn_resize_image(false, rvn_get_shortcode_unautop($content), $width, $height, $crop);
    
    
    //
    // Output
    //
    
    $output = '';
    $class  = "image framed {$fancy} {$align}";
    
    $output.= ($in_gallery) ? "<div class='{$size} {$last}'>" : '';
    if($caption) {
      $output.= "<div class='wp-caption {$class} {$align}'>";
      $class = '';
    }
    
    
    if($link) {
      $output.= "<a class='{$class}' {$open_new_tab} href='{$link}'>";
    }
    elseif($no_lightbox != 'true') {
      $output.= "<a data-gal='lightbox[gallery]' class='{$class}' href='{$link_url}'>";
    }
    else {
      $output.= "<div class='{$class}'>";
    }
    
    $output.= '<img src="'.$img_attr['url'].'" width="'.$img_attr['width'].'" height="'.$img_attr['height'].'" title="'.$title.'" alt="'.$alt.'" />';
    
    if($link || $no_lightbox != 'true') {
      $output.= '</a>';
    }
    else {
      $output.= '</div>';
    }
    
    $output.= ($caption) ? '<p class="wp-caption-text">'.$caption.'</p>' : '';
    $output.= ($caption) ? '</div>' : '';
    $output.= ($in_gallery) ? '</div>' : '';
    
    $output.= ($last) ? do_shortcode('[divider]') : '';
    
    $output = str_replace('<br/>', '', $output);
    $output = str_replace('<br>', '', $output);
    $output = str_replace('\n', '', $output);
    
    return $output;
  }
}

if(function_exists('sc_image'))
{
  add_shortcode('image', 'sc_image');
}



/* Notification
------------------------------------------------------------ */

if(!function_exists('sc_info_box'))
{
  function sc_info_box($atts, $content = null, $sc_name = '') {
    extract(shortcode_atts(array(
      'style' => 'note',
      'icon'  => ''
    ), $atts));
    
    $class = '';
    
    if    ($icon == 'none') $class = 'no-icon';
    elseif($icon)           $icon  = "style='background-image: url($icon);'";
    
    return "<p class='info-box {$style} {$class}' {$icon}>".do_shortcode($content)."</p>";
  }
}

if(function_exists('sc_info_box'))
{
  add_shortcode('info_box', 'sc_info_box');
}



/* List
------------------------------------------------------------ */

if(!function_exists('sc_list'))
{
  function sc_list($atts, $content = null, $sc_name = '') {
  	return str_replace('<ul>', '<ul class="'.$sc_name.'">', rvn_get_shortcode_unautop($content));
  }
}

if(function_exists('sc_list'))
{
  add_shortcode('checklist', 'sc_list');
  add_shortcode('crosslist', 'sc_list');
  add_shortcode('minuslist', 'sc_list');
  add_shortcode('pluslist',  'sc_list');
}



/* Inline Style
------------------------------------------------------------ */

if(!function_exists('sc_inline_style'))
{
  function sc_inline_style($atts, $content = null, $sc_name = '') {
    extract(shortcode_atts(array(
      'text_size'  => '',
      'text_align' => '',
      'class'      => '',
      'style'      => ''
    ), $atts));
    
    $class = "class='text {$class} {$text_size} {$text_align}'";
    $style = ($style) ? "style='{$style}'" : '';
    
    return "<{$sc_name} {$class} {$style}>".rvn_get_shortcode_unautop($content)."</{$sc_name}>";
  }
}

if(function_exists('sc_inline_style'))
{
  add_shortcode('div',  'sc_inline_style');
  add_shortcode('span', 'sc_inline_style');
}



/* Table
------------------------------------------------------------ */

if(!function_exists('sc_table'))
{
  function sc_table($atts, $content = null, $sc_name = '') {
    extract(shortcode_atts(array(
      'style' => 'default'
    ), $atts));
    
    return "<div class='table $style'>".rvn_get_shortcode_unautop($content)."</div>";
  }
}

if(function_exists('sc_table'))
{
  add_shortcode('table', 'sc_table');
}



/* Tab Group
------------------------------------------------------------ */

if(!function_exists('sc_tabgroup'))
{
  function sc_tabgroup($atts, $content = null, $sc_name = '') {
    extract(shortcode_atts(array(
      'type'  => 'horizontal',
      'style' => 'default'
    ), $atts));
    
		$output = "<div class='tabgroup $type $style'>";
	 	$output.= rvn_get_shortcode_unautop($content);
		$output.= '</div>';
		
		return $output;
  }
}

if(function_exists('sc_tabgroup'))
{
  add_shortcode('tabgroup', 'sc_tabgroup');
}



/* Tab
------------------------------------------------------------ */

if(!function_exists('sc_tab'))
{
	function sc_tab($atts, $content = null, $sc_name ="")
	{		
		extract(shortcode_atts(array(
		  'title'  => 'Title goes here',
		  'active' => ''
		), $atts));
    
    //$active = ($active == 'true') ? 'active' : '';
	  
		$output = "<div class='tab'><strong>$title</strong></div>";
		$output.= "<div class='tab-content'>";
		$output.= wpautop(rvn_get_shortcode_unautop($content));
		$output.= '</div>';
	
		return $output;
	}
}

if(function_exists('sc_tab'))
{
  add_shortcode('tab', 'sc_tab');
}



/* Toggler Group
------------------------------------------------------------ */

if(!function_exists('sc_togglergroup'))
{
  function sc_togglergroup($atts, $content = null, $sc_name = '') {
    extract(shortcode_atts(array(
      'accordion' => '',
      'style'     => 'default'
    ), $atts));
    
    $accordion = ($accordion == 'true') ? 'close-all' : '';
    
		$output = "<div class='togglergroup $accordion $style'>";
	 	$output.= rvn_get_shortcode_unautop($content);
		$output.= '</div>';
  
  	return $output;
  }
}

if(function_exists('sc_togglergroup'))
{
  add_shortcode('togglergroup', 'sc_togglergroup');
}



/* Toggler
------------------------------------------------------------ */

if(!function_exists('sc_toggler'))
{
  function sc_toggler($atts, $content = null, $sc_name = '') {
    extract(shortcode_atts(array(
      'title'  => 'Title goes here',
      'active' => ''
    ), $atts));
    
    $active = ($active == 'true') ? 'active' : '';
    
    $output = "<div class='toggler-wrapper'>";
  	$output.= "<div class='toggler $active'><strong>$title</strong></div>";
  	$output.= "<div class='toggler-content $active'>".wpautop(rvn_get_shortcode_unautop($content)).'</div>';
  	$output.= '</div>';
  
  	return $output;
  }
}

if(function_exists('sc_toggler'))
{
  add_shortcode('toggler', 'sc_toggler');
}



?>