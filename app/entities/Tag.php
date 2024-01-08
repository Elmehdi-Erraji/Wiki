<?php 

namespace App\entities;


class Tag {

    private $id;
    private $tagName;

    public function __construct($tagName)
    {
        $this->tagName = $tagName;
    }

    public function getId() {
        return $this->id;
    }

    public function getTagName()
    {   
        return $this->tagName;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setTagName($tagName)
    {
        $this->tagName = $tagName;
    }
}