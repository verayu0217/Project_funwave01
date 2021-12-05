<?php
require_once("method/pdo-connect.php");

$spot_code=$_GET["spot_code"];

if(isset($_POST["action"])&&($_POST["action"]=="delete")){

    $sql_query="DELETE FROM spot_list WHERE spot_code=?";
    $stmt=$db_host -> prepare($sql_query);

    try{

        $stmt->execute([$spot_code]);


    }catch(PDOException $e){
        echo $e->getMessage();
    }

    //重新導向回到主畫面
    header("Location: spot-list.php");
}else{

    $sql_select="SELECT spot_code, spot_name, spot_location FROM spot_list WHERE spot_code=?";
    $stmt=$db_host->prepare($sql_select);

    try{

        $stmt->execute([$spot_code]);

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
                <a role="button" href="spot-list.php" class="btn btn-primary">返回</a>
            </div>
        </div>
        <article class="article col-9 shadow-sm"> <!--content-->

            <div>

                <form action="" method="post">
                    <div class="col-md-5 m-3">
                        <label for="spot_code" class="form-label">浪點代號</label>
                        <input type="text" class="form-control-plaintext" id="spot_code" name="spot_code" value="<?= $row['spot_code'] ?>" readonly>
                    </div>

                    <div class="col-md-5 m-3">
                        <label for="spot_name" class="form-label">浪點名稱</label>
                        <input type="text" class="form-control-plaintext" id="spot_name" name="spot_name" value="<?= $row['spot_name'] ?>" readonly>
                    </div>
                    <div class="col-md-5 m-3">
                        <label for="spot_location" class="form-label">浪點位置</label>
                        <input type="text" class="form-control-plaintext" id="spot_location" name="spot_location" value="<?=$row['spot_location'] ?>" readonly>
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