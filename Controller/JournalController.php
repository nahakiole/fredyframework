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

        (new JournalRepository($this->database))->create(new \Model\Entity\Journal(null,'title','content'));

        $this->loadTemplate('journal.twig');

        $journalRepository = new JournalRepository($this->database);
        $journals = $journalRepository->findAll();

        $journal = $journalRepository->findById(3);

        $twigContext = array(
            'journals' => $journals,
            'singleJournal' => $journal
            );

        return $twigContext;

    }
}