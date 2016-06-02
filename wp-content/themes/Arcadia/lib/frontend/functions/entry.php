<?php



/* Get Entry
------------------------------------------------------------ */

if(!function_exists('rvn_get_entry'))
{
  function rvn_get_entry($args = null) {
    return (new entry($args));
  }
}







/* Entry
------------------------------------------------------------ */

if(!class_exists('entry')) {

  class entry {
  
    public $post;
    protected $last_class = '';
  
    
    
    /* Construct
    ------------------------------------------------------------ */
    
    public function __construct($args) {
      $this->initialize_variables($args);
      $this->initialize_layout_variables();
      $this->set_divider();
    }
    
    
    
    /* To String
    ------------------------------------------------------------ */
    
    public function __toString() {
      return $this->get_entry();
    }
    
    
    
    /* Get Entry
    ------------------------------------------------------------ */
    
    public function get_entry() {
      if($this->list_layout) return $this->get_list_layout_entry();
      else                   return $this->get_grid_layout_entry();
    }
    
    
    
    /* Initialize Variables
    ------------------------------------------------------------ */
    
    protected function initialize_variables($args) {
      $defaults = array(
        'post_id'               => rvn_get_post_id(),
        'featured_content_type' => rvn_get_content_type(),
        'featured_content_size' => array(), // if set use is like array($width, $height)
        'column_size'           => 'full',
        'class'                 => array('preview'),
        'list_layout'           => false,
        'show_full_post'        => false,
        'excerpt_length'        => false,
        'meta_infos'            => array(),
        'show_featured_content' => true,
        'show_headings'         => true,
        'show_excerpts'         => true,
        'show_buttons'          => true,
        'show_tags'             => true,
        'read_more_link_text'   => 'Read more',
        'last'                  => 'auto',
        'featured_image_link_method' => 'lightbox',
        'portfolio' => array('external_link' => false,
                             'external_link_text' => 'Visit site',
                             'external_link_opens_new_tab' => true)
      );
      
      $args = wp_parse_args($args, $defaults);
      
      foreach($args as $arg => $value) {
        $this->{$arg} = $value;
      }
      
      $this->post = rvn_get_post($this->post_id);
      $this->show_meta_infos = !empty($this->meta_infos);
      $this->content_size    = rvn_get_page_content_size();
      $this->full_width_page = ($this->content_size == 'full');
      $this->entry_class     = $this->class;
      $this->entry_preview   = in_array('preview', $this->entry_class);
      
      // If external portfolio link is set
      if(isset($this->portfolio['external_link']) && $this->portfolio['external_link']) {
        $this->featured_image_link_method = 'external';
      }
      
      // Hide Heading on Front Page
      if(is_front_page() && !rvn_get_option('show-frontpage-content-title')) {
        $frontpage_content_id = (int)rvn_get_option('frontpage-content');
        if($this->post_id == $frontpage_content_id) {
          $this->show_headings = false;
        }
      }
    }
    
    
    
    /* Initialize Layout Variables
    ------------------------------------------------------------ */
    
    protected function initialize_layout_variables() {
      
      // List Layout
      if($this->list_layout) {
        $this->divider_pos = 1;
        $this->entry_class[] = 'entry-meta-style-s2';
        
        switch($this->column_size) {
          case 'one-fourth':
            $this->excerpt_column_size = 'three-fourth';
            $this->heading_tag = 'h2';
            if(!$this->full_width_page) { unset($this->meta_infos[2]); }
            break;
          case 'one-third':
            $this->excerpt_column_size = 'two-third';
            $this->heading_tag = 'h2';
            if(!$this->full_width_page) { unset($this->meta_infos[2]); }
            break;
          case 'one-half':
            $this->excerpt_column_size = 'one-half';
            $this->heading_tag = 'h2';
            if($this->full_width_page) { unset($this->meta_infos[2]); }
            else                       { unset($this->meta_infos[1]); unset($this->meta_infos[2]); }
            break;
          default: // two-third
            $this->excerpt_column_size = 'one-third';
            if($this->full_width_page) { $this->heading_tag = 'h2'; unset($this->meta_infos[1]); unset($this->meta_infos[2]); }
            else                       { $this->heading_tag = 'h4'; $this->show_meta_infos = false; }
        }
      }
      
      // Grid Layout
      else {
        $this->entry_class[] = 'entry-meta-style-s1';
        
        switch($this->column_size) {
          case 'one-fourth':
            $this->divider_pos = 4;
            if($this->full_width_page) { $this->heading_tag = 'h4'; $this->show_meta_infos = false; }
            else                       { $this->heading_tag = 'h4'; $this->show_meta_infos = false; }
            break;
          case 'one-third':
            $this->divider_pos = 3;
            if($this->full_width_page) { $this->heading_tag = 'h3'; unset($this->meta_infos[1]); unset($this->meta_infos[2]); }
            else                       { $this->heading_tag = 'h4'; $this->show_meta_infos = false; }
            break;
          case 'one-half':
            $this->divider_pos = 2;
            if($this->full_width_page) { $this->heading_tag = 'h2'; unset($this->meta_infos[2]); }
            else                       { $this->heading_tag = 'h3'; unset($this->meta_infos[1]);  unset($this->meta_infos[2]); }
            break;
          default: // full
            $this->divider_pos = 1;
            $this->heading_tag = 'h2';
        }
      }
      
      $this->entry_class[] = ($this->show_headings)   ? '' : 'no-heading';
      $this->entry_class[].= ($this->show_meta_infos) ? '' : 'no-meta-infos';
      $this->entry_class[].= ($this->show_excerpts)   ? '' : 'no-excerpt';
      $this->entry_class[].= ($this->show_buttons)    ? '' : 'no-buttons';
    }
    
    
    
    /* Set Divider
    ------------------------------------------------------------ */
    
    protected function set_divider() {
      if($this->last == 'auto') {
        static $row_entries_counter = 1;
        $this->last_class = ($row_entries_counter == $this->divider_pos) ? 'last' : '';
        $row_entries_counter = ($this->last_class) ? 0 : $row_entries_counter;
        $row_entries_counter++;
      }
      elseif($this->last == 'true') {
        $this->last_class = 'last';
      }
    }
    
    
    
    /* Get Featured Content
    ------------------------------------------------------------ */
    
    protected function get_featured_content() {
      $featured_content = '';
      
      if($this->show_featured_content) {
        $full  = ($this->full_width_page) ? '-full' : '';
        $style = ($this->list_layout) ? 's2' : 's1';
        $featured_content_size_id = $this->featured_content_type.$full.'-'.$style.'-'.$this->column_size;
        $featured_content = rvn_get_featured_content($this->post_id, $featured_content_size_id, $this->featured_content_size, $this->featured_image_link_method, $this->portfolio);
      }
      
      if($featured_content) {
        $this->entry_class[] = 'with-featured-content';
        return '<div class="entry-featured-content">'.$featured_content.'</div><!-- END .entry-featured-content -->';
      }
      else {
        $this->entry_class[] = 'no-featured-content';
        return false;
      }
    }
    
    
    
    /* Get Content
    ------------------------------------------------------------ */
    
    protected function get_content() {
      $content = '';
      
      // Get full Content
      if((is_single($this->post_id) || is_page($this->post_id)) || $this->show_full_post) {
        $content = rvn_get_content();
        
        // Get Tags
        if($this->show_tags) {
          $tags = get_the_tags();
          if($tags) {
            $content.= '<p class="taggroup"><strong>'.__('Tags:', 'ruventhemes').'</strong> ';
            foreach($tags as $tag) {
              $content.= '<a class="passive" href="'.get_tag_link($tag->term_id).'">'.$tag->name.'</a> '; 
            }
            $content.= '</p>';
          }
        }
      }
      
      // Get Excerpt
      else {
    	  if($this->show_excerpts) {
        	if(!has_excerpt($this->post_id) && !is_numeric($this->excerpt_length)) {
            $content = rvn_get_content($this->post_id, true);
          }
        	else {
        	  // Workaround for issue that manual excerpts won't show up when posts are included through shortcode
        	  $auto_excerpt = $this->post->post_excerpt;
        	  $excerpt = ($auto_excerpt) ? $auto_excerpt : get_the_excerpt();
        	  
        	  // Reduced excerpt length
        	  if($this->excerpt_length && is_numeric($this->excerpt_length)) {
              $excerpt = wp_trim_words($excerpt, $this->excerpt_length, ' [&hellip;]');
        	  }
        	  
        		$content = "<p>{$excerpt}</p>";
        	}
      	}
      }
      
      // Wrap Content
      if($content) {
        $content = '<div class="entry-content">'.$content.'</div><!-- END .entry-content -->';
      }
      
      return $content;
    }
    
    
    
    /* Get Meta Infos
    ------------------------------------------------------------ */
    
    protected function get_meta_infos() {
      
      if($this->show_meta_infos) {
        $output = '<div class="entry-meta passive-links">';
        
        // Workaround for embedded entries
        global $post;
        $this_post = get_post($this->post_id);
        $original_post = $post;
        $post = $this_post;
        
        
        
        for($i=1; $i<= count($this->meta_infos); $i++) {
          $meta_info = $this->meta_infos[$i-1];
          
          $output.= "<span class='{$meta_info} meta-info meta-info-".$i."'><span class='content'>";
          
          // Date
          if($meta_info == 'date') {
            $output.= '<a href="'.get_month_link(get_the_date('Y'), get_the_date('m')).'">';
            $output.= '<time datetime="'.get_the_date('c').'" pubdate>'.get_the_date().'</time>';
            $output.= '</a>';
          }
          
          // Categories
          elseif($meta_info == 'categories') {
            $category = get_the_category();
            if(empty($category))
              $output.= __('No Category', 'ruventhemes');
            else
              $output.= get_the_category_list(', ');
          }
          
          // Comments
          elseif($meta_info == 'comments') {
            ob_start();
              comments_popup_link(__('Leave a comment', 'ruventhemes'), __('1 Comment', 'ruventhemes'), __('% Comments', 'ruventhemes'), 'comments-link', __('Comments Off', 'ruventhemes'));
              $output.= ob_get_contents();
            ob_end_clean();
          }
          
          // Author
          elseif($meta_info == 'author') {
            ob_start();
              the_author_posts_link();
              $output.= ob_get_contents();
            ob_end_clean();
          }
          
          $output.= '</span></span>';
        }
        
        $post = $original_post;
        
        $output.= '</div><!-- END .entry-meta -->';
        
        return $output;
      }
      
      return false;
    }
    
    
    
    /* Get Read More Link
    ------------------------------------------------------------ */
    
    protected function get_read_more_link() {
      if($this->entry_preview && $this->show_buttons) {
        $output = '<div class="read-more">';
        
        if(isset($this->portfolio['external_link']) && $this->portfolio['external_link']) {
          $url = $this->portfolio['external_link'];
          $link_text = $this->portfolio['external_link_text'];
          $target = $this->portfolio['external_link_opens_new_tab'] ? 'target="_blank"' : '';
      	  $output.= '<a href="'.$url.'" '.$target.' class="passive more-link">'.$link_text.' &raquo;</a>';
        }
        
        else {
      	  $output.= '<a href="'.get_permalink($this->post_id).'" class="passive more-link">'.$this->read_more_link_text.' &raquo;</a>';
        }
        
        $output.= '</div>';
        
        return $output;
      }
      return false;
    }
    
    
    
    /* Get Heading
    ------------------------------------------------------------ */
    
    protected function get_heading() {
      if($this->show_headings) {
        if(isset($this->portfolio['external_link']) && $this->portfolio['external_link']) {
          $url = $this->portfolio['external_link'];
          $target = $this->portfolio['external_link_opens_new_tab'] ? 'target="_blank"' : '';
          $title_link = '<a href="'.$url.'" '.$target.'>'.get_the_title($this->post_id).'</a>';
        }
        else {
          $title_link = '<a href="'.get_permalink($this->post_id).'">'.get_the_title($this->post_id).'</a>';
        }
        return "<{$this->heading_tag} class='entry-heading top'>{$title_link}</{$this->heading_tag}>";
      }
      return false;
    }
    
    
    
    /* Get Grid Layout Entry
    ------------------------------------------------------------ */
    
    protected function get_grid_layout_entry() {
      $output = "<header class='entry-header'>";
      $output.= $this->get_featured_content();
      $heading = '';
      if(($this->entry_preview || is_single()) && ('portfolio-page' != $this->featured_content_type)) {
        $output.= $this->get_heading();
      }
      if(!$this->entry_preview && $this->show_meta_infos) {
        $output.= '<div class="entry-data">'.$this->get_meta_infos().'</div>';
      }
      $output.= '</header>';
      
      $output.= $this->get_content();
      
      if($this->entry_preview && $this->show_meta_infos) {
        $output.= '<footer class="entry-data">';
        $output.= $this->get_meta_infos();
        $output.= $this->get_read_more_link();
        $output.= '</footer>';
      }
      elseif($this->entry_preview && !$this->show_meta_infos) {
        $output.= $this->get_read_more_link();
      }
      
      $entry_class = join(' ', $this->entry_class);
      $wrap_start = '<article id="entry-'.$this->post_id.'" '.rvn_get_post_class("entry $entry_class $this->last_class " . $this->column_size).'>';
      $wrap_end   = '</article><!-- END .entry -->';
      
      $output = $wrap_start . $output . $wrap_end;
      
      $output.= ($this->last_class) ? do_shortcode('[divider]') : '';
      
      return $output;
    }
    
    
    
    /* Get List Layout Entry
    ------------------------------------------------------------ */
    
    protected function get_list_layout_entry() {
      $entry_class = join(' ', $this->entry_class);
      
      // Setup Header
      $header = '<header class="entry-header">';
      $header.= $this->get_heading();
      $header.= '</header><!-- END .entry-header -->';
      
      $output = '<article id="entry-'.$this->post_id.'" '.rvn_get_post_class("entry $entry_class").'>';
            
      $featured_content = $this->get_featured_content();
      if($featured_content) {
        $output.= '<div class="'.$this->column_size.'">';
        $output.=   $featured_content;
        $output.= '</div><!-- END .'.$this->column_size.' -->';
      }
      else {
        $this->excerpt_column_size = 'full';
      }
      
      $output.= "<div class='{$this->excerpt_column_size} last'>";
      
      $output.= $header;
      
      $output.= $this->get_content();
      
      if($this->entry_preview && $this->show_meta_infos) {
        $output.= '<footer class="entry-data">';
        $output.= $this->get_meta_infos();
        $output.= $this->get_read_more_link();
        $output.= '</footer>';
      }
      elseif($this->entry_preview && !$this->show_meta_infos) {
        $output.= $this->get_read_more_link();
      }
      
      $output.= "</div><!-- END .{$this->excerpt_column_size}.last -->";
      
      $output.= do_shortcode('[divider]');
      $output.= '</article><!-- END .entry -->';
      
      return $output;
    }
    
    
  }
}

?>