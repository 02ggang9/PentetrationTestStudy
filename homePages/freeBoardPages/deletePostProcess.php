<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/connectDatabase/DatabaseClass.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/boardService/DeletePostClass.php");


if(!isset($_SESSION["login_user"])) $_SESSION["login_user"] = NULL;

if($_SERVER["REQUEST_METHOD"] == "GET") {
    $db = new Database();
    $delete = new DeletePost($_GET["title"], $_SESSION["login_user"]);

    if( !$db->isConnected()) {
        echo $db->getError();
        die("Unable to connect to DB");
    }

    $delete->deletePost($db);
}