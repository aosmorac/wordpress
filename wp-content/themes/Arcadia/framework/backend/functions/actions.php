<?php



/* Put Global Javascript Variables Code
------------------------------------------------------------ */

if(!function_exists('rvn_put_global_javascript_variables_code'))
{
  function rvn_put_global_javascript_variables_code() {
		echo "<script type='text/javascript'> /* <![CDATA[ */ ";
		echo   "var rvn = { ";
		echo     "template_url: '".TEMPLATEURL."', ";
		echo     "fw_url: '".FW_URL."', ";
		echo " }; /* ]]> */ </script>";
  }
}

if(function_exists('rvn_put_global_javascript_variables_code'))
{
  add_action('admin_print_scripts', 'rvn_put_global_javascript_variables_code');
}



/* Activate Theme
------------------------------------------------------------ */

if(!function_exists('rvn_activate_theme'))
{
	function rvn_activate_theme() {
		global $pagenow;
		
		if(is_admin() && $pagenow == 'themes.php' && isset($_GET['activated'])) {
		  $old_theme_version = rvn_get_option('theme-version');
		  $cur_theme_version = THEME_VERSION;
		  
		  if(version_compare($cur_theme_version, $old_theme_version, '!=')) {
  		  update_option(OPTION_ID_PREFIX.'old-theme-version', $old_theme_version);
  			update_option(OPTION_ID_PREFIX.'theme-version', $cur_theme_version);
			}
			
			header('Location: '.admin_url().'admin.php?page=main');
		}
	}
}

if(function_exists('rvn_activate_theme'))
{
	add_action('admin_init', 'rvn_activate_theme');
}



?>