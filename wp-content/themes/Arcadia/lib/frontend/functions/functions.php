<?php



/* Get Attribute Value
------------------------------------------------------------ */

if(!function_exists('rvn_get_attr_value'))
{
  function rvn_get_attr_value($code, $tag) {
  	// Get attribute from html tag
  	$pattern = '/'.preg_quote($code).'=([\'"])?((?(1).+?|[^\s>]+))(?(1)\1)/is';
  	return (preg_match($pattern, $tag, $match)) ? urldecode($match[2]) : false;
  }
}



/* Get Background CSS Code
------------------------------------------------------------ */

if(!function_exists('rvn_background_css_code'))
{
  function rvn_background_css_code($option_prefix = 'bg') {
    $image      = rvn_get_option($option_prefix.'-image');
    $h_position = rvn_get_option($option_prefix.'-image-h-position');
    $v_position = rvn_get_option($option_prefix.'-image-v-position');
    $repeat     = rvn_get_option($option_prefix.'-image-repeat');
    $attachment = rvn_get_option($option_prefix.'-image-attachment');
    $color      = rvn_get_option($option_prefix.'-color');

	  $output = $color ? "background-color: $color;" : '';

    if($image) {
      $output.= " background-image: url($image);";

      // Repeat
      if(!in_array($repeat, array('no-repeat', 'repeat-x', 'repeat-y', 'repeat')))
        $repeat = 'repeat';
      $output.= " background-repeat: $repeat;";

      // Position
      if(!in_array($h_position, array('center', 'right', 'left')))
        $h_position = 'left';
      if(!in_array($v_position, array('center', 'top', 'bottom')))
        $v_position = 'top';
      $output.= " background-position: $v_position $h_position;";

      // Attachment
      if(!in_array($attachment, array('fixed', 'scroll')))
  			$attachment = 'scroll';
      $output.= " background-attachment: $attachment;";
    }

    return $output;
  }
}



/* Get Compressed CSS Code
------------------------------------------------------------ */

if(!function_exists('rvn_get_compressed_css_code'))
{
  function rvn_get_compressed_css_code($code) {
    // Remove Comments
    $code = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $code);
    // Remove tabs, spaces, newlines, etc.
    $code = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $code);

    return $code;
  }
}



/* Get Compressed JS Code
------------------------------------------------------------ */

if(!function_exists('rvn_get_compressed_js_code'))
{
  function rvn_get_compressed_js_code($code) {
    // Remove Comments (makes trouble when code contains URL (http://...)
    //$code = preg_replace("/((?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/)|(?:\/\/.*))/", "", $code);
    // Remove Comments
    $code = preg_replace('/(?<!\S)\/\/\s*[^\r\n]*/', '', $code);
    // Remove tabs, spaces, newlines, etc.
    $code = str_replace(array("\r\n","\r","\t","\n",'  ','    ','     '), '', $code);
    // Remove other spaces before and after
    $code = preg_replace(array('(( )+\))','(\)( )+)'), ')', $code);

    return $code;
  }
}



/* Get Content
------------------------------------------------------------ */

if(!function_exists('rvn_get_content'))
{
  function rvn_get_content($force_excerpt = false) {
    if($force_excerpt) {
      global $more;
  	  $more = 0;
  	}
    $content  = apply_filters('the_content', get_the_content());
    //$content  = str_replace( ']]>', ']]>', $content ); // Bug fix
    $content  = str_replace(']]>', ']]&gt;', $content);
    return $content;
  }
}



/* Get Content Type
------------------------------------------------------------ */

if(!function_exists('rvn_get_content_type'))
{
  function rvn_get_content_type() {
    $original_post_id = rvn_get_original_post_id();

    // Portfolio Page
    if(get_post_type($original_post_id) == 'portfolio')
      return 'portfolio-page';

    // Pages
    if(is_page($original_post_id))
      return 'page';

    // Pages
    if(is_single($original_post_id))
      return 'post';

    return 'blog';
  }
}



/* Get Darker Hex Color
------------------------------------------------------------ */

if(!function_exists('rvn_get_darker_hex_color'))
{
  function rvn_get_darker_hex_color($hex, $factor = 30) {
    $hex = str_replace('#', '', $hex);
    $new_hex = '';

    $base['R'] = hexdec($hex{0}.$hex{1});
    $base['G'] = hexdec($hex{2}.$hex{3});
    $base['B'] = hexdec($hex{4}.$hex{5});

    foreach($base as $k => $v) {
      $amount = $v / 100;
      $amount = round($amount * $factor);
      $new_decimal = $v - $amount;

      $new_hex_component = dechex($new_decimal);
      if(strlen($new_hex_component) < 2)
        $new_hex_component = "0".$new_hex_component;
      $new_hex.= $new_hex_component;
    }

    return $new_hex;
  }
}



/* Menu Fallback
------------------------------------------------------------ */

