<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/connectDatabase/DatabaseClass.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/connectDatabase/UserServiceClass.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/connectDatabase/UserUpdateClass.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = new UserUpdate();
    $db = new Database();

    $user->setId($_SESSION["login_user"]);
    $user->setPass($_POST["userPw"]);
    $user->setPassCheck($_POST["checkUserPw"]);

    if( !$db->isConnected()) {
        echo $db->getError();
        die("Unable to connect to DB");
    }

    $user->userUpdate($db);
}