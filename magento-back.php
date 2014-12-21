<?php
/*
Plugin Name: Magento
Plugin URI: http://stunningcodes.co.nf
Description: A plugin to create widgets in WordPress
Version: 1.0
Author: Makas Rock
Author URI: http://stunningcodes.com
*/

// use widgets_init action hook to execute custom function
add_action( 'widgets_init', 'Magento_register_widgets' );



//register our widget
function Magento_register_widgets() {
	register_widget( 'Magento' );
}


class Magento extends WP_Widget {


//process the new widget
	function Magento() {
		$widget_ops = array(
			'classname' => 'Magento_widget_class',
			'description' => 'Display a magento content.'
		);
		$this-> WP_Widget( 'Magento', 'Magento',$widget_ops );
	}


//build the widget settings form
function form($instance) {
	$defaults = array( 
		'title' => '', 
		'movie' => '', 
		'song' => '' 
		);
	
	$instance = wp_parse_args( (array) $instance, $defaults );

	$title = $instance['title'];
	$movie = $instance['movie'];
	$song = $instance['song'];
?>
	<p> Title: <input class="widefat" name="<?php echo $this-> get_field_name('title'); ?> "type="text" value="<?php echo esc_attr( $title ); ?>" / > </p>
	<p> Favorite Movie: <input class="widefat" name="<?php echo $this-> get_field_name('movie'); ?> " type="text" value="<?php echo esc_attr( $movie ); ?>" / > </p>
	<p> Favorite Song: 
		<textarea class="widefat" name="<?php echo $this-> get_field_name( 'song' ); ?> " / ><?php echo esc_attr( $song ); ?></textarea>
	</p>
<?php
}
//save the widget settings


function update($new_instance, $old_instance) {
	$instance = $old_instance;
	$instance['title'] = strip_tags( $new_instance['title'] );
	$instance['movie'] = strip_tags( $new_instance['movie'] );
	$instance['song'] = strip_tags( $new_instance['song'] );
	return $instance;
}
//display the widget
function widget($args, $instance) {
	extract($args);
	echo $before_widget;
	$title = apply_filters( 'widget_title', $instance['title'] );
	$movie = empty( $instance['movie'] ) ? ' & nbsp;' : $instance['movie'];
	$song = empty( $instance['song'] ) ? ' & nbsp;' : $instance['song'];

	if (!empty( $title ) ) { echo $before_title . $title . $after_title; };
	echo '<p>Fav Movie:'.$movie.'</p>';
	echo '<p>Fav Song:'.$song.'</p>'; 
	echo $after_widget;
	}
}
?>