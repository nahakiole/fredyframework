<?php
session_start();
require_once __DIR__ . '/Framework/Configuration.php';
require_once __DIR__ . '/Framework/vendor/autoload.php';
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();
$configuration = new \Framework\Configuration();
require_once __DIR__ . '/Framework/Autoloader.php';
new \Framework\Fredy($configuration);