<?php
require_once("method/pdo-connect.php");

if(isset($_POST["action"])&&($_POST["action"]=="update")){


    $sql_query="UPDATE course_schedule SET schedule_id=?, coach_id=?,course_code=?,course_time=? WHERE schedule_id=?";
    $stmt=$db_host-> prepare($sql_query);



    try{
        $stmt -> execute(array($_POST["schedule_id"],$_POST["coach_id"], $_POST["course_code"], $_POST["course_time"],$_POST["schedule_id"]));
        $row=$stmt->fetch(PDO::FETCH_ASSOC);


    }catch(PDOException $e){
        echo $e->getMessage();
    }

    //重新導向回到主畫面 不知道為什麼停在原頁面不能直接看到修改的樣子
    header("Location: course-schedule-list.php");
}else{

    $sql_select="SELECT schedule_id, coach_id, course_code, course_time FROM course_schedule WHERE schedule_id=?";
    $stmt=$db_host->prepare($sql_select);

    try{

        $stmt->execute(array($_GET["schedule_id"]));
        $row=$stmt->fetch(PDO::FETCH_ASSOC);

    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <title>修改開課清單</title>
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
                        <label for="schedule_id" class="form-label">開課代號</label>
                        <input type="text" class="form-control-plaintext" id="schedule_id" name="schedule_id" value="<?=$row['schedule_id']?>" readonly >
                    </div>
                    <div class="col-md-5 m-3">
                        <label for="coach_code" class="form-label">教練代號</label>
                        <input type="text" class="form-control" id="coach_code" name="coach_id" value="<?=$row['coach_id']?>">
                    </div>
                    <div class="col-md-5 m-3">
                        <label for="course_code" class="form-label">課程代碼</label>
                        <input type="text" class="form-control" id="course_code" name="course_code" value="<?=$row['course_code']?>">
                    </div>
                    <div class="col-md-5 m-3">
                        <label for="course_time" class="form-label">上課時段</label>
                        <input type="text" class="form-control" id="course_time" name="course_time" value="<?=$row['course_time']?>">
                    </div>


                    <div class="col-md-5 m-3">
                        <input name="action" type="hidden" value="update">
                        <button class="btn btn-primary" type="submit">更新課程資料</button>
                    </div>
                </form>
            </div>

        </article> <!--/content-->
    </div>
</div>
</body>
</html>

