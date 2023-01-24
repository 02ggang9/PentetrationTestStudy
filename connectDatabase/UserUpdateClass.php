<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/connectDatabase/DatabaseClass.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/connectDatabase/UserServiceClass.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/connectDatabase/UserSignUpClass.php");


class UserUpdate extends UserSignUp {

    private $preUserID;

    public function __construct() {
        $this->preUserID = $_SESSION["login_user"];
    }

    public function getPreUserID() {
        return $this->preUserID;
    }

    public function userUpdate(Database $db) {

        if($this->checkPassCheck()) {
            echo "<script>alert('비밀번호가 다릅니다!');";
            echo "window.location.href='/PenetrationTestStudy/homePages/myPages/mainMyPage.php'";
            echo "</script>";
            die();
        }

        $db->query("UPDATE USER_TABLE SET password = :pw WHERE id = :preID;");
        $db->bind(":pw", $this->getMd5Pass());
        $db->bind(":preID", $this->getPreUserID());
        $db->resultset();

        if($db->rowCount() == 1) {
            echo "<script>alert('회원정보 변경 성공!');";
            echo "window.location.href='/PenetrationTestStudy/homePages/mainHomePages/mainHomePage.php'";
            echo "</script>";
        } else {
            echo "<script>alert('회원정보 변경 실패');";
            echo "window.location.href='/PenetrationTestStudy/homePages/myPages/mainMyPage.php'";
            echo "</script>";
        }

    }
}