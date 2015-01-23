<?php 
class SC_DB{
	public static function init(){
		require(ABSPATH.'wp-load.php');
		global $wpdb;
		
		
		$tablename = $wpdb-> prefix . "magento_products";
		
		
		$sql = "CREATE TABLE IF NOT EXISTS `$tablename` (
					`wp_sc_auto_id` int(11) NOT NULL AUTO_INCREMENT,
					`wp_sc_product_id` varchar(100) NOT NULL,
					`wp_sc_product_name` varchar(100) NOT NULL,
					`wp_sc_product_price` varchar(100) NOT NULL,
					`wp_sc_product_image` varchar(100) NOT NULL,
					`wp_sc_timestamp` DATETIME,		
					PRIMARY KEY (`wp_sc_auto_id`)
				);";
		$wpdb->query($sql);
		
		$wpdb-> show_errors();
		
// 		$newdata = array(
// 				'hit_ip' => '127.0.0.1',
// 				'hit_date' => current_time( 'mysql' ),
// 				'post_id' => '123'
// 		);
// 		
// 		$wpdb-> show_errors();
		//print_r($products);
	}
	
	static public function insertDb($data){
		require(ABSPATH.'wp-load.php');
		global $wpdb;
		$table = $wpdb-> prefix . "magento_products";	
		
		$fields = array_keys($data);
		$formatted_fields = array();
		foreach ( $fields as $field ) {
			$form = '%s';
			$formatted_fields[] = $form;
		}
		$sql = "INSERT INTO `$table` (`" . implode( '`,`', $fields ) . "`) VALUES ('" . implode( "','", $formatted_fields ) . "')";
		$sql .= " ON DUPLICATE KEY UPDATE ";
			
		$dup = array();
		foreach($fields as $field) {
			$dup[] = "`" . $field . "` = VALUES(`" . $field . "`)";
		}
			
		$sql .= implode(',', $dup);
		
		$wpdb->query( $wpdb->prepare( $sql, $data) );
		//$wpdb-> insert($tablename,$newdata);
	}
	
	
}
?>