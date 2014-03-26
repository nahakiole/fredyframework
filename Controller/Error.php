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
        $this->loadTemplate('error.twig');


        return [
            'title' => 'Die Seite unter ' . $request->SERVER['REQUEST_URI'] . ' wurde nicht gefunden.',
            'message' => 'Die Seite unter ' . $request->SERVER['REQUEST_URI'] . ' wurde nicht gefunden. Möchtest du zurück auf die <a href="/">Startseite</a>?'
        ];
    }

    /**
     * @param $request \Model\Entity\Request
     * @return null
     */
    public function serverError($request)
    {
        $this->loadTemplate('error.twig');

        return [
            'title' => $this->errorMessage,
            'message' => 'Da ging etwas daneben'
        ];
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
