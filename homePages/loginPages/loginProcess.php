<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/connectDatabase/DatabaseClass.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/connectDatabase/UserServiceClass.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = new UserService();
    $db = new Database();
    $user->setId($_POST["userId"]);
    $user->setPass($_POST["userPw"]);

    if( !$db->isConnected()) {
        echo $db->getError();
        die("Unable to connect to DB");
    }

    $user->userLogin($db);
    
}

