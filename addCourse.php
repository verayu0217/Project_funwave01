<?php

if(isset($_POST["action"])&&($_POST["action"]=="add")){
	require_once("method/pdo-connect.php");

	$sql_query = "INSERT INTO course_list (course_code ,course_name ,course_level ,course_price ,spot_code) VALUES (?, ?, ?, ? ,?)";
	$stmt = $db_host-> prepare($sql_query);

    try{

//        $stmt -> execute(array($_POST["course_code"], $_POST["course_name"], $_POST["course_level"], $_POST["course_price"], $_POST["spot_code"]));

        $stmt -> execute([$_POST["course_code"], $_POST["course_name"], $_POST["course_level"], $_POST["course_price"], $_POST["spot_code"]]);


    }catch(PDOException $e){
        echo $e->getMessage();
    }
	//重新導向回到主畫面
	header("Location: course-list.php");
}

?>

<!doctype html>
<html lang="en">
<head>
    <title>新增課程</title>
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
                        <input type="text" class="form-control" id="course_code" name="course_code" placeholder="請輸入課程代號">
                    </div>
                    <div class="col-md-5 m-3">
                        <label for="course_name" class="form-label">課程名稱</label>
                        <input type="text" class="form-control" id="course_name" name="course_name" placeholder="請輸入課程名稱">
                    </div>
                    <div class="col-md-5 m-3">
                        <label for="course_level" class="form-label">課程級別</label>
                        <input type="text" class="form-control" id="course_level" name="course_level" placeholder="請輸入課程級別">
                    </div>
                    <div class="col-md-5 m-3">
                        <label for="course_price" class="form-label">課程費用</label>
                        <input type="text" class="form-control" id="course_price" name="course_price" placeholder="請輸入課程費用">
                    </div>
                    <div class="col-md-5 m-3">
                        <label for="spot_code" class="form-label">浪點代號</label>
                        <input type="text" class="form-control" id="spot_code" name="spot_code" placeholder="請輸入浪點代號">
                    </div>

                    <div class="col-md-5 m-3">
                        <input name="action" type="hidden" value="add">
                        <button class="btn btn-primary" type="submit">新增課程資料</button>
                        <button class="btn btn-primary" type="reset">重新填寫</button>
                    </div>
                </form>
            </div>

        </article> <!--/content-->
    </div>
</div>
</body>
</html>