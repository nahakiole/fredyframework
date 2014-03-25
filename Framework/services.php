<?php
/** @var $container Pimple */

$container['PDO'] = function($c){
    return new PDO(
        'mysql:host='.$c['db.host'].';dbname='.$c['db.dbname'].';'
        ,$c['db.user']
        ,$c['db.password']);
};

$container['demo'] = function(){
    return new \Controller\Demo();
};

$container['error'] = function(){
    return new \Controller\Error();
};

$container['journal'] = function($c){
    return new \Controller\JournalController($c['PDO']);
};

