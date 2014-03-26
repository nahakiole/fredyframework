<?php

namespace Controller;

use View\HTMLTemplate;
use View\HTMLView;
use Model\Repository\JournalRepository;
use Model\Factory\JournalFactory;

class JournalController extends Controller
{
    private $database;

    protected $templatePath = 'journal.twig';

    public function __construct($database)
    {
        parent::__construct();
        $this->database = $database;
    }

    function indexAction($matches)
    {

        $journalRepository = new JournalRepository($this->database);
        $journals = $journalRepository->findAll();

        $twigContext = array(
            'journals' => $journals
            );

        return $twigContext;

    }
}