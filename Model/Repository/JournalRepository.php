<?php

namespace Model\Repository;

use Model\Entity\Journal;
use Model\Factory\JournalFactory;

class JournalRepository extends Repository
{

    /**
     *
     * @var string
     */
    protected $tableName = 'journal';

    public function __construct($db){
        parent::__construct($db);
        $this->entity = new Journal('','','');
        $this->factory = new JournalFactory();
    }

    
}