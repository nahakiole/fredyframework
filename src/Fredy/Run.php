<?php
if (MODE == 'dev'){
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
}
elseif (MODE == 'prod'){
    ini_set('display_errors', 'Off');
    error_reporting(0);
}
$configuration = require_once ROOTPATH . "/Configuration.php";
$services = require_once ROOTPATH . '/Services.php';
$autoloader = new \Fredy\FredyAutoloader();
return new Pimple(array_merge($services, $configuration));