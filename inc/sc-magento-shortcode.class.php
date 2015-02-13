<?php
class SC_Shortcode{
    public static function init($attr){
        $categories = SC_Utility::$_categories;
        
        if(in_array($attr['cat'], $categories)){

            if(isset($attr['items']) && !is_null($attr['items'])){

                $products = (SC_DB::getDataDb(array_search($attr['cat'],$categories),$attr['items']));
                
                SC_Template::set_product_template($products);
                    // echo '<img src="'.$product->wp_sc_product_image.'" width="200px;" alt="">';
                    // echo $product->wp_sc_product_name;
                    // echo '<br>';
                

            }
        }

    }
}
?>