<?php 

namespace App\entities;


class Category {

    private $id;
    private $categoryName;

    public function __construct($categoryName)
    {
        $this->categoryName = $categoryName;
    }

    public function getId() {
        return $this->id;
    }

    public function getcategoryName()
    {   
        return $this->categoryName;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setcategoryName($categoryName)
    {
        $this->categoryName = $categoryName;
    }
}