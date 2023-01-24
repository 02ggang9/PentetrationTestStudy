<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/connectDatabase/DatabaseClass.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/boardService/RecommandPostClass.php");


if(!isset($_SESSION["login_user"])) $_SESSION["login_user"] = NULL;

if($_SERVER["REQUEST_METHOD"] == "GET") {
    $db = new Database();
    $recommand = new RecommandPost($_GET["title"], $_SESSION["login_user"]);

    if( !$db->isConnected()) {
        echo $db->getError();
        die("Unable to connect to DB");
    }

    if(!$recommand->checkSession()) {
        echo "<script>alert('로그인 하세요!!');";
        echo "window.location.href='/PenetrationTestStudy/homePages/loginPages/mainLoginPage.php'";
        echo "</script>";
        die();
    }

    $recommand->cancleRecommandThisPost($db);

}