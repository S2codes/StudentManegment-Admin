<?php
    define('api_Key', 'ss123');
    function authentication ($key) 
    {
        if ($key == api_Key) {
            return true;
        }else{
            return false;
        }
    }
?>