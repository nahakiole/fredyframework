<?php

namespace Controller;


use  Fredy\Configuration;
use Fredy\Controller\Controller;
use  Fredy\LanguageLoader;
use  Fredy\View\HTMLResponse;

class Demo extends Controller
{
    /**
     * @var \Fredy\Model\Repository\EntityManager
     */
    private $em;

    /**
     * @param $em \Fredy\Model\Repository\EntityManager
     */
    public function __construct($em)
    {
        $this->em = $em;
    }


    /**
     * @param $request \Model\Entity\Request
     * @return \Fredy\View\Response
     */
    function indexAction($request)
    {
        $response = new HTMLResponse('demo.twig');
        $journalRepository = $this->em->getRepository("Journal");
        $journalEntities =  $journalRepository->findAll(6);

        //echo $languageContainer->getString('password_too_short');
        //echo $languageContainer->getStringWithAttributes('integer_min_max',[ 10, 11]);

        $response->setTwigVariables(
            [
                'title' => 'Demo',
                'journal' => $journalEntities,
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
     * @return \Fredy\View\Response
     */
    function subdomainAction($request)
    {
        $response = new HTMLResponse('subdomain.twig');
        $response->setTwigVariables(['subdomain' => $request->matches['subdomain']]);
        return $response;
    }
}