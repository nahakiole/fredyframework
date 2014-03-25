<?php
/** @var $container Pimple
 * @return \PDO
 */

$container['PDO'] = function($c){
    return new PDO($c['db.host']);
};

$container['demo'] = function(){
    return new \Controller\Demo();
};

$container['error'] = function(){
    return new \Controller\Error();
};

