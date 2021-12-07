<?php

//新增時先讀取資料庫 取得目前開課代碼  在UI顯示結果+1 取得最新流水號
require_once("method/pdo-connect.php");
$sql_first_number="SELECT *FROM course_schedule where schedule_id";
$stmt = $db_host->prepare($sql_first_number);
try{
    $stmt->execute();
    $resultTotal=$stmt->rowCount();

}catch(PDOException $e){
    echo $e->getMessage();
}


//如果表單送出
if(isset($_POST["action"])&&($_POST["action"]=="add")){
	require_once("method/pdo-connect.php");

	$sql_query = "INSERT INTO course_schedule (coach_id ,course_code ,course_time) VALUES (?, ?, ?)";
	$stmt = $db_host-> prepare($sql_query);

    try{


        $stmt -> execute([$_POST["coach_id"], $_POST["course_code"], $_POST["course_time"], ]);


    }catch(PDOException $e){
        echo $e->getMessage();
    }
	//重新導向回到主畫面
	header("Location: course-schedule-list.php");
}

?>

<!doctype html>
<html lang="en">
<head>
    <title>新增開課清單</title>
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
                        <!--判斷如果取得目前的筆數讓它+1變成最新-->
                        <?php if(isset($resultTotal)): ?>
                        <label for="course_code" class="form-label">開課代碼</label>
                        <input type="text" class="form-control-plaintext" id="course_code" name="course_code" value="<?=$resultTotal+1?>" readonly">
                        <?php endif?>
                    </div>

                    <div class="col-md-5 m-3">
                        <label for="course_name" class="form-label">教練代號</label>
                        <input type="text" class="form-control" id="course_name" name="coach_id" placeholder="請輸入教練代號" required>
                    </div>
                    <div class="col-md-5 m-3">
                        <label for="course_level" class="form-label">課程代碼</label>
                        <input type="text" class="form-control" id="course_level" name="course_code" placeholder="請輸入課程代碼" required>
                    </div>

                    <div class="col-md-5 m-3">
                        <label for="course_price" class="form-label">上課時段</label>
                        <input type="time" class="form-control" id="course_price" name="course_time" placeholder="請選擇上課的時段" required>
                    </div>

                    <div class="col-md-5 m-3">
                        <input name="action" type="hidden" value="add">
                        <button class="btn btn-primary" type="submit">新增開課資料</button>
                        <button class="btn btn-primary" type="reset">重新填寫</button>
                    </div>
                </form>
            </div>

        </article> <!--/content-->
    </div>
</div>
</body>
</html>