if(!function_exists('rvn_get_fb_menu'))
{
  function rvn_get_fb_menu($echo = true, $main = true, $depth = 3) {
	  $frontpage_id = rvn_get_option('frontpage-content');
	  $current_class = (is_home()) ? 'current_page_item' : '';
	  $main = ($main) ? 'id="main-nav" class="main"' : '';

  	$output = '<nav '.$main.'>';
  	$output.= '<ul>';
  	$output.= '<li class="'.$current_class.' menu-item-home"><a href="'.home_url().'">'._x('Home', 'menu entry', 'ruventhemes').'</a></li>';
  	$output.= wp_list_pages('title_li=&sort_column=menu_order&echo=0&depth='.$depth.'&exclude='.$frontpage_id);
  	$output.= '</ul>';
  	$output.= '</nav>';

  	if($echo)
  	  echo $output;
  	else
  	  return $output;
  }
}



/* Get Featured Content
------------------------------------------------------------ */

if(!function_exists('rvn_get_featured_content'))
{
  function rvn_get_featured_content($rvn_post_id = 0, $size_id, $size = array(), $image_link_method = 'lightbox', $portfolio = array('external_link' => '#', 'external_link_opens_new_tab' => false))
  {
    $rvn_post_id = rvn_get_post_id($rvn_post_id);
    $page_type   = rvn_get_page_type();
    $output      = '';

    // Get content replacement value based on page type
    $content_rep = rvn_get_post_meta($rvn_post_id, 'featured-content-'.$page_type.'-replacent');

    // If content replacement is available
    if($content_rep) {
      // If no featured content should be displayed, return nothing
      if($content_rep == 'none') {
        return '';
      }
      // If replacement image is available
      if(rvn_is_image($content_rep)) {
        $featured_image = rvn_get_featured_image($rvn_post_id, $size_id, $size, $content_rep);
      }
      // If replacement video is available
      else {
        $content_rep = htmlspecialchars_decode($content_rep, ENT_QUOTES);
        $featured_video = rvn_get_featured_video($rvn_post_id, $content_rep, $size_id, $size);
      }
    }

    // If image is available
    elseif(has_post_thumbnail($rvn_post_id)) {
      $featured_image = rvn_get_featured_image($rvn_post_id, $size_id, $size);
    }

    // Create featured image HTML output if its set
    if(isset($featured_image)) {
      // If Lightbox should open on click
      if($image_link_method == 'lightbox') {
        // Get lightbox replacement value
        $lightbox_content_url = rvn_get_post_meta($rvn_post_id, 'featured-content-lightbox-replacent');
        // If lightbox replacement is not available, set default
        if(!$lightbox_content_url)
          $lightbox_content_url = rvn_get_featured_lightbox_content_url($rvn_post_id);

        // Output featured image lightbox link
        $output.= '<a data-gal="lightbox[featured]" class="fancy framed" href="'.$lightbox_content_url.'">'.$featured_image.'</a>';
      }
      // If Entry should open on click
      elseif($image_link_method == 'entry') {
        // Output featured image with link to entry
        $output.= '<a class="fancy framed entry-link" href="'.get_permalink($rvn_post_id).'">'.$featured_image.'</a>';
      }
      // If external link should open on click
      elseif($image_link_method == 'external') {
        $url = $portfolio['external_link'];
        $target = $portfolio['external_link_opens_new_tab'] ? 'target="_blank"' : '';
        $output.= '<a class="fancy framed external-link" '.$target.' href="'.$url.'">'.$featured_image.'</a>';
      }
      // If nothing should happen on click
      else {
        $output.= '<div class="fancy framed">'.$featured_image.'</div>';
      }
    }

    // Create featured video HTML output if its set
    elseif(isset($featured_video)) {
      $output.= '<div class="fancy framed">';
      $output.= $featured_video;
      $output.= '</div>';
    }

    return $output;
  }
}



/* Get Featured Content Size by Type
------------------------------------------------------------ */

if(!function_exists('rvn_get_featured_content_size_by_id'))
{
  function rvn_get_featured_content_size_by_id($id) {
    global $rvn;
    return (isset($rvn['img_size'][$id])) ? $rvn['img_size'][$id] : false;
  }
}



/* Get Featured Image
------------------------------------------------------------ */

if(!function_exists('rvn_get_featured_image'))
{
  function rvn_get_featured_image($rvn_post_id = 0, $size_id, $size = array(), $url = false, $img_attr = array()) {
    $crop          = true;
    $img_id        = false;
    $resize_method = 'crop';

    $img_attr_defaults = array(
      'alt'   => '',
      'title' => ''
    );

    $img_attr = wp_parse_args($img_attr, $img_attr_defaults);

    // Get default width and height
    list($width, $height) = rvn_get_featured_content_size_by_id($size_id);

    // If specific content size is set with $size, take the sizes and not the ones that are preset
    if($size && is_array($size)) {
      $width  = empty($size[0]) ? $width  : $size[0];
      $height = empty($size[1]) ? $height : $size[1];
    }

    // If image is featured image and not a replacement
    if(!$url) {
      $rvn_post_id = rvn_get_post_id($rvn_post_id);
      // Get featured image ID
      $img_id = get_post_thumbnail_id($rvn_post_id);
      // Get alternative text if post has featured image
      if($img_id && !$img_attr['alt'])
        $img_attr['alt'] = get_post_meta($img_id, '_wp_attachment_image_alt', true);
      // Return false if post has no feature image
      if(!$img_id)
        return false;
      // If no height is set, set resize method to adaptive height
      if(!(int)$height)
        $resize_method = 'adaptive-height';
    }

    // If replacement image url is set
    else {
      // Get page type
      $page_type = rvn_get_page_type();
      // Get replacement method based in page type
      $resize_method = rvn_get_post_meta($rvn_post_id, 'featured-content-'.$page_type.'-replacent-resize-method');
      // If resize method is set to "inherit", set it to "adaptive-height" if global resize method is set to the same and else to "crop"
      if($resize_method == 'inherit') {
        $resize_method = (!is_numeric($height)) ? 'adaptive-height' : 'crop';
      }
      // If global height is set to "adaptive", but replacement image is croped
      if(!is_numeric($height) && $resize_method == 'crop') {
        global $rvn;
        $height = $rvn['default'][$size_id.'-img-height'];
      }
    }

    // If height is set to be adaptive (*), set it to 9999px so height can be adjusted automatically and disable cropping
    if($resize_method == 'adaptive-height') {
      $height = '9999';
      $crop   = false;
    }

    if($resize_method != 'no-resize') {
      // Resize image if necessary and get its attributes
      $resize_img_attr = rvn_resize_image($img_id, $url, $width, $height, $crop);
    }
    else {
      $resize_img_attr = getimagesize($url);
      $resize_img_attr = array('url'    => $url,
                            	 'width'  => $resize_img_attr[0],
                            	 'height' => $resize_img_attr[1]);
    }

    // Return image element of featured image
    return '<img src="'.$resize_img_attr['url'].'" width="'.$resize_img_attr['width'].'" height="'.$resize_img_attr['height'].'" alt="'.$img_attr['alt'].'" title="'.$img_attr['title'].'" />';
  }
}



