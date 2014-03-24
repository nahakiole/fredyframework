<?php

namespace Controller;


use View\HTMLView;

class Error extends Controller
{

    private $errorMessage = '';

    public function notFound()
    {
        $this->view = new HTMLView('View/Templates/index.html');
        $this->view->setHeader('HTTP/1.0 404 Not Found');
        $this->view->template->setVariable(
            [
                'SITE_TITLE' => 'Diese Seite wurde nicht gefunden.',
                'CONTENT' => 'Diese Seite wurde leider nicht gefunden. Möchtest du zurück auf die <a href="/">Startseite</a>?'
            ]
        );
        return $this->view;
    }

    public function serverError()
    {
        $this->view = new HTMLView('View/Templates/index.html');
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

    function indexAction($matches)
    {
        // TODO: Implement indexAction() method.
    }
}
