<?php

//made by Kervin Zoren Bonaobra 

spl_autoload_register('myAutoLoaderModel');
spl_autoload_register('myAutoLoaderController');
spl_autoload_register('myAutoLoaderInclude');

function myAutoLoaderModel($className){
    $path = "../../app/models/";
    $extension = ".php";
    $fullPath = $path . $className . $extension;


    if(!file_exists($fullPath)){
        return false;
    }
    include_once $fullPath;
}

function myAutoLoaderController($className){
    $path = "../../app/controllers/";
    $extension = ".php";
    $fullPath = $path . $className . $extension;


    if(!file_exists($fullPath)){
        return false;
    }
    include_once $fullPath;
}

function myAutoLoaderInclude($className){
    $path = "../../app/includes/";
    $extension = ".inc.php";

    $fullPath = $path . $className . $extension;

    if(!file_exists($fullPath)){
        return false;
    }
    include_once $fullPath;
}