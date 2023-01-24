<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/connectDatabase/DatabaseClass.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/questionService/QuestionPostClass.php");

class AnswerQuestionPost extends QuestionPost {



    public function __construct($idx, $answer) {
        $this->idx = $idx;
        $this->adminAnswer = $answer;
    }

    public function checkAnswerAuth($session) {
        if($session == "admin") return true;
        else return false;
    }

    public function answerPost(Database $db) {
        $db->query("UPDATE question_table SET checkAnswer = :checkAnswer, adminAnswer = :adminAnswer WHERE idx = :idx");
        $db->bind(":checkAnswer", "답변완료");
        $db->bind(":adminAnswer", $this->getAdminAnswer());
        $db->bind(":idx", $this->getIdx());
        $db->resultset();

        if($db->rowCount() == 1) {
            echo "<script>alert('답글 성공');";
            echo "history.go(-1);";
            echo "</script>";
        } else {
            echo "<script>alert('실패');";
            echo "history.go(-1);";
            echo "</script>";
        }
    }




}



