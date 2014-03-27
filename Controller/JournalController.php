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

    function indexAction($request)
    {

        $this->loadTemplate('journalList.twig');

        $journalRepository = new JournalRepository($this->database);

        // $insertJournal = new \Model\Entity\Journal(null,'title','content');
        // $journalRepository->update($insertJournal);


        // $journal = $journalRepository->findById(1);
        // $journalRepository->remove($journal);

        // $filter = new Filter($this->database);
        // $filter->addCondition(new Condition('content','<>','content'));
        // $journals = $journalRepository->findByFilter($filter);

        $journals = $journalRepository->findAll();

        $twigContext = array(
            'journals' => $journals
            );

        return $twigContext;

    }

    public function journalAction($request)
    {
        $this->loadTemplate('journal.twig');

        $journalRepository = new JournalRepository($this->database);

        $id = $request->matches['id'];
        $journal = $journalRepository->findById($id);

        $twigContext = array(
            'journal' => $journal
            );

        return $twigContext;
    }
}