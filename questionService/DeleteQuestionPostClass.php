<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/connectDatabase/DatabaseClass.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/questionService/ReadQuestionPostClass.php");

class DeleteQuestionPost extends QuestionPost {


    public function deleteQuestionPost(Database $db, $password) {
        $db->query("DELETE FROM question_table WHERE password = :password");
        $db->bind(":password",$password);
        $db->resultsetAssoc();

        if($db->rowCount() == 1) {
            echo "<script>alert('글 삭제 성공!');";
            echo "window.location.href='/PenetrationTestStudy/homePages/questionBoardPages/mainQuestionBoardPage.php'";
            echo "</script>";
        } else {
            echo "<script>alert('글 삭제 실패!');";
            echo "window.location.href='/PenetrationTestStudy/homePages/questionBoardPages/mainQuestionBoardPage.php'";
            echo "</script>";
        }

    }





}