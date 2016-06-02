<section id="piecemaker-slider-area" class="featured-content">
  
  <div class="piecemaker-slider-wrapper">
    <div id="piecemaker-slider">
      
      <div class="image-wrapper">
        
        <?php
          
          //
          // Loop
          //
          
          $query_array = array(
            'post_type'   => 'featured_item',
            'post_status' => 'publish',
            'numberposts' => 1
          );
          $rvn_posts = get_posts($query_array);
          
          if($rvn_posts) {
            
            foreach($rvn_posts as $rvn_post) {
              setup_postdata($rvn_post);
              
              $image = rvn_get_featured_image($rvn_post->ID, "piecemaker-slider-full");
              
              if($image) {
                echo $image;
              }
        	  }
        	}
        	
        	
        	//
        	// Dummy Content
        	//
        	
        	else {
        	  echo rvn_get_featured_image(0, 'piecemaker-slider-full', IMAGES_URL."/dummy/dummy_1.png");
        	}
        ?>
                
      </div>
      <!-- END .image-wrapper -->
      
    </div>
    <!-- END #piecemaker-slider -->
  </div>
  <!-- END .wrapper -->
  
</section>

<?php
  $img_height = rvn_get_option('piecemaker-slider-img-height');
        
  $slider_height = $img_height + 50;
  $swf_file_url  = PLUGINS_URL.'/piecemaker/piecemaker.swf';
  $css_file_url  = PLUGINS_URL.'/piecemaker/piecemaker.css';
  $xml_file_url  = PLUGINS_URL.'/piecemaker/piecemaker.xml.php';
?>

<script type="text/javascript">
  jQuery(document).ready(function() {
    
    var flashvars = {};

    flashvars.xmlSource = "<?php echo $xml_file_url; ?>";
    flashvars.cssSource = "<?php echo $css_file_url; ?>";

    var params = {};
    params.play  = "true";
    params.menu  = "false";
    params.scale = "showall";
    params.wmode = "transparent";
    params.allowfullscreen   = "true";
    params.allowscriptaccess = "always";
    params.allownetworking   = "all";

    swfobject.embedSWF('<?php echo $swf_file_url; ?>', 'piecemaker-slider', '962', '<?php echo $slider_height; ?>', '10', null, flashvars, params, null);
    
  });
</script>