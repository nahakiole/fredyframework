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
        $this->view->addTemplate('CONTENT', new HTMLTemplate('View/Templates/feature_block.html'));
        $randomBlockOfText = 'Lorem Ipsum</h3>
<p>Weit hinten, hinter den Wortbergen, fern der Länder Vokalien und Konsonantien leben die Blindtexte.</p>

<p>Abgeschieden wohnen sie in Buchstabhausen an der Küste des Semantik, eines großen Sprachozeans. Ein kleines Bächlein namens Duden fließt durch ihren Ort und versorgt sie mit den nötigen Regelialien.</p>

<p>Es ist ein paradiesmatisches Land, in dem einem gebratene Satzteile in den Mund fliegen.</p>

<p>Nicht einmal von der allmächtigen Interpunktion werden die Blindtexte beherrscht – ein geradezu unorthographisches Leben.</p>';


        for ($i = 1; $i < 6; $i++){
            $this->view->getTemplate('CONTENT')->setBlockVariable([
                'CONTENT' => '<h3> '.$i.' '.$randomBlockOfText
            ]);
            $this->view->getTemplate('CONTENT')->preRender();
        }




    }
}