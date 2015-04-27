<?php
if(!class_exists('WP_List_Table')){
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
class youtube_master_admin_updater_multisite_table extends WP_List_Table {
	/**
	 * Display the rows of records in the table
	 * @return string, echo the markup of the rows
	 */
function display() {
global $youtube_master_plugin_slug;
?>
<table class="widefat fixed" cellspacing="0">
	<thead>
		<tr>
			<th id="columnname" class="manage-column column-columnname" scope="col" width="350"><legend><h3><img src="<?php echo plugins_url('../images/techgasp-warning-icon.png', __FILE__); ?>" style="float:left; height:16px; vertical-align:middle;" /><?php _e('&nbsp;Wordpress Network or Multi-Site Detected', 'youtube_master'); ?></h3></legend></th>
		</tr>
	</thead>

	<tfoot>
		<tr>
			<th class="manage-column column-columnname" scope="col"></th>
		</tr>
	</tfoot>

	<tbody>
		<tr class="alternate">
			<td class="column-columnname" style="vertical-align:middle">
<?php
if ( is_plugin_active( 'youtube-master/youtube-master.php' ) ) {
global $wpdb;
$blog_count = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->blogs WHERE public='1' AND archived='0' AND spam='0' AND deleted='0'" );
update_site_option('youtube_master_multi_blog_count', $blog_count);
$techgasp_plugin_name = get_site_option('youtube_master_name');
echo '<h2><b>Active Websites Detected: '.$blog_count.'</b></h2>';
//CHECK IF IS NETWORK ACTIVE
if ( is_plugin_active_for_network( 'youtube-master/youtube-master.php' ) ) {
echo '<h2><img style="vertical-align:middle;" src="'.plugins_url('../images/techgasp-check-no.png', __FILE__).'" alt="'.get_option('youtube_master_name').'" width="90px" style="vertical-align:bottom" /> <font color="red"><b>WARNING. Plugin is Network Active.</b></font></h2>
<b><font color="red">Turn off Network Activate on your Network Admin plugin page.</b></font><br>
<b><font color="red">It will cause unexpected Wordpress behaviours and errors.</b></font><br>';
}
else{
echo '<h2><img style="vertical-align:middle;" src="'.plugins_url('../images/techgasp-check-yes.png', __FILE__).'" alt="'.get_option('youtube_master_name').'" width="90px" style="vertical-align:bottom" /> <font color="green"><b>OK. Plugin is Network DeActived.</b></font></h2>';
}
}
?>
			</td>
		</tr>
	</tbody>
</table>
<br>
<?php
	}
}