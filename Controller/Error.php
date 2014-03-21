<?php

namespace Controller;


class Error extends Controller
{

    private $errorMessage = '';

    public function notFound()
    {
        $this->view = new \View\HTMLView('View/Templates/index.html');
        $this->view->setHeader('HTTP/1.0 404 Not Found');
        $this->view->template->setVariable(
            [
                'SITE_TITLE' => 'Da ging etwas daneben.',
                'SITE_DESC' => 'Diese Seite wurde nicht gefunden.'
            ]
        );
        return $this->view;
    }

    public function serverError()
    {
        $this->view = new \View\HTMLView('View/Templates/index.html');
        $this->view->setHeader('HTTP/1.0 500');
        $this->view->template->setVariable(
            [
                'SITE_TITLE' => 'Da ging etwas daneben.',
                'SITE_DESC' => 'Ein Fehler ist aufgetreten.<br/>'.$this->errorMessage
            ]
        );
        return $this->view;
    }

    /**
     * @param string $errorMessage
     */
    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }

    function indexAction()
    {
        // TODO: Implement indexAction() method.
    }
}
