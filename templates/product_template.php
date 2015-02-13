<div style="width:100%;background:#efefef;float:left;height:auto;padding:5px 10px;">
	
	<?php
	foreach($products as $product){
		?>
		<div style="max-width:150px;height:auto;padding:4px;float:left;">
			<div style="width:100%;"><img src="<?php echo $product->wp_sc_product_image;?>" width="100%" alt=""></div>
			<div style="width:100%;font-size:11px;"><?php echo $product->wp_sc_product_name;?></div>
			<div style="width:100%;background:#ddddff;text-align:center;border-radius:4px;">Rs. <?php echo $product->wp_sc_product_price;?></div>
			<a style="cursor:pointer;padding:5px 20px;background:#ddddff;text-align:center;border-radius:4px;">View</a>
		</div>
		<?php
		//print_r($product->wp_sc_product_name);
	}

	


	/*
	Hi stdClass Object ( 
	[wp_sc_auto_id] => 3 
	[wp_sc_product_category] => 7 
	[wp_sc_product_id] => 5608 
	[wp_sc_product_name] => Apple + Pear + Cinnamon (+ Nothing Else) 120g 
	[wp_sc_product_price] => 495 
	[wp_sc_product_image] => http://d212d91fo3cklt.cloudfront.net/media/catalog/product/cache/0/image/c8421450ca620efd04b91bf8fe80f763/s/m/smooth_4_applepearcinnamon120g_0_1.jpg 
	[wp_sc_timestamp] => 2015-02-13 03:38:34 
	*/
	?>
</div>