<?php
/*
Plugin Name: Magento
Plugin URI: http://stunningcodes.co.nf
Description: A plugin to create widgets in WordPress
Version: 1.0
Author: Makas Rock
Author URI: http://stunningcodes.com
*/


add_action('add_meta_boxes','boj_mbe_create');
	function boj_mbe_create() {
		add_meta_box( 'boj-meta','My Custom Meta Box','boj_mbe_function','post','normal','high');
	}
	function boj_mbe_function() {
		echo 'Welcome to my meta box! ';
	}
?>