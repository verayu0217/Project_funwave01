<?php

if(isset($_POST["action"])&&($_POST["action"]=="add")) {
    require_once("method/pdo-connect.php");
    $valid=1;
    $sql_query = "INSERT INTO spot_list (spot_code ,spot_name ,spot_location,valid) VALUES (?, ?, ? ,?)";
    $stmt = $db_host->prepare($sql_query);

    try {

        $stmt->execute([$_POST["spot_code"], $_POST["spot_name"], $_POST["spot_location"],$valid]);


    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    //重新導向回到主畫面
    header("Location: spot-list.php");
}

?>

<!doctype html>
<html lang="en">
<head>
    <title>新增浪點</title>
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
                <a role="button" href="spot-list.php" class="btn btn-primary">返回</a>
            </div>
        </div>
        <article class="article col-9 shadow-sm"> <!--content-->
            <div>
                <form action="" method="post">
                    <div class="col-md-5 m-3">
                        <label for="spot_code" class="form-label">浪點代號</label>
                        <input type="text" class="form-control" id="spot_code" name="spot_code" placeholder="請輸入浪點代號" required>
                    </div>

                    <div class="col-md-5 m-3">
                        <label for="spot_name" class="form-label">浪點名稱</label>
                        <input type="text" class="form-control" id="spot_name" name="spot_name" placeholder="請輸入浪點名稱" required>
                    </div>
                    <div class="col-md-5 m-3">
                        <label for="spot_location" class="form-label">浪點位置</label>
                        <input type="text" class="form-control" id="spot_location" name="spot_location" placeholder="請輸入浪點位置" required>
                    </div>

                    <div class="col-md-5 m-3">
                        <input name="action" type="hidden" value="add">
                        <button class="btn btn-primary" type="submit">新增浪點資訊</button>
                        <button class="btn btn-primary" type="reset">重新填寫</button>
                    </div>
                </form>
            </div>

        </article> <!--/content-->
    </div>
</div>
</body>
</html>