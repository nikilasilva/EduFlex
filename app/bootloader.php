<?php

spl_autoload_register(function($classname){
    $filename = "../app/models/".ucfirst($classname). ".php";
    if(file_exists($filename)){
        require $filename;    
    }
});

    // Load configurations
    require_once 'config/config.php';

    // Load libraries
    require_once '../app/libraries/Core.php';
    require_once '../app/libraries/Controller.php';
    require_once '../app/libraries/Database.php';
    require_once '../app/libraries/Model.php';

    

?>