<?php



/* Get Social Icons
------------------------------------------------------------ */

if(!function_exists('rvn_get_social_icons'))
{
  function rvn_get_social_icons() {
    return array(
      'Twitter'      => 'twitter',
      'Facebook'     => 'facebook',
      'Google'       => 'google',
      'Flickr'       => 'flickr',
      
      'Amazon'       => 'amazon',
      'App Store'    => 'app-store',
      'Apple'        => 'apple',
      'Blogger'      => 'blogger',
      'Delicious'    => 'delicious',
      'deviantArt'   => 'deviantart',
      'Digg'         => 'digg',
      'Dribbble'     => 'dribbble',
      'Forrst'       => 'forrst',
      'Last.fm'      => 'lastfm',
      'LinkedIn'     => 'linkedin',
      'Microsoft'    => 'microsoft',
      'MySpace'      => 'myspace',
      'PayPal'       => 'paypal',
      'Picasa'       => 'picasa',
      'Pinterest'    => 'pinterest',
      'RSS'          => 'rss',
      'Skype'        => 'skype',
      'StumbleUpon'  => 'stumbleupon',
      'Technorati'   => 'technorati',
      'Tumblr'       => 'tumblr',
      'Vimeo'        => 'vimeo',
      'WordPress'    => 'wordpress',
      'Yahoo!'       => 'yahoo',
      'Yelp'         => 'yelp',
      'YouTube'      => 'youtube'
    );
  }
}



/* Get Font Face CSS Code
------------------------------------------------------------ */

if(!function_exists('rvn_get_font_face_css_code'))
{
  function rvn_get_font_face_css_code($font_name, $file_name) {
    $slug = rvn_get_slug($font_name);
    $file_url = FONTS_URL.'/'.$slug.'/'.$file_name;
    
    $output = ' @font-face {';
    $output.= ' font-family: "'.$font_name.'";';
    $output.= ' src: url("'.$file_url.'.eot");';
    $output.= ' src: url("'.$file_url.'.eot?iefix") format("eot"),';
    $output.= '      url("'.$file_url.'.woff") format("woff"),';
    $output.= '      url("'.$file_url.'.ttf") format("truetype"),';
    $output.= '      url("'.$file_url.'.svg#webfont") format("svg");';
    $output.= ' font-weight: normal;';
    $output.= ' font-style: normal;';
    $output.= ' }';
    
    return $output;
  }
}



/* Get Fonts for Select Menu
------------------------------------------------------------ */

if(!function_exists('rvn_get_fonts_for_select_menu'))
{
  function rvn_get_fonts_for_select_menu() {
    $font_array = rvn_get_fonts();
    $font_stack = array();
    
    // Filter output, so option name equals option value
    foreach($font_array as $font_type => $fonts) {
      $font_stack[$font_type] = $fonts;
      foreach($font_stack[$font_type] as $font_name => $font_attr) {
        $font_stack[$font_type][$font_name] = $font_name;
      }
    }
    
    return $font_stack;
  }
}



/* Register Footer Widget Areas
------------------------------------------------------------ */

if(!function_exists('rvn_register_footer_widget_areas'))
{
  function rvn_register_footer_widget_areas() {
    $footer_columns = explode('::', rvn_get_option('footer-columns'));
    $footer_columns_count = count($footer_columns);
    
    for($i = 1; $i <= $footer_columns_count; $i++) {
      rvn_register_sidebar('Footer Column '.$i);
    }
  }
}



/* Register Page Widget Areas
------------------------------------------------------------ */

if(!function_exists('rvn_register_page_widget_areas'))
{
  function rvn_register_page_widget_areas() {
    $custom_sidebars = explode('::', rvn_get_option('custom-sidebars'));
    
    foreach($custom_sidebars as $title) {
      if($title) {
        $slug  = rvn_get_slug($title);
        $title = 'Custom Sidebar: '.$title;
        rvn_register_sidebar($title, $slug);
      }
    }
  }
}



/* Register Sidebar
------------------------------------------------------------ */

