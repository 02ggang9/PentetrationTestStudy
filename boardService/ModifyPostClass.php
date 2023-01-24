<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/connectDatabase/DatabaseClass.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/boardService/PostClass.php");


class ModifyPost extends Post {

    private $preTitle;
    private $modifyUserName;

    public function __construct($title, $preTitle, $modifyUserName, $content) {
        $this->title = $title;
        $this->preTitle = $preTitle;
        $this->modifyUserName = $modifyUserName;
        $this->content = $content;
    }

    private function getPreTitle() {
        return $this->preTitle;
    }

    private function getModifyUserName() {
        return $this->modifyUserName;
    }

    private function passAuth(Database $db) {
        $db->query("SELECT * FROM notice_table WHERE title = :preTitle");
        $db->bind(":preTitle",$this->getPreTitle());
        $this->row = $db->resultsetAssoc();

        foreach($this->row AS $val) {
            $this->setWriter($val["userName"]);
        }

        if($this->getWriter() == $this->getModifyUserName()) return true;
        else return false;
    }

    private function passTitleName(Database $db) {
        $db->query("SELECT * FROM notice_table WHERE title = :title");
        $db->bind(":title",$this->getTitle());
        $this->row = $db->resultsetAssoc();

        if($this->getTitle() == $this->getPreTitle()) return true;

        if($db->rowCount() == 0) return true;
        else return false;
    }

    public function modifyPost(Database $db) {
        if(!$this->passAuth($db)) {
            echo "<script>alert('인가 시도 탐지!');";
            echo "window.location.href='/PenetrationTestStudy/homePages/freeBoardPages/mainFreeBoardPage.php'";
            echo "</script>";
            die();
        }

        if(!$this->passTitleName($db)) {
            echo "<script>alert('이미 존재하는 제목입니다!');";
            echo "window.location.href='/PenetrationTestStudy/homePages/freeBoardPages/mainFreeBoardPage.php'";
            echo "</script>";
            die();
        }

        if($this->getTitle() && $this->getContent()) {
            $db->query("UPDATE notice_table SET title = :title, content = :content, date = :date");
            $db->bind(":title",$this->getTitle());
            $db->bind(":content",$this->getContent());
            $db->bind(":date",date('Y-m-d')); # 수정을 요함
            $db->resultsetAssoc();

            if($db->rowCount() == 1) {
                echo "<script>alert('글 수정 성공!');";
                echo "window.location.href='/PenetrationTestStudy/homePages/freeBoardPages/mainFreeBoardPage.php'";
                echo "</script>";
            } else {
                echo "<script>alert('글 수정 실패');";
                echo "window.location.href='/PenetrationTestStudy/homePages/freeBoardPages/mainFreeBoardPage.php'";
                echo "</script>";
                die();
            }
        } else {
            echo "<script>alert('제목과 내용을 적어주세요!');";
            echo "window.location.href='/PenetrationTestStudy/homePages/freeBoardPages/mainFreeBoardPage.php'";
            echo "</script>";
        }

        




    }


}