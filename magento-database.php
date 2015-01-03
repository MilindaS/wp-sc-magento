<?php
/*
Plugin Name: Magento Database
Plugin URI: http://stunningcodes.co.nf
Description: A plugin to create w<div idgets in WordPress
Version: 1.0
Author: Makas Rock
Author URI: http://stunningcodes.com
*/

$tablename = $wpdb-> prefix . "hits";
// Insert a record
$newdata = array(
'hit_ip' => '127.0.0.1',
'hit_date' => current_time( 'mysql' ),
'post_id' => '123'
);
$wpdb-> insert($tablename,$newdata);
// Update a record
$newdata = array( 'post_id' => '456' );
$where = array( 'post_id' => '123', 'hit_id' => 1 );
$wpdb-> update( $tablename, $newdata, $where );
?>