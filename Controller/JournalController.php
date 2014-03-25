<?php

namespace Controller;

use View\HTMLTemplate;
use View\HTMLView;
use Model\Repository\JournalRepository;
use Model\Factory\JournalFactory;

class JournalController extends Controller
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    function indexAction($matches)
    {
        $this->view = new HTMLView('View/Templates/index.html');
        $this->view->template->setVariable([
            'SITE_TITLE' => 'Journal test',
            'SITE_DESC' => ''
        ]);
        $this->view->addTemplate('CONTENT', new HTMLTemplate('View/Templates/journal.html'));
        $journalRepository = new JournalRepository($this->database);
        $journalFactory = new JournalFactory();
        $journals = $journalFactory->buildAll($journalRepository->findAll());

        $this->view->addTemplate('JOURNALS', new HTMLTemplate('View/Templates/journals.html'));
        foreach ($journals as $journal) {
            $this->view->getTemplate('JOURNALS')->setBlockVariable([
                'TITLE' => $journal->title,
                'CONTENT' => $journal->content
            ]);
            $this->view->getTemplate('JOURNALS')->preRender();
        }
    }
}