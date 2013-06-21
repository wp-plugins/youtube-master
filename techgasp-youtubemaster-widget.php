<?php
//Load Shortcode Framework

//Hook Widget
add_action( 'widgets_init', 'techgasp_youtubemaster_widget' );
//Register Widget
function techgasp_youtubemaster_widget() {
register_widget( 'techgasp_youtubemaster_widget' );
}

class techgasp_youtubemaster_widget extends WP_Widget {
	function techgasp_youtubemaster_widget() {
	$widget_ops = array( 'classname' => 'Youtube Master', 'description' => __('Youtube Master displays Youtube Playlists or Single Videos with optional Youtube Subscribe Channel button in any template widget position. ', 'Youtube Master') );
	$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'techgasp_youtubemaster_widget' );
	$this->WP_Widget( 'techgasp_youtubemaster_widget', __('Youtube Master', 'youtube master'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		//Our variables from the widget settings.
		$name = "Youtube Master";
		$title = isset( $instance['title'] ) ? $instance['title'] :false;
		$youtubespacer ="'";
		$show_youtubebutton = isset( $instance['show_youtubebutton'] ) ? $instance['show_youtubebutton'] :false;
		$youtubebutton_id = $instance['youtubebutton_id'];
		echo $before_widget;
		
	// Display the widget title
		if ( $title )
		echo $before_title . $name . $after_title;
	//Display Youtube Subscribe Channel Button
		if ( $show_youtubebutton )
		echo '<a href="//www.youtube.com/subscription_center?add_user_id='.$youtubebutton_id.'&feature=creators_cornier-//s.ytimg.com/yt/img/creators_corner/Subscribe_to_my_videos/YT_Subscribe_160x27_red.png"  target="_blank"><img src="//s.ytimg.com/yt/img/creators_corner/Subscribe_to_my_videos/YT_Subscribe_160x27_red.png" alt="Subscribe to me on YouTube"/></a><img src="//www.youtube-nocookie.com/gen_204?feature=creators_cornier-//s.ytimg.com/yt/img/creators_corner/Subscribe_to_my_videos/YT_Subscribe_160x27_red.png" style="display: none"/>';
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
		return $instance;
	}
	function form( $instance ) {
	//Set up some default widget settings.
	$defaults = array( 'name' => __('Youtube Master', 'Youtube master'), 'title' => true, 'show_youtubebutton' => false, 'youtubebutton_id' => false );
	$instance = wp_parse_args( (array) $instance, $defaults );
	?>
		<b>Check the buttons to be displayed:</b>
	<p>
	<input type="checkbox" <?php checked( (bool) $instance['title'], true ); ?> id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><b><?php _e('Display Widget Title', 'youtube master'); ?></b></label></br>
	</p>
	<hr>
	<p>
	<input type="checkbox" <?php checked( (bool) $instance['show_youtubebutton'], true ); ?> id="<?php echo $this->get_field_id( 'show_youtubebutton' ); ?>" name="<?php echo $this->get_field_name( 'show_youtubebutton' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'show_youtubebutton' ); ?>"><b><?php _e('Youtube Subcribe Channel Button', 'youtube master'); ?></b></label></br>
	</p>
	<p>
	<label for="<?php echo $this->get_field_id( 'youtubebutton_id' ); ?>"><?php _e('insert your Youtube Channel ID:', 'youtube master'); ?></label></br>
	<input id="<?php echo $this->get_field_id( 'youtubebutton_id' ); ?>" name="<?php echo $this->get_field_name( 'youtubebutton_id' ); ?>" value="<?php echo $instance['youtubebutton_id']; ?>" style="width:auto;" />
	</p>
	<p>Read plugin online documentation for help getting your channel ID.</p>
	<hr>
	<p><b>Youtube Master Advanced Version constains Display or hide Widget Title, Display or hide Youtube Subscribe Button, Display or hide Youtube Player (Single Youtube Videos or Playlist), Shortcode Framework, publish widget inside pages and posts</b></p>
	<p><a class="button-primary" href="http://wordpress.techgasp.com/youtube-master/" target="_blank" title="Youtube Master Advanced Version">Youtube Master Advanced Version</a></p>
	<?php
	}
 }
?>