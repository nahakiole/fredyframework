<?php

namespace Controller;


use  Fredy\Configuration;
use Fredy\Controller\Controller;
use  Fredy\LanguageLoader;
use  Fredy\View\HTMLResponse;
use View\FrontendResponse;

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
        $response = new FrontendResponse('demo.twig', $request);
        $journalRepository = $this->em->getRepository("Journal");
        $journalEntities =  $journalRepository->findAll(6);
        $response->setTwigVariables(
            [
                'title' => 'Demo',
                'journal' => $journalEntities
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