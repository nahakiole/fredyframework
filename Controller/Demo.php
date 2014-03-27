<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 21.03.14
 * Time: 22:48
 */

namespace Controller;


use Framework\Configuration;
use Framework\LanguageLoader;
use View\BootstrapHTMLGenerator;
use View\HTMLResponse;

class Demo extends Controller
{


    public function __construct($database,LanguageLoader $languageLoader)
    {
        $this->database = $database;
        $this->languageLoader = $languageLoader;
    }


    /**
     * @param $request \Model\Entity\Request
     * @return \View\Response
     */
    function indexAction($request)
    {
        $response = new HTMLResponse('demo.twig');
        $languageContainer = $this->languageLoader->loadLanguageFile('demo');
        //echo $languageContainer->getString('password_too_short');
        //echo $languageContainer->getStringWithAttributes('integer_min_max',[ 10, 11]);
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
        $form->addChildren(  $HTMlGenerator->getTextarea('content', 'Content', 'Test', 'Here goes your content', 'This is where you have to type in your content', true, []));
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


        $response->setTwigVariables(['features' => $features, 'offset' => Configuration::$OFFSETPATH, 'title' => 'Demo', 'form' => $form->render()]);
        return $response;

    }

    /**
     * @param $request \Model\Entity\Request
     * @return \View\Response
     */
    function postAction($request)
    {
        $this->loadTemplate('demo.twig');

        return array('response' => ['success' => true]);
    }

    /**
     * @param $request \Model\Entity\Request
     * @return \View\Response
     */
    function subdomainAction($request)
    {
        $this->loadTemplate('subdomain.twig');
        return array('subdomain' => $request->matches['subdomain']);
    }
}