/* Get Lightbox Content URL
------------------------------------------------------------ */

if(!function_exists('rvn_get_featured_lightbox_content_url'))
{
  function rvn_get_featured_lightbox_content_url($rvn_post_id = 0) {
    $rvn_post_id = rvn_get_post_id($rvn_post_id);
    $content     = rvn_get_post_meta($rvn_post_id, 'lightbox-content');

    // If there is no specific Lightbox content URL, use a bigger version of the featured image
    if(!$content) {
      $image_id  = get_post_thumbnail_id($rvn_post_id);
      $image_url = wp_get_attachment_image_src($image_id, 'large');
      $content   = $image_url[0];
    }

    return $content;
  }
}



/* Get Featured Video
------------------------------------------------------------ */

if(!function_exists('rvn_get_featured_video'))
{
  function rvn_get_featured_video($rvn_post_id = 0, $embedding_code, $size_id, $size = array()) {
    $rvn_post_id = rvn_get_post_id($rvn_post_id);
    // Get page type
    $page_type = rvn_get_page_type();
    // Get replacement method
    $rep_resize_method = rvn_get_post_meta($rvn_post_id, 'featured-content-'.$page_type.'-replacent-resize-method');

    // Just return embedding code when video shouldn't be resized
    if($rep_resize_method == 'no-resize') {
      return $embedding_code;
    }

    // If video should adapt height or be cropped
    else {
      $crop = true;

      // Get default width and height
      list($width, $height) = rvn_get_featured_content_size_by_id($size_id);

      // If specific content size is set with $size, take the sizes and not the ones that are preset
      if($size && is_array($size)) {
        $width  = empty($size[0]) ? $width  : $size[0];
        $height = empty($size[1]) ? $height : $size[1];
      }

      // If resize method is set to "inherit", set it to "adaptive-height" if global resize method is set to the same and else to "crop"
      if($rep_resize_method == 'inherit') {
        $rep_resize_method = (!is_numeric($height)) ? 'adaptive-height' : 'crop';
      }

      // If global height is set to "adaptive", but replacement video is croped
      if(!is_numeric($height) && $rep_resize_method == 'crop') {
        global $rvn;
        $height = $rvn['default'][$size_id.'-img-height'];
      }

      // If video should resize proportional to width
      $crop = ($rep_resize_method == 'adaptive-height') ? false : true;

      // Return resized embedding code
      return rvn_resize_video($embedding_code, $width, $height, $crop);
    }
  }
}



/* Get Font Family
------------------------------------------------------------ */

if(!function_exists('rvn_get_font_family'))
{
  function rvn_get_font_family($font_family) {
    $google_web_fonts = rvn_get_fonts(array('Google Web Fonts'));
    $google_web_fonts = $google_web_fonts['Google Web Fonts'];

    foreach($google_web_fonts as $google_web_font_name => $google_web_font_code) {
      if($font_family == $google_web_font_code) {
        $google_web_font_name = (strpos($google_web_font_name, ' ') !== false) ? "'".$google_web_font_name."'" : $google_web_font_name;
        return $google_web_font_name.', sans-serif';
      }
    }

    return $font_family;
  }
}



/* Get Info Bar Content
------------------------------------------------------------ */

if(!function_exists('rvn_get_info_bar_content'))
{
  function rvn_get_info_bar_content($bar = 'footer-bar') {
    $left_content_type  = rvn_get_option("{$bar}-left-content-type");
    $right_content_type = rvn_get_option("{$bar}-right-content-type");
    $output = '';

    $content_types = array(
      'primary'   => $left_content_type,
      'secondary' => $right_content_type
    );
    foreach($content_types as $position => $content_type) {
      if($content_type == 'text')
        $output.= rvn_get_info_bar_text($bar, $position);
      elseif($content_type == 'social-icons')
        $output.= rvn_get_info_bar_social_icons($position);
      elseif($content_type == 'menu')
        $output.= rvn_get_info_bar_menu($bar, $position);
    }

    return $output;
  }
}



