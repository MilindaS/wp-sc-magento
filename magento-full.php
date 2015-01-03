<?php
/*
Plugin Name: Magento Full
Plugin URI: http://stunningcodes.co.nf
Description: A plugin to create w<div idgets in WordPress
Version: 1.0
Author: Makas Rock
Author URI: http://stunningcodes.com
*/

add_action('admin_menu','magento_admin_menu');

function magento_admin_menu(){
	add_menu_page(
		$page_title = 'Magento Settings',
		$menu_title = 'Magento',
		$capability = 'manage_options',
		$menu_slug = __FILE__,
		$function = 'magento_settings',
		$icon_url = "dashicons-cart",
		$position = null
		);
}



function magento_settings(){
?>
<div class="wrap">
	<h2><span class="dashicons dashicons-cart" style="font-size:28px;margin-right:16px;"></span>Magento Integration</h2>
	<h3>API Settings</h3>

	<form method="POST" action="">
		<table class="form-table">

		<tr valign="top">
			<th scope="row"> <label for="fname"> First Name </label> </th>
			<td> <input maxlength="45" size="25" name="fname" /> </td>
			</tr>
		<tr valign="top">
			<td></td>
			<td>
				<input type="submit" name="save" value="Save Options" class="button-primary" />				
			</td>
		</tr>
		</table>
	</form>
	
</div>
<?php
}

?>