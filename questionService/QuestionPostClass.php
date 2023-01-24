<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/connectDatabase/DatabaseClass.php");

class QuestionPost {

    protected $idx;
    protected $title;
    protected $contact;
    protected $date;
    protected $checkAnswer;
    protected $password;
    protected $adminAnswer;
    protected $content;
    protected $row;
    protected $userName;

    public function getIdx() {
        return $this->idx;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getContact() {
        return $this->contact;
    }

    public function getDate() {
        return $this->date;
    }

    public function getCheckAnswer() {
        return $this->checkAnswer;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getAdminAnswer() {
        return $this->adminAnswer;
    }

    public function getContent() {
        return $this->content;
    }

    public function getRow() {
        return $this->row;
    }

    public function getUserName() {
        return $this->userName;
    }

    public function setIdx($idx) {
        $this->idx = $idx;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setContact($contact) {
        $this->contact = $contact;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function setCheckAnswer($checkAnswer) {
        $this->checkAnswer = $checkAnswer;
    }
    
    public function setPassword($password) {
        $this->password = $password;
    }

    public function setAdminAnswer($adminAnswer) {
        $this->adminAnswer = $adminAnswer;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function setUserName($userName) {
        $this->userName = $userName;
    }

    public function checkUserName() {
        if($_SESSION["login_user"] == "admin" || $_SESSION["login_user"] == NULL) return true;
        else return false;
    }


}