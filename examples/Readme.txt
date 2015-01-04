add_menu_page(
		$page_title = 'Magento Settings',
		$menu_title = 'Magento',
		$capability = 'manage_options',
		$menu_slug = 'magento_slug',
		$function = '',
		$icon_url = "dashicons-cart",
		$position = null
		);
	add_submenu_page(
		$parent_slug = 'magento_menu_slug',
		$page_title = 'About My Plugin',
		$menu_title = 'API Settings',
		$capability = 'manage_options',
		$menu_slug = 'magento_slug',
		$function = 'magento_api');




		jquery
		add_action( 'wp_enqueue_script', 'load_jquery' );
function load_jquery() {
    wp_enqueue_script( 'jquery' );
}


<script>
    jQuery(document).ready(function($) {
    // Code here will be executed on document ready. Use $ as normal.
    alert(1);
});
</script>