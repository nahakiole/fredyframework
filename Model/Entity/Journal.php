<?php

namespace Model\Entity;

use Model\Entity\DataType\Integer;
use Model\Entity\DataType\Text;

class Journal extends Entity
{


    function __construct($content, $id, $title)
    {
        $textDataType = new Text();
        $integerDataType = new Integer();
        $this->fields[] = new Field($textDataType, 'textarea', true, 'content', $content, 3);
        $this->fields[] = new Field($integerDataType, 'input', true, 'id', $id, 1);
        $this->fields[] = new Field($textDataType, 'textarea', true, 'title', $title, 2);
        uksort($this->fields, array($this, 'sortByFieldsIndex'));
    }

    function sortByFieldsIndex($a, $b)
    {
        return $this->fields[$a]->index >= $this->fields[$b]->index ? 1 : -1;
    }


}
