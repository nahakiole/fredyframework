<?php 

namespace Model\Entity;

class Journal extends Entity
{
    public $id;
    public $title;
    public $content;
    
    public function __construct($data)
    {
        $this->id = $data['id'];
        $this->title = $data['title'];
        $this->content = $data['content'];
    }

}
