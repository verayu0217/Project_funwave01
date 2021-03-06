<?php
require_once("method/pdo-connect.php");

if(isset($_POST["action"])&&($_POST["action"]=="update")){


    $sql_query="UPDATE student_list SET student_id=?, student_name=?,student_gender=?,student_birthday=?,student_phone=?,student_email=? ,student_address=? ,s_emergency_contact=? ,s_emergency_contact_no=? WHERE student_id=?";
    $stmt=$db_host-> prepare($sql_query);



    try{
        $stmt -> execute(array($_POST["student_id"], $_POST["student_name"], $_POST["student_gender"], $_POST["student_birthday"], $_POST["student_phone"],$_POST["student_email"],$_POST["student_address"],$_POST["s_emergency_contact"],$_POST["s_emergency_contact_no"],$_POST["student_id"]));

        $row=$stmt->fetch(PDO::FETCH_ASSOC);


    }catch(PDOException $e){
        echo $e->getMessage();
    }

    //重新導向回到主畫面 不知道為什麼停在原頁面不能直接看到修改的樣子
    header("Location: student-list.php");
}else{

    $sql_select="SELECT student_id ,student_name ,student_gender ,student_birthday ,student_phone ,student_email ,student_address ,s_emergency_contact ,s_emergency_contact_no FROM student_list WHERE student_id=?";
    $stmt=$db_host->prepare($sql_select);

    try{

        $stmt->execute(array($_GET["student_id"]));
        $row=$stmt->fetch(PDO::FETCH_ASSOC);

    }catch(PDOException $e){
        echo $e->getMessage();
    }
}



?>

<!doctype html>
<html lang="en">
<head>
    <title>修改學員資料</title>
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
                        <input type="text" class="form-control" id="student_id" name="student_id" value="<?= $row['student_id'] ?>" readonly>
                    </div>

                    <div class="col-md-5 m-3">
                        <label for="student_name" class="form-label">姓名</label>
                        <input type="text" class="form-control" id="student_name" name="student_name" value="<?= $row['student_name'] ?>">
                    </div>
                    <div class="col-md-5 m-3">
                        <label for="student_gender" class="form-label">性別</label>
                        <input type="text" class="form-control" id="student_gender" name="student_gender" value="<?=$row['student_gender'] ?>">
                    </div>
                    <div class="col-md-5 m-3">
                        <label for="student_birthday" class="form-label">出生年月日</label>
                        <input type="text" class="form-control" id="student_birthday" name="student_birthday" value="<?=$row['student_birthday'] ?>">
                    </div>
                    <div class="col-md-5 m-3">
                        <label for="student_phone" class="form-label">連絡電話</label>
                        <input type="text" class="form-control" id="student_phone" name="student_phone" value="<?=$row['student_phone'] ?>">
                    </div>
                    <div class="col-md-5 m-3">
                        <label for="student_email" class="form-label">電子郵件</label>
                        <input type="text" class="form-control" id="student_email" name="student_email" value="<?=$row['student_email'] ?>">
                    </div>
                    <div class="col-md-5 m-3">
                        <label for="student_address" class="form-label">住址</label>
                        <input type="text" class="form-control" id="student_address" name="student_address" value="<?=$row['student_address'] ?>">
                    </div>
                    <div class="col-md-5 m-3">
                        <label for="s_emergency_contact" class="form-label">緊急聯絡人</label>
                        <input type="text" class="form-control" id="s_emergency_contact" name="s_emergency_contact" value="<?=$row['s_emergency_contact'] ?>" >
                    </div>
                    <div class="col-md-5 m-3">
                        <label for="s_emergency_contact_no" class="form-label">緊急聯絡人電話</label>
                        <input type="text" class="form-control" id="s_emergency_contact_no" name="s_emergency_contact_no" value="<?=$row['s_emergency_contact_no'] ?>">
                    </div>

                    <div class="col-md-5 m-3">
                        <input name="action" type="hidden" value="update">
                        <button class="btn btn-primary" type="submit" onclick="submitFun()">更新學員資料</button>
                    </div>
                </form>
            </div>

        </article> <!--/content-->
    </div>
</div>

<script>
    function submitFun(){
        alert("已更新完成");
    }
</script>
</body>
</html>

