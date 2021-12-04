<?php
require_once("method/connect.php");

if(isset($_POST["action"])&&($_POST["action"]=="update")){
    $sql_query="UPDATE course_list SET course_code=?, course_name=?,course_level=?,course_price=?,spot_code=? WHERE course_code=?";
    $stmt = $conn -> prepare($sql_query);
    $stmt->bind_param("sssiss", $_POST["course_code"], $_POST["course_name"], $_POST["course_level"], $_POST["course_price"], $_POST["spot_code"],$_POST["course_code"]);

    $stmt -> execute();
    $stmt -> close();
    $conn -> close();
    //重新導向回到主畫面
    header("Location: course-list.php");
}


//若沒有送出表單
//注意sql語法打錯會有問題
$sql_select="SELECT course_code, course_name, course_level, course_price,spot_code FROM course_list WHERE course_code=?";
$stmt=$conn->prepare($sql_select);
$stmt->bind_param("s",$_GET["course_code"]);
$stmt->execute();
$stmt->bind_result($code,$name,$level,$price,$spot);
$stmt->fetch();

?>

<!doctype html>
<html lang="en">
<head>
    <title>修改課程資料</title>
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
                        <input type="text" class="form-control" id="course_code" name="course_code" value="<?=$code?>">
                    </div>
                    <div class="col-md-5 m-3">
                        <label for="course_name" class="form-label">課程名稱</label>
                        <input type="text" class="form-control" id="course_name" name="course_name" value="<?=$name?>">
                    </div>
                    <div class="col-md-5 m-3">
                        <label for="course_level" class="form-label">課程級別</label>
                        <input type="text" class="form-control" id="course_level" name="course_level" value="<?=$level?>">
                    </div>
                    <div class="col-md-5 m-3">
                        <label for="course_price" class="form-label">課程費用</label>
                        <input type="text" class="form-control" id="course_price" name="course_price" value="<?=$price?>">
                    </div>
                    <div class="col-md-5 m-3">
                        <label for="spot_code" class="form-label">浪點代號</label>
                        <input type="text" class="form-control" id="spot_code" name="spot_code" value="<?=$spot?>"
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
