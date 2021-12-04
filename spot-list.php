<?php
require_once("method/connect.php");

//總筆數
$sqlTotal="SELECT * FROM spot_list";
$resultTotal=$conn->query($sqlTotal);
$totalCourse=$resultTotal->num_rows;
//所有課程

if (isset($_GET["s"])&&($_GET["s"]!="")){
    $search = $_GET["s"];
    $sql="SELECT * FROM spot_list WHERE spot_name LIKE '%$search%'";
}
else{
    //顯示分頁
    if(isset($_GET["p"])){
        $p=$_GET["p"];
    }else{
        $p=1;

    }
    $pageItems=8;
    $startItem=($p-1)*$pageItems;

//計算總頁數
    $pageCount=$totalCourse/$pageItems;

//取餘數
    $pageR=$totalCourse%$pageItems;


    $startNo=($p-1)*$pageItems+1;
    $endNo=$p*$pageItems;

    if($pageR!==0){
        $pageCount=ceil($pageCount);//如果不=0無條件進位
        if($pageCount==$p){
            $endNo=$endNo-($pageItems-$pageR);
        }
    }

    $sql="SELECT * FROM spot_list LIMIT $startItem, $pageItems;";

}

//$sql="SELECT * FROM course_list LIMIT =8";

$result_query = $conn->query($sql);
//經過搜尋後
$course_rows = $result_query->num_rows;




?>
<!doctype html>
<html lang="en">

<head>
    <title>上課地點清單</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php require_once("public/css.php") ?>

</head>

<body>
<div class="container-fluid">
    <div class="row wrap d-flex">
                        <?php require_once("./public/header.php") ?>
        <!--menu-->
        <aside class="col-lg-2 navbar-side shadow-sm">
                                    <?php require_once("./public/nav.php") ?>
        </aside>
        <!--/menu-->
        <div class="col-lg-9 d-flex justify-content-between align-items-center button-group shadow-sm">
            <div>
                <a role="button" href="service.php" class="btn btn-primary">返回</a>
            </div>

            <div>
                <a role="button" href="addSpot.php" class="btn btn-primary">新增</a>
            </div>
            <form action="" method="get">
                <div class="d-flex">
                    <input class="form-control me-2" type="search" name="s" placeholder="請輸入浪點名稱" value="<?php if (isset($search)) echo $search; ?>">
                    <button class="btn btn-outline-success text-nowrap">搜尋</button>
                </div>
            </form>
        </div>


        <article class="article col-lg-9 shadow-sm table-responsive">
            <!--content-->
            <div class="table-wrap">
                <?php if ($course_rows > 0) : ?>
                    <table class="table table-control  table-sm table-striped align-middle my-3">
                        <thead>
                        <tr>

                            <th>浪點編號</th>
                            <th>浪點名稱</th>
                            <th>浪點位置</th>


                        </tr>
                        </thead>
                        <tbody>
                        <?php while ($row = $result_query->fetch_assoc()) : ?>
                            <tr>

                                <td><?= $row["spot_code"] ?></td>
                                <td><?= $row["spot_name"] ?></td>
                                <td><?= $row["spot_location"] ?></td>


                                <td>
                                    <a role="button" href="deleteSpot.php?student_id=<?= $row[""] ?>" class="btn btn-danger">刪除</a>
                                    <a role="button" href="updateSpot.php?student_id=<?= $row[""] ?>" class="btn btn-primary">修改</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                        </tbody>
                    </table>
                    <!--        如果使用搜尋功能因為沒有p pagaCount會跑出來有問題 所以加上判斷 有p才出現這個UI-->
                    <?php if(isset($p)): ?>
                        <nav aria-label="Page navigation example ">
                            <ul class="pagination justify-content-center">
                                <?php for($i=1;$i<=$pageCount; $i++) :?>
                                    <!--當下頁數跟頁碼相同時echo active 寫在li class裡面-->
                                    <li class="page-item <?php if($p==$i) echo "active" ?>">
                                        <a class="page-link" href="spot-list.php?p=<?=$i?>"><?=$i?></a></li>
                                <?php endfor; ?>
                            </ul>
                        </nav>
                    <?php endif; ?>
                <?php else : ?>
                    沒有資料
                <?php endif; ?>
            </div>

        </article>
        <!--/content-->
    </div>
</div>
</body>

</html>