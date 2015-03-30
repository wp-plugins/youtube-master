<?php
function menu_single_youtube_master_admin(){
if ( is_admin() )
add_menu_page( 'Youtube Master', 'Youtube Master', 'manage_options', 'youtube-master', 'youtube_master_admin', plugins_url( 'youtube-master/images/techgasp-minilogo-16.png' ) );
}
		///////////////////////
		// WORDPRESS ACTIONS //
		///////////////////////
		if( is_multisite() ) {
		add_action( 'network_admin_menu', 'menu_single_youtube_master_admin' );
		add_action( 'admin_menu', 'menu_single_youtube_master_admin' );
		}
		else {
		add_action( 'admin_menu', 'menu_single_youtube_master_admin' );
		}

function youtube_master_admin(){
?>
<div class="wrap">
<div style="width:40px; vertical-align:middle; float:left;"><img src="<?php echo plugins_url('../images/techgasp-minilogo.png', __FILE__); ?>" alt="' . esc_attr__( 'TechGasp Plugins') . '" /><br /></div>
<h2><b>&nbsp;TechGasp</b></h2>
<?php

if(!class_exists('WP_List_Table')){
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

if(!class_exists('youtube_master_admin_table_header')){
	require_once( dirname( __FILE__ ) . '/youtube-master-admin-table-header.php');
}
//Prepare Table of elements
$wp_list_table = new youtube_master_admin_table_header();
//Table of elements
$wp_list_table->display();
?>
</br>
<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', __FILE__); ?>) repeat-x; height: 10px"></div>
</br>
<?php
if(!class_exists('youtube_master_admin_table_news')){
	require_once( dirname( __FILE__ ) . '/youtube-master-admin-table-news.php');
}
//Prepare Table of elements
$wp_list_table = new youtube_master_admin_table_news();
//Table of elements
$wp_list_table->display();
?>
</br>
<h2>IMPORTANT: Makes no use of Javascript or Ajax to keep your website fast and conflicts free</h2>

<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', __FILE__); ?>) repeat-x; height: 10px"></div>

<br>

<p>
<a class="button-secondary" href="http://wordpress.techgasp.com" target="_blank" title="Visit Website">More TechGasp Plugins</a>
<a class="button-secondary" href="http://wordpress.techgasp.com/support/" target="_blank" title="TechGasp Support">TechGasp Support</a>
<a class="button-primary" href="http://wordpress.techgasp.com/youtube-master/" target="_blank" title="Visit Website"><?php echo get_option('youtube_master_name'); ?> Info</a>
<a class="button-primary" href="http://wordpress.techgasp.com/youtube-master-documentation/" target="_blank" title="Visit Website"><?php echo get_option('youtube_master_name'); ?> Documentation</a>
<a class="button-primary" href="http://wordpress.techgasp.com/youtube-master/" target="_blank" title="Visit Website">Get Add-ons</a>
</p>
<?php
}