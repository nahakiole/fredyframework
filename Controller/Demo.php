<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 21.03.14
 * Time: 22:48
 */

namespace Controller;


use Framework\Configuration;
use Framework\LanguageLoader;
use View\BootstrapHTMLGenerator;
use View\HTMLResponse;

class Demo extends Controller
{


    public function __construct($database,LanguageLoader $languageLoader)
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
        $features = [
            [
                'name' => 'Clean code',
                'icon' => 'fa-code'
            ],
            [
                'name' => 'Open source',
                'icon' => 'fa-github'
            ],
            [
                'name' => 'Blazing fast',
                'icon' => 'fa-bolt'
            ],
            [
                'name' => 'Made with coffee',
                'icon' => 'fa-coffee'
            ]

        ];


        $response->setTwigVariables(['features' => $features, 'offset' => Configuration::$OFFSETPATH, 'title' => 'Demo']);
        return $response;

    }

    /**
     * @param $request \Model\Entity\Request
     * @return \View\Response
     */
    function postAction($request)
    {
        $this->loadTemplate('demo.twig');

        return array('response' => ['success' => true]);
    }

    /**
     * @param $request \Model\Entity\Request
     * @return \View\Response
     */
    function subdomainAction($request)
    {
        $this->loadTemplate('subdomain.twig');
        return array('subdomain' => $request->matches['subdomain']);
    }
}