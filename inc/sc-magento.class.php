<?php
/**
 * Defines the Magento class for admin pages.
 */
require_once('sc-magento-cron.class.php');
require_once('sc-magento-api.class.php');


class SC_Magento {

    public static function init(){
        add_action('admin_menu',array('SC_Magento','magento_setup_admin_menu'));
        add_action( 'init',array('SC_Magento','load_css'));
    }

    public function magento_setup_admin_menu(){
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
            array('SC_Magento','magento_api_settings')
        );
        add_submenu_page(
            'magento_slug',
            'Cron Settings',
            'Cron Settings',
            'manage_options',
            'magento_cron_slug',
            array('SC_Magento','magento_cron_settings')
        );
        add_submenu_page(
            'magento_slug',
            'About My Plugin',
            'About',
            'manage_options',
            'magento_about_slug',
            array('SC_Magento','magento_about')
        );
    }

    public function magento_api_settings(){
        SC_Api::init();
    }

    public function magento_cron_settings(){
        SC_Cron::init();
    }

    public function magento_about(){
?>
        <div class="wrap">
            <h2>About SC Magento</h2>
        </div>
<?php
    }


    public function load_css() {
        wp_enqueue_style( 'style',WP_SCMI_CSS_DIR.'style.css');
    }

}
?>