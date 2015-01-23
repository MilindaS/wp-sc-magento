<?php


class SC_Cron {

    public static function init(){
    	
    	self::sc_cron_db_add();
    	
    	
    	
    	if(get_option('sc_cron_status')=='on'){
        	$hook =	get_option('sc_cron_hook_name');
        	$schedule = get_option('sc_cron_schedule');
        	self::addCron($hook,$schedule);
        }else{
        	$hook =	get_option('sc_cron_hook_name');
        	self::removeCron($hook);
        }        
        //self::removeCron('sc_magento_hook');
        
        
    }
       	
   	static public function removeCron($hook){
   		wp_clear_scheduled_hook($hook);		
	}
	
	static public function addCron($hook,$schedule){
		
		self::removeCron($hook);
		if ( !wp_next_scheduled($hook) ) {
			wp_schedule_event( time(), $schedule, $hook);
		}
		add_action($hook, array(__CLASS__,'sc_cron_db_add'));
	}
	
	static public function sc_cron_db_add() {
		// Save products to database
		$products = SC_Api::getProduct();
		//print_r($products);
		// foreach($products as $product){				
  //   		//print_r($products);
  //           $newdata = array(
  //   						'wp_sc_product_id' => $product['entity_id'],
  //   						'wp_sc_product_name' => $product['name'],
  //   						'wp_sc_product_price' => $product['final_price_with_tax'],
  //   						'wp_sc_product_image' => $product['image_url'],
  //   						'wp_sc_timestamp' => current_time( 'mysql' )
  //   				);
		// 	SC_DB::insertDb($newdata);
		// }
	}
	
    static public function displayCrons(){
        $cron = _get_cron_array();
        $schedules = wp_get_schedules();
        $date_format = 'M j, Y @ G:i';
?>

    <div class="wrap" id="cron-gui">
        <h2>
            SC Cron Events Scheduled 
            <a id="addCron" class="add-new-h2">Add Cron</a>
        </h2>
        <table class="widefat fixed">
            <thead>
                <tr>
                    <th scope="col"> Next Run (GMT/UTC) </th>
                    <th scope="col"> Schedule </th>
                    <th scope="col"> Hook Name </th>
                    <th scope="col"> Action </th>
                </tr>
            </thead>
            <tbody>
           
                <?php foreach ( $cron as $timestamp => $cronhooks ) { ?>
                    <?php foreach ( (array) $cronhooks as
                        $hook => $events ) { ?>
                        <?php foreach ( (array) $events as $event ) { 
                        	if(!strstr($hook,'wp_')){
                        	?>
                        	
                            <tr>
                            	
                                <td>
                                    <?php echo date_i18n( $date_format, wp_next_scheduled( $hook ) ); ?>
                                </td>
                                <td>
                                <?php 
                                    if ( $event[ 'schedule' ] ) {
                                        echo $schedules[
                                        $event[ 'schedule' ] ][ 'display' ];
                                    } else {
                                ?> One-time <?php
                                    }
                                ?>
                                </td>
                                
                                <td> <?php echo $hook; ?> <input type="hidden" value="<?php echo $hook; ?>" name="hook_name_delete" /> </td>                          
                                <td><input type="submit" id="delete_btn" value="Delete" /></td>
                            	
                            </tr>
                           
                        <?php } ?>
                    <?php } ?>
                  <?php } ?>
                <?php } ?>
            </tbody>
             
        </table>        
    </div>
<?php
    	
    }
	
}
?>