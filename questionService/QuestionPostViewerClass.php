<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/connectDatabase/DatabaseClass.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/questionService/QuestionPostClass.php");

class QuestionPostViewer extends QuestionPost {

    private $findMethod;
    private $search;
    private $sorting;

    private $page = 1;
    private $list = 5;
    private $block_ct = 5;
    private $blockNumber;
    private $countRow;
    private $blockStart;
    private $blockEnd;
    private $totalPage;
    private $totalBlock;
    private $startNumber;

    public function __construct($findMethod) {
        $this->findMethod = $findMethod;
    }

    private function getFindMethod() {
        return $this->findMethod;
    }

    private function getSearch() {
        return $this->search;
    }

    private function getSorting() {
        return $this->sorting;
    }

    public function getStartNumber() {
        return $this->startNumber;
    }

    public function getList() {
        return $this->list;
    }

    public function setSearch($search) {
        $this->search = $search;
    }

    public function setSorting($sorting) {
        $this->sorting = $sorting;
    }

    public function setFindMethod($findMethod) {
        $this->findMethod = $findMethod;
    }

    public function setPage($page) {
        $this->page = $page;
    }


    public function titleSearchMethod(Database $db) {
        $db->query("SELECT * FROM question_table WHERE title LIKE :title LIMIT :startNumber, :list");
        $db->bind(":title", "%" . $this->getSearch() . "%");
        $db->bind(":startNumber", $this->getStartNumber());
        $db->bind(":list", $this->getList());
        $this->row = $db->resultsetAssoc();
        $this->printList();
    }

    public function idxSearchMethod(Database $db) {
        $db->query("SELECT * FROM question_table WHERE idx = :idx");
        $db->bind(":idx", $this->getSearch());
        $this->row = $db->resultsetAssoc();
        $this->printList();
    }

    public function contactSearchMethod(Database $db) {
        $db->query("SELECT * FROM question_table WHERE contact = :contact LIMIT :startNumber, :list");
        $db->bind(":contact", $this->getSearch());
        $db->bind(":startNumber", $this->getStartNumber());
        $db->bind(":list", $this->getList());
        $this->row = $db->resultsetAssoc();
        $this->printList();
    }

    public function defalutSearchMethod(Database $db) {
        $db->query("SELECT * FROM question_table LIMIT :startNumber, :list");
        $db->bind(":startNumber", $this->getStartNumber());
        $db->bind(":list", $this->getList());
        $this->row = $db->resultsetAssoc();
        $this->printList();
    }


    public function viewList(Database $db) {
        if($this->getFindMethod() == "title") $this->titleSearchMethod($db);
        elseif($this->getFindMethod() == "idx") $this->idxSearchMethod($db);
        elseif($this->getFindMethod() == "contact") $this->contactSearchMethod($db);
        else $this->defalutSearchMethod($db);
    }

    private function printList() {
        foreach($this->row AS $val) {
            echo "<tbody><tr><td></td>";
            echo "<td><div class='widget-26-job-title'>" . $val["idx"] . "</div></td>";
            echo "<td><div class='widget-26-job-title'><a href='checkQuestionPostPassword.php?idx=" . $val["idx"] . "'>" .  $val["title"] . "</div></td>";
            echo "<td><div class='widget-26-job-title'>" . $val["date"] . "</div></td>";
            echo "<td><div class='widget-26-job-title'>" . $val["checkAnswer"] . "</div></td>";
            echo "</tr></tbody>";
        }
    }
    
    /*
    정렬 방식
    */

    private function idxSortingMethod(Database $db) {
        $db->query("SELECT * FROM question_table ORDER BY idx LIMIT :startNumber, :list");
        $db->bind(":startNumber", $this->getStartNumber());
        $db->bind(":list", $this->getList());
        $this->row = $db->resultsetAssoc();
        $this->printList();
    }

    private function titleSortingMethod(Database $db) {
        $db->query("SELECT * FROM question_table ORDER BY title DESC LIMIT :startNumber, :list");
        $db->bind(":startNumber", $this->getStartNumber());
        $db->bind(":list", $this->getList());
        $this->row = $db->resultsetAssoc();
        $this->printList();
    }

    private function dateSortingMethod(Database $db) {
        $db->query("SELECT * FROM question_table ORDER BY date DESC LIMIT :startNumber, :list");
        $db->bind(":startNumber", $this->getStartNumber());
        $db->bind(":list", $this->getList());
        $this->row = $db->resultsetAssoc();
        $this->printList();
    }

    private function hitSortingMethod(Database $db) {
        $db->query("SELECT * FROM question_table ORDER BY viewCount DESC LIMIT :startNumber, :list");
        $db->bind(":startNumber", $this->getStartNumber());
        $db->bind(":list", $this->getList());
        $this->row = $db->resultsetAssoc();
        $this->printList();
    }

    public function viewSortedList(Database $db) {
        if($this->getSorting() == "idx") $this->idxSortingMethod($db);
        elseif($this->getSorting() == "title") $this->titleSortingMethod($db);
        elseif($this->getSorting() == "date") $this->dateSortingMethod($db);
        else $this->hitSortingMethod($db);
    }


    /*
    페이징
    */

    public function BoardPaging(Database $db) {
        $db->query("SELECT * FROM question_table");
        $db->execute();
        $this->countRow = $db->rowCount();
        $this->blockNumber = ceil($this->page/$this->block_ct);
        $this->blockStart = (($this->blockNumber -1) * $this->block_ct);
        $this->blockEnd = ($this->blockStart + $this->block_ct) -1;
        $this->totalPage = ceil($this->countRow/$this->list);
        if($this->blockEnd > $this->totalPage) $this->blockEnd = $this->totalPage;
        $this->totalBlock = ceil($this->totalPage/$this->block_ct);
        $this->startNumber = ($this->page -1) * $this->list;
    }

    public function pageButton() {
        for($i=$this->blockStart+1; $i<=$this->blockEnd; $i++) {
            echo "<a  style='color: black; text-decoration-line: none;' href='mainQuestionBoardPage.php?findMethod=" . $this->getFindMethod() . "&search=" . $this->getSearch() . "&page=" . $i . "'>[" . $i . "]&nbsp;</a>";
        }
    }


    


}