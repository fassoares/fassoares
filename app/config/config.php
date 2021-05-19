<?php
    define('BASE', '/sisfgts/');
    define('UNSET_URI_COUNT',1);
    define('DEBUG_URI', false);


    
spl_autoload_register(
    function($class_name){
    $filename= "model\\".$class_name.".php";
    if(file_exists(($filename))){
        require_once($filename);
    }else{
        $filename="Classes".DIRECTORY_SEPARATOR.$class_name.".php"; 
        if (file_exists(($filename))){
            require_once($filename);
        }
    }
});
?>