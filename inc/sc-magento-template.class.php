<?php
class SC_Template{
	static public function init(){
		echo 1;
	}
	static public function set_product_template($products){
		require_once(dirname(__FILE__) .'/../templates/product_template.php');
	}
}
?>