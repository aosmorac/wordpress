  
          
          <div id="main-bottom"></div>
          
        </div>
        <!-- END #main -->
      </div>
      <!-- END #main-bg -->
      
      
      <footer id="footer" class="main">
      
        <section id="footer-widget-area">
          
            <div class="wrapper">
              <?php rvn_put_footer_widget_area(); ?>
            </div>
            <!-- END .wrapper -->
          <div id="footer-bg"></div>
          <div id="footer-bottom-border"></div>
          <!-- END #footer-bg -->
        </section>
        
        
        <?php if(rvn_get_option('show-footer-bar') == 'true'): ?>
          <section id="footer-bar" class="info-bar">
            <div class="wrapper">
              <?php echo rvn_get_info_bar_content('footer-bar'); ?>
            </div>
          </section>
        <?php endif; ?>
      
      </footer>
      
    </div>
    <!-- END #body-container -->
    
    
    
    
    <?php wp_footer(); ?>
  </body>
  
</html>