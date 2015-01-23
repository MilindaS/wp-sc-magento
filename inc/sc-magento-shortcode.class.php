<?php
class SC_Shortcode{
    public static function init($attr){
        switch($attr['mage']){
            case '':
                $title = "This is a link";
                $href = "http://www.google.com";
                break;
        }
    }
}
?>



<!-- switch($attr['mage']){
        case '1':
            $title = "This is first title";
            $href = "http://www.google.com";
            break;
        case '2':
            $title = "This is second title";
            $href = "http://www.amazon.com";
            break;  
        default:
            $title = "This is default title";
            $href = "http://www.yahoo.com";
            break;  
    }

    return "<a href='$href'>$title</a>"; -->