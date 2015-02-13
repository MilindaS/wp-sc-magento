<?php 
class SC_DB{

	
	public function __construct(){
		require(ABSPATH.'wp-load.php');
		
	}

	public static function createDb(){
		global $wpdb;
		$tablename = $wpdb-> prefix . "magento_products";
		
		$sql = "CREATE TABLE IF NOT EXISTS `$tablename` (
					`wp_sc_auto_id` int(11) NOT NULL AUTO_INCREMENT,
					`wp_sc_product_category` varchar(100) NOT NULL,
					`wp_sc_product_id` varchar(100) NOT NULL UNIQUE,
					`wp_sc_product_name` varchar(100) NOT NULL,
					`wp_sc_product_price` varchar(100) NOT NULL,
					`wp_sc_product_image` varchar(255) NOT NULL,
					`wp_sc_product_url` varchar(255) NOT NULL,
					`wp_sc_timestamp` DATETIME,		
					PRIMARY KEY (`wp_sc_auto_id`)
				);";
		$wpdb->query($sql);
		
		$wpdb-> show_errors();
	}
	
	static public function insertDb($data){
		global $wpdb;
		$table = $wpdb-> prefix . "magento_products";	
		
		$fields = array_keys($data);
		$formatted_fields = array();
		foreach ( $fields as $field ) {
			$form = '%s';
			$formatted_fields[] = $form;
		}
		$sql = "INSERT INTO `$table` (`" . implode( '`,`', $fields ) . "`) VALUES ('" . implode( "','", $formatted_fields ) . "') ON DUPLICATE KEY UPDATE";
		
			
		$dup = array();
		foreach($fields as $field) {
			$dup[] = "`" . $field . "` = VALUES(`" . $field . "`)";
		}
			
		$sql .= implode(',', $dup);
		
		$wpdb->query( $wpdb->prepare( $sql, $data) );
		//$wpdb-> insert($tablename,$newdata);
	}

	static public function getDataDb($category=null,$items=null){
		global $wpdb;
		
		if($category && $items){
			$category = mysql_real_escape_string($category);
			$items = mysql_real_escape_string($items);
			
			$sql = "SELECT * FROM wp_magento_products WHERE wp_sc_product_category ='$category' ORDER BY wp_sc_timestamp LIMIT 0, $items";
			
			$data = array($category,$items);

			return $wpdb->get_results($sql);
		}
		
		
	}
	
	
}
?>