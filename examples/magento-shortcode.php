<?php
/*
Plugin Name: Magento ShortCode
Plugin URI: http://stunningcodes.co.nf
Description: A plugin to create widgets in WordPress
Version: 1.0
Author: Makas Rock
Author URI: http://stunningcodes.com
*/
add_shortcode('magento','magento_shortcode_function');

function magento_shortcode_function($attr){
	switch($attr['magento']){
		case '1':
			$title = "This is first title";
			$href = "http://www.google.com";
			break;
		case '2':
			$title = "This is second title";
			$href = "http://www.amazon.com";
			break;	
		default:
			$title = "This is default title";
			$href = "http://www.yahoo.com";
			break;	
	}

	return "<a href='$href'>$title</a>";
}
?>