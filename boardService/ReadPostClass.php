<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/connectDatabase/DatabaseClass.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/boardService/PostClass.php");

class readPost extends Post {
    

    public function __construct($title) {
        $this->title = $title;
    }

    public function viewCountUp(Database $db) {
        $db->query("UPDATE notice_table SET viewCount = :viewCount WHERE title = :title");
        $db->bind(":viewCount",($this->getViewr())+1);
        $db->bind(":title",$this->getTitle());
        $db->execute();
    }

    public function readContent(Database $db) {
        // $this->viewCountUp($db);
        $db->query("SELECT * FROM notice_table WHERE title = :title");
        $db->bind(":title",$this->getTitle());
        $this->row = $db->resultsetAssoc();

        foreach($this->row AS $val) {
            $this->setContent($val["content"]);
            $this->setWriter($val["userName"]);
            $this->setViewer($val["viewCount"]);
            $this->setDate($val["date"]);
        }
    }

    
}