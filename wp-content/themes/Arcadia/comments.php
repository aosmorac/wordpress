<?php
  if('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die('Please do not load this page directly. Thanks!');
  
  if(post_password_required()) return;
  
  global $post;
?>

<?php if(have_comments() || comments_open()): ?>

<?php echo do_shortcode('[hr size="small"]'); ?>

<section id="comments" class="<?php echo (have_comments() ? 'with-comments' : 'no-comments') ?>">
  
  <?php if(have_comments()): ?>
  
  	<h3 class="top">
  	  <?php
  	    comments_number(__('No Comments', 'ruventhemes'), __('One Comment', 'ruventhemes'), __('% Comments', 'ruventhemes'));
  	    printf(' '._x('on &#8220;%s&#8221;', 'comments-heading', 'ruventhemes'), get_the_title($post->ID));
  	  ?>
  	</h3>
  	<ol class="comment-list">
  		<?php
        wp_list_comments(array( 
          'type'     => 'all',
          'callback' => 'rvn_put_comment'
        ));
      ?>
  	</ol>
	
  	<?php if(get_comment_pages_count() > 1 && get_option('page_comments')): ?>
      <div class="comments-paginator">
      	<?php previous_comments_link("&laquo; ".__('Older Comments', 'ruventhemes')) ?>
      	<?php next_comments_link(__('Newer Comments', 'ruventhemes')." &raquo;") ?>
      </div>
    <?php endif; ?>
    
  <?php endif; ?>
  
  <?php
  	if(!comments_open()) {
  	  echo do_shortcode('[info_box style="notice"]'.__('Comments are closed.', 'ruventhemes').'[/info_box]');
  	}
	?>

  <?php if(comments_open()) rvn_put_comment_form(); ?>
  
</section>
<!-- END #comments -->

<?php endif; ?>