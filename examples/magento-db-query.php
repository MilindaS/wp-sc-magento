<?php
/*
Plugin Name: Magento
Plugin URI: http://stunningcodes.co.nf
Description: A plugin to create w<div idgets in WordPress
Version: 1.0
Author: Makas Rock
Author URI: http://stunningcodes.com
*/
require(ABSPATH.'wp-load.php');
?>
<pre>
<?php
$wpdb-> show_errors();

$tablename = $wpdb-> prefix . "hits";

$sql = "CREATE TABLE `$tablename` (
					`hit_id` int(11) NOT NULL AUTO_INCREMENT,
					`hit_ip` varchar(100) NOT NULL,
					`hit_date` datetime,
					`post_id` int(11) NOT NULL,
					PRIMARY KEY (`hit_id`)
);";
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
var_dump( dbDelta($sql) );
$wpdb-> print_error();
?>
</pre>