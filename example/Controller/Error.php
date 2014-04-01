<?php

namespace Controller;


use  Fredy\View\HTMLResponse;
use  Fredy\View\HTMLView;

class Error extends Controller
{

    private $errorMessage = '';

    /**
     * @param $request \Model\Entity\Request
     * @return null
     */
    public function notFound($request)
    {
        $response = new HTMLResponse('error.twig');

        $response->setTwigVariables([
            'title' => 'Diese Seite wurde nicht gefunden.',
            'message' => 'Die Seite unter <a href="' . $request->SERVER['REQUEST_URI'] . '"> ' . $request->SERVER['REQUEST_URI'] . '</a> wurde nicht gefunden. Möchtest du zurück auf die <a href="/">Startseite</a>?'
        ]);

        $response->addHeaderField('HTTP/1.0', ' 404 Not Found');

        return $response;
    }

    /**
     * @param $request \Model\Entity\Request
     * @return null
     */
    public function serverError($request)
    {
        $response = new HTMLResponse('error.twig');

        $response->setTwigVariables([
            'title' => !empty($this->errorMessage) ? $this->errorMessage : 'Internal Server Error',
            'message' => 'Da ging etwas daneben'
        ]);

        $response->addHeaderField('HTTP/1.0', ' 500 Internal Server Error');

        return $response;
    }

    /**
     * @param $request \Model\Entity\Request
     * @return null
     */
    public function noAccess($request)
    {
        $response = new HTMLResponse('error.twig');

        $response->setTwigVariables([
            'title' => !empty($this->errorMessage) ? $this->errorMessage : 'No access to this file.',
            'message' => 'You have no access to this file.'
        ]);

        $response->addHeaderField('HTTP/1.0', '403 Forbidden');

        return $response;
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
