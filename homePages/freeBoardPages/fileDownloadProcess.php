<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/connectDatabase/DatabaseClass.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/boardService/FileDownloadClass.php");

if($_SERVER["REQUEST_METHOD"] == "GET") {
    $db = new Database();
    $fileDownload = new FileDownload($_GET["title"]);

    $fileDownload->fileDownload($db);


}