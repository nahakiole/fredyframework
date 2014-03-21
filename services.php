<?php
$container['mysqli'] = function($c){
    return new mysqli($c['db.host']);
};

$container['demo'] = function($c){
    return new \Controller\Demo();
};

$container['error'] = function($c){
    return new \Controller\Error();
};