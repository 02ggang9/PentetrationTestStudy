<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/connectDatabase/DatabaseClass.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/boardService/PostClass.php");


class MakeContent extends Post {

    public function __construct($title, $writer, $content, $fileTmpName, $fileName, $fileType, $password = NULL, $contact = NULL) {
        $this->title = $title;
        $this->writer = $writer;
        $this->content = $content;
        $this->viewr = 0;
        $this->date = date('Y-m-d');
        $this->fileTmpName = $fileTmpName;
        $this->fileName = $fileName;
        $this->fileType = $fileType;
        $this->password = $password;
        $this->contact = $contact;
    }

    /*
    파일 업로드 취약점 대응 방안
    0. 데이터베이스에 저장 x 
    1. 파일 이름 확인 v
    2. 파일 시그니처 확인 v
    3. 파일 ContentType 확인 v
    4. storeImages 디렉토리 권한 제한 v
    */ 

    public function passFileName() {
        $fileExt = explode(".",strrev(strtolower($this->getFileName())));
        $fileExt = strrev($fileExt[0]);
        $whiteList = array("png", "img", "jpeg", "jpg");

        if(in_array($fileExt,$whiteList)) return true;
        else return false;
    }

    public function passFileSignature() {
        if(exif_imagetype($this->getFileName()) == (IMAGETYPE_PNG || IMAGETYPE_JPEG)) return true;
        else return false;
    }

    public function passContentType() {
        $whiteList = array("image/png", "image/jpeg");

        if(in_array($this->getFileType(), $whiteList)) return true;
        else return false;
    }

    public function allPass() {
        if($this->passFileName() && $this->passFileSignature() && $this->passContentType()) {
            return true;
        } else {
            return false;
        }
    }

    public function checkSession() {
        if($this->getWriter()) return true;
        else return false;
    }

    private function passTitleName(Database $db) {
        $db->query("SELECT * FROM notice_table WHERE title = :title");
        $db->bind(":title",$this->getTitle());
        $this->row = $db->resultsetAssoc();

        if($db->rowCount() == 0) return true;
        else return false;


    }



    public function makeContent(Database $db) {

        if($this->getFileTmpName() != NULL) {
            if(!$this->passFileName()) {
                echo "<script>alert('허용하지 않은 확장자 사용!');";
                echo "window.location.href='/PenetrationTestStudy/homePages/freeBoardPages/mainFreeBoardPage.php'";
                echo "</script>";
                die();
            }
        } 

        if(!$this->passTitleName($db)) {
            echo "<script>alert('중복되는 제목입니다!');";
            echo "window.location.href='/PenetrationTestStudy/homePages/freeBoardPages/mainFreeBoardPage.php'";
            echo "</script>";
            die();
        }


        $path = $_SERVER["DOCUMENT_ROOT"] . "/PenetrationTestStudy/storeImages/" . $this->getFileName();
        move_uploaded_file($this->getFileTmpName(), $path);

        if($this->getTitle() && $this->getContent()) {
            $db->query("INSERT INTO notice_table (userName, title, content, viewCount, date, filePath, password, contact) VALUES (:userName, :title, :content, :viewCount, :date, :filePath, :password, :contact);");
            $db->bind(":userName", $this->getWriter());
            $db->bind(":title", $this->getTitle());
            $db->bind(":content", $this->getContent());
            $db->bind(":viewCount", $this->getViewr());
            $db->bind(":date", $this->getDate());
            $db->bind(":filePath", $this->getFileName());
            $db->bind(":password", $this->getPassword());
            $db->bind(":contact", $this->getContact());

            $db->resultset();

            if($db->rowCount() == 1) {
                echo "<script>alert('글쓰기 성공!');";
                echo "window.location.href='/PenetrationTestStudy/homePages/freeBoardPages/mainFreeBoardPage.php'";
                echo "</script>";
            } else {
                echo "<script>alert('글쓰기 실패');";
                echo "window.location.href='/PenetrationTestStudy/homePages/freeBoardPages/mainFreeBoardPage.php'";
                echo "</script>";
                die();
            }
        } else {
            echo "<script>alert('제목과 내용을 적어주세요!');";
            echo "window.location.href='/PenetrationTestStudy/homePages/freeBoardPages/makeContentPage.php'";
            echo "</script>";
        }
    }


}