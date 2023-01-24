<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/connectDatabase/DatabaseClass.php");

class UserService {

    public $id;
    public $pass;
    public $md5Pass;
    public $userSession;
    // protected $checkUserSession = false;

    public function setId($id) {
        $this->id = $id;
    }

    public function setPass($pass) {
        $this->pass = $pass;
        $this->md5Pass = md5($pass);
    }

    public function getId() {
        return $this->id;
    }

    public function getPass() {
        return $this->pass;
    }

    public function getMd5Pass() {
        return $this->md5Pass;
    }

    public function setSession() {
        $_SESSION["login_user"] = $this->id;
        $this->userSession = $_SESSION["login_user"];
    }

    public function getSession() {
        if(isset($_SESSION["login_user"])) return true;
        else return false;
    }

    public function userLogin(Database $db) {
        $db->query("SELECT * FROM USER_TABLE WHERE id = :id AND password = :pw");
        $db->bind(":id", $this->getId());
        $db->bind(":pw", $this->getMd5Pass());
        $db->resultset();

        if($db->rowCount() > 0) {
            $this->setSession();
            echo "<script>alert('로그인 성공');";
            echo "window.location.href='/PenetrationTestStudy/homePages/mainHomePages/mainHomePage.php'";
            echo "</script>";
        } else {
            echo "<script>alert('로그인 실패');";
            echo "window.location.href='/PenetrationTestStudy/homePages/loginPages/mainLoginPage.php'";
            echo "</script>";
        }
    }

    public function userLogout() {
        if($this->getSession()) {
            session_destroy();
            echo "<script>alert('로그아웃 성공');";
            echo "window.location.href='/PenetrationTestStudy/homePages/mainHomePages/mainHomePage.php'";
            echo "</script>";
        } else {
            echo "<script>alert('로그아웃 실패');";
            echo "window.location.href='/PenetrationTestStudy/homePages/loginPages/mainLoginPage.php'";
            echo "</script>";
        }
        
    }
}