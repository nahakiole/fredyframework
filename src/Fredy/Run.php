<?php
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();
$configuration = require_once ROOTPATH . "/Configuration.php";
$services = require_once ROOTPATH . '/Services.php';
new \Fredy\FredyAutoloader();
new \Fredy\Fredy(new Pimple(array_merge($services, $configuration)));