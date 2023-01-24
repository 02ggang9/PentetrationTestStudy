<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/connectDatabase/DatabaseClass.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/connectDatabase/UserServiceClass.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/questionService/ReadQuestionPostClass.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/questionService/DeleteQuestionPostClass.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) ."/PenetrationTestStudy/questionService/AnswerQuestionPostClass.php");

if(!isset($_POST["mode"])) $_POST["mode"] = "";
if(!isset($_SESSION["login_user"])) $_SESSION["login_user"] = "";

$db = new Database();
$user = new UserService();
$delete = new DeleteQuestionPost();
// $answer = new AnswerQuestionPost();


if($_SERVER['REQUEST_METHOD'] == "POST") {
    $post = new ReadQuestionPost($_POST["idx"]);
    
    if($post->checkPassword($db, $_POST["password"])) {
        echo "<script>alert('통과!');</script>";

        $post->readQuestionPost($db);
    } else {
        echo "<script>alert('비밀번호가 다릅니다!');";
        echo "history.back()";
        echo "</script>";
        die();
    }

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
            <div class="col-lg-4 col-sm-12 text-lg-start text-center">
                <h5>작성일 : <?php echo $post->getDate();?>    연락처 : <?php echo $post->getContact();?> </h5>
            </div>
            <div class="col-lg-6 col-sm-12 text-lg-end text-center">
                <h5>답변완료 : <?php echo $post->getCheckAnswer();?></h5>
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
    </br>
    </br>   
    
    <div class="container">
    <hr>
        <?php 
        if($post->getCheckAnswer() == "답변완료") { ?>
        <div class="row">
            <div class= "col-12">
                <h1>관리자 답변</h1>
            </div>
        </div>
        <div class="row">
            <div class= "col-12">
                <h5>GGANG9</h5>
            </div>
        </div>
        <div class="row">
            <div class= "col-12">
                <p><?php echo $post->getAdminAnswer(); ?></p>
            </div>
        </div>
        <?php } ?>
    </div>
    

    <div class="container">
        <form method="POST" action="deleteQuestionPostProcess.php">
        <?php
            echo "<input type='hidden' name='password' value='" . $post->getPassword() . "'>"; 
            echo "<button type='submit' class='btn btn-outline-dark'>글 삭제</button>";
        ?>
        </form>
        <?php
        if($_SESSION["login_user"] == "admin") {
            echo "<form method='POST' action='answerQuestionPostProcess.php'>";
            echo "<input type='hidden' name='idx' value='" . $post->getIdx() . "'>";
            echo "<div class='container'>";
            echo "<div class='row'>";
            echo "<textarea class='form-control' name='answer'></textarea>";
            echo "</div>";
            echo "</div>"; 
            echo "<button type='submit' class='btn btn-outline-dark'>댓글 달기</button>";
            echo "</form>";
        }
            
        ?>
    </div>
    
    
    




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
