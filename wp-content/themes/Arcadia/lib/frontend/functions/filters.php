<?php



/* Enable Shortcodes in Text Widget
------------------------------------------------------------ */

add_filter('widget_text', 'do_shortcode');



/* Excerpt Length
------------------------------------------------------------ */

if(!function_exists('rvn_excerpt_length'))
{
  function rvn_excerpt_length($length) {
    return 99;
  }
}

if(function_exists('rvn_excerpt_length'))
{
  add_filter('excerpt_length', 'rvn_excerpt_length');
}



/* Get Nothing
------------------------------------------------------------ */

// This functions can be used as callback when 'nothing' should be returned
if(!function_exists('rvn_get_nothing'))
{
  function rvn_get_nothing() {
    return '';
  }
}

if(function_exists('rvn_get_nothing')) {
  // Disable auto read more link for "the_content"
  add_filter('the_content_more_link', 'rvn_get_nothing');
}



/* No Texturize Shortcodes
------------------------------------------------------------ */

// To disable texturazation in certain shortcodes (e.g. the multiplication x in image sc paths)
function rvn_no_texturize_shortcodes($shortcodes) {
    $shortcodes[] = 'image';
    return $shortcodes;
}
add_filter( 'no_texturize_shortcodes', 'rvn_no_texturize_shortcodes' );



/* No Texturize Shortcodes
------------------------------------------------------------ */

function rvn_search_form( $form ) {

    $form = '<div class="searchform">
      <form role="search" method="get" action="'. home_url() .'/">
      	<p>
      		<input type="text" value="'. get_search_query() .'" id="s" name="s" size="35" placeholder="'. __('Search term', 'ruventhemes') .'" />
      		<input type="submit" id="searchsubmit" value="'. __('Search', 'ruventhemes') .'" />
      	</p>
      </form>
    </div>';

    return $form;
}

add_filter( 'get_search_form', 'rvn_search_form' );



?>