<?php

if($_SERVER["REQUEST_METHOD"] == "GET") {
    $idx = $_GET["idx"];

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
    

    <!-- ggang9 Picture and title Container -->
    <div class="container">
        <main>
            <div class="py-5 text-center">
                    <img class="d-block mx-auto mb-4" src="https://sitem.ssgcdn.com/87/70/47/item/1000026477087_i1_1200.jpg" alt width="200" height="200">
                    <h2>비밀번호 입력</h2>
            </div>
		</main>
    </div>
    <!--  -->

    <!-- Search bar Container -->
    <form method="POST" action="viewQuestionPostPage.php">
        <div class="container">
            <div class="row">
                <div class="col-12 card-margin">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-12">
                                <?php echo "<input type='hidden' name='idx' value='" . $idx . "'>"; ?>
                                <input type="text" placeholder="비밀번호" class="form-control" id="password" name="password">
                                </br>
                                <div class="d-flex justify-content-center">
                                    <div class="row">
                                        <div class="align-self-center">
                                            <button type="submit" class="form-control">제출</button>
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
</body>
            