<?php
require_once("method/pdo-connect.php");

$course_code=$_GET["course_code"];

if(isset($_POST["action"])&&($_POST["action"]=="delete")){

    $sql_query="DELETE FROM course_list WHERE course_code=?";
    $stmt=$db_host -> prepare($sql_query);

    try{

        $stmt->execute([$course_code]);


    }catch(PDOException $e){
        echo $e->getMessage();
    }

    //重新導向回到主畫面
    header("Location: course-list.php");
}else{

    $sql_select="SELECT course_code, course_name, course_level, course_price,spot_code FROM course_list WHERE course_code=?";
    $stmt=$db_host->prepare($sql_select);

    try{

        $stmt->execute([$course_code]);

        $row=$stmt->fetch(PDO::FETCH_ASSOC);

    }catch(PDOException $e){
//        echo $e->getMessage();
    }

}






?>


<!doctype html>
<html lang="en">
<head>
    <title>刪除課程</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php require_once("./public/css.php") ?>

</head>
<body>
<div class="container-fluid">
    <div class="row">
        <?php require_once("./public/header.php") ?>
        <!--menu-->
        <aside class="col-lg-2 navbar-side shadow-sm">
            <?php require_once("./public/nav.php") ?>
        </aside>
        <!--/menu-->
        <div class="col-9 d-flex justify-content-between align-items-center button-group shadow-sm">
            <div>
                <a role="button" href="course-list.php" class="btn btn-primary">返回</a>
            </div>
        </div>
        <article class="article col-9 shadow-sm"> <!--content-->

                <div>

                    <form action="" method="post">
                        <div class="col-md-5 m-3">
                            <label for="course_code" class="form-label">課程代號</label>
                            <input type="text" class="form-control-plaintext" id="course_code" name="course_code" value="<?= $row['course_code'] ?>" readonly>
                        </div>
                        <div class="col-md-5 m-3">
                            <label for="course_name" class="form-label">課程名稱</label>
                            <input type="text" class="form-control-plaintext" id="course_name" name="course_name" value="<?= $row['course_name'] ?>" readonly>
                        </div>
                        <div class="col-md-5 m-3">
                            <label for="course_level" class="form-label">課程級別</label>
                            <input type="text" class="form-control-plaintext" id="course_level" name="course_level" value="<?= $row['course_level'] ?>" readonly>
                        </div>
                        <div class="col-md-5 m-3">
                            <label for="course_price" class="form-label">課程費用</label>
                            <input type="text" class="form-control-plaintext" id="course_price" name="course_price" value="<?= $row['course_price'] ?>" readonly>
                        </div>
                        <div class="col-md-5 m-3">
                            <label for="spot_code" class="form-label">浪點代號</label>
                            <input type="text" class="form-control-plaintext" id="spot_code" name="spot_code" value="<?=$row['spot_code'] ?>" readonly>
                        </div>

                        <div class="col-md-5 m-3">

                            <input name="action" type="hidden" value="delete">
                            <button class="btn btn-primary" type="submit">確定刪除這筆資料</button>
                        </div>

                    </form>

                </div>

        </article> <!--/content-->
    </div>
</div>
</body>
</html>