/* Get Info Bar Menu
------------------------------------------------------------ */

if(!function_exists('rvn_get_info_bar_menu'))
{
  function rvn_get_info_bar_menu($bar = 'footer-bar', $class = 'primary') {
    $menu = wp_nav_menu(array(
      'echo'           => 0,
      'theme_location' => $bar,
      'container'      => 'nav',
  		'fallback_cb'    => 'rvn_put_info_bar_fb_menu',
      'depth'          => 1
    ));

    return '<div class="'.$class.'">'.$menu.'</div>';
  }
}



/* Get Info Bar Social Icons
------------------------------------------------------------ */

if(!function_exists('rvn_get_info_bar_social_icons'))
{
  function rvn_get_info_bar_social_icons($class = 'primary') {
    $output = '<ul class="social-icons '.$class.'">';
    $list  = '';
    $social_icons = rvn_get_social_icons();

    foreach($social_icons as $title => $img_id) {
      $url  = rvn_get_option('social-link-'.$img_id);
      $list.= rvn_get_social_icon_list_element($img_id, $title);
    }

    return ($list) ? $output.$list.'</ul>' : '';
  }
}



/* Get Info Bar Text
------------------------------------------------------------ */

if(!function_exists('rvn_get_info_bar_text'))
{
  function rvn_get_info_bar_text($bar = 'footer-bar', $class = 'primary') {
    $text = rvn_get_option("{$bar}-text");
    $text = do_shortcode($text);
    if(!empty($text)) {
      return '<div class="'.$class.'">'.$text.'</div>';
    }
  }
}



/* Get Lighter Hex Color
------------------------------------------------------------ */

if(!function_exists('rvn_get_lighter_hex_color'))
{
  function rvn_get_lighter_hex_color($hex, $factor = 30) {
    $hex = str_replace('#', '', $hex);
    $new_hex = '';

    $base['R'] = hexdec($hex{0}.$hex{1});
    $base['G'] = hexdec($hex{2}.$hex{3});
    $base['B'] = hexdec($hex{4}.$hex{5});

    foreach ($base as $k => $v) {
      $amount = 255 - $v;
      $amount = $amount / 100;
      $amount = round($amount * $factor);
      $new_decimal = $v + $amount;

      $new_hex_component = dechex($new_decimal);
      if(strlen($new_hex_component) < 2)
        $new_hex_component = "0".$new_hex_component;
      $new_hex.= $new_hex_component;
    }

    return $new_hex;
  }
}



/* Get Page Content Size
------------------------------------------------------------ */

if(!function_exists('rvn_get_page_content_size'))
{
  function rvn_get_page_content_size() {
    global $rvn;
    return (!$rvn['layout']['fullwidth']) ? 'two-third' : 'full';
  }
}



/* Get Page Type
------------------------------------------------------------ */

if(!function_exists('rvn_get_page_type'))
{
  function rvn_get_page_type($page_id = 0) {
    $page_id = ($page_id) ? $page_id : rvn_get_original_post_id();

    if(is_page($page_id) || is_single($page_id))
      return 'entry';

    return 'overview';
  }
}



/* Get Paginator
------------------------------------------------------------ */

// Original Code from a Tutorial by Christian “Kriesi” Budschedl
// http://www.kriesi.at/archives/how-to-build-a-wordpress-post-pagination-without-plugin/
// Code was modified by Ruven Pelka

