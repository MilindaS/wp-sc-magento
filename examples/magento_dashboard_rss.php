<?php
/*
Plugin Name: Magento Dashboard
Plugin URI: http://stunningcodes.co.nf
Description: A plugin to create widgets in WordPress
Version: 1.0
Author: Makas Rock
Author URI: http://stunningcodes.com
*/

// use widgets_init action hook to execute custom function
add_action( 'wp_dashboard_setup', 'Magento_register_widgets' );



//register our widget
function Magento_register_widgets() {
	//register_widget( 'Magento' );
	wp_add_dashboard_widget('dashboard_custom_feed','My Plugin Information','Magento_Display','Magento_setup');
}

function Magento_setup() {
	//check if option is set before saving
	if ( isset( $_POST['boj_rss_feed'] ) ) {
	//retrieve the option value from the form
		$boj_rss_feed = esc_url_raw( $_POST['boj_rss_feed'] );
		//save the value as an option
		update_option( 'boj_dashboard_widget_rss', $boj_rss_feed );
	}
	//load the saved feed if it exists
	$boj_rss_feed = get_option( 'boj_dashboard_widget_rss ');
?>
	<label for="feed">
	RSS Feed URL: <input type="text" name="boj_rss_feed" id="boj_rss_feed" value="<?php echo esc_url( $boj_rss_feed ); ?>" size="50" />
	</label>
	<?php
}


function Magento_Display()
{
	//load our widget option
	$boj_option = get_option( 'boj_dashboard_widget_rss ');
	//if option is empty set a default
	$boj_rss_feed = ( $boj_option ) ? $boj_option : 'http://wordpress.org/news/feed/';
	echo ' <div class=”rss-widget” >';
	wp_widget_rss_output( array(
		'url' => $boj_rss_feed,
		'title' => 'RSS Feed News',
		'items' => 2,
		'show_summary' => 1,
		'show_author' => 0,
		'show_date' => 1
	) );
	echo '</div>';
}
?>
