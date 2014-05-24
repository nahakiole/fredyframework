<?php
return [
    'PDO'            => function ($c) {
            return new \Fredy\PDO(
                'mysql:host=' . $c['db.host'] . ';dbname=' . $c['db.dbname'] . ';'
                , $c['db.user']
                , $c['db.password']);
        },

    'em'             => function ($c) {
            return new \Fredy\Model\Repository\EntityManager($c['PDO']);
        },

    'demo'           => function ($c) {
            return new \Controller\Demo($c['em'], $c['languageLoader']);
        },

    'error'          => function () {
            return new \Controller\Error();
        },

    'journal'        => function ($c) {
            return new \Controller\JournalController($c['PDO'], $c['languageLoader']);
        },

    'languageLoader' => function ($c) {
            return new \Fredy\LanguageLoader($c['language.default'], $c['language.array'], $c['language.directory'], isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])
                ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : 'de');
    }
];