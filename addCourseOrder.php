
<?php

if(isset($_POST["action"])&&($_POST["action"]=="add")) {
    require_once("method/pdo-connect.php");

    $sql_query = "INSERT INTO course_order_list (course_order_datetime ,schedule_id, coach_id, student_id) VALUES (?, ?, ?, ?)";
    $stmt = $db_host->prepare($sql_query);

    try {

        $stmt->execute([$_POST["course_order_datetime"], $_POST["schedule_id"],$_POST["coach_id"],$_POST["student_id"]]);


    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    //重新導向回到主畫面
    header("Location: course-order-list.php");
}

?>

<!doctype html>
<html lang="en">
<head>
    <title>新增課程訂單</title>
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
                <a role="button" href="course-order-list.php" class="btn btn-primary">返回</a>
            </div>
        </div>
        <article class="article col-9 shadow-sm"> <!--content-->
            <div>
                <form action="" method="post">
                    <div class="col-md-5 m-3">
                        <label for="course_order_id" class="form-label">訂單編號 自動帶出流水號</label>
                        <input type="text" class="form-control-plaintext" id="course_order_id" name="course_order_id"  readonly>
                    </div>

                    <div class="col-md-5 m-3">
                        <label for="course_order_datetime" class="form-label">訂單日期</label>
                        <input type="text" class="form-control" id="course_order_datetime" name="course_order_datetime" placeholder="請輸入訂單日期">
                    </div>
                    <div class="col-md-5 m-3">
                        <label for="schedule_id" class="form-label">開課代碼</label>
                        <input type="text" class="form-control" id="schedule_id" name="schedule_id" placeholder="請輸入開課代碼">
                    </div>

                    <div class="col-md-5 m-3">
                        <label for="coach_id" class="form-label">教練代碼</label>
                        <input type="text" class="form-control" id="coach_id" name="coach_id" placeholder="請輸入教練代碼">
                    </div>

                    <div class="col-md-5 m-3">
                        <label for="student_id" class="form-label">學生編號</label>
                        <input type="text" class="form-control" id="student_id" name="student_id" placeholder="請輸入學生編號">
                    </div>

                    <div class="col-md-5 m-3">
                        <input name="action" type="hidden" value="add">
                        <button class="btn btn-primary" type="submit">新增課程訂單</button>
                        <button class="btn btn-primary" type="reset">重新填寫</button>
                    </div>
                </form>
            </div>

        </article> <!--/content-->
    </div>
</div>
</body>
</html>