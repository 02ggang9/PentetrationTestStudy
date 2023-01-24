<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/connectDatabase/DatabaseClass.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/questionService/AnswerQuestionPostClass.php");

if(!isset($_SESSION["login_user"])) $_SESSION["login_user"] = "";

if($_SERVER['REQUEST_METHOD'] == "POST") {
    // echo $_POST["idx"];
    // echo $_POST["answer"];

    $db = new Database();
    $post = new AnswerQuestionPost($_POST["idx"], $_POST["answer"]);

    if(!$post->checkAnswerAuth($_SESSION["login_user"])){
        echo "<script>alert('관리자만 가능합니다');";
        echo "history.go(-1);";
        echo "</script>";
        die();
    }

    $post->answerPost($db);

}

?>

