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
use View\BootstrapHTMLGenerator;
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
        $HTMlGenerator = new BootstrapHTMLGenerator();

        $form = $HTMlGenerator->getForm('test', $request->matches[0], 'POST');
        $form->addChildren( $HTMlGenerator->getTextfield('title', 'Title', '', 'Type in your title', 'This is where you have to type in your Title', true, []));
        $form->addChildren(  $HTMlGenerator->getTextarea('content', 'Content', '', 'Here goes your content', []));
        $form->addChildren( $HTMlGenerator->getRadiobuttons(
            'radio',
            'Radiobuttons',
            [
                1 => [
                    'label' => 'Test'
                ],
                2 => [
                    'label' => 'Test'
                ],
                3 => [
                    'label' => 'Test'
                ]
            ],
            'Type in your title',
            'This is where you have to type in your Title',
            []
        ));
        $form->addChildren( $HTMlGenerator->getCheckbox('scheckbox', 'Single Checkbox', '', 'Type in your title', 'This is where you have to type in your Title', true, []));
        $form->addChildren( $HTMlGenerator->getCheckboxes('mscheckbox', 'Checkboxes', [
            1 => [
                'label' => 'Test'
            ],
            2 => [
                'label' => 'Test'
            ],
            3 => [
                'label' => 'Test'
            ]
        ], 'Type in your title', 'This is where you have to type in your Title', true, []));

        $form->addChildren($HTMlGenerator->getButton('test', '', 'Absenden', []));

        return array('features' => $features, 'offset' => Configuration::$OFFSETPATH, 'title' => 'Demo', 'form' => $form->render());

    }

    /**
     * @param $request \Model\Entity\Request
     * @return null
     */
    function postAction($request)
    {
        $this->loadTemplate('response.twig');

        return array('response' => ['success' => true]);
    }

    /**
     * @param $request \Model\Entity\Request
     * @return null
     */
    function subdomainAction($request)
    {
        $this->loadTemplate('subdomain.twig');
        return array('subdomain' => $request->matches['subdomain']);
    }
}