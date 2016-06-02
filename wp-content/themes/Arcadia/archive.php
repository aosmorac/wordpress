<?php
  $archive_layout = rvn_get_option('archive-layout');

  if($archive_layout == 'blog'):
    get_template_part('template_blog_archive');
  else:
    get_template_part('template_archive');
  endif;
?>