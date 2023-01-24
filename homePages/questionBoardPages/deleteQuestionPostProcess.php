<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/connectDatabase/DatabaseClass.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/questionService/DeleteQuestionPostClass.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new Database();
    $delete = new DeleteQuestionPost();

    $password = $_POST["password"];

    if( !$db->isConnected()) {
        echo $db->getError();
        die("Unable to connect to DB");
    }

    $delete->deleteQuestionPost($db, $password);
}