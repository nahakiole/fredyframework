<?php
/** @var $container Pimple */

$container['mysqli'] = function($c){
    return new mysqli($c['db.host']);
};

$container['demo'] = function(){
    return new \Controller\Demo();
};

$container['error'] = function(){
    return new \Controller\Error();
};

