<?php
/*
Plugin Name: Twitter Info
Plugin URI: http://example.com/
Description: Get number of followers and last tweet of a Twitter user
Author: WROX
Author URI: http://wrox.com
*/
// Define the Twitter username. Edit this.
define( 'BOJ_TI_USERNAME', 'ozh' );
// Name of the transient key to cache values
define( 'BOJ_TI_KEY', 'boj_ti_key' );
// Poll Twitter API
// Return array of (follower count, last tweet), or false on error
function boj_ti_ask_twitter() {
	// Send GET request to Twitter API
	$api_url = 'http://api.twitter.com/1/users/show.json?screen_name=';
	$api_response = wp_remote_get( $api_url . urlencode( BOJ_TI_USERNAME ) );
	// Get the JSON object
	$json = wp_remote_retrieve_body( $api_response );
	// Make sure the request was successful or return false
	if( empty( $json ) ) return false;
	// Decode the JSON object
	// Return an array with follower count and last tweet
	$json = json_decode( $json );
		return array(
			'followers' => $json-> followers_count,
			'last_tweet' => $json-> status-> text
		);
}
// Return array of followers and last tweet, either from cache or fresh
function boj_ti_get_infos( $info = 'followers' ) {
	// first, look for a cached result
	if ( false !== $cache = get_transient( BOJ_TI_KEY ) ) return $cache[$info];
	// no cache? Then get fresh value
	$fresh = boj_ti_ask_twitter();
	// Default cache life span is 1 hour (3600 seconds)
	$cache = 3600;
	// If Twitter query unsuccessful, store dummy values for 5 minutes
	if( $fresh === false ) {
		$fresh = array(
			'followers' => 0,
			'last_tweet' => '',
			);
		$cache = 60*5;
	}
// Store transient
set_transient( BOJ_TI_KEY, $fresh, 60*5 );
// Return fresh asked info
return $fresh[$info];
}
// Echo number of followers
function boj_ti_followers() {
	$num = boj_ti_get_infos( 'followers' );
	echo " <p> I have $num followers on Twitter! </p> ";
}
	// Echo last tweet
function boj_ti_last_tweet() {
	$tweet = boj_ti_get_infos( 'last_tweet' );
	echo " <p> My last tweet: $tweet </p> ";
}
// Register custom actions
add_action( 'boj_ti_followers' , 'boj_ti_followers' );
add_action( 'boj_ti_last_tweet', 'boj_ti_last_tweet' );
?>