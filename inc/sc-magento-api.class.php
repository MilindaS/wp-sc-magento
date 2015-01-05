<?php


class SC_Api {

    static public function init(){
        SC_Api::display();
    }
    
    static public function getProduct(){
        //return 1;
        $rest_url = get_option('rest_url');
        $rest_username = get_option('rest_username');
        $rest_api_key = get_option('rest_api_key');


        $curl = curl_init($rest_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_response = curl_exec($curl);

        if ($curl_response === false) {
            $info = curl_getinfo($curl);
            curl_close($curl);
            die('error occured during curl exec. Additioanl info: ' . var_export($info));
        }

        curl_close($curl);
        $decoded = json_decode($curl_response,true);
        if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
            die('error occured: ' . $decoded->response->errormessage);
        }
        //echo 'response ok!';
        //var_export($decoded->response);
        $content = '<div class="sc-row">';
        foreach($decoded as $item){
            //$content.=$item['entity_id'];
            $content .= '<div class="sc-widget-panel">
                            <div id="sc-widget-container-1">    
                                <center>
                                    <div class="sc-row"><img src="'.$item["image_url"].'" alt="" id="sc-widget-img"></div>
                                    <span id="sc-widget-title">'.$item["name"].'</span>
                                    <div id="sc-widget-price">SLRs '.$item["final_price_with_tax"].'.00</div>
                                    <a id="sc-widget-button" href="">View Product</a>
                                </center>
                            </div>
                        </div>';
        }
        $content .= '</div>';
        //print_r($decoded);

        return $content;
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