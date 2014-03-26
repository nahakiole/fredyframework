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

        $this->loadTemplate('journal.twig');

        $journalRepository = new JournalRepository($this->database);

        $journalRepository->update(new \Model\Entity\Journal(2,'title','content'));

        $journals = $journalRepository->findAll();

        $journal = $journalRepository->findById(3);

        $journalRepository->remove($journal);

        $twigContext = array(
            'journals' => $journals,
            'singleJournal' => $journal
            );

        return $twigContext;

    }
}