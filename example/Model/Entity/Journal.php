<?php

namespace Model\Entity;

use  Fredy\Model\Entity\DataType\Id;
use  Fredy\Model\Entity\DataType\Text;
use Fredy\Model\Entity\Entity;
use Fredy\Model\Entity\Field;

class Journal extends Entity
{

	public $tableName = 'journal';

    function __construct()
    {
        $this->addField(new Field('content', new Text(20), null));
        $this->addField(new Field('id', new Id(), null));
        $this->addField(new Field('title', new Text(0, 50), null));
    }

}
