<?php
/*
Plugin Name: Magento Submenu
Plugin URI: http://stunningcodes.co.nf
Description: A plugin to create w<div idgets in WordPress
Version: 1.0
Author: Makas Rock
Author URI: http://stunningcodes.com
*/

add_action('admin_menu','magento_admin_menu');
echo __FILE__;
function magento_admin_menu(){
	add_menu_page(
		$page_title = 'Magento Settings',
		$menu_title = 'Magento',
		$capability = 'manage_options',
		$menu_slug = 'magento_menu_slug',
		$function = 'magento_settings',
		$icon_url = "dashicons-cart",
		$position = null
		);
	add_submenu_page(
		$parent_slug = 'magento_menu_slug',
		$page_title = 'About My Plugin',
		$menu_title = 'About',
		$capability = 'manage_options',
		$menu_slug = 'magento_menu_slug_about',
		$function = 'boj_menuexample_about_page');
}
?>