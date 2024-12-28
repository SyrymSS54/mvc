<?php
class view{
    function __construct()
    {
        
    }

    function view($title,$main,$main_set,$template,$data = ''){
        //title - page name
        //main - body tag
        //main_set - template body or generation body
        //template - html template
        if($main_set){
            ob_start();
            require_once $main;
            $body = ob_get_clean();
        } else {
            $body = $main;
        }
        ob_start();
        require_once $template;
        ob_end_flush();
    }
}
?>