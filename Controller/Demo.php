<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 21.03.14
 * Time: 22:48
 */

namespace Controller;


use Framework\Configuration;
use Model\Entity\DataType\Integer;
use Model\Entity\Journal;
use View\HTMLTemplate;
use View\HTMLView;
use View\Redirect;

class Demo extends Controller
{

    /**
     * @param $request \Model\Entity\Request
     * @return null
     */
    function indexAction($request)
    {

        $loader = new \Twig_Loader_Filesystem('View/Templates');
        $twig = new \Twig_Environment($loader);
        $this->view = $twig->loadTemplate('demo.twig');
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

        $journal = new Journal('Test', 5, 'Testdsf');


        foreach ($journal as $key => $field) {
            /**
             * @var $field \Model\Entity\Field
             */
            echo $field->name . ":" . $field->value . "<br/>";
        }


        return array('features' => $features, 'offset' => Configuration::$OFFSETPATH, 'title' => 'Demo');

    }

    /**
     * @param $request \Model\Entity\Request
     * @return null
     */
    function postAction($request)
    {
        $this->view = new Redirect('Location: /Error/404');
    }
}