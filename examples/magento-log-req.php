<?php
/*
Plugin Name: Log HTTP requests
Plugin URI: http://example.com/
Description: Log each HTTP requests into a flat text file for further analysis
Author: WROX
Author URI: http://wrox.com
*/
// Hook into filters
add_filter( 'http_request_args', 'boj_loghttp_log_request', 10, 2 );
add_filter( 'http_response', 'boj_loghttp_log_response', 10, 3 );
// Log requests.
// Parameters passed: request parameters and URL
function boj_loghttp_log_request( $r, $url ) {
// Get request parameters formatted for display
$params = print_r( $r, true );
// Get date with format 2010-11-25 @ 13:37:00
$date = date( 'Y-m-d @ H:i:s' );
// Message to log:
$log = <<<LOG
$date: request sent to $url
Parameters: $params
--------------
LOG;
// Log message into flat file
error_log( $log, 3, dirname( __FILE__ ).'/http.log' );
// Don't forget to return the requests arguments!
return $r;
}
// Log responses
// Parameters passed: server response, requests parameters and URL
function boj_loghttp_log_response( $response, $r, $url ) {
// Get server response formatted for display
$resp = print_r( $response, true );
// Get date with format 2010-11-25 @ 13:37:00
$date = date( 'Y-m-d @ H:i:s' );
// Message to log:
$log = <<<LOG
$date: response received from $url
Response: $resp
--------------
LOG;
// Log message into flat file
error_log( $log, 3, dirname( __FILE__ ).'/http.log' );
// Don't forget to return the response!
return $response;
}
?>