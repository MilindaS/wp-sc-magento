<?php


class SC_Api {

    static public function init(){
        SC_Api::display();
    }

    static public function display(){
        ?>
        <div class="wrap">
            <div class="sc-row">
                <h2>Magento API Settings</h2>
            </div>
            <div class="sc-row">
                <div class="sc-container" id="container-1">
                    <form method="post" action="options.php">
                    <?php settings_fields('sc_magento'); ?>
                        <table class="form-table api-form" >
                            <tr class="form-field form-required">
                                <th scope="row"><label for="rest_url">Rest URL <span class="description">(required)</span></label></th>
                                <td><input name="rest_url" id="rest_url" value="<?php echo get_option('rest_url'); ?>" type="text"></td>
                            </tr>
                            <tr class="form-field">
                                <th scope="row"><label for="rest_username">Username</label></th>
                                <td><input name="rest_username" id="rest_username" value="<?php echo get_option('rest_username'); ?>" type="text"></td>
                            </tr>
                            <tr class="form-field">
                                <th scope="row"><label for="rest_api_key">Api Key</label></th>
                                <td><input name="rest_api_key" id="rest_api_key" value="<?php echo get_option('rest_api_key'); ?>" type="password"></td>
                            </tr>
                            <tr class="form-field">
                                <th></th>
                                <td>
                                    <?php submit_button(); ?>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>

                <div class="sc-container" id="container-2">
                    <h3 class="hndle"><span>Guide</span></h3>
                </div>
            </div>
        </div>
<?php
    }

}
?>