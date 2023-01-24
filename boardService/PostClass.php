<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/connectDatabase/DatabaseClass.php");


class Post {

    protected $title;
    protected $writer;
    protected $content;
    protected $viewr;
    protected $date;
    protected $fileTmpName;
    protected $fileName;
    protected $fileType;
    protected $password;
    protected $contact;
    protected $row;

    public function getTitle() {
        return $this->title;
    }

    public function getWriter() {
        return $this->writer;
    }

    public function getContent() {
        return $this->content;
    }

    public function getViewr() {
        return $this->viewr;
    }

    public function getDate() {
        return $this->date;
    }

    public function getFileTmpName() {
        return $this->fileTmpName;
    }

    public function getFileName() {
        return $this->fileName;
    }

    public function getFileType() {
        return $this->fileType;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getContact() {
        return $this->contact;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setWriter($writer) {
        $this->writer = $writer;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function setViewer($viewr) {
        $this->viewr = $viewr;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function setPasword($password) {
        $this->password = $password;
    }
    
    public function setFileName($fileName) {
        $this->fileName = $fileName;
    }



}