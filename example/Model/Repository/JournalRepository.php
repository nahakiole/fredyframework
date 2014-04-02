<?php

namespace Model\Repository;

use  Model\Entity\Journal;
use  Model\Factory\JournalFactory;
use Fredy\Model\Repository\Repository;

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