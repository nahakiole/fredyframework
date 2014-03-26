<?php


namespace Model\Factory;


use Model\Entity\Journal;

class JournalFactory extends Factory {
    public function build($data)
    {
        return new Journal($data['content'], $data['id'], $data['title']);
    }
}