<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/connectDatabase/DatabaseClass.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/connectDatabase/UserServiceClass.php");

$user = new UserService();


?>


<!DOCTYPE html>
<html leng="en">
<head>
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <meta charset="UTF-8">
    <title>이수빈 PHP Web Hacking Test Site</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./../intro.css">
    
</head>
<body>
    <!-- navigation bar list -->
    <div class="container">
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
        
    </div>
    <hr>
    <div class="container">
        <main>
            <div class="py-5 text-center">
                <img class="d-block mx-auto mb-4" src="http://gdimg.gmarket.co.kr/1114235699/still/600?ver=1631606970" alt width="350" height="350">
            </div>
        </main>
    </div>

    <div class="container">
            <div class="text_box" data-trigger>
                <span class="text"></span>
            </div>
        </div>
    <!--  -->
    
    
    <script type="text/javascript" src="./../homePageIntro.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
