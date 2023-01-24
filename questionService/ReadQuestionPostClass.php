<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/connectDatabase/DatabaseClass.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/questionService/QuestionPostClass.php");

class ReadQuestionPost extends QuestionPost {


    public function __construct($idx) {
        $this->idx = $idx;
    }

    public function checkPassword(Database $db, $password) {
        $db->query("SELECT * FROM question_table WHERE idx = :idx");
        $db->bind(":idx",$this->getIdx());
        $this->row = $db->resultsetAssoc();

        foreach($this->row AS $val) {
            $this->setPassword($val["password"]);
        }
        
        if($this->getPassword() == $password) return true;
        else return false;

    }

    public function passwordPrompt(Database $db) {
        

    }

    public function readQuestionPost(Database $db) {
        // $this->viewCountUp($db);
        $db->query("SELECT * FROM question_table WHERE idx = :idx");
        $db->bind(":idx",$this->getIdx());
        $this->row = $db->resultsetAssoc();

        foreach($this->row AS $val) {
            $this->setTitle($val["title"]);
            $this->setContact($val["contact"]);
            $this->setDate($val["date"]);
            $this->setCheckAnswer($val["checkAnswer"]);
            $this->setPassword($val["password"]);
            $this->setAdminAnswer($val["adminAnswer"]);
            $this->setContent($val["content"]);
        }

    }

    
}