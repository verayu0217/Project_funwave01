<?php
require_once("method/pdo-connect.php");

$student_id=$_GET["student_id"];

if(isset($_POST["action"])&&($_POST["action"]=="delete")){

    $sql_query="DELETE FROM student_list WHERE student_id=?";
    $stmt=$db_host -> prepare($sql_query);

    try{

        $stmt->execute([$student_id]);


    }catch(PDOException $e){
        echo $e->getMessage();
    }

    //重新導向回到主畫面
    header("Location: student-list.php");
}else{

    $sql_select="SELECT student_id ,student_name ,student_gender ,student_birthday ,student_phone ,student_email ,student_address ,s_emergency_contact ,s_emergency_contact_no FROM student_list WHERE student_id=?";
    $stmt=$db_host->prepare($sql_select);

    try{

        $stmt->execute([$student_id]);

        $row=$stmt->fetch(PDO::FETCH_ASSOC);

    }catch(PDOException $e){
//        echo $e->getMessage();
    }

}




?>


<!doctype html>
<html lang="en">
<head>
    <title>刪除學員資料</title>
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
                <a role="button" href="student-list.php" class="btn btn-primary">返回</a>
            </div>
        </div>
        <article class="article col-9 shadow-sm"> <!--content-->

            <div>

                <form action="" method="post">
                    <div class="col-md-5 m-3">
                        <label for="student_id" class="form-label">編號</label>
                        <input type="text" class="form-control-plaintext" id="student_id" name="student_id" value="<?= $row['student_id'] ?>" readonly>
                    </div>

                    <div class="col-md-5 m-3">
                        <label for="student_name" class="form-label">姓名</label>
                        <input type="text" class="form-control-plaintext" id="student_name" name="student_name" value="<?= $row['student_name'] ?>" readonly>
                    </div>
                    <div class="col-md-5 m-3">
                        <label for="student_gender" class="form-label">性別</label>
                        <input type="text" class="form-control-plaintext" id="student_gender" name="student_gender" value="<?=$row['student_gender'] ?>" readonly>
                    </div>
                    <div class="col-md-5 m-3">
                        <label for="student_birthday" class="form-label">出生年月日</label>
                        <input type="text" class="form-control-plaintext" id="student_birthday" name="student_birthday" value="<?=$row['student_birthday'] ?>" readonly>
                    </div>
                    <div class="col-md-5 m-3">
                        <label for="student_phone" class="form-label">連絡電話</label>
                        <input type="text" class="form-control-plaintext" id="student_phone" name="student_phone" value="<?=$row['student_phone'] ?>" readonly>
                    </div>
                    <div class="col-md-5 m-3">
                        <label for="student_email" class="form-label">電子郵件</label>
                        <input type="text" class="form-control-plaintext" id="student_email" name="student_email" value="<?=$row['student_email'] ?>" readonly>
                    </div>
                    <div class="col-md-5 m-3">
                        <label for="student_address" class="form-label">住址</label>
                        <input type="text" class="form-control-plaintext" id="student_address" name="student_address" value="<?=$row['student_address'] ?>" readonly>
                    </div>
                    <div class="col-md-5 m-3">
                        <label for="s_emergency_contact" class="form-label">緊急聯絡人</label>
                        <input type="text" class="form-control-plaintext" id="s_emergency_contact" name="s_emergency_contact" value="<?=$row['s_emergency_contact'] ?>" readonly>
                    </div>
                    <div class="col-md-5 m-3">
                        <label for="s_emergency_contact_no" class="form-label">緊急聯絡人電話</label>
                        <input type="text" class="form-control-plaintext" id="s_emergency_contact_no" name="s_emergency_contact_no" value="<?=$row['s_emergency_contact_no'] ?>" readonly>
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