<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/connectDatabase/DatabaseClass.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/boardService/MakeContentClass.php");


if(!isset($_SESSION["login_user"])) $_SESSION["login_user"] = NULL;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new Database();
    $post = new MakeContent($_POST["title"], $_SESSION["login_user"], $_POST["content"], $_FILES["fileUpload"]["tmp_name"], $_FILES["fileUpload"]["name"], $_FILES["fileUpload"]["type"]);



    if( !$db->isConnected()) {
        echo $db->getError();
        die("Unable to connect to DB");
    }

    if(!$post->checkSession()) {
        echo "<script>alert('로그인 하세요!!');";
        echo "window.location.href='/PenetrationTestStudy/homePages/loginPages/mainLoginPage.php'";
        echo "</script>";
        die();
    }
    $post->makeContent($db);
    
}
