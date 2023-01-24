<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/connectDatabase/DatabaseClass.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/boardService/PostClass.php");


class FileDownload extends Post {

    public $targetDir;

    private function getTargetDir() {
        return $this->targetDir;
    }


    public function __construct($title) {
        $this->title = $title;

    }

    public function fileDownload(Database $db) {
        $db->query("SELECT * FROM notice_table WHERE title = :title");
        $db->bind(":title",$this->getTitle());
        $this->row = $db->resultsetAssoc();

        foreach($this->row AS $val) {
            $this->setFileName($val["filePath"]);
        }

        $this->targetDir = $_SERVER["DOCUMENT_ROOT"] . "/PenetrationTestStudy/storeImages/" . $this->getFileName();

        if(file_exists($this->getTargetDir())) { # Hum... 이상하네
            if(filesize($this->getTargetDir()) == 0) {
                echo "<script>alert('파일이 존재하지 않습니다!');";
                echo "window.location.href='/PenetrationTestStudy/homePages/freeBoardPages/mainFreeBoardPage.php'";
                echo "</script>";
                die();
            }
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=" . $this->getTargetDir());
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: " . filesize($this->getTargetDir()));
            header("Cache-Control: cache.must-revalidate");
            header("Pragma: no-cache");
            header("Expires: 0");
    
            if(is_file($this->getTargetDir())) {
                $fp = fopen($this->getTargetDir(), "r");
                while(!feof($fp)) {
                    $buf = fread($fp, 8096);
                    $read = strlen($buf);
                    print($buf);
                    flush();
                }
                fclose($fp);

            }
        } 
    }


}