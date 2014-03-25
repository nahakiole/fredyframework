<?php
session_start();
require_once __DIR__ . '/Framework/Configuration.php';
require_once __DIR__.'/Framework/vendor/autoload.php';
$configuration = new \Framework\Configuration();
require_once  __DIR__ . '/Framework/Autoloader.php';
new \Framework\Fredy($configuration);