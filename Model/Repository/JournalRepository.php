<?php

namespace Model\Repository;

class JournalRepository extends Repository
{

    /**
     *
     * @var string
     */
    protected $tableName = 'journal';

    /**
     * Array with all fields
     */
    protected $fields = ['id','name','content'];

    public function findAll($limit=0, $offset=0)
    {
        $query = 
            'SELECT id, title, content FROM '.$this->tableName.';';
        $stmt = $this->database->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll();

    }
    
}