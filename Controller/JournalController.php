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
        $journals = $journalRepository->findAll();

        $twigContext = array(
            'journals' => $journals
            );

        return $twigContext;

    }
}