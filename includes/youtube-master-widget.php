<?php
//Hook Widget
add_action( 'widgets_init', 'youtube_master_widget' );
//Register Widget
function youtube_master_widget() {
register_widget( 'youtube_master_widget' );
}

class youtube_master_widget extends WP_Widget {
	function youtube_master_widget() {
	$widget_ops = array( 'classname' => 'Youtube Master', 'description' => __('Youtube Master displays Youtube Playlists or Single Videos with optional Youtube Subscribe Channel button in any template widget position. ', 'youtube_master') );
	$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'youtube_master_widget' );
	$this->WP_Widget( 'youtube_master_widget', __('Youtube Master', 'youtube_master'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		//Our variables from the widget settings.
		$name = "Youtube Master";
		$title = isset( $instance['title'] ) ? $instance['title'] :false;
		$youtubespacer ="'";
		$show_youtubebutton = isset( $instance['show_youtubebutton'] ) ? $instance['show_youtubebutton'] :false;
		$youtubebutton_id = $instance['youtubebutton_id'];
		$youtubebutton_layout = $instance['youtubebutton_layout'];
		echo $before_widget;
		
	// Display the widget title
		if ( $title )
		echo $before_title . $name . $after_title;
	//Display Youtube Video

	//Display Youtube Playlist

	//Display Youtube Subscribe Channel Button
		if ( $show_youtubebutton )
		echo '<script src="https://apis.google.com/js/plusone.js"></script>' .
			'<div class="g-ytsubscribe" data-channelid="'.$youtubebutton_id.'" data-layout="'.$youtubebutton_layout.'"></div>';
	echo $after_widget;
	}
	//Update the widget
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		//Strip tags from title and name to remove HTML
		$instance['name'] = strip_tags( $new_instance['name'] );
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['show_youtubebutton'] = $new_instance['show_youtubebutton'];
		$instance['youtubebutton_id'] = $new_instance['youtubebutton_id'];
		$instance['youtubebutton_layout'] = $new_instance['youtubebutton_layout'];
		return $instance;
	}
	function form( $instance ) {
	//Set up some default widget settings.
	$defaults = array( 'name' => __('Youtube Master', 'youtube_master'), 'title' => true, 'show_youtubebutton' => false, 'youtubebutton_id' => false, 'youtubebutton_layout' => false );
	$instance = wp_parse_args( (array) $instance, $defaults );
	?>
		<b>Check the buttons to be displayed:</b>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; height:16px; vertical-align:middle;" />
	&nbsp;
	<input type="checkbox" <?php checked( (bool) $instance['title'], true ); ?> id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><b><?php _e('Display Widget Title', 'youtube_master'); ?></b></label></br>
	</p>
<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', __FILE__); ?>) repeat-x; height: 10px"></div>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; height:16px; vertical-align:middle;" />
	&nbsp;
	<input type="checkbox" <?php checked( (bool) $instance['show_youtubebutton'], true ); ?> id="<?php echo $this->get_field_id( 'show_youtubebutton' ); ?>" name="<?php echo $this->get_field_name( 'show_youtubebutton' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'show_youtubebutton' ); ?>"><b><?php _e('Youtube Subcribe Channel Button', 'youtube_master'); ?></b></label></br>
	</p>
	<p>
	<label for="<?php echo $this->get_field_id( 'youtubebutton_id' ); ?>"><?php _e('insert your Youtube Channel ID:', 'youtube_master'); ?></label></br>
	<input id="<?php echo $this->get_field_id( 'youtubebutton_id' ); ?>" name="<?php echo $this->get_field_name( 'youtubebutton_id' ); ?>" value="<?php echo $instance['youtubebutton_id']; ?>" style="width:auto;" />
	</p>
	<div class="description"><a href="http://www.youtube.com/account_advanced/" target="_blank" title="Youtube Channel ID">Get my Channel ID</a></div>
	<p>
	<label for="<?php echo $this->get_field_id( 'youtubebutton_layout' ); ?>"><?php _e('Youtube Button Type:', 'youtube_master'); ?></label></br>
	<input id="<?php echo $this->get_field_id( 'youtubebutton_layout' ); ?>" name="<?php echo $this->get_field_name( 'youtubebutton_layout' ); ?>" value="<?php echo $instance['youtubebutton_layout']; ?>" style="width:auto;" />
	</p>
	<div class="description">Write the desired layout, <b>default</b> or <b>full</b></a>.</div>
	<br>
<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', __FILE__); ?>) repeat-x; height: 10px"></div>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; width:16px; vertical-align:middle;" />
	&nbsp;
	<b>Show Youtube Video:</b>
	</p>
	<div class="description">Only available in advanced version.</div>
	<br>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; width:16px; vertical-align:middle;" />
	&nbsp;
	<b>Show Youtube Playlist:</b>
	</p>
	<div class="description">Only available in advanced version.</div>
	<br>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; width:16px; vertical-align:middle;" />
	&nbsp;
	<b>Youtube Width:</b>
	</p>
	<div class="description">Only available in advanced version.</div>
	<br>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; width:16px; vertical-align:middle;" />
	&nbsp;
	<b>Youtube Height:</b>
	</p>
	<div class="description">Only available in advanced version.</div>
	<br>
<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', __FILE__); ?>) repeat-x; height: 10px"></div>
		<p>
		<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; width:16px; vertical-align:middle;" />
		&nbsp;
		<b>Youtube Master Website</b>
		</p>
		<p><a class="button-secondary" href="http://wordpress.techgasp.com/youtube-master/" target="_blank" title="Youtube Master Info Page">Info Page</a> <a class="button-secondary" href="http://wordpress.techgasp.com/youtube-master-documentation/" target="_blank" title="Youtube Master Documentation">Documentation</a> <a class="button-primary" href="http://wordpress.techgasp.com/youtube-master/" target="_blank" title="Youtube Master">Advanced Version</a></p>
<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', __FILE__); ?>) repeat-x; height: 10px"></div>
		<p>
		<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; width:16px; vertical-align:middle;" />
		&nbsp;
		<b>Advanced Version Updater:</b>
		</p>
		<div class="description">The advanced version updater allows to automatically update your advanced plugin. Only available in advanced version.</div>
	<?php
	}
 }
?>