<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/connectDatabase/DatabaseClass.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/connectDatabase/UserServiceClass.php");

class UserSignUp extends UserService {

    public $passCheck;

    public function getPassCheck() {
        return $this->passCheck;
    }

    public function setPassCheck($passCheck) {
        $this->passCheck = $passCheck;
    }

    public function checkPassCheck() {
        if($this->getPassCheck() != $this->getPass()) return true;
        else return false;
    }

    public function checkDuplicateID(Database $db) {
        $db->query("SELECT * FROM USER_TABLE WHERE id = :id");
        $db->bind(":id", $this->getId());
        $db->resultset();

        if($db->rowCount() > 0) return true;
        else return false;
    }

    public function signUp(Database $db) {
        if($this->checkDuplicateID($db)) {
            echo "<script>alert('이미 존재하는 아이디 입니다');";
            echo "window.location.href='/PenetrationTestStudy/homePages/signUpPages/mainSignUpPage.php'";
            echo "</script>";
            die();
        }

        if($this->checkPassCheck()) {
            echo "<script>alert('비밀번호가 다릅니다!');";
            echo "window.location.href='/PenetrationTestStudy/homePages/signUpPages/mainSignUpPage.php'";
            echo "</script>";
            die();
        }
        
        $db->query("INSERT INTO USER_TABLE (id,password) VALUES (:id, :pw);");
        $db->bind(":id", $this->getId());
        $db->bind(":pw", $this->getMd5Pass());
        $db->resultset();

        if($db->rowCount() == 1) {
            echo "<script>alert('회원가입 성공!');";
            echo "window.location.href='/PenetrationTestStudy/homePages/loginPages/mainLoginPage.php'";
            echo "</script>";
        } else {
            echo "<script>alert('회원가입 실패');";
            echo "window.location.href='/PenetrationTestStudy/homePages/signUpPages/mainSignUpPage.php'";
            echo "</script>";
        }
    }

}