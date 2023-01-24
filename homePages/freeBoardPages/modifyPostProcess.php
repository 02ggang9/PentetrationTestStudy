<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/connectDatabase/DatabaseClass.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/boardService/ModifyPostClass.php");

if(!isset($_SESSION["login_user"])) $_SESSION["login_user"] = NULL;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new Database();
    $modify = new ModifyPost($_POST["title"], $_POST["preTitle"], $_SESSION["login_user"], $_POST["content"]);

    $modify->modifyPost($db);

    
}