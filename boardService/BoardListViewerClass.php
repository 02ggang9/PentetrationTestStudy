<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/connectDatabase/DatabaseClass.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/boardService/PostClass.php");

class BoardListViewer extends Post {

    private $search;
    private $sortMethod;
    private $searchMethod;
    private $date1;
    private $date2;

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

    public $row;

    public function __construct($searchMethod = "title", $date1, $date2) {
        $this->searchMethod = $searchMethod;
        $this->date1 = $date1;
        $this->date2 = $date2;
    }

    public function getSortMethod() {
        return $this->sortMethod;
    }

    public function getSearchMethod() {
        return $this->searchMethod;
    }

    public function getRow() {
        return $this->row;
    }

    public function getSearch() {
        return $this->search;
    }

    public function getDate1() {
        return $this->date1;
    }

    public function getDate2() {
        return $this->date2;
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

    public function setSortMethod($sortMethod) {
        $this->sortMethod = $sortMethod;
    }

    public function setSearchMethod($searchMethod) {
        $this->searchMethod = $searchMethod;
    }

    public function setPage($page) {
        $this->page = $page;
    }

    public function titleSearchMethod(Database $db) {
        $db->query("SELECT * FROM notice_table WHERE title LIKE :title AND date BETWEEN :date1 AND :date2 LIMIT :startNumber, :list");
        $db->bind(":title", "%" . $this->getSearch() . "%");
        $db->bind(":date1", $this->getDate1());
        $db->bind(":date2", $this->getDate2());
        $db->bind(":startNumber", $this->getStartNumber());
        $db->bind(":list", $this->getList());
        $this->row = $db->resultsetAssoc();
        $this->printList();
    }

    public function writerSearchMethod(Database $db) {
        $db->query("SELECT * FROM notice_table WHERE userName LIKE :userName AND date BETWEEN :date1 AND :date2 LIMIT :startNumber, :list");
        $db->bind(":userName", "%" . $this->getSearch() . "%");
        $db->bind(":date1", $this->getDate1());
        $db->bind(":date2", $this->getDate2());
        $db->bind(":startNumber", $this->getStartNumber());
        $db->bind(":list", $this->getList());
        $this->row = $db->resultsetAssoc();
        $this->printList();
    }

    public function contentSearchMethod(Database $db) {
        $db->query("SELECT * FROM notice_table WHERE content LIKE :content AND date BETWEEN :date1 AND :date2 LIMIT :startNumber, :list");
        $db->bind(":content", "%" . $this->getSearch() . "%");
        $db->bind(":date1", $this->getDate1());
        $db->bind(":date2", $this->getDate2());
        $db->bind(":startNumber", $this->getStartNumber());
        $db->bind(":list", $this->getList());
        $this->row = $db->resultsetAssoc();
        $this->printList();
    }

    public function defalutSearchMethod(Database $db) {
        $db->query("SELECT * FROM notice_table LIMIT :startNumber, :list");
        $db->bind(":startNumber", $this->getStartNumber());
        $db->bind(":list", $this->getList());
        $this->row = $db->resultsetAssoc();
        $this->printList();
    }


    public function viewList(Database $db) {
        if($this->getSearchMethod() == "title") $this->titleSearchMethod($db);
        elseif($this->getSearchMethod() == "writer") $this->writerSearchMethod($db);
        elseif($this->getSearchMethod() == "content") $this->contentSearchMethod($db);
        else $this->defalutSearchMethod($db);
    }

    private function printList() {
        foreach($this->row AS $val) {
            echo "<tbody><tr><td></td>";
            echo "<td><div class='widget-26-job-title'>" . $val["userName"] . "</div></td>";
            echo "<td><div class='widget-26-job-title'><a href='viewFreeBoardPage.php?title=" . $val["title"] . "'>" .  $val["title"] . "</div></td>";
            echo "<td><div class='widget-26-job-title'>" . $val["date"] . "</div></td>";
            echo "<td><div class='widget-26-job-title'>" . $val["viewCount"] . "</div></td>";
            echo "</tr></tbody>";
        }
    }
    
    /*
    정렬 방식
    */

    private function writerSortingMethod(Database $db) {
        $db->query("SELECT * FROM notice_table ORDER BY userName DESC LIMIT :startNumber, :list");
        $db->bind(":startNumber", $this->getStartNumber());
        $db->bind(":list", $this->getList());
        $this->row = $db->resultsetAssoc();
        $this->printList();
    }

    private function titleSortingMethod(Database $db) {
        $db->query("SELECT * FROM notice_table ORDER BY title DESC LIMIT :startNumber, :list");
        $db->bind(":startNumber", $this->getStartNumber());
        $db->bind(":list", $this->getList());
        $this->row = $db->resultsetAssoc();
        $this->printList();
    }

    private function dateSortingMethod(Database $db) {
        $db->query("SELECT * FROM notice_table ORDER BY date DESC LIMIT :startNumber, :list");
        $db->bind(":startNumber", $this->getStartNumber());
        $db->bind(":list", $this->getList());
        $this->row = $db->resultsetAssoc();
        $this->printList();
    }

    private function hitSortingMethod(Database $db) {
        $db->query("SELECT * FROM notice_table ORDER BY viewCount DESC LIMIT :startNumber, :list");
        $db->bind(":startNumber", $this->getStartNumber());
        $db->bind(":list", $this->getList());
        $this->row = $db->resultsetAssoc();
        $this->printList();
    }

    public function viewSortedList(Database $db) {
        if($this->getSortMethod() == "writer") $this->writerSortingMethod($db);
        elseif($this->getSortMethod() == "title") $this->titleSortingMethod($db);
        elseif($this->getSortMethod() == "date") $this->dateSortingMethod($db);
        else $this->hitSortingMethod($db);
    }


    /*
    페이징
    */

    public function BoardPaging(Database $db) {
        $db->query("SELECT * FROM notice_table");
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
            echo "<a  style='color: black; text-decoration-line: none;' href='mainFreeBoardPage.php?searchList=" . $this->getSearchMethod() . "&search=" . $this->getSearch() . "&date1=" . $this->getDate1() . "&date2=" . $this->getDate2() . "&page=" . $i . "'>[" . $i . "]&nbsp;</a>";
        }
    }


}