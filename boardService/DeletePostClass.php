<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/connectDatabase/DatabaseClass.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/boardService/PostClass.php");

class DeletePost extends Post {

    
    private $viewUserName;

    public function __construct($title, $viewUserName) {
        $this->title = $title;
        $this->viewUserName = $viewUserName;
    }

    public function getViewUserName() {
        return $this->viewUserName;
    }

    private function passAuth(Database $db) {
        $db->query("SELECT * FROM notice_table WHERE title = :title");
        $db->bind(":title",$this->getTitle());
        $this->row = $db->resultsetAssoc();

        foreach($this->row AS $val) {
            $this->setWriter($val["userName"]);
        }

        if($this->getWriter() == $this->getViewUserName()) return true;
        else return false;
    }

    public function deletePost(Database $db) {

        

        if(!$this->passAuth($db)) {
            echo "<script>alert('인가 시도 탐지!');";
            echo "window.location.href='/PenetrationTestStudy/homePages/freeBoardPages/mainFreeBoardPage.php'";
            echo "</script>";
            die();
        }

        $db->query("DELETE FROM notice_table WHERE title = :title");
        $db->bind(":title",$this->getTitle());
        $db->resultsetAssoc();

        if($db->rowCount() == 1) {
            echo "<script>alert('글 삭제 성공!');";
            echo "window.location.href='/PenetrationTestStudy/homePages/freeBoardPages/mainFreeBoardPage.php'";
            echo "</script>";
        } else {
            echo "<script>alert('글 삭제 실패!');";
            echo "window.location.href='/PenetrationTestStudy/homePages/freeBoardPages/mainFreeBoardPage.php'";
            echo "</script>";
        }

        $db->query("DELETE FROM like_manager WHERE likePostTitle = :likePostTitle");
        $db->bind(":likePostTitle",$this->getTitle());
        $db->resultsetAssoc();
        
    }

}