if(!function_exists('rvn_register_sidebar'))
{
  function rvn_register_sidebar($name, $s_id = '', $desc = '', $class = '') {
    $s_id = empty($s_id) ? rvn_get_slug($name) : $s_id;
    register_sidebar(array(
      'name'          => $name,
      'id'            => 'sidebar-'.$s_id,
    	'description'   => $desc,
    	'before_widget' => '<aside id="%1$s" class="widget %2$s '.$class.'">',
    	'after_widget'  => '</aside><!-- END .widget -->',
    	'before_title'  => '<h3 class="widget-title">',
    	'after_title'   => '</h3>'
    ));
  }
}



/* Get Fonts
------------------------------------------------------------ */

if(!function_exists('rvn_get_fonts'))
{
  function rvn_get_fonts($type_order = array('System Fonts', 'Integrated Fonts', 'Google Web Fonts')) {
    
    $fonts['Integrated Fonts'] = array(
      'Daniel' => array(
        'font_family' => "'Daniel', sans-serif",
        'file_name'   => 'daniel-webfont'
      ),
      'Droid Serif' => array(
        'font_family' => "'Droid Serif', serif",
        'file_name'   => 'DroidSerif-Regular-webfont'
      ),
      'Journal' => array(
        'font_family' => "Journal, sans-serif",
        'file_name'   => 'journal-webfont'
      ),
      'Comfortaa Regular' => array(
        'font_family' => "'Comfortaa Regular', sans-serif",
        'file_name'   => 'Comfortaa_Regular-webfont'
      ),
      'Comfortaa Bold' => array(
        'font_family' => "'Comfortaa Bold', sans-serif",
        'file_name'   => 'Comfortaa_Bold-webfont'
      )
    );
    
    
    $fonts['System Fonts'] = array(
      'Helvetica Neue' => array(
        'font_family' => "'Helvetica Neue', Helvetica, Arial, sans-serif"
      ),
      'Arial' => array(
        'font_family' => "Arial, sans-serif"
      ),
      'Lucida Grande' => array(
        'font_family' => "'Lucida Grande', 'Lucida Sans Unicode', Verdana, sans-serif"
      ),
      'Myriad Pro' => array(
        'font_family' => "'Myriad Pro', Myriad, Arial, sans-serif"
      ),
      'Tahoma' => array(
        'font_family' => "Tahoma, Geneva, Arial, sans-serif"
      ),
      'Trebuchet MS' => array(
        'font_family' => "Trebuchet MS, Arial, sans-serif"
      ),
      'Verdana' => array(
        'font_family' => "Verdana, sans-serif"
      ),
      'Georgia' => array(
        'font_family' => "Georgia, serif"
      ),
      'Times New Roman' => array(
        'font_family' => "'Times New Roman', Times, serif"
      ),
      'Palatino Linotype' => array(
        'font_family' => "'Palatino Linotype', 'Book Antiqua', Palatino, serif"
      ),
      'Comic Sans MS ;-)' => array(
        'font_family' => "'Comic Sans MS', cursive, sans-serif"
      )
    );
    
    
    $fonts['Google Web Fonts'] = array(
      'Damion' => array(
        'link' => 'Damion',
        'css'  => "font-family: 'Damion', cursive; font-weight: 400;"
      ),
      'Federo' => array(
        'link' => 'Federo',
        'css'  => "font-family: 'Federo', cursive; font-weight: 400;"
      ),
      'Josefin Sans' => array(
        'link' => 'Josefin+Sans',
        'css'  => "font-family: 'Josefin Sans', sans-serif; font-weight: 400;"
      ),
      'Josefin Sans (Semi-Bold)' => array(
        'link' => 'Josefin+Sans:600',
        'css'  => "font-family: 'Josefin Sans', sans-serif; font-weight: 600;"
      ),
      'Josefin Sans (Bold)' => array(
        'link' => 'Josefin+Sans:700',
        'css'  => "font-family: 'Josefin Sans', sans-serif; font-weight: 700;"
      ),
      'Lato' => array(
        'link' => 'Lato',
        'css'  => "font-family: 'Lato', sans-serif; font-weight: 400;"
      ),
      'Lobster' => array(
        'link' => 'Lobster&subset=latin,latin-ext',
        'css'  => "font-family: 'Lobster', cursive; font-weight: 400;"
      ),
      'Lobster Two' => array(
        'link' => 'Lobster+Two',
        'css'  => "font-family: 'Lobster Two', cursive; font-weight: 400;"
      ),
      'Lobster Two (Bold)' => array(
        'link' => 'Lobster+Two:700',
        'css'  => "font-family: 'Lobster Two', cursive; font-weight: 700;"
      ),
      'Mako' => array(
        'link' => 'Mako',
        'css'  => "font-family: 'Mako', sans-serif; font-weight: 400;"
      ),
      'Metrophobic' => array(
        'link' => 'Metrophobic',
        'css'  => "font-family: 'Metrophobic', sans-serif; font-weight: 400;"
      ),
      'Open Sans' => array(
        'link' => 'Open+Sans&subset=latin,latin-ext',
        'css'  => "font-family: 'Open Sans', sans-serif; font-weight: 400;"
      ),
      'Open Sans (Semi-Bold)' => array(
        'link' => 'Open+Sans:600&subset=latin,latin-ext',
        'css'  => "font-family: 'Open Sans', sans-serif; font-weight: 600;"
      ),
      'Oswald' => array(
        'link' => 'Oswald',
        'css'  => "font-family: 'Oswald', sans-serif; font-weight: 400;"
      ),
      'Philosopher' => array(
        'link' => 'Philosopher',
        'css'  => "font-family: 'Philosopher', sans-serif; font-weight: 400;"
      ),
      'Philosopher (Bold)' => array(
        'link' => 'Philosopher:700',
        'css'  => "font-family: 'Philosopher', sans-serif; font-weight: 700;"
      ),
      'Questrial' => array(
        'link' => 'Questrial',
        'css'  => "font-family: 'Questrial', sans-serif; font-weight: 400;"
      ),
      'Quicksand (Book)' => array(
        'link' => 'Quicksand:300',
        'css'  => "font-family: 'Quicksand', sans-serif; font-weight: 300;"
      ),
      'Quicksand' => array(
        'link' => 'Quicksand',
        'css'  => "font-family: 'Quicksand', sans-serif; font-weight: 400;"
      ),
      'Quicksand (Bold)' => array(
        'link' => 'Quicksand:700',
        'css'  => "font-family: 'Quicksand', sans-serif; font-weight: 700;"
      ),
      'Shanti' => array(
        'link' => 'Shanti',
        'css'  => "font-family: 'Shanti', sans-serif; font-weight: 400;"
      ),
      'Varela' => array(
        'link' => 'Varela&subset=latin,latin-ext',
        'css'  => "font-family: 'Varela', sans-serif; font-weight: 400;"
      ),
      'Varela Round' => array(
        'link' => 'Varela+Round',
        'css'  => "font-family: 'Varela Round', sans-serif; font-weight: 400;"
      ),
      'Vollkorn' => array(
        'link' => 'Vollkorn',
        'css'  => "font-family: 'Vollkorn', serif; font-weight: 400;"
      ),
      'Voltaire' => array(
        'link' => 'Voltaire',
        'css'  => "font-family: 'Voltaire', sans-serif; font-weight: 400;"
      ),
      'Yanone Kaffeesatz' => array(
        'link' => 'Yanone+Kaffeesatz',
        'css'  => "font-family: 'Yanone Kaffeesatz', sans-serif; font-weight: 400;"
      ),
      'Yanone Kaffeesatz (Bold)' => array(
        'link' => 'Yanone+Kaffeesatz:700',
        'css'  => "font-family: 'Yanone Kaffeesatz', sans-serif; font-weight: 700;"
      ),
      'Yellowtail' => array(
        'link' => 'Yellowtail',
        'css'  => "font-family: 'Yellowtail', cursive; font-weight: 400;"
      )
    );
    
    $sorted_fonts = array();
    foreach($type_order as $type) {
      $sorted_fonts[$type] = $fonts[$type];
    }
    
    return $sorted_fonts;
  }
}

?>