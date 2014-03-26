<?php

namespace Controller;


use View\HTMLView;

class Error extends Controller
{

    private $errorMessage = '';

    /**
     * @param $request \Model\Entity\Request
     * @return null
     */
    public function notFound($request)
    {
        $this->view = new HTMLView('View/Templates/index.twig');
        $this->view->setHeader('HTTP/1.0 404 Not Found');

        $this->view->template->setVariable(
            [
                'SITE_TITLE' => 'Die Seite unter '.$request->SERVER['REQUEST_URI'].' wurde nicht gefunden.',
                'CONTENT' => 'Die Seite unter '.$request->SERVER['REQUEST_URI'].' wurde nicht gefunden. Möchtest du zurück auf die <a href="/">Startseite</a>?'
            ]
        );
        return $this->view;
    }

    /**
     * @param $request \Model\Entity\Request
     * @return null
     */
    public function serverError($request)
    {
        $this->view = new HTMLView('View/Templates/index.twig');
        $this->view->setHeader('HTTP/1.0 500');
        $this->view->template->setVariable(
            [
                'SITE_TITLE' => 'Da ging etwas daneben.'
            ]
        );
    }

    /**
     * @param string $errorMessage
     */
    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }

    /**
     * @param $request \Model\Entity\Request
     * @return null
     */
    function indexAction($request)
    {
        // TODO: Implement indexAction() method.
    }
}
