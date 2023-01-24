<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/connectDatabase/DatabaseClass.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/questionService/MakeQuestionPostClass.php");

if(!isset($_SESSION["login_user"])) $_SESSION["login_user"] = NULL;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new Database();
    $post = new MakeQuestionPost(NULL, $_POST["title"], $_POST["contact"], "Hold", $_POST["password"], "", $_POST["content"], $_SESSION["login_user"]);


    if( !$db->isConnected()) {
        echo $db->getError();
        die("Unable to connect to DB");
    }

    if(!$post->checkUserName()) {
        echo "<script>alert('비회원 전용입니다!');";
        echo "window.location.href='/PenetrationTestStudy/homePages/questionBoardPages/mainQuestionBoardPage.php'";
        echo "</script>";
        die();
    }
    $post->makeQuestionContent($db);
    
}



