<?php

namespace Model\Repository;

use Model\Entity\Journal;
use Model\Factory\JournalFactory;

class JournalRepository extends Repository
{

    /**
     * @var string
     */
    protected $tableName = 'journal';

    /**
     * @param $db \PDO
     */
    public function __construct($db)
    {
        $this->entity = new Journal(null, null, null);
        $this->factory = new JournalFactory();
        parent::__construct($db);
    }

}