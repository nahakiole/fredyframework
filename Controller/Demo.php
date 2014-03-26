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
use Model\Factory\JournalFactory;
use Model\Repository\JournalRepository;
use View\HTMLTemplate;
use View\HTMLView;
use View\Redirect;

class Demo extends Controller
{


    public function __construct($database)
    {
        $this->database = $database;
    }


    /**
     * @param $request \Model\Entity\Request
     * @return null
     */
    function indexAction($request)
    {
        $this->loadTemplate('demo.twig');

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


        $journalRepository = new JournalRepository($this->database);
        $journals = $journalRepository->findAll(1);

        foreach ($journals as $key => $journal) {
            foreach ($journal as $field) {
                echo '<br/>';
                echo $field->toSelectString();
                echo '<br/>';
                echo $field->toInsertString();
            }
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