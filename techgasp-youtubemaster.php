<?php
/**
Plugin Name: Youtube Master
Plugin URI: http://wordpress.techgasp.com/youtube-master/
Version: 2.0
Author: TechGasp
Author URI: http://wordpress.techgasp.com
Text Domain: youtube-master
Description: Youtube Master displays Youtube Playlists or Single Videos with optional Youtube Subscribe Channel button in any template widget position.
License: GPL2 or later
*/
/*  Copyright 2013 TechGasp  (email : info@techgasp.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
if(!class_exists('techgasp_youtubemaster')) :

// DEFINE PLUGIN ID
define('TECHGASP_YOUTUBEMASTER_ID', 'youtube-master-options');

// DEFINE PLUGIN NICK
define('TECHGASP_YOUTUBEMASTER_NICK', 'Youtube Master');

require_once('techgasp-youtubemaster-widget.php');

    class techgasp_youtubemaster
    {
		/** function/method
		* Usage: return absolute file path
		* Arg(1): string
		* Return: string
		*/
		public static function file_path($file)
		{
			return ABSPATH.'wp-content/plugins/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__)).$file;
		}
		/** function/method
		* Usage: hooking the plugin options/settings
		* Arg(0): null
		* Return: void
		*/
		public static function techgasp_youtubemaster_register()
		{
			register_setting(TECHGASP_YOUTUBEMASTER_ID.'_options', 'tsm_quote');
		}
		/** function/method
		* Usage: hooking (registering) the plugin menu
		* Arg(0): null
		* Return: void
		*/
		public static function menu()
		{
			// Create menu tab
			add_options_page(TECHGASP_YOUTUBEMASTER_NICK.' Plugin Options', TECHGASP_YOUTUBEMASTER_NICK, 'manage_options', TECHGASP_YOUTUBEMASTER_ID.'_options', array('techgasp_youtubemaster', 'options_page'));
			add_filter( 'plugin_action_links', array('techgasp_youtubemaster', 'techgasp_youtubemaster_link'), 10, 2 );
		}
		/** function/method
		* Usage: show options/settings form page
		* Arg(0): null
		* Return: void
		*/
		public static function options_page()
		{
			if (!current_user_can('manage_options'))
			{
				wp_die( __('You do not have sufficient permissions to access this page.') );
			}
			$plugin_id = TECHGASP_YOUTUBEMASTER_ID;
			// display options page
			include(self::file_path('techgasp-youtubemaster-admin.php'));
		}
		/** function/method
                * Usage: show options/settings form page
                * Arg(0): null
                * Return: void
                */
		 public static function techgasp_youtubemaster_widget()
                {
                        // display widget page
                        include(self::file_path('techgasp-youtubemaster-widget.php'));
                }
		/** function/method
		* Usage: filtering the content
		* Arg(1): string
		* Return: string
		*/
		public static function content_with_quote($content)
		{
			$quote = '<p><blockquote>' . get_option('tsm_quote') . '</blockquote></p>';
			return $content . $quote;
		}
		
		// Add settings link on plugin page
		public function techgasp_youtubemaster_link($links, $file) {
		static $this_plugin;
		if (!$this_plugin) $this_plugin = plugin_basename(__FILE__);
		if ($file == $this_plugin){
		$settings_link = '<a href="' . admin_url( 'options-general.php?page='.TECHGASP_YOUTUBEMASTER_ID).'_options' . '">' . __( 'Settings' ) . '</a>';
		array_unshift($links, $settings_link);
		}
		return $links;
		}
	}
		if ( is_admin() )
		{
		add_action('admin_init', array('techgasp_youtubemaster', 'techgasp_youtubemaster_register'));
		add_action('admin_menu', array('techgasp_youtubemaster', 'menu'));
		}
		add_filter('the_content', array('techgasp_youtubemaster', 'content_with_quote'));
endif;
?>