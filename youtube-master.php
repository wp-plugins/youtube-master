<?php
/**
Plugin Name: Youtube Master
Plugin URI: http://wordpress.techgasp.com/youtube-master/
Version: 4.4.1.5
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
if(!class_exists('youtube_master')) :
///////DEFINE DIR///////
define( 'YOUTUBE_MASTER_DIR', plugin_dir_path( __FILE__ ) );
///////DEFINE URL///////
define( 'YOUTUBE_MASTER_URL', plugin_dir_url( __FILE__ ) );
///////DEFINE ID//////
define( 'YOUTUBE_MASTER_ID', 'youtube-master');
///////DEFINE VERSION///////
define( 'YOUTUBE_MASTER_VERSION', '4.4.1.5' );
global $youtube_master_version, $youtube_master_name;
$youtube_master_version = "4.4.1.5"; //for other pages
$youtube_master_name = "Youtube Master"; //pretty name
if( is_multisite() ) {
update_site_option( 'youtube_master_installed_version', $youtube_master_version );
update_site_option( 'youtube_master_name', $youtube_master_name );
}
else{
update_option( 'youtube_master_installed_version', $youtube_master_version );
update_option( 'youtube_master_name', $youtube_master_name );
}
// HOOK ADMIN
require_once( dirname( __FILE__ ) . '/includes/youtube-master-admin.php');
// HOOK ADMIN IN & UN SHORTCODE
require_once( dirname( __FILE__ ) . '/includes/youtube-master-admin-shortcodes.php');
// HOOK ADMIN WIDGETS
require_once( dirname( __FILE__ ) . '/includes/youtube-master-admin-widgets.php');
// HOOK ADMIN ADDONS
require_once( dirname( __FILE__ ) . '/includes/youtube-master-admin-addons.php');
// HOOK ADMIN UPDATER
require_once( dirname( __FILE__ ) . '/includes/youtube-master-admin-updater.php');
// HOOK WIDGET YOUTUBE BUTTONS
require_once( dirname( __FILE__ ) . '/includes/youtube-master-widget-youtube-buttons.php');

class youtube_master{
//REGISTER PLUGIN
public static function youtube_master_register(){
register_activation_hook( __FILE__, array( __CLASS__, 'youtube_master_activate' ) );
}
public static function content_with_quote($content){
$quote = '<p>' . get_option('tsm_quote') . '</p>';
	return $content . $quote;
}
//SETTINGS LINK IN PLUGIN MANAGER
public static function youtube_master_links( $links, $file ) {
if ( $file == plugin_basename( dirname(__FILE__).'/youtube-master.php' ) ) {
		if( is_network_admin() ){
		$techgasp_plugin_url = network_admin_url( 'admin.php?page=youtube-master' );
		}
		else {
		$techgasp_plugin_url = admin_url( 'admin.php?page=youtube-master' );
		}
	$links[] = '<a href="' . $techgasp_plugin_url . '">'.__( 'Settings' ).'</a>';
	}
	return $links;
}

public static function youtube_master_updater_version_check(){
global $youtube_master_version;
//CHECK NEW VERSION
$youtube_master_slug = basename(dirname(__FILE__));
$current = get_site_transient( 'update_plugins' );
$youtube_plugin_slug = $youtube_master_slug.'/'.$youtube_master_slug.'.php';
@$r = $current->response[ $youtube_plugin_slug ];
if (empty($r)){
$r = false;
$youtube_plugin_slug = false;
if( is_multisite() ) {
update_site_option( 'youtube_master_newest_version', $youtube_master_version );
}
else{
update_option( 'youtube_master_newest_version', $youtube_master_version );
}
}
if (!empty($r)){
$youtube_plugin_slug = $youtube_master_slug.'/'.$youtube_master_slug.'.php';
@$r = $current->response[ $youtube_plugin_slug ];
if( is_multisite() ) {
update_site_option( 'youtube_master_newest_version', $r->new_version );
}
else{
update_option( 'youtube_master_newest_version', $r->new_version );
}
}
}
//Remove WP Updater
// Advanced Updater
//Updater Label Message
//END CLASS
}
if ( is_admin() ){
	add_action('admin_init', array('youtube_master', 'youtube_master_register'));
	add_action('init', array('youtube_master', 'youtube_master_updater_version_check'));
}
add_filter('the_content', array('youtube_master', 'content_with_quote'));
add_filter( 'plugin_action_links', array('youtube_master', 'youtube_master_links'), 10, 2 );
endif;