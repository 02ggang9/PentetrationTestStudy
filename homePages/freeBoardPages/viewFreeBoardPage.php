<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/connectDatabase/DatabaseClass.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/connectDatabase/UserServiceClass.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/boardService/BoardListViewerClass.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/boardService/ReadPostClass.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/boardService/RecommandPostClass.php");

$db = new Database();
$user = new UserService();

if(!isset($_SESSION["login_user"])) $_SESSION["login_user"] = NULL;

$viewUserName = $_SESSION["login_user"];

if($_SERVER['REQUEST_METHOD'] == "GET") {
    $post = new readPost($_GET["title"]);
    $post->readContent($db);
    $post->viewCountUp($db);
    $recommand = new RecommandPost($_GET["title"], $viewUserName);
    
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
    <!--  -->

    <!-- read Post -->
    <div class="container">
        <br>
        <main>
            <div class="py-5 text-center">
                <?php 
                    if($recommand->alreadyRecommand($db)) {
                        echo '<img class="d-block mx-auto mb-4" src="https://i.pinimg.com/originals/88/1c/14/881c14ed6f5108423895617e3f003273.png" alt width="200" height="200">';
                    } else {
                        echo '<img class="d-block mx-auto mb-4" src="http://m.ezendolls.com/web/product/big/201803/609_shop1_972362.jpg" alt width="200" height="200">';
                    }
                ?>
                <!-- <img class="d-block mx-auto mb-4" src="http://m.ezendolls.com/web/product/big/201803/609_shop1_972362.jpg" alt width="200" height="200"> -->
            </div>
        </main>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1><?php echo $post->getTitle();?></h1>
            </div>
        </div>
        </br>
        <div class="row">
            <div class="col-lg-1 col-sm-12 text-lg-start text-center">
                <h4><?php echo $post->getWriter();?></h4>
            </div>
            <div class="col-lg-4 col-sm-12 text-lg-start text-center">
                <h5>작성일 : <?php echo $post->getDate();?>    조회수 : <?php echo $post->getViewr();?></h5>
            </div>
            <div class="col-lg-6 col-sm-12 text-lg-end text-center">
                <?php
                
                echo "<button class='btn btn-link float-right'><a style='color:black' href='recommandPostProcess.php?title=" . $post->getTitle() . "'> 따봉</a></button>";
                echo "<button class='btn btn-link float-right'><a style='color:black' href='cancleRecommandPostProcess.php?title=" . $post->getTitle() . "'> 취소</a></button>";

                ?>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <p><?php echo $post->getContent();?></p>
            </div>
        </div>
    </div>   
    </br>
    

    <div class="container">
        <?php
        echo "<button class='btn btn-md btn-primary btn-outlined float-right'><a style='color:white' href='fileDownloadProcess.php?title=" . $post->getTitle() . "'> 파일 다운로드</a></button>";
            echo " ";
            if($post->getWriter() == $viewUserName) {
                echo " ";
                echo "<button class='btn btn-md btn-primary btn-outlined float-right'><a style='color:white' href='deletePostProcess.php?title=" . $post->getTitle() . "'> 글삭제</a></button>";
                echo " ";
                echo "<button class='btn btn-md btn-primary btn-outlined float-right'><a style='color:white' href='modifyPostPage.php?title=" . $post->getTitle() . "'> 수정</a></button>";
            }
        ?>
    </div>
    
    
    




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
