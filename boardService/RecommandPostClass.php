<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/connectDatabase/DatabaseClass.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/boardService/PostClass.php");


class RecommandPost extends Post {

    private $likeUserName;


    public function __construct($title, $likeUserName) {
        $this->title = $title;
        $this->likeUserName = $likeUserName;
    }

    public function getLikeUserName() {
        return $this->likeUserName;
    }

    public function checkSession() {
        if($this->getLikeUserName()) return true;
        else return false;
    }

    private function isPostMine(Database $db) {
        $db->query("SELECT * FROM notice_table WHERE title = :title");
        $db->bind(":title",$this->getTitle());
        $this->row = $db->resultsetAssoc();

        foreach($this->row AS $val) {
            $this->setWriter($val["userName"]);
        }

        if($this->getLikeUserName() == $this->getWriter()) return true;
        else return false;
    }

    public function alreadyRecommand(Database $db) {
        $db->query("SELECT * FROM like_manager WHERE likePostTitle = :likePostTitle AND likeUser = :likeUser");
        $db->bind(":likePostTitle",$this->getTitle());
        $db->bind(":likeUser",$this->getLikeUserName());
        $this->row = $db->resultsetAssoc();

        if($db->rowCount() != 0) return true;
        else return false;
            
    }

    public function recommandThisPost(Database $db) {
        if($this->isPostMine($db)) {
            echo "<script>alert('자신의 게시물입니다!!');";
            echo "window.location.href='/PenetrationTestStudy/homePages/freeBoardPages/viewFreeBoardPage.php?title=" . $this->getTitle() . "'";
            echo "</script>";
            die();
        }

        if($this->alreadyRecommand($db)) {
            echo "<script>alert('이미 따봉 하셨습니다!');";
            echo "window.location.href='/PenetrationTestStudy/homePages/freeBoardPages/viewFreeBoardPage.php?title=" . $this->getTitle() . "'";
            echo "</script>";
            die();
        }

        $db->query("INSERT INTO like_manager (likePostTitle, likeUser) VALUES (:likePostTitle, :likeUser)");
        $db->bind(":likePostTitle",$this->getTitle());
        $db->bind(":likeUser",$this->getLikeUserName());
        $db->resultsetAssoc();

        echo "<script>alert('따봉 완료!');";
        echo "window.location.href='/PenetrationTestStudy/homePages/freeBoardPages/viewFreeBoardPage.php?title=" . $this->getTitle() . "'";
        echo "</script>";
    }


    // 추천 취소 기능


    public function cancleRecommandThisPost(Database $db) {
        if($this->isPostMine($db)) {
            echo "<script>alert('자신의 게시물입니다!!');";
            echo "window.location.href='/PenetrationTestStudy/homePages/freeBoardPages/viewFreeBoardPage.php?title=" . $this->getTitle() . "'";
            echo "</script>";
            die();
        }

        if(!$this->alreadyRecommand($db)) {
            echo "<script>alert('추천하지 않은 게시물입니다!');";
            echo "window.location.href='/PenetrationTestStudy/homePages/freeBoardPages/viewFreeBoardPage.php?title=" . $this->getTitle() . "'";
            echo "</script>";
            die();
        }

        $db->query("DELETE FROM like_manager WHERE likePostTitle = :likePostTitle AND likeUser = :likeUser");
        $db->bind(":likePostTitle",$this->getTitle());
        $db->bind(":likeUser",$this->getLikeUserName());
        $db->resultsetAssoc();

        echo "<script>alert('따봉 취소!');";
        echo "window.location.href='/PenetrationTestStudy/homePages/freeBoardPages/viewFreeBoardPage.php?title=" . $this->getTitle() . "'";
        echo "</script>";
    }




}

