<?php
/*

THIS PLUGIN IS HIGHLY MODIFIED BY RUVEN PELKA


Plugin Name: Simple Twitter Widget
Plugin URI: https://github.com/matthiassiegel/Simple-Twitter-Widget
Description: A simple but powerful widget to display updates from a Twitter feed. Configurable, reliable and with advanced caching.
Version: 1.02
Author: Matthias Siegel
Author URI: http://chipsandtv.com/


Copyright 2010  Matthias Siegel  (email: chipsandtv@gmail.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/




/* Twitter Widget
============================================================ */

if(!class_exists('rvn_twitter_widget'))
{
	class rvn_twitter_widget extends WP_Widget {
  
  
  
    /* Constructor
    ------------------------------------------------------------ */
    
		function __construct() {
  		$widget_ops = array('classname' => 'widget_twitter', 'description' => __('Display your latest tweets', 'ruventhemes'));
  		parent::__construct('twitter', __('CUSTOM: Twitter', 'ruventhemes'), $widget_ops);
		}
  
  
  
    /* Widget
    ------------------------------------------------------------ */
		
		function widget($args, $instance) {
			extract($args);
			
			// User-selected settings
			$title           = apply_filters('widget_title', (empty($instance['title']) ? __('Latest Tweets', 'ruventhemes') : $instance['title']), $instance, $this->id_base);
			$username        = $instance['username'];
			$number          = $instance['number'];
			$show_date       = $instance['show_date'];
			$show_replies    = $instance['show_replies'];
			$show_retweets   = $instance['show_retweets'];
			$clickable_links = $instance['clickable_links'];

			require_once(ABSPATH . WPINC . '/feed.php');

			// Get current upload directory
      
      echo $before_widget;
			echo $before_title . $title . $after_title;
      echo '<div class="widget-content">';
      
      $output = '';
      
      $cache_id = OPTION_ID_PREFIX.'twitter-widget-cache_'.$username.'_'.$widget_id;
  		$cached_data = get_transient($cache_id);
  		
			// If cached data exist
			if($cached_data) {
  			$output = $cached_data;
  			echo (!$output) ? '<p>'.__('Error while loading Twitter feed.', 'ruventhemes').'</p>' : '';
			}
			
			// If cached data don't exist, create or update them, otherwise load from file
			else {
        
				$feed = fetch_feed('https://api.twitter.com/1/statuses/user_timeline.rss?screen_name=' . $username);
				
				// This check prevents fatal errors - which can't be turned off in PHP - when feed updates fail
				if(method_exists($feed, 'get_items')) {
					$tweets = $feed->get_items(0);
          
					$output.= '<ul>';
          
          $i = 0;
					foreach($tweets as $t) {
						// Get tweet text
						$text = $t->get_description();
						
						// Remove username from text
						$prefix_len = strlen($username.': ');
						$text = substr($text, $prefix_len, strlen($text) - $prefix_len);
						
						$show_tweet = true;
						
						// If no replies should be displayed
						if(!$show_replies) {
						  $show_tweet = ($text[0] == '@')  ? false : true;
						}
						// If no retweets should be displayed
						if($show_tweet && !$show_retweets) {
						  $show_tweet = (substr($text, 0, 2) == 'RT') ? false : true;
						}
						
						// If tweet should be displayed
						if($show_tweet) {
  						$output .= '<li class="tweet">';
  						
  						// Get date/time and convert to Unix timestamp
  						$time = strtotime($t->get_date());
  
  						// If status update is newer than 7 days, print time as "... ago" instead of date stamp
  						if((abs(time() - $time)) < (60*60*24*7)) {
  							$time = human_time_diff($time) . ' ago';
  						}
  						else {
  							$time = date('j F Y', $time);
  						}
  
  						// Make links and Twitter names clickable
  						if($clickable_links) {
  							// Match URLs
				    		$text = preg_replace('`\b(([\w-]+://?|www[.])[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/)))`', '<a href="$0">$0</a>', $text);
				    		// Match @name
				    		$text = preg_replace('/(@)([a-zA-Z0-9\_]+)/', '@<a href="http://twitter.com/$2">$2</a>', $text);
  						}
              
              // Save filtered tweet text
  						$output.= $text;
  
  			    	// Display date/time
  						if($show_date) {
  						  $datetime = 'datetime="'.date('c', strtotime($t->get_date())).'"';
  						  $output.= '<a href="'.$t->get_permalink().'" class="post-date"><time '.$datetime.' pubdate>'.$time.'</time></a>';
              }
              
  						$output.= '</li>';
  						
  						// Iteration
  						$i++;
  						if($i == $number) break;
  					}	  
					}
					
					$output .= '</ul>';
					
					// Save updated feed to cache
					set_transient($cache_id, $output, 60*30); // Interval = 30 mins
        }
        
        
				else {
  				echo (!$output) ? '<p>'.__('Error while loading Twitter feed.', 'ruventhemes').'</p>' : '';
				}
				
			}
			
			// Display everything
			echo $output;
			
			echo '</div>';
			echo $after_widget;
		}
  
  
  
    /* Update
    ------------------------------------------------------------ */
		
		function update($new_instance, $old_instance) {
			$instance = $old_instance;

			$instance['title']           = $new_instance['title'];
			$instance['username']        = $new_instance['username'];
			$instance['number']          = $new_instance['number'];
			$instance['show_date']       = $new_instance['show_date'];
			$instance['show_replies']    = $new_instance['show_replies'];
			$instance['show_retweets']   = $new_instance['show_retweets'];
			$instance['clickable_links'] = $new_instance['clickable_links'];
			
			// Delete the cache file when options were updated so the content gets refreshed on next page load
			$upload = wp_upload_dir();
			$cachefile = $upload['basedir'] . '/cache.widget_twitter_' . $old_instance['username'] . '.txt';
			@unlink($cachefile);

			return $instance;
		}
  
  
  
    /* Form
    ------------------------------------------------------------ */
		
		function form($instance) {
			// Set up some default widget settings
			$instance = wp_parse_args((array) $instance, array(
			  'title'           => __('Latest Tweets', 'ruventhemes'),
			  'username'        => '_ruven',
			  'number'          => 3,
			  'show_date'       => true,
			  'show_replies'    => false,
			  'show_retweets'   => true,
			  'clickable_links' => true
			));
			
			extract($instance);
			
			if(!is_numeric($number)) $number = 3;
      
      ?>
  			<p>
  				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ruventhemes'); ?></label>
  				<input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($title); ?>" />
  			</p>
  			<p>
  				<label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Your Twitter username:', 'ruventhemes'); ?></label>
  				<input class="widefat" type="text" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" value="<?php echo $username; ?>" />
  			</p>
    		<p>
    		  <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of entries to show:', 'ruventhemes'); ?></label>
    		  <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
    		</p>
  			<p>
  				<input class="checkbox" type="checkbox" <?php if($show_date) echo 'checked="checked" '; ?>id="<?php echo $this->get_field_id('show_date'); ?>" name="<?php echo $this->get_field_name('show_date'); ?>" />
  				<label for="<?php echo $this->get_field_id('show_date'); ?>"><?php _e('Show Date', 'ruventhemes'); ?></label>
  				<br />
  				<input class="checkbox" type="checkbox" <?php if($show_replies) echo 'checked="checked" '; ?>id="<?php echo $this->get_field_id('show_replies'); ?>" name="<?php echo $this->get_field_name('show_replies'); ?>" />
  				<label for="<?php echo $this->get_field_id('show_replies'); ?>"><?php _e('Show Replies', 'ruventhemes'); ?></label>
  				<br />
  				<input class="checkbox" type="checkbox" <?php if($show_retweets) echo 'checked="checked" '; ?>id="<?php echo $this->get_field_id('show_retweets'); ?>" name="<?php echo $this->get_field_name('show_retweets'); ?>" />
  				<label for="<?php echo $this->get_field_id('show_retweets'); ?>"><?php _e('Show Retweets', 'ruventhemes'); ?></label>
  				<br />
  				<input class="checkbox" type="checkbox" <?php if($clickable_links) echo 'checked="checked" '; ?>id="<?php echo $this->get_field_id('clickable_links'); ?>" name="<?php echo $this->get_field_name('clickable_links'); ?>" />
  				<label for="<?php echo $this->get_field_id('clickable_links'); ?>"><?php _e('Make URLs and usernames clickable', 'ruventhemes'); ?></label>
  			</p>
      <?php
		}
		
		
	}	
}







/* Register Widget
============================================================ */

if(class_exists('rvn_twitter_widget'))
{
  add_action('widgets_init', 'register_twitter_widget');
  
  function register_twitter_widget() {
  	register_widget('rvn_twitter_widget');
  }
}







?>