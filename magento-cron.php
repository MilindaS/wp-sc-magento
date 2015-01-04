<?php
/*
Plugin Name: Magento Cron
Plugin URI: http://stunningcodes.co.nf
Description: A plugin to create widgets in WordPress
Version: 1.0
Author: Makas Rock
Author URI: http://stunningcodes.com
*/

add_action( 'admin_menu', 'boj_cron_menu' );

function boj_cron_menu() {
//create cron example settings page
	add_options_page(
			$page_title = 'Cron Example Settings',
			$menu_title = 'Cron Settings',
			$capability = 'manage_options',
			$menu_slug = 'boj-cron',
			$function = 'boj_cron_settings'
		);
}
add_action('boj_cron_hook', 'boj_cron_email_reminder');

function boj_cron_email_reminder() {
	//send scheduled email
	wp_mail('rockmakas@gmail.com','Elm St. Reminder','Dont fall asleep!' );
}
function boj_cron_settings() {
	//verify event has not been scheduled
	if ( !wp_next_scheduled( 'boj_cron_hook' ) ) {
	//schedule the event to run hourly
		wp_schedule_event( time(), 'five_minutely', 'boj_cron_hook' );
	}

}

add_filter( 'cron_schedules', 'boj_cron_add_minly' );
function boj_cron_add_minly( $schedules ) {
	//create a 'weekly' recurrence schedule option
	$schedules['five_minutely'] = array(
		'interval' => 300,
		'display' => 'Once Weekly'
		);
	return $schedules;
}

add_action( 'admin_menu', 'boj_view_cron_menu' );
function boj_view_cron_menu() {
//create view cron jobs settings page
	add_options_page(
		'View Cron Jobs',
		'View Cron Jobs',
		'manage_options',
		'boj-view-cron',
		'boj_view_cron_settings'
		);
}

function boj_view_cron_settings() {
	$cron = _get_cron_array();
	$schedules = wp_get_schedules();
	$date_format = 'M j, Y @ G:i';
	?>
	<div class="wrap" id="cron-gui">
		<h2> Cron Events Scheduled </h2>
		<table class="widefat fixed">
			<thead>
				<tr>
					<th scope="col"> Next Run (GMT/UTC) </th>
					<th scope="col"> Schedule </th>
					<th scope="col"> Hook Name </th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ( $cron as $timestamp => $cronhooks ) { ?>
					<?php foreach ( (array) $cronhooks as
						$hook => $events ) { ?>
						<?php foreach ( (array) $events as $event ) { ?>
							<tr>
								<td>
									<?php echo date_i18n( $date_format,	wp_next_scheduled( $hook ) ); ?>
								</td>
								<td>
								<?php 
									if ( $event[ 'schedule' ] ) {
										echo $schedules[
										$event[ 'schedule' ] ][ 'display' ];
									} else {
								?> One-time <?php
									}
								?>
								</td>
								<td> <?php echo $hook; ?> </td>
							</tr>
						<?php } ?>
					<?php } ?>
				<?php } ?>
			</tbody>
		</table>
	</div>
<?php
}
?>