<?php


class SC_Cron {

    public static function init(){
        self::displayCrons();   
    }

    static public function displayCrons(){
        $cron = _get_cron_array();
        $schedules = wp_get_schedules();
        $date_format = 'M j, Y @ G:i';
?>


    <script>
    jQuery(document).ready(function(){
        var html = '<div class="sc-row cron-panel">';
        html += '<h3>Add Cron</h3>';
        
        html += '<table class="widefat fixed">';
            html += '<form>';
            html += '<tr>';
                html += '<td>Shedule Name</td>';
                html += '<td>';
                    html += '<select name="" id="">';
                    html += '<option value="">Inert to Datab</option>';
                    html += '</select>';
                html += '</td>';
            html += '</tr>';            

            html += '<tr>';
                html += '<td>Shedule</td>';
                html += '<td>';
                    html += '<select name="" id="">';
                    html += '<option value="">Twise a day</option>';
                    html += '</select>';
                html += '</td>';
            html += '</tr>';

            html += '<tr>';
                html += '<td></td>';
                html += '<td><input type="submit" class="button action" id="applyCron">Apply</a></td>';
            html += '</tr>';
            html += '</form>';

        html += '</table>';

        
        html += '</div>';
        jQuery('a#login').colorbox({html:html,opacity:0.5,transition:'elastic',width:"50%", preloading:false});
    });
    </script>

    <div class="wrap" id="cron-gui">
        <h2>
            Cron Events Scheduled 
            <a id="login" class="add-new-h2">Add Cron</a>
        </h2>
        <table class="widefat fixed">
            <thead>
                <tr>
                    <th scope="col"> Next Run (GMT/UTC) </th>
                    <th scope="col"> Schedule </th>
                    <th scope="col"> Hook Name </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ( $cron as $timestamp => $cronhooks ) { ?>
                    <?php foreach ( (array) $cronhooks as
                        $hook => $events ) { ?>
                        <?php foreach ( (array) $events as $event ) { ?>
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
                                <td> <?php echo $hook; ?> </td>
                            </tr>
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