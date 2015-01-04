<?php
/*
Plugin Name: 	SC Magento Integration
Plugin URI: 	http://stunningcodes.co.nf
Description: 	Display magento product content in WordPress
Version: 		1.0.0
Author: 		Makas Rock
Author URI: 	http://stunningcodes.com

Copyright 2014  StunningCodes  (email : rockmakas@gmail.com)
Author - Makas (StunningCodes)
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

add_action('plugins_loaded','wp_sc_magento_init');


function wp_sc_magento_init(){

    $plugin_dir = trailingslashit( dirname( __FILE__ ) );
    $plugin_url = plugin_dir_url( __FILE__ );

    define( 'WP_SCMI_JS_DIR', $plugin_url . 'js/' );
    define( 'WP_SCMI_CSS_DIR', $plugin_url . 'css/' );
    define( 'WP_SCMI_IMG_DIR', $plugin_url . 'img/' );
    define( 'WP_SCMI_INC_DIR', $plugin_dir . 'inc/' );

    require_once( WP_SCMI_INC_DIR . 'sc-magento.class.php');
    SC_Magento::init();
}
?>