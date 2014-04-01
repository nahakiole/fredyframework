<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/Configuration.php';

$configuration = new Configuration();
new \Fredy\Fredy($configuration);