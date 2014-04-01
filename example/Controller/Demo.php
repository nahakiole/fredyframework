<?php

namespace Fredy\Controller;


use  Fredy\Configuration;
use  Fredy\LanguageLoader;
use  Fredy\View\HTMLResponse;

class Demo extends Controller
{


    public function __construct($database, LanguageLoader $languageLoader)
    {
        $this->database = $database;
        $this->languageLoader = $languageLoader;
    }


    /**
     * @param $request \Model\Entity\Request
     * @return \View\Response
     */
    function indexAction($request)
    {
        $response = new HTMLResponse('demo.twig');
        $languageContainer = $this->languageLoader->loadLanguageFile('demo');
        //echo $languageContainer->getString('password_too_short');
        //echo $languageContainer->getStringWithAttributes('integer_min_max',[ 10, 11]);

        $response->setTwigVariables(
            [
                'offset' => Configuration::$OFFSETPATH,
                'title' => 'Demo',
                'navigation' => [
                    [
                        'text' => 'Home',
                        'url' => '/',

                        'active' => 'active',
                        'active_class' => 'active'
                    ],
                    [
                        'text' => 'Journal',
                        'url' => '/journal',
                        'active_class' => 'active',
                        'children' => [
                            [
                                'text' => 'Home',
                                'url' => '/journal',
                                'active_class' => 'active'
                            ],
                        ]
                    ]
                ]
            ]

        );
        return $response;

    }


    /**
     * @param $request \Model\Entity\Request
     * @return \View\Response
     */
    function subdomainAction($request)
    {
        $response = new HTMLResponse('subdomain.twig');
        $response->setTwigVariables(['subdomain' => $request->matches['subdomain']]);
        return $response;
    }
}