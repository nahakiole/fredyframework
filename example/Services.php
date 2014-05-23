<?php
$services['PDO'] = function ($c) {
    return new \PDO(
        'mysql:host=' . $c['db.host'] . ';dbname=' . $c['db.dbname'] . ';'
        , $c['db.user']
        , $c['db.password']);
};

$services['em'] = function ($c) {
    return new \Fredy\Model\Repository\EntityManager($c['PDO']);
};

$services['demo'] = function ($c) {
    return new \Controller\Demo($c['em'], $c['languageLoader']);
};

$services['error'] = function () {
    return new \Controller\Error();
};

$services['journal'] = function ($c) {
    return new \Controller\JournalController($c['PDO'], $c['languageLoader']);
};

$services['test'] = function ($c) {
    return new \Controller\Test();
};

$services['oliver'] = function ($c) {
    return new \Controller\Oliver();
};

$services['languageLoader'] = function ($c) {
    return new \Fredy\LanguageLoader($c['language.default'], $c['language.array'], $c['language.directory'], isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : 'de');
};