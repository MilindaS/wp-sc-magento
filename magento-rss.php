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
		'title' => 'RSS Feed',
		'rss_feed' => 'http://strangework.com/feed',
		'rss_items' => '2'
	);
	$instance = wp_parse_args( (array) $instance, $defaults );
	$title = $instance['title'];
	$rss_feed = $instance['rss_feed'];
	$rss_items = $instance['rss_items'];
	$rss_date = $instance['rss_date'];
	$rss_summary = $instance['rss_summary'];
?>
<p> Title: <input class="widefat" name="<?php echo $this-> get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /> </p>
<p> RSS Feed: <input class="widefat" name="<?php echo $this-> get_field_name( 'rss_feed' ); ?>" type="text" value="<?php echo esc_attr( $rss_feed ); ?> "/> </p>
<p> Items to Display:
	<select name="<?php echo $this-> get_field_name( 'rss_items' ); ?>" >
		<option value="1" <?php selected( $rss_items, 1 ); ?> > 1 </option>
		<option value="2" <?php selected( $rss_items, 2 ); ?> > 2 </option>
		<option value="3" <?php selected( $rss_items, 3 ); ?> > 3 </option>
		<option value="4" <?php selected( $rss_items, 4 ); ?> > 4 </option>
		<option value="5" <?php selected( $rss_items, 5 ); ?> > 5 </option>
	</select >
</p>
<p> Show Date?: <input name="<?php echo $this-> get_field_name( 'rss_date' ); ?>" type="checkbox" <?php checked( $rss_date, 'on' ); ?> /> </p>
<p> Show Summary?: <input name="<?php echo $this-> get_field_name( 'rss_summary' ); ?>" type="checkbox" <?php checked( $rss_summary, 'on' ); ?> /> </p>
<?php
}
//save the widget settings


function update($new_instance, $old_instance) {
	$instance = $old_instance;
	$instance['title'] = strip_tags( $new_instance['title'] );
	$instance['rss_feed'] = strip_tags( $new_instance['rss_feed'] );
	$instance['rss_items'] = strip_tags( $new_instance['rss_items'] );
	$instance['rss_date'] = strip_tags( $new_instance['rss_date'] );
	$instance['rss_summary'] = strip_tags( $new_instance['rss_summary'] );
	return $instance;
}
//display the widget
function widget($args, $instance) {
	extract($args);
	echo $before_widget;
	$title = apply_filters( 'widget_title', $instance['title'] );
	$rss_feed = empty( $instance['rss_feed'] ) ? '' : $instance['rss_feed'];
	$rss_items = empty( $instance['rss_items'] ) ? 2 : $instance['rss_items'];
	$rss_date = empty( $instance['rss_date'] ) ? 0 : 1;
	$rss_summary = empty( $instance['rss_summary'] ) ? 0 : 1;
		
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		
		if ( $rss_feed ) {
			//display the RSS feed
			wp_widget_rss_output( array(
			'url' => $rss_feed,
			'title' => $title,
			'items' => $rss_items,
			'show_summary' => $rss_summary,
			'show_author' => 0,
			'show_date' => $rss_date
			) );
		} 
		echo $after_widget;
	}
}
?>