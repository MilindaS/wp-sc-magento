<?php


class SC_Cron {

    public static function init(){
        self::displayCrons();   

        if(isset($_POST['cron_name']) && $_POST['cron_name']!=""){
        	self::addCron($_POST['cron_name'],$_POST['schedule']);
        }
        if(isset($_POST['hook_name_delete']) && $_POST['hook_name_delete']!=""){
        	self::removeCron($_POST['hook_name_delete']);
        }
    }
	static public function removeCron($cron){
		$timestamp = wp_next_scheduled($cron);
		wp_unschedule_event( $timestamp,$cron);		
		
	}
	static public function addCron($cron,$schedule){
		
		add_action($cron, 'boj_cron_email_reminder');
		
		if ( !wp_next_scheduled($cron) ) {
			//schedule the event to run hourly
			wp_schedule_event( time(), $schedule, $cron);
		}
	}
	
	function boj_cron_email_reminder() {
		//send scheduled email
		wp_mail( 'you@example.com', 'Elm St. Reminde','Dont fall asleep!' );
	}
	
    static public function displayCrons(){
        $cron = _get_cron_array();
        $schedules = wp_get_schedules();
        $date_format = 'M j, Y @ G:i';
?>


    <script>
    jQuery(document).ready(function(){

    	function hi(){
        	alert(1);};
        
        var html = '<div class="cron-panel">';
        
        
		html += '<div class="sc-row">';
		html += '<div class="col-md-10"><span id="sc-cb-title">Add Cron</span></div>';
		html += '<div class="col-md-2"><a id="sc-closeBtn" onClick="parent.jQuery.fn.colorbox.close();">X</a></div>';
		html += '</div>';
        html +=			'<div class="sc-row">';
        html +=    			'<form action="<?php echo "http://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI];?>" method="post" >';
        html +=	'<div class="sc-row">';
        html +=		'<div class="col-md-3">Cron Name</div>';
        html +=		'<div class="col-md-9">';
        html +=			'<input type="text" style="width:250px;" name="cron_name" />';
        html +=		'</div>';
        html +='</div>';            
        
        html +=	'<div class="sc-row">';
        html +=		   		'<div class="col-md-3">Shedule</div>';
        html +=            '<div class="col-md-9">';
        html +=	            '<select name="schedule">';
        html +=	            	'<option value="hourly">Hourly</option>';
        html +=	            	'<option value="Twice Daily">Twise a day</option>';
        html +=	            	'<option value="Once Daily">Daily</option>';
        html +=	            	'<option value="">Weekly</option>';
        html +=	            	'<option value="">Monthly</option>';
        html +=	            	'<option value="">Yearly</option>';
        html +=	            '</select>';
        html +=            '</div>';
        html += '</div>';
        
        html +=	'<div class="sc-row">';
        html +=         '<div class="col-md-offset-3 col-md-9"><input type="submit" class="button-secondary" value="Submit"/></div>';
        html +=     '</div>';
        html +='</form>';
        html +='</div>';
        html += '</div>';
        
        

        jQuery(document).on('click','#addCron',function(){
        	jQuery.colorbox({
            	html:html,
            	opacity:0.5,
            	transition:'elastic',
            	width:"50%",
            	height:"60%",
            	preloading:false,
            	close:''});
        });

        
    });
    </script>

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
                            <form action="<?php echo "http://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI];?>" method="POST">
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
                            	</form>
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