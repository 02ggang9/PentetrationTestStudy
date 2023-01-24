
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

    <!-- input user's login information container -->
    <div class="container">
        <main>
            <div class="py-5 text-center">
                <img class="d-block mx-auto mb-4" src="https://sitem.ssgcdn.com/87/70/47/item/1000026477087_i1_1200.jpg" alt width="200" height="200">
                <h2>로그인</h2>
            </div>
            <div class="row g-5">
                <div class="col-md-6 offset-md-3">
                    <form method="POST" action="\PenetrationTestStudy\homePages\loginPages\loginProcess.php">
                        <div class="col-12">
                            <label for="userId" class="form-label">User ID</label>
                            <input type="text" class="form-control" id="userId" name="userId">
                            </div><p>
                        <div>
                            <label for="userPw" class="form-label">User Password</label>
                            <input type="text" class="form-control" id="userPw" name="userPw">
                        </div>  
                        <div class="row pt-3">
                            <div class="col-md-12">
                                <input class="btn btn-md btn-primary btn-outlined float-right" id="_submit" name="_submit" type="submit" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>                        
        </main>
    </div>        
    <!--  -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
