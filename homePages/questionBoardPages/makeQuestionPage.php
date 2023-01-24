<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/connectDatabase/DatabaseClass.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/connectDatabase/UserServiceClass.php");

$user = new UserService();


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
    <!--  -->
    
    <!-- ggang9 Picture -->
    <div class="container">
        <main>
            <div class="py-5 text-center">
                <img class="d-block mx-auto mb-4" src="https://sitem.ssgcdn.com/87/70/47/item/1000026477087_i1_1200.jpg" alt width="200" height="200">
                <h2>글쓰기</h2>
            </div>
        </main>
    </div>
    <!--  -->


    <form method="POST" action="makeQuestionProcess.php">

        <!-- input Title Container -->
        <div class="container">
            <div class="row">
                <div class="col-12 card-margin">
                    <div class="card search-form">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-18">
                                    <div class="row no-gutters">
                                        <div class="col-18">
                                            <input type="text" placeholder="Title" class="form-control" id="title" name="title">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br/>
        <!--  -->

        <!-- input Content Container -->
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <textarea class="form-control" name="content" placeholder="내용"></textarea>
                </div>
            </div>
        </div>
        <br/>
        <!--  -->

        <!-- input File Container -->
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <input type="text" placeholder="연락처" class="form-control" id="contact" name="contact">
                </div>
            </div>		
        </div>
        <br/>
        <!--  -->

        <!-- input File Container -->
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <input type="text" placeholder="비밀번호" class="form-control" id="password" name="password">
                </div>
            </div>		
        </div>
        <br/>
        <!--  -->



        <!-- complete button -->
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="col-md-6">
                        <button class="btn btn-md btn-primary btn-outlined float-right" id="_submit" name="_submit" type="submit" value="1">
                            완료
                        </button> 
                    </div>
                </div>
            </div>
        </div>
        <!--  -->
    </form>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
