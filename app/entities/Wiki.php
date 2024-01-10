<?php 

namespace app\entities;


class Wiki {
    private $id;
    private $title;
    private $content;
    private $image;
    private $created_at;
    private $status;
    private $category_id;
    private $user_id;

    private $categoryName;

    private $tags = [];

    public function __construct( $title, $content, $image, $status, $category_id, $user_id) {
       
        $this->title = $title;
        $this->content = $content;
        $this->image = $image;
        $this->status = $status;
        $this->category_id = $category_id;
        $this->user_id = $user_id;
    }

    public function getTags() {
        return $this->tags;
    }

    public function setTags($tags) {
        $this->tags = $tags;
    }
    public function getCategoryName() {
        return $this->categoryName;
    }

    public function setCategoryName($categoryName) {
        $this->categoryName = $categoryName;
    }

    public function getId() {
        return $this->id;
    }
    public function setId($id) {
       $this->id = $id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getContent() {
        return $this->content;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function setCreatedAt($created_at) {
        $this->created_at = $created_at;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getCategoryId() {
        return $this->category_id;
    }

    public function setCategoryId($category_id) {
        $this->category_id = $category_id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }
}
