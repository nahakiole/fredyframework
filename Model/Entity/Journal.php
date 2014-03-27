<?php

namespace Model\Entity;

use Model\Entity\DataType\Id;
use Model\Entity\DataType\Integer;
use Model\Entity\DataType\Text;

class Journal extends Entity
{


    function __construct($id, $title, $content)
    {
        $this->addField(new Field('content', new Text(), 'textarea', true,  $content, 3));
        $this->addField(new Field('id', new Id(), 'input', true, $id, 1));
        $this->addField(new Field('title', new Text(0,50), 'textarea', true, $title, 2));
        uksort($this->fields, array($this, 'sortByFieldsIndex'));
    }

    function sortByFieldsIndex($a, $b)
    {
        return $this->fields[$a]->index >= $this->fields[$b]->index ? 1 : -1;
    }


}
