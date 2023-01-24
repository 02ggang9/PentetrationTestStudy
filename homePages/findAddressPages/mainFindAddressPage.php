<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/connectDatabase/DatabaseClass.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/connectDatabase/UserServiceClass.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/boardService/BoardListViewerClass.php");


$db = new Database();
$user = new UserService();

if(!isset($_GET["search"])) $_GET["search"] = "";
if(!isset($_GET["searchList"])) $_GET["searchList"] = "defalut";
if(!isset($_GET["date1"])) $_GET["date1"] = "1000-00-00";
if(!isset($_GET["date2"])) $_GET["date2"] = "3000-00-00";

if($_GET["date1"] == "") $_GET["date1"] = "1000-00-00";
if($_GET["date2"] == "") $_GET["date2"] = "3000-00-00";

if($_SERVER["REQUEST_METHOD"] == "GET") {
    $post = new BoardListViewer($_GET["searchList"], $_GET["date1"], $_GET["date2"]);

    if(!isset($_GET["page"])) {
        $post->setPage(1);
    } else {
        $post->setPage($_GET["page"]);
    }

    $post->setSearch($_GET["search"]);
    $post->BoardPaging($db);
}

?>


<!DOCTYPE html>
<html leng="en">
<head>
    <meta charset="UTF-8">
    <title>이수빈 PHP Web Hacking Test Site</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- navigation bar list -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <div class="container">
            <a href="\PenetrationTestStudy\homePages\mainHomePages\mainHomePage.php" class="navbar-brand"><img class="img-responsive" src="https://sitem.ssgcdn.com/87/70/47/item/1000026477087_i1_1200.jpg" height="25" alt="GGang9"></a>
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li class="nav-item"><a class="nav-link" href="\PenetrationTestStudy\homePages\findAddressPages\mainFindAddressPage.php">주소검색</a></li>
                <li class="nav-item"><a class="nav-link" href="\PenetrationTestStudy\homePages\freeBoardPages\mainFreeBoardPage.php">자유 게시판</a></li>
                <li class="nav-item"><a class="nav-link" href="\PenetrationTestStudy\homePages\questionBoardPages\mainQuestionBoardPage.php">문의 게시판</a></li>
            </ul>
            <ul class="navbar-nav col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                <?php 
                if(!$user->getSession()) { ?> 
                    <li class="nav-item"><a class="nav-link" href="\PenetrationTestStudy\homePages\signUpPages\mainSignUpPage.php">회원가입</a></li>
                    <li class="nav-item"><a class="nav-link" href="\PenetrationTestStudy\homePages\loginPages\mainLoginPage.php">로그인</a></li>
                <?php } else {?>
                <li class="nav-item"><a class="nav-link" href="\PenetrationTestStudy\homePages\logoutPages\mainLogoutPage.php">로그아웃</a></li>
                <li class="nav-item"><a class="nav-link" href="\PenetrationTestStudy\homePages\myPages\mainMyPage.php">마이페이지</a></li>
                <?php } ?>
            </ul>
        </div>
    </nav>

    <!-- ggang9 Picture and title Container -->
    <div class="container">
        <main>
            <div class="py-5 text-center">
                    <img class="d-block mx-auto mb-4" src="https://sitem.ssgcdn.com/87/70/47/item/1000026477087_i1_1200.jpg" alt width="200" height="200">
                    <h2>주소 검색</h2>
            </div>
		</main>
    <!--  -->
    
    <!-- Search bar Container -->
    <form method="GET" action="mainFreeBoardPage.php">
        <div class="container">
            <div class="row">
                <div class="col-12 card-margin">
                    <div class="card-body p-0">
                        
                            <div class="row">
                                <div class="col-12">
                                    <div class="row no-gutters">
                                        <div class="col-lg-2 col-md-3 col-sm-12 p-0">
                                            <select class="form-select" name="region">
                                                <option value="서울특별시">서울특별시</option>
                                                <option value="writer">작성자</option>
                                                <option value="content">내용</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-8 col-md-6 col-sm-12 p-0">
                                            <input type="text" placeholder="Search..." class="form-control" id="search" name="search">
                                        </div>
                                        <div class="col-lg-2 col-md-3 col-sm-12 p-0">
                                            <button type="submit" class="form-control">Search</button>
                                        </div>
                                    </div>
                                    </br>
                                    <div class="d-flex justify-content-center">
                                        <div class="row">
                                            <div class="align-self-center">
                                                <input type="date" name="date1"> ~ <input type="date" name="date2">
                                            </div>
                                        </div>
                                    </div>
                                    </br>
                                </div>
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!--  -->

        <!--  -->
        <div class="contanier">
            <p><p>
            <div class="row">
                <div class="col-12">
                    <div class="card card-margin">
                        <div class="card-body">
                            <div class="row search-body">
                                <div class="col-lg-12">
                                    <div class="search-result">
                                        <div class="result-header">
                                            <div class="row">
                                            </div>
                                        </div>
                                        <div class="result-body">
                                            <div class="table-responsive">
                                            </br>
                                                <table class="table widget-26">
                                                    <thead>
                                                        <tr>
                                                            <td> </td>
                                                            <td>
                                                                <div class="widget-26-job-title">
                                                                    <a style="text-decoration-line: none;" href='mainFreeBoardPage.php?sorting=writer'>작성자</a>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="widget-26-job-title">
                                                                    <a style="text-decoration-line: none;" href='mainFreeBoardPage.php?sorting=title'>제목</a>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="widget-26-job-title">
                                                                    <a style="text-decoration-line: none;" href='mainFreeBoardPage.php?sorting=date'>날짜</a>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="widget-26-job-title">
                                                                    <a style="text-decoration-line: none;" href='mainFreeBoardPage.php?sorting=hit'>조회수</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </thead>
                                                    <?php 

                                                        if(!isset($_GET["sorting"])) {
                                                            if($_GET["searchList"] == "title") $post->setSearchMethod("title");
                                                            elseif($_GET["searchList"] == "writer") $post->setSearchMethod("writer");
                                                            elseif($_GET["searchList"] == "content") $post->setSearchMethod("content");
                                                            else $post->setSearchMethod("defalut");
    
                                                            $post->viewList($db);
                                                        } else {
                                                            $post->setSortMethod($_GET["sorting"]);
                                                            $post->viewSortedList($db);
                                                        }
                                                    ?>
                                                </table>
                                            </div>
                                        </div>       
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><br>
            
            <div class="container">
                <div class="row">
                    <div class="d-flex justify-content-center">
                        
                        <?php
                            $post->pageButton();
                        ?>
                    </div>
                </div>
            </div>
    </form>
        <!--  -->

        <!-- button to makeContent.php -->
            </br>
            <div class="row">
                <div class="col-md-6">
                    <button class='btn btn-md btn-primary btn-outlined float-right'><a style='color:white' href='makeContentPage.php'>글쓰기</a></button>
                </div>
            </div>
        <!--  -->

        </div>
    



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
