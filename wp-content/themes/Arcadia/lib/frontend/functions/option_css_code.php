<?php



/* Get Option CSS Code
------------------------------------------------------------ */

if(!function_exists('rvn_get_option_css_code'))
{
  function rvn_get_option_css_code($compress_code = true) {
    return (new option_css_code($compress_code));
  }
}







/* Option CSS Code
------------------------------------------------------------ */

if(!class_exists('option_css_code')) {

  class option_css_code {
    
    protected $output = '';
    protected $options, $font_options = array();
    protected $compress_code, $combined_font_face_css_code, $google_web_fonts_code;
  
    
    
    /* Construct
    ------------------------------------------------------------ */
    
    public function __construct($compress_code = true) {
      $this->compress_code = $compress_code;
      
      $this->set_options();
      $this->set_font_options();
      $this->set_custom_options();
      $this->set_fonts();
    }
    
    
    
    /* To String
    ------------------------------------------------------------ */
    
    public function __toString() {
      return $this->get_cached_code();
    }
  
    
    
    /* Get CSS Code
    ------------------------------------------------------------ */
    
    protected function get_cached_code() {
      $theme_options_last_update   = rvn_get_option('theme-options-last-update');
      $option_css_code_last_update = rvn_get_option('option-css-code-last-update');
      $cached_option_css_code      = rvn_get_option('option-css-code');
      
      if($cached_option_css_code && $option_css_code_last_update &&
        $option_css_code_last_update == $theme_options_last_update) {
        return $cached_option_css_code;
      }
      else {
        $option_css_code = $this->get_code();
        rvn_update_option('option-css-code', $option_css_code);
        rvn_update_option('option-css-code-last-update', $theme_options_last_update);
        return $option_css_code;
      }
    }
  
    
    
    /* Get CSS Code
    ------------------------------------------------------------ */
    
    protected function get_code() {
      $output = $this->google_web_fonts_code;
      
      if($this->compress_code) {
        $output.= rvn_get_compressed_css_code($this->get_css_code());
      }
      else {
        $output.= $this->get_css_code();
      }
      
      return $output;
    }
  
    
    
    /* Get Options
    ------------------------------------------------------------ */
    
    protected function set_options() {
      $option_ids = $this->get_font_size_option_ids();
      foreach($option_ids as $option_id) {
        $key = str_replace('-', '_', $option_id);
        $this->options[$key] = rvn_get_option($option_id);
      }
    }
  
    
    
    /* Get Font Options
    ------------------------------------------------------------ */
    
    protected function set_font_options() {
      $font_option_ids = $this->get_font_option_ids();
      foreach($font_option_ids as $font_option_id) {
        $key = str_replace('-', '_', $font_option_id);
        $this->font_options[$key] = rvn_get_font_family(rvn_get_option($font_option_id));
      }
    }
  
    
    
    /* Get Custom Options
    ------------------------------------------------------------ */
    
    protected function set_custom_options() {
      extract($this->options);
      
      $custom_options = array(
        
        // Header
        'left_logo_top_padding'        => rvn_get_option('left-logo-top-padding'),
        'centered_logo_top_padding'    => rvn_get_option('centered-logo-top-padding'),
        'centered_logo_bottom_padding' => rvn_get_option('centered-logo-bottom-padding'),
        'header_shine_height'          => 400 - (int)rvn_get_option('header-shine-height'),
        
        // Nivo Slider
        'nivo_slider_img_height' => rvn_get_option('nivo-slider-img-height'),
        
        // Cycle Slider
        'cycle_slider_img_height'     => rvn_get_option('cycle-slider-img-height'),
        'cycle_slider_caption_height' => rvn_get_option('cycle-slider-img-height') - 30, // Minus caption top and bottom padding (15px)
        
        // Cycle Slider (Alt. Layout)
        'cycle_alt_slider_img_height' => rvn_get_option('cycle-alt-slider-img-height'),
        'cycle_alt_slider_height'     => rvn_get_option('cycle-alt-slider-img-height') + 0, // Plus padding
        
        // Piecemaker Slider
        'piecemaker_slider_height' => rvn_get_option('piecemaker-slider-img-height'),
        'piecemaker_slider_height' => rvn_get_option('piecemaker-slider-img-height') + 50,
        
        // Featured Image
        'featured_image_height'         => rvn_get_option('featured-image-height'),
        'featured_image_caption_height' => rvn_get_option('featured-image-height') - 30, // Minus caption top and bottom padding (15px)
        
        // Featured Video
        'featured_video_height' => rvn_get_option('featured-video-height')
      );
      
      $this->options = array_merge($this->options, $custom_options);
    }
  
    
    
    /* Get Font Size Option IDs
    ------------------------------------------------------------ */
    
    protected function get_font_size_option_ids() {
      return array(
        'body-font-size',
        'h1-font-size', 'h2-font-size', 'h3-font-size', 'h4-font-size', 'h5-font-size', 'h6-font-size', 
        'header-bar-font-size',
        'nav-font-size',
        'sub-nav-font-size',
        'sidebar-heading-font-size',
        'sidebar-font-size',
        'footer-heading-font-size',
        'footer-font-size',
        'footer-bar-font-size'
      );
    }
  
    
    
    /* Get Font Option IDs
    ------------------------------------------------------------ */
    
    protected function get_font_option_ids() {
      return array(
        'body-font',
        'h1-font', 'h2-font', 'h3-font', 'h4-font', 'h5-font', 'h6-font', 
        'nav-font',
        'sub-nav-font'
      );
    }
  
    
    
    /* Setup Fonts
    ------------------------------------------------------------ */
    
    protected function set_fonts() {
      $font_stack = rvn_get_fonts();
      $font_face_css_codes = array();
      $gwf_query  = '';
      $gwf_active_fonts = array();
      
      $font_option_ids = $this->get_font_option_ids();
      
      foreach($font_stack as $font_type => $fonts) {
        
        foreach($font_option_ids as $font_option_id) {
          $selected_font = rvn_get_option($font_option_id);
          
          foreach($fonts as $font_name => $font_attr) {
            
            if($selected_font == $font_name) {
              
              // System Fonts
              if('System Fonts' == $font_type) {
                $font_css_code = 'font-family: '.$font_attr['font_family'].';';
              }
              
              // Integrated Fonts
              if('Integrated Fonts' == $font_type) {
                $font_css_code = 'font-family: '.$font_attr['font_family'].';';
                if(!in_array($font_name, $font_face_css_codes)) {
                  $font_face_css_codes[$font_name] = rvn_get_font_face_css_code($font_name, $font_attr['file_name']);
                }
              }
              
              // Google Web Fonts
              if('Google Web Fonts' == $font_type) { 
                // Don't assign fonts to query that have been already assigned
                if(!in_array($font_name, $gwf_active_fonts)) {
                  $gwf_active_fonts[] = $font_name;
                  $gwf_query.= ($gwf_query) ? '|'.$font_attr['link'] : $font_attr['link'];
                }
                $font_css_code = $font_attr['css'];
              }
              
              // Setup CSS Code
              $var_name = str_replace('-', '_', $font_option_id);
              $this->font_options[$var_name.'_code'] = $font_css_code;
              
              // Get out of Loop
              break;
            }
          }
        }
      }
      
      // Integrated Fonts Setup
      $combined_font_face_css_code = '';
      foreach($font_face_css_codes as $font_face_css_code) {
        $combined_font_face_css_code.= $font_face_css_code.' ';
      }
      
      // Google Web Fonts Setup
      $gwf_code = '';
      if(isset($gwf_query) && $gwf_query) {
        $gwf_code = '<link href="http://fonts.googleapis.com/css?family='.$gwf_query.'" rel="stylesheet">';
      };
      
      // Output
      $this->combined_font_face_css_code = $combined_font_face_css_code;
      $this->google_web_fonts_code = $gwf_code;
    }
  
    
    
    /* Get CSS Code
    ------------------------------------------------------------ */
    
    protected function get_css_code() {
      
      
      //
      // Generate Variables
      //
      
      extract($this->options);
      extract($this->font_options);
      $combined_font_face_css_code = $this->combined_font_face_css_code;
    
      
      //
      // Other CSS Code
      //
      
      $css_code = 
<<<CSS

<style type="text/css" media="all">
  
  /* FontFace Code */
  
  $combined_font_face_css_code
  
  
  /* Generic */
  
  body,
  input,
  textarea,
  input[type=checkbox] + label,
  input[type=radio] + label,
  blockquote p.source {
  	$body_font_code
  }
  
  body,
  input,
  textarea,
  input[type=checkbox] + label,
  input[type=radio] + label {
  	font-size: $body_font_size;
  }
  
  h1 { $h1_font_code font-size: $h1_font_size; }
  h2 { $h2_font_code font-size: $h2_font_size; }
  h3 { $h3_font_code font-size: $h3_font_size; }
  h4 { $h4_font_code font-size: $h4_font_size; }
  h5 { $h5_font_code font-size: $h5_font_size; }
  h6 { $h6_font_code font-size: $h6_font_size; }
  
  
  /* Header Bar */

  #header-bar {
    font-size: $header_bar_font_size;
  }
  
  
  /* Header */
  
  body.header-style-left #header .wrapper h1#logo {
    padding-top: {$left_logo_top_padding}px;
  }
  
  body.header-style-center #header .wrapper h1#logo {
    padding-top: {$centered_logo_top_padding}px;
    padding-bottom: {$centered_logo_bottom_padding}px;
  }
  
  body.header-style-center #header-shine {
    top: -{$header_shine_height}px;
  }
  
  
  /* Navigation */
  
  #main-nav > ul > li > a {
    $nav_font_code
  }
  
  #main-nav ul li ul li a {
    $sub_nav_font_code
  }
  
  
  /* Nivo Slider */
  
  #nivo-slider-area .deco-loading-screen {
    height: {$nivo_slider_img_height}px;
  }
  
  #nivo-slider .nivo-caption p strong {
    $h2_font_code
    font-size: $h2_font_size;
  }
  
  
  /* Cycle Slider */
  
  #cycle-slider-area .wrapper .deco-loading-screen,
  #cycle-slider {
    height: {$cycle_slider_img_height}px;
  }
  
  #cycle-slider .slide .caption.left-full-height,
  #cycle-slider .slide .caption.right-full-height {
    height: {$cycle_slider_caption_height}px;
  }
  
  
  /* Cycle Slider (Alt. Layout) */
  
  #cycle-alt-slider {
    height: {$cycle_alt_slider_height}px;
  }
  
  
  /* Piecemaker Slider */
  
  #piecemaker-slider-area .wrapper {
    height: {$piecemaker_slider_height}px;
  }
  
  
  /* Featured Image */
  
  #featured-image-area .wrapper .deco-loading-screen,
  #featured-image {
    height: {$featured_image_height}px;
  }
  
  #featured-image .image-wrapper .caption.left-full-height,
  #featured-image .image-wrapper .caption.right-full-height {
    height: {$featured_image_caption_height}px;
  }
  
  
  /* Featured Video */
  
  #featured-video-area .wrapper .deco-loading-screen,
  #featured-video {
    height: {$featured_video_height}px;
  }
  
  
  /* Sidebar & Footer */
  
  #sidebar { font-size: $sidebar_font_size; }
  
  #sidebar h3 {
    font-size: $sidebar_heading_font_size;
  }
  
  
  
  /* Navigation */

  #main-nav > ul > li > a { font-size: $nav_font_size; }
  #main-nav ul li ul li a { font-size: $sub_nav_font_size; }
  
  
  /* Footer */
  
  #footer-widget-area { font-size: $footer_font_size; }
  #footer-widget-area h3 { font-size: $footer_heading_font_size; }  


  /* Footer Bar */
  
  #footer-bar { font-size: $footer_bar_font_size; }
    
</style>
      
CSS;
    
      return $css_code;
    }
    
    
    
  } 
}

?>