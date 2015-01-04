<?php
/*
Plugin Name: Magento Del Post
Plugin URI: http://stunningcodes.co.nf
Description: A plugin to create w<div idgets in WordPress
Version: 1.0
Author: Makas Rock
Author URI: http://stunningcodes.com
*/
add_action( 'boj_del_rev_cron_hook', 'boj_cron_rev_delete' );

function boj_cron_rev_delete() {
	global $wpdb;
	$sql = "DELETE a,b,c FROM $wpdb-> posts a 
				LEFT JOIN $wpdb-> term_relationships b
				ON (a.ID = b.object_id)
				LEFT JOIN $wpdb-> postmeta c
				ON (a.ID = c.post_id)
				WHERE a.post_type = 'revision'
				AND DATEDIFF( now(), a.post_modified ) > 30 ";
	//execute query to delete all post revisions and meta data
		$wpdb-> query( $wpdb-> prepare( $sql ) );
}

add_action( 'admin_init', 'boj_cron_rev_admin_init' );

function boj_cron_rev_admin_init(){
	//register the options in the Settings API
	register_setting(
		$option_group = 'general',
		$option_name = 'boj_cron_rev_options',
		$sanitize_callback = null
		);
	//register the field in the Settings API
	add_settings_field(
		$id ='boj_cron_rev_field',
		$title = 'Delete post revisions weekly?',
		$callback ='boj_cron_rev_setting_input',
		$page = 'general',
		$section = 'default',
		$args = null
		);
	//load the option value
	$options = get_option('boj_cron_rev_options');

	$boj_del_rev = $options['boj_del_rev'];
	// if the option is enabled and
	// not already scheduled lets schedule it
	if ( $boj_del_rev == 'on' && !wp_next_scheduled( 'boj_del_rev_cron_hook' ) ) {
	//schedule the event to run hourly
		wp_schedule_event( time(), 'weekly','boj_del_rev_cron_hook' );
	// if the option is NOT enabled and scheduled lets unschedule it
	} elseif ( $boj_del_rev != 'on' &&	wp_next_scheduled( 'boj_del_rev_cron_hook' ) ) {
		//get time of next scheduled run
		$timestamp = wp_next_scheduled( 'boj_del_rev_cron_hook' );
		//unschedule custom action hook
		wp_unschedule_event( $timestamp, 'boj_del_rev_cron_hook' );
	}
	}
	function boj_cron_rev_setting_input() {
	// load the 'boj_del_rev' option from the database
		$options = get_option( 'boj_cron_rev_options' );
		$boj_del_rev = $options['boj_del_rev'];
		//display the option checkbox
		echo "<input id='boj_del_rev' name='boj_cron_rev_options[boj_del_rev]'	type='checkbox' ".checked( $boj_del_rev, 'on', false ). "/>";
	}
	//register a weekly recurrence
	add_filter( 'cron_schedules', 'boj_cron_add_weekly' );
	function boj_cron_add_weekly( $schedules ) {
	//create a 'weekly' recurrence schedule
		$schedules['weekly'] = array(
			'interval' => 604800,
			'display' => 'Once Weekly'
		);
	return $schedules;
	}
?>