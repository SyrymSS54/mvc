<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('session.gc_maxlifetime', 300);
ini_set('session.cookie_lifetime', 0);
session_set_cookie_params(0);

function debug_var($var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
};

session_start();

spl_autoload_register(function($class){
    $class_data = require 'application/config/config_class.php';
    // debug_var($class);
    // debug_var($class_data[$class]);
    // debug_var($class_data);
    require_once $class_data[$class];
});

$uri = $_SERVER['REQUEST_URI'];//router $uri
$config_router = require_once 'application/config/config_router.php';//router $config

$router = new router($uri,$config_router);
?>