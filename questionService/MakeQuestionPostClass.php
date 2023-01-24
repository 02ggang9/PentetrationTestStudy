<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/connectDatabase/DatabaseClass.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/questionService/QuestionPostClass.php");

class MakeQuestionPost extends QuestionPost {

    public function __construct($idx, $title, $contact, $checkAnswer, $password, $adminAnswer, $content, $userName) {
        $this->idx = $idx;
        $this->title = $title;
        $this->contact = $contact;
        $this->date = date("Y-m-d");
        $this->checkAnswer = $checkAnswer;
        $this->password = $password;
        $this->adminAnswer = $adminAnswer;
        $this->content = $content;
        $this->userName = $userName;
    }

    private function isFull() {
        if($this->getTitle() && $this->getContact() && $this->getPassword() && $this->getContent()) return true;
        else return false;
    }

    public function makeQuestionContent(Database $db) {

        if(!$this->checkUserName()) {
            echo "<script>alert('비회원 전용입니다!');";
            echo "window.location.href='/PenetrationTestStudy/homePages/questionBoardPages/mainQuestionBoardPage.php'";
            echo "</script>";
            die();
        }

        if(!$this->isFull()) {
            echo "<script>alert('제목, 연락처, 비밀번호, 본문을 다 작성해주세요!');";
            echo "window.location.href='/PenetrationTestStudy/homePages/questionBoardPages/mainQuestionBoardPage.php'";
            echo "</script>";
            die();
        }

        $db->query("INSERT INTO question_table (idx, title, contact, date, checkAnswer, password, adminAnswer, content) VALUES (:idx, :title, :contact, :date, :checkAnswer, :password, :adminAnswer, :content);");
        $db->bind(":idx", NULL);
        $db->bind(":title", $this->getTitle());
        $db->bind(":contact", $this->getContact());
        $db->bind(":date", $this->getDate());
        $db->bind(":checkAnswer", $this->getCheckAnswer());
        $db->bind(":password", $this->getPassword());
        $db->bind(":adminAnswer", $this->getAdminAnswer());
        $db->bind(":content", $this->getContent());

        $db->resultsetAssoc();

        if($db->rowCount() == 1) {
            echo "<script>alert('글쓰기 성공!');";
            echo "window.location.href='/PenetrationTestStudy/homePages/questionBoardPages/mainQuestionBoardPage.php'";
            echo "</script>";
        } else {
            echo "<script>alert('글쓰기 실패');";
            echo "window.location.href='/PenetrationTestStudy/homePages/freeBoardPages/mainQuestionBoardPage.php'";
            echo "</script>";
            die();
        }
    }

    







}

