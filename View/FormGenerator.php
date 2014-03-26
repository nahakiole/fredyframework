<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 25.03.14
 * Time: 17:32
 */

namespace View;


class FormGenerator {

    private $entity;
    private $actionURL;
    private $actionJSONURL;
    private $method;
    private $javascriptCallback;

    function __construct($entity, $actionJSONURL, $actionURL,  $javascriptCallback, $method = 'POST')
    {
        $this->actionJSONURL = $actionJSONURL;
        $this->actionURL = $actionURL;
        $this->entity = $entity;
        $this->javascriptCallback = $javascriptCallback;
        $this->method = $method;
    }


    public function getHTMLForm(){

    }

}