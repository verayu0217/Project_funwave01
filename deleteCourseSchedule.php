<?php
require_once("method/pdo-connect.php");

$schedule_id=$_GET["schedule_id"];

if(isset($_POST["action"])&&($_POST["action"]=="delete")){

    $sql_query="DELETE FROM course_schedule WHERE schedule_id=?";
    $stmt=$db_host -> prepare($sql_query);

    try{

        $stmt->execute([$schedule_id]);


    }catch(PDOException $e){
        echo $e->getMessage();
    }

    //重新導向回到主畫面
    header("Location: course-schedule-list.php");
}else{

    $sql_select="SELECT schedule_id, coach_id, course_code, course_time FROM course_schedule WHERE schedule_id=?";
    $stmt=$db_host->prepare($sql_select);

    try{

        $stmt->execute([$schedule_id]);

        $row=$stmt->fetch(PDO::FETCH_ASSOC);

    }catch(PDOException $e){
//        echo $e->getMessage();
    }

}






?>


<!doctype html>
<html lang="en">
<head>
    <title>刪除開課資料</title>
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
                <a role="button" href="course-schedule-list.php" class="btn btn-primary">返回</a>
            </div>
        </div>
        <article class="article col-9 shadow-sm"> <!--content-->

            <div>

                <form action="" method="post">
                    <div class="col-md-5 m-3">
                        <label for="course_code" class="form-label">開課代碼</label>
                        <input type="text" class="form-control-plaintext" id="course_code" name="schedule_id" value="<?= $row['schedule_id'] ?>" readonly>
                    </div>
                    <div class="col-md-5 m-3">
                        <label for="course_name" class="form-label">教練代號</label>
                        <input type="text" class="form-control-plaintext" id="course_name" name="coach_id" value="<?= $row['coach_id'] ?>" readonly>
                    </div>
                    <div class="col-md-5 m-3">
                        <label for="course_level" class="form-label">課程代碼</label>
                        <input type="text" class="form-control-plaintext" id="course_level" name="course_code" value="<?= $row['course_code'] ?>" readonly>
                    </div>
                    <div class="col-md-5 m-3">
                        <label for="course_price" class="form-label">上課時段</label>
                        <input type="text" class="form-control-plaintext" id="course_price" name="course_time" value="<?= $row['course_time'] ?>" readonly>
                    </div>


                    <div class="col-md-5 m-3">

                        <input name="action" type="hidden" value="delete">
                        <button class="btn btn-danger" type="submit" onclick="javascript:return del()">刪除開課資料</button>
                    </div>

                </form>

            </div>

        </article> <!--/content-->
    </div>
</div>

<script>

    function del() {
        var msg = "確定確定要刪除這個開課表嗎？";
        if (confirm(msg)==true){
            return true;
        }else{
            return false;
        }
    }
</script>
</body>
</html>