if(!function_exists('rvn_get_paginator'))
{
  function rvn_get_paginator($pages = '', $range = 3) {
    $showitems = ($range * 2) + 1;

    if(empty($pages)) {
      global $wp_query;
      $pages = $wp_query->max_num_pages;
      if(!$pages) $pages = 1;
    }

    global $paged;
    if(empty($paged)) $paged = 1;

    if($pages != 1) {
      $output = '<div class="paginator">';
      /*
      if($paged > 2 && $paged > $range+1 && $showitems < $pages)
        $output.= '<a href="'.get_pagenum_link(1).'">&laquo; First</a>';
      */
      //if($paged > 1 && $showitems < $pages)
      $output.= "<a href='".get_pagenum_link($paged-1)."' class='first'>&laquo; "._x('Prev', 'paginator', 'ruventhemes')."</a>";

      for($i=1; $i<=$pages; $i++) {
         if($pages != 1 && (!($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
           if($paged == $i)
             $output.= '<span class="current">'.$i.'</span>';
           else
             $output.= '<a href="'.get_pagenum_link($i).'" class="inactive">'.$i.'</a>';
         }
      }

      //if($paged < $pages && $showitems < $pages)
      if($paged == $pages) $paged--;
      $output.= '<a href="'.get_pagenum_link($paged+1).'" class="last">'._x('Next', 'paginator', 'ruventhemes').' &raquo;</a>';
      /*
      if($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages)
        $output.= '<a href="'.get_pagenum_link($pages).'">Last &raquo;</a>';
      */
      $output.= "</div>\n";

      echo $output;
    }
  }
}



/* Get Social Icon List Element
------------------------------------------------------------ */

if(!function_exists('rvn_get_social_icon_list_element'))
{
  function rvn_get_social_icon_list_element($img_id, $title = '', $folder = 'white_16') {
    $url = rvn_get_option('social-link-'.$img_id);
    if($url) {
      $img_url = IMAGES_URL.'/social_icons/'.$folder.'/'.$img_id.'.png';
      $style   = "style='background-image: url($img_url);'";
      return "<li><a href='$url' target='_blank' title='$title' $style>$title</a></li>";
    }

    return false;
  }
}



/* Is Blog Page?
------------------------------------------------------------ */

if(!function_exists('rvn_is_blog_page'))
{
  function rvn_is_blog_page($page_id = 0) {
    $page_id = ($page_id) ? $page_id : rvn_get_original_post_id();
    return ($page_id == (int)rvn_get_option('blog-page'));
  }
}



/* Is Image?
------------------------------------------------------------ */

if(!function_exists('rvn_is_image'))
{
  function rvn_is_image($file) {
    $suffix = end(explode('.', $file));
    $allowed_suffixes = array('jpg', 'jpeg', 'png', 'gif');
    return in_array($suffix, $allowed_suffixes);
  }
}



/* Is Portfolio Page?
------------------------------------------------------------ */

if(!function_exists('rvn_is_portfolio_page'))
{
  function rvn_is_portfolio_page($page_id = 0) {
    static $is_portfolio_page = false;

    if(!$is_portfolio_page) {
      global $rvn;
      $page_id = ($page_id) ? $page_id : rvn_get_original_post_id();

      $multitable_str  = rvn_get_option('portfolio-multitable');
      $multitable_data = rvn_get_multitable_data($multitable_str);
      $rvn['data']['portfolio-page-settings'] = $multitable_data;

      for($i = 1; $i <= count($multitable_data); $i++) {
        $options = $multitable_data[$i-1];
        if((int)$options['rvn_portfolio-page_'.$i] == $page_id) {
          $is_portfolio_page = true;
        }
      }
    }

    return $is_portfolio_page;
  }
}



/* Put Comment Form Callback
------------------------------------------------------------ */

if(!function_exists('rvn_put_comment_form'))
{
  function rvn_put_comment_form() {
    global $post, $user_identity;

    $commenter = wp_get_current_commenter();
    $req       = get_option('require_name_email');
    $aria_req  = ($req ? " aria-required='true'" : '');

    $fields = array(
    	'author' => '<p class="one-third comment-form-author">' .
    	            '<label for="author">'.__('Name', 'ruventhemes').($req ? '<span class="required"> *</span>' : ' ').'</label>' .
    	            '<input type="text" id="author" name="author" value="'.esc_attr($commenter['comment_author']).'" size="30"'.$aria_req.' />' .
    	            '</p>',
    	'email'  => '<p class="one-third comment-form-email">' .
    	            '<label for="email">'.__('E-Mail', 'ruventhemes').($req ? '<span class="required"> * </span>' : ' ').__('(will not be published)', 'ruventhemes').'</label>' .
    	            '<input type="text" id="email" name="email" value="'.esc_attr($commenter['comment_author_email']).'" size="30"'.$aria_req.' />' .
    	            '</p>',
    	'url'    => '<p class="one-third last comment-form-url">' .
    	            '<label for="url">'.__('Website', 'ruventhemes').'</label>' .
    	            '<input type="text" id="url" name="url" value="'.esc_attr($commenter['comment_author_url']).'" size="30" />' .
    	            '</p>'
    );

    comment_form(array(
      'fields'               => apply_filters('comment_form_default_fields', $fields),
    	'comment_field'        => '<span class="spacer"></span><span class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></span>',
    	'must_log_in'          => '<p class="must-log-in">'.sprintf(__('You must be <a href="%s">logged in</a> to post a comment.'), wp_login_url( apply_filters('the_permalink', get_permalink($post->ID)))).'</p>',
    	'logged_in_as'         => '<p class="logged-in-as">'.sprintf(__('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>'), admin_url('profile.php'), $user_identity, wp_logout_url(apply_filters('the_permalink', get_permalink($post->ID)))).'</p>',
    	'comment_notes_before' => '',
    	'comment_notes_after'  => '<p class="form-allowed-tags quiet">'.sprintf(__('You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s'), ' <code>'.allowed_tags().'</code>').'</p>',
    	'id_form'              => 'comment-form',
    	'id_submit'            => 'submit',
    	'title_reply'          => __('Leave a Reply', 'ruventhemes'),
    	'title_reply_to'       => __('Leave a Reply to %s', 'ruventhemes'),
    	'cancel_reply_link'    => __('Cancel Reply', 'ruventhemes'),
    	'label_submit'         => __('Submit Reply', 'ruventhemes')
    ));
  }
}



/* Put Comment Callback
------------------------------------------------------------ */

if(!function_exists('rvn_put_comment'))
{
  function rvn_put_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    $comment_class = implode(' ', get_comment_class());

    // Comment Start
    $output = '<li id="comment-'.get_comment_ID().'" class="comment '.$comment_class.'">';
    $output.= '<article>';

    // Avatar
    $output.= '<div class="gravatar one-sixth">';
    $output.= get_avatar($comment, 122);
    $output.= get_comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth'])));
    $output.= '</div><!-- END .gravatar -->';

    // Content Head Start
    $output.= '<div class="main five-sixth last">';
    $output.= '<header>';

    // Author Name
    $output.= '<cite class="author-name">'.get_comment_author_link().'</cite>';

    // Date and Time
    $output.= '<a class="meta-data quiet" href="'.esc_url(get_comment_link($comment->comment_ID)).'">';
    $output.= '<time datetime="'.get_comment_date('c').'" pubdate>';
  	$output.= sprintf(_x('%1$s at %2$s', 'timeframe', 'ruventhemes'), get_comment_date(),  get_comment_time());
  	$output.= '</time>';
    $output.= '</a>';

    // Content Head End
    $output.= '</header>';

  	// Content Start
    $output.= '<div class="content">';

    // Moderation
  	if($comment->comment_approved == '0') {
  	  $output.= '<span class="moderation-awaited">'.__('Your comment is awaiting moderation.', 'ruventhemes').'</span>';
  		$output.= '<br />';
  	}

  	// Content Text
    $output.= get_comment_text();
    $edit_comment_link = get_edit_comment_link();
    if(!empty($edit_comment_link))
      $output.= ' (<a href="'.$edit_comment_link.'">'.__('Edit', 'ruventhemes').'</a>)';

    // Content End
    $output.= '</div><!-- END .content -->';

    // Comment End
  	$output.= '</div><!-- END .main -->';
    $output.= '</article>';

    // Output
    echo $output;
  }
}



/* Put Featured Content
------------------------------------------------------------ */

if(!function_exists('rvn_put_featured_content'))
{
  function rvn_put_featured_content() {
    $feature_method = rvn_get_option('frontpage-feature-method');
    if(is_front_page() && $feature_method) {
      switch($feature_method) {
        case 'nivo-slider'       : get_template_part('lib/frontend/templates/slider_nivo');         break;
        case 'cycle-slider'      : get_template_part('lib/frontend/templates/slider_cycle');        break;
        case 'cycle-alt-slider'  : get_template_part('lib/frontend/templates/slider_cycle_alt');    break;
        case 'piecemaker-slider' : get_template_part('lib/frontend/templates/slider_piecemaker');   break;
        case 'featured-image'    : get_template_part('lib/frontend/templates/featured_image');      break;
        case 'featured-image-alt': get_template_part('lib/frontend/templates/featured_image_alt');  break;
        case 'featured-video'    : get_template_part('lib/frontend/templates/featured_video');      break;
        case 'featured-video-alt': get_template_part('lib/frontend/templates/featured_video_alt');  break;
      }
    }
  }
}



/* Put Footer Widget Area
------------------------------------------------------------ */

if(!function_exists('rvn_put_footer_widget_area'))
{
  function rvn_put_footer_widget_area() {
    $columns = explode('::', rvn_get_option('footer-columns'));
    $columns_count = count($columns);

    $i = 1;
    foreach($columns as $column) {
      $last = ($i == $columns_count) ? 'last' : '';
      echo "<div class='$column $last'>";
      dynamic_sidebar('Footer Column '.$i);
      echo '</div>';
      $i++;
    }

    echo do_shortcode('[divider]');
  }
}



/* Put Header Bar
------------------------------------------------------------ */

if(!function_exists('rvn_put_header_bar'))
{
  function rvn_put_header_bar() {
    if('true' == rvn_get_option('show-header-bar')) {
      echo '<section id="header-bar" class="info-bar">';
      echo   '<div class="wrapper ">';
      echo     rvn_get_info_bar_content('header-bar');
      echo   '</div>';
      echo '</section>';
    }
  }
}



/* Put Logo
------------------------------------------------------------ */

if(!function_exists('rvn_put_logo'))
{
  function rvn_put_logo() {
    $logo_url = rvn_get_option('logo', IMAGES_URL.'/dummy/logo.png');
    $output = '<h1 id="logo">';
    $output.=   '<a href="'.get_home_url().'">';
    $output.=     '<img src="'.$logo_url.'" alt="'.get_bloginfo('name').'" />';
    $output.=   '</a>';
    $output.= '</h1>';

    if('header-style-center' == rvn_get_option('header-style')) {
      echo '<div id="logo-wrapper" class="wrapper">'.$output.'</div>';
      echo '<div id="header-divider"></div>';
    }
    else {
      echo $output;
    }
  }
}



/* Put Info Bar Fallback Menu
------------------------------------------------------------ */

if(!function_exists('rvn_put_info_bar_fb_menu'))
{
  function rvn_put_info_bar_fb_menu() {
    return rvn_get_fb_menu(false, false, 1);
  }
}



/* Put No Entries Found
------------------------------------------------------------ */

if(!function_exists('rvn_put_no_entries_found'))
{
  function rvn_put_no_entries_found($heading = '', $text = '') {
    if($heading !== false) {
      $heading = !empty($heading) ? $heading : '<h3 class="top">'.__('No Entries Found', 'ruventhemes').'</h3>';
    }
    $text = !empty($text)    ? $text    : __('Sorry, but there are no entries in here that are matching your criteria.', 'ruventhemes');
    echo '<article class="entry">';
    echo $heading;
    echo '<p>'.$text.'</p>';
    get_search_form();
    echo '</article>';
  }
}



/* Put Page Header
------------------------------------------------------------ */

if(!function_exists('rvn_put_page_header'))
{
  function rvn_put_page_header($title = false) {
    $title = empty($title) ? get_the_title() : $title;
    $output = '<div id="page-header">';
    $output.= '<div id="page-title" class="primary">';
    $output.= '<h1 class="top bottom">' . $title . '</h1>';
    $output.= '</div>';

    $content_type = rvn_get_option('page-header-right-content-type');
    $output.= '<div class="secondary">';

    if('social-icons' == $content_type) {
      $output.= rvn_get_page_header_social_icons();
    }
    elseif('search-form' == $content_type) {
      $output.= get_search_form(false);
    }

    $output.= '</div>';

    $output.= '</div>';
    echo $output;
  }
}



/* Get Page Header Social Icons
------------------------------------------------------------ */

if(!function_exists('rvn_get_page_header_social_icons'))
{
  function rvn_get_page_header_social_icons() {
    $output = '<ul class="social-icons">';
    $list   = '';
    $social_icons = rvn_get_social_icons();

    foreach($social_icons as $title => $img_id) {
      $url  = rvn_get_option('social-link-'.$img_id);
      $list.= rvn_get_social_icon_list_element($img_id, $title, 'grey_round_22');
    }

    return ($list) ? $output.$list.'</ul>' : '';
  }
}



/* Put Sidebar Widget Area
------------------------------------------------------------ */

if(!function_exists('rvn_put_sidebar_widget_area'))
{
  function rvn_put_sidebar_widget_area() {
    $post_id = rvn_get_original_post_id();

    $custom_sidebar      = 'Custom Sidebar: '.rvn_get_post_meta($post_id, 'sidebar');
    $default_sidebar     = 'Default Sidebar';
    $alt_default_sidebar = $default_sidebar;

    if(rvn_is_blog_page($post_id)) {
      $default_sidebar = 'Default Sidebar for Blog';
    }
    elseif(rvn_is_portfolio_page($post_id)) {
      $default_sidebar = 'Default Sidebar for Portfolio';
    }
    elseif(get_post_type($post_id) == 'portfolio') {
      $default_sidebar     = 'Default Sidebar for Portfolio Pages';
      $alt_default_sidebar = 'Default Sidebar for Portfolio';
    }
    elseif(is_single($post_id)) {
      $default_sidebar     = 'Default Sidebar for Posts';
      $alt_default_sidebar = 'Default Sidebar for Blog';
    }
    elseif(is_page($post_id)) {
      $default_sidebar = 'Default Sidebar for Pages';
    }
    elseif(is_front_page()) {
      $default_sidebar = 'Front Page';
    }

    if    (is_404()      && dynamic_sidebar('404 - Page not Found')) true;
    elseif(is_category() && dynamic_sidebar('Category')) true;
    elseif(is_archive()  && dynamic_sidebar('Archive'))  true;
    elseif(is_search()   && dynamic_sidebar('Search'))   true;

    elseif($custom_sidebar && dynamic_sidebar($custom_sidebar)) true;
    elseif(dynamic_sidebar($default_sidebar))     true;
    elseif(dynamic_sidebar($alt_default_sidebar)) true;
    elseif(dynamic_sidebar('Default Sidebar'))    true;

    else {
      $args = array(
      	'before_widget' => '<aside id="" class="widget widget_pages">',
      	'after_widget'  => '</aside><!-- END .widget -->',
      	'before_title'  => '<h3 class="widget-title">',
      	'after_title'   => '</h3>'
    	);
      the_widget('WP_Widget_Meta', null, $args);
      the_widget('WP_Widget_Links', null, $args);
    }
  }
}



/* Put Welcome Bar
------------------------------------------------------------ */

if(!function_exists('rvn_put_welcome_bar'))
{
  function rvn_put_welcome_bar() {
    if(is_front_page()) {
      $show_welcome_bar = rvn_get_option('show-welcome-bar');
      $title            = rvn_get_option('welcome-bar-title');
      $text             = rvn_get_option('welcome-bar-text');

      if($show_welcome_bar && ($title || $text)) {
        echo '<section id="welcome-bar">';
        echo '<div class="wrapper">';
        if($title) echo "<h2>{$title}</h2>";
        if($title && $text) echo do_shortcode('[spacer size="small"]');
        if($text)  echo "<p>{$text}</p>";
        echo '</div>';
        echo '</section>';
      }
    }
  }
}



/* Resize Video
------------------------------------------------------------ */

if(!function_exists('rvn_resize_video'))
{
  function rvn_resize_video($embedding_code, $width, $height, $crop = false) {
    $patterns     = array();
    $replacements = array();

    // Get video size from embedding code
    $orig_width  = rvn_get_attr_value('width', $embedding_code);
    $orig_height = rvn_get_attr_value('height', $embedding_code);

    // If video shoudn't be cropped
    if(!$crop) {
      // Set height to 9999px to make it scale as heigh as needed
      $height = 9999;
      // Get proportional video size // original sizes need to be bigger than outcome (times 10)
      list($width, $height) = wp_constrain_dimensions($orig_width*10, $orig_height*10, $width, $height);
    }

    // Replace width and height in embedding code
    $sizes = array('width', 'height');
    foreach($sizes as $size) {
      $size_value = ($size == 'width') ? $width : $height;

      // Set patterns
      $patterns[] = '/'.$size.'="([0-9]+)"/';
      $patterns[] = "/".$size."='([0-9]+)'/";
      $patterns[] = '/'.$size.'=([0-9]+)/';
      $patterns[] = '/'.$size.':([0-9]+)/';

      // Set replacements
      $replacements[] = $size.'="'.$size_value.'"';
      $replacements[] = $size."='".$size_value."'";
      $replacements[] = $size.'='.$size_value.'';
      $replacements[] = $size.':'.$size_value;
    }

    // Replace patterns with replacements and return value
    return preg_replace($patterns, $replacements, $embedding_code);
  }
}



/* Resize Image
------------------------------------------------------------ */

/*
 * Resize images dynamically using wp built in functions
 * Victor Teixeira
 * http://core.trac.wordpress.org/ticket/15311
 *
 * php 5.2+
 *
 * Exemplo de uso:
 *
 * <?php
 * $thumb = get_post_thumbnail_id();
 * $image = vt_resize( $thumb, '', 140, 110, true );
 * ?>
 * <img src="<?php echo $image[url]; ?>" width="<?php echo $image[width]; ?>" height="<?php echo $image[height]; ?>" />
 *
 * @param int $attach_id
 * @param string $img_url
 * @param int $width
 * @param int $height
 * @param bool $crop
 * @return array
 */

if(!function_exists('rvn_resize_image'))
{
  function rvn_resize_image( $attach_id = null, $img_url = null, $width, $height, $crop = false ) {

  	// this is an attachment, so we have the ID
  	if ( $attach_id ) {

  		$image_src = wp_get_attachment_image_src( $attach_id, 'full' );
  		$file_path = get_attached_file( $attach_id );

  	// this is not an attachment, let's use the image url
  	} else if ( $img_url ) {

  		$file_path = parse_url( $img_url );
  		$file_path = $_SERVER['DOCUMENT_ROOT'] . $file_path['path'];

  		//$file_path = ltrim( $file_path['path'], '/' );
  		//$file_path = rtrim( ABSPATH, '/' ).$file_path['path'];

  		$orig_size = getimagesize( $file_path );

  		$image_src[0] = $img_url;
  		$image_src[1] = $orig_size[0];
  		$image_src[2] = $orig_size[1];
  	}

  	$file_info = pathinfo( $file_path );
  	$extension = '.'. $file_info['extension'];

  	// the image path without the extension
  	$no_ext_path = $file_info['dirname'].'/'.$file_info['filename'];

  	$cropped_img_path = $no_ext_path.'-'.$width.'x'.$height.$extension;

  	// checking if the file size is larger than the target size
  	// if it is smaller or the same size, stop right here and return
  	if ( $image_src[1] > $width || $image_src[2] > $height ) {

  		// the file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match)
  		if ( file_exists( $cropped_img_path ) ) {

  			$cropped_img_url = str_replace( basename( $image_src[0] ), basename( $cropped_img_path ), $image_src[0] );

  			$vt_image = array (
  				'url' => $cropped_img_url,
  				'width' => $width,
  				'height' => $height
  			);

  			return $vt_image;
  		}

  		// $crop = false
  		if ( $crop == false ) {

  			// calculate the size proportionaly
  			$proportional_size = wp_constrain_dimensions( $image_src[1], $image_src[2], $width, $height );
  			$resized_img_path = $no_ext_path.'-'.$proportional_size[0].'x'.$proportional_size[1].$extension;

  			// checking if the file already exists
  			if ( file_exists( $resized_img_path ) ) {

  				$resized_img_url = str_replace( basename( $image_src[0] ), basename( $resized_img_path ), $image_src[0] );

  				$vt_image = array (
  					'url' => $resized_img_url,
  					'width' => $proportional_size[0],
  					'height' => $proportional_size[1]
  				);

  				return $vt_image;
  			}
  		}

  		// no cache files - let's finally resize it
  		$new_img_path = image_resize( $file_path, $width, $height, $crop );
  		$new_img_size = getimagesize( $new_img_path );
  		$new_img = str_replace( basename( $image_src[0] ), basename( $new_img_path ), $image_src[0] );

  		// resized output
  		$vt_image = array (
  			'url' => $new_img,
  			'width' => $new_img_size[0],
  			'height' => $new_img_size[1]
  		);

  		return $vt_image;
  	}

  	// default output - without resizing
  	$vt_image = array (
  		'url'    => $image_src[0],
  		'width'  => $image_src[1],
  		'height' => $image_src[2]
  	);

  	return $vt_image;
  }
}



/* Set Page Content Size
------------------------------------------------------------ */

if(!function_exists('rvn_set_page_content_size'))
{
  function rvn_set_page_content_size() {
    global $post;
    $page_content_size = rvn_get_post_meta($post->ID, 'page-content-size');
    if($page_content_size == 'full') {
      rvn_set_fullwidth_page_size();
    }
  }
}



/* Set Sidebar Position
------------------------------------------------------------ */

if(!function_exists('rvn_set_sidebar_position'))
{
  function rvn_set_sidebar_position() {
    global $post;
    $sidebar_position = rvn_get_post_meta($post->ID, 'sidebar-position');
    if($sidebar_position != 'inherit') {
      rvn_add_body_class('sidebar-'.$sidebar_position);
    }
    else {
      rvn_set_body_class('sidebar-position', 'left', 'sidebar-left');
    }
  }
}



?>