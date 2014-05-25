<?php

$configuration = require_once ROOTPATH . "/Configuration.php";
$services = require_once ROOTPATH . '/Services.php';
$autoloader = new \Fredy\FredyAutoloader();
return new Pimple(array_merge($services, $configuration));