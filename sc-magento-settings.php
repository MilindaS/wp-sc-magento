<div class="wrap">
            <div class="sc-row">
                <h2>Magento Settings</h2>
            </div>
            <div class="sc-row">
                <div class="sc-container" id="container-1">
                <div class="sc-row">
                	<div class="col-md-12">
                		<h3>API Settings</h3>
                	</div>
                </div>
                    <form method="post" action="options.php">
                    <?php settings_fields('sc_magento'); ?>
                        <table class="form-table api-form" >
                            <tr class="form-field form-required">
                                <td scope="row"><label for="rest_url">Rest URL <span class="description">(required)</span></label></td>
                                <td><input name="rest_url" id="rest_url" value="<?php echo get_option('rest_url'); ?>" type="text"></td>
                            </tr>
                            <tr class="form-field">
                                <td scope="row"><label for="rest_username">Username</label></td>
                                <td><input name="rest_username" id="rest_username" value="<?php echo get_option('rest_username'); ?>" type="text"></td>
                            </tr>
                            <tr class="form-field">
                                <td scope="row"><label for="rest_api_key">Api Key</label></td>
                                <td><input name="rest_api_key" id="rest_api_key" value="<?php echo get_option('rest_api_key'); ?>" type="password"></td>
                            </tr>
                            <tr class="form-field">
                                <td></td>
                                <td>
                                    <?php submit_button(); ?>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>

                <div class="sc-container" id="container-2">
                <form action="options.php" method="post">
                 <?php settings_fields('sc_magento_cron'); ?>
                    <div class="row">
                    	<div class="col-md-12">
                    		<h3 class="hndle"><span>Cron Settings</span></h3>	
                    	</div>
                    </div>
                    <table class="form-table" >
                    	<tr class="form-field">
                            <td scope="row" ><label for="">Status</label></td>
                            <td>:</td>
                            <td width="70%">
                            	<input id="sc-checkb-r" type="checkbox" name="cron_status" <?php if(get_option('cron_status')=='on'){echo 'checked';}?> >
                            	<span id="sc-checkb" class="bg-inactive">
                            		<span id="sc-check"></span>
                            	</span>
                            	<span id="sc-check-status">inactive</span> 
                            </td>
                        </tr>
                        <tr class="form-field">
                            <td scope="row" ><label for="">Hook</label></td>
                            <td>:</td>
                            <td width="70%">
                            	<input type="hidden" name="cron_hook_name" value="sc_magento_hook" />
                            	sc_magento_hook
                            </td>
                        </tr>
                        <tr class="form-field">
                            <td scope="row" ><label for="" style="position:relative;top:8px">Schedule</label></td>
                            <td>:</td>
                            <td width="70%">
                            	<select name="cron_schedule">
				                   	<option <?php if(get_option('cron_schedule')=='hourly'){echo 'selected="selected"';}?> value="hourly" >Hourly</option>
				                   	<option <?php if(get_option('cron_schedule')=='twicedaily'){echo 'selected="selected"';}?> value="twicedaily" >Twice a Day</option>
				                   	<option <?php if(get_option('cron_schedule')=='daily'){echo 'selected="selected"';}?> value="daily">Daily</option>				                   				                   	
                   				</select>
                            </td>
                        </tr>
                        <tr class="form-field">
                            <td scope="row" ><label for="" >Description</label></td>
                            <td>:</td>
                            <td width="70%">
                            	<div id="sc-cron-desc">This cron will gets the magento content and saves database </div>
                            </td>
                        </tr>
                        <tr class="form-field">
                            <td></td>
                            <td></td>
                            <td width="70%">
                            	<?php submit_button('Update','submit','cron_update'); ?>
                            </td>
                        </tr>
                    </table>
                   </form>
                </div>
            </div>
        </div>