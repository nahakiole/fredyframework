<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 21.03.14
 * Time: 22:48
 */

namespace Controller;


use View\HTMLTemplate;
use View\HTMLView;

class Demo extends Controller
{

    function indexAction()
    {
        $this->view = new HTMLView('View/Templates/index.html');
        $this->view->template->setVariable([
            'SITE_TITLE' => 'Demo Controller',
            'SITE_DESC' => 'This is the demonstration controller.'

        ]);
        $this->view->addTemplate('CONTENT', new HTMLTemplate('View/Templates/demo.html'));
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


        $this->view->addTemplate('FEATURES', new HTMLTemplate('View/Templates/features.html'));
        foreach ($features as $feature) {
            $this->view->getTemplate('FEATURES')->setBlockVariable([
                'NAME' => $feature['name'],
                'ICON' => $feature['icon']
            ]);
            $this->view->getTemplate('FEATURES')->preRender();
        }


    }
}