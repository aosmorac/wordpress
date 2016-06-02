<!DOCTYPE html>

<html <?php language_attributes(); ?>>
  <head>
    
    <title><?php rvn_put_title(); ?></title>
    
    <!-- Meta-Tags -->
    <meta charset="<?php bloginfo('charset'); ?>" />    
    <!--
		<meta name="Theme Name" content="<?php echo THEME_NAME; ?>" />
		<meta name="Theme Version" content="<?php echo THEME_VERSION; ?>" />
		<meta name="Framework Version" content="<?php echo FW_VERSION; ?>" />
		<meta name="WP Version" content="<?php bloginfo('version') ?>"/>
		-->
    
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="<?php echo get_bloginfo('stylesheet_url').'?ver='.THEME_VERSION; ?>" type="text/css" media="all" />
    
    <link rel="stylesheet" id="color-scheme" href="<?php echo STYLESHEETS_URL.'/'.rvn_get_option('color-scheme').'.css?ver='.THEME_VERSION; ?>" type="text/css" media="all" />
    
    <?php
      // Get CSS code that was adjusted in the backend options
      echo rvn_get_option_css_code();
      
      // Comment Form
      if(is_singular()) wp_enqueue_script('comment-reply');
      
      // Scripts and stylesheets of the theme will be included here.
      // See file "/lib/frontend/actions.php" and look for
      //   the functions "rvn_enqueue_scripts_and_styles()" and 
      //   "rvn_put_header_code()".
      wp_head();
    ?>
  </head>
  
  <body <?php body_class(rvn_get_body_class()); ?>>
    
    <?php rvn_put_header_bar(); ?>
    
    <div id="body-container">
    
      <header id="header" class="main">
        <div id="header-shine"></div>
        <div id="header-gradient"></div>
        <div id="header-light"></div>
        <div id="header-wrapper" class="wrapper">
          <?php rvn_put_logo(); ?>
          
          <?php
            wp_nav_menu(array(              'theme_location'  => 'main',
              'container'       => 'nav', 
              'container_id'    => 'main-nav',
              'container_class' => 'main', 
							'fallback_cb'     => 'rvn_get_fb_menu',               'depth'           => 3
            ));
          ?>
        </div>
        <!-- END .wrapper -->
        <div id="header-top-border"></div>
        <div id="header-bg"></div>
        
      </header>
      
      <div id="main-bg">
        <div id="main">
      
          <?php
            // Put Slider / Feature Method
            rvn_put_featured_content();
            
            // Put the Welcome Bar
            rvn_put_welcome_bar();
          ?>