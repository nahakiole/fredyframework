<?php

session_start();
require_once __DIR__ . '/vendor/autoload.php';

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();
require_once 'Services.php';
new \Fredy\FredyAutoloader();
$configuration = new \Fredy\Configuration('Configuration.php');

new \Fredy\Fredy($configuration, new Pimple(array_merge($services,$configuration->config) ));