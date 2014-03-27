<?php

namespace Controller;

use View\HTMLTemplate;
use View\HTMLView;
use Model\Repository\Filter;
use Model\Repository\Condition;
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

        // $journalRepository->update(new \Model\Entity\Journal(2,'title','content'));

        $journals = $journalRepository->findAll();

        $journal = $journalRepository->findById(1);

        // $journalRepository->remove($journal);

        $filter = new Filter($this->database);

        $filter->addCondition(new Condition('content','<>','content'));

        set_magic_quotes_runtime(0);

        // $journals = $journalRepository->findByFilter($filter);

        $twigContext = array(
            'journals' => $journals,
            'singleJournal' => $journal
            );

        return $twigContext;

    }
}