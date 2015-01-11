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

class SC_Init{

    public static function init(){
        add_action('init', array(__CLASS__, 'sc_path_conf'));
        add_action('admin_init', array(__CLASS__, 'sc_settings_register'));
        add_action('admin_menu', array(__CLASS__, 'sc_magento_setup_admin_menu'));
        add_action('widgets_init', array(__CLASS__, 'sc_magento_widgets'));        
    }

    public function sc_path_conf(){
        $plugin_dir = trailingslashit( dirname( __FILE__ ) );
        $plugin_url = plugin_dir_url( __FILE__ );

        define( WP_SCMI_JS_DIR, $plugin_url . 'js/' );
        define( WP_SCMI_CSS_DIR, $plugin_url . 'css/' );
        define( WP_SCMI_IMG_DIR, $plugin_url . 'img/' );
        define( WP_SCMI_INC_DIR, $plugin_dir . 'inc/' );
        
        define( WP_SCMI_ASS_URI, $plugin_url . 'assets/' );


        wp_enqueue_style( 'main_style',WP_SCMI_CSS_DIR.'style.css');
        wp_enqueue_style( 'colorbox_css',WP_SCMI_ASS_URI.'colorbox/colorbox.css');
        wp_register_script( 'main_js', WP_SCMI_JS_DIR. 'main.js', array( 'jquery' ));
        wp_enqueue_script( 'main_js' );
        wp_register_script( 'colorbox_js', WP_SCMI_ASS_URI. 'colorbox/jquery.colorbox-min.js', array( 'jquery' ));
        wp_enqueue_script( 'colorbox_js' );
        
        
    }
    
    public function sc_settings_register(){
        register_setting('sc_magento', 'rest_url');
        register_setting('sc_magento', 'rest_username');
        register_setting('sc_magento', 'rest_api_key');   
             
        register_setting('sc_magento_cron', 'sc_cron_status');
        register_setting('sc_magento_cron', 'sc_cron_hook_name');
        register_setting('sc_magento_cron', 'sc_cron_schedule');
        
        require_once(dirname( __FILE__ ).'/inc/sc-magento-db.class.php');
        SC_DB::init();
        
        require_once(dirname( __FILE__ ).'/inc/sc-magento-cron.class.php');
        SC_Cron::init();
        
        
    }

    public function sc_magento_setup_admin_menu(){
        add_menu_page(
            'Magento Settings',
            'Magento',
            'manage_options',
            'magento_slug',
            '',
            "dashicons-cart",
            null
        );
        add_submenu_page(
            'magento_slug',
            'API Settings',
            'API Settings',
            'manage_options',
            'magento_slug',
            array(__CLASS__,'magento_settings')
        );
        add_submenu_page(
            'magento_slug',
            'Cron Settings',
            'Cron Settings',
            'manage_options',
            'magento_cron_slug',
            array(__CLASS__,'magento_cron_settings')
        );
        add_submenu_page(
            'magento_slug',
            'About My Plugin',
            'About',
            'manage_options',
            'magento_about_slug',
            array(__CLASS__,'magento_about')
        );
    }

    public function sc_magento_widgets(){
    	require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR.'inc/'.'sc-magento-widget.class.php');
        register_widget('SC_Products_Widget');
    }

    public function magento_settings(){
    	require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR.'sc-magento-settings.php');    
    }

    public function magento_cron_settings(){
        require_once(WP_SCMI_INC_DIR.'sc-magento-cron.class.php');
        SC_Cron::displayCrons();
    }
    public function magento_about(){
    ?>
            <div class="wrap">
                <h2>About SC Magento</h2>
                
            </div>
    <?php
    }

}
SC_Init::init();
?>