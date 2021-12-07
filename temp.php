<?php
require_once("method/pdo-connect.php");

//查詢所有浪點的SQL敘述
$sql_spot="SELECT * FROM spot_list ";
$stmtSpot=$db_host->prepare($sql_spot);

//執行 fetch出來
try{
    $stmtSpot->execute();
    $spotRows=$stmtSpot->fetchAll(PDO::FETCH_ASSOC);

}catch(PDOException $e){
    echo $e->getMessage();
    $db_host=NULL;
    exit;
}

//宣告一個陣列
//foreach跑出所有fetch出來的結果
//儲存在....
$areaArr=[];
foreach($spotRows as $area){
//    浪點代號=地區的陣列
//    是表示fetch出來的資料 我只要這兩個欄位的意思嗎?
    $areaArr[$area["spot_code"]]=$area["spot_area"];

}

//做篩選
//select的name有get過來的話
if(isset($_GET["area"])){
    $area=$_GET["area"];
    $sql="SELECT * FROM course_list WHERE spot_code=? ";
    $stmt=$db_host->prepare( $sql);

    try{
        $stmt->execute([$area]);
        $CourseRows= $stmt->fetchAll(PDO::FETCH_ASSOC);

    }catch(PDOException $e){
        echo $e->getMessage();
        $db_host=NULL;
        exit;
    }
}else{

    //所有課程
    $sql_total_course="SELECT * FROM course_list ";
    $stmtCourse=$db_host->prepare($sql_total_course);

    try{
        $stmtCourse->execute();
        $CourseRows=$stmtCourse->fetchAll(PDO::FETCH_ASSOC);


    }catch(PDOException $e){
        echo $e->getMessage();
        $db_host=NULL;
        exit;
    }
}



?>


<!doctype html>
<html lang="en">

<head>
    <title>課程清單管理</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!--    --><?php //require_once("./public/css.php") ?>



</head>

<body>

<div class="container-fluid">
    <div class="row wrap d-flex">
<!--        --><?php //require_once("./public/header.php") ?>
        <!--menu-->
        <aside class="col-lg-2 navbar-side shadow-sm">
<!--            --><?php //require_once("./public/nav.php") ?>
        </aside>


        <!--/menu-->
        <div class="col-lg-9 d-flex justify-content-end align-items-center button-group shadow-sm">

            <!--下拉選單課程地區-->
            <form action="" >
                <div class="py-2 d-flex">
                    <div class="col-auto me-2">
                        <select class="form-select" name="area" id="">
                            <option value="">請選擇地區</option>
                    <!-- 跟上面一樣fetch出來的結果 取出這兩個欄位-->
                            <?php foreach($spotRows as $spot):?>
                                <option value="<?=$spot["spot_code"] ?>"><?=$spot["spot_area"]?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-primary" type="submit"> 篩選</button>

                    </div>

                </div>


            </form>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>課程代號</th>
                    <th>課程區域</th>
                    <th>課程名稱</th>
                </tr>
                </thead>
                <tbody>
                <!--所有課程fetch出來的結果取值課程編號&課程名稱-->
                <!--                還有一個是存在陣列key對value的關係-->
                <?php foreach($CourseRows as $course):?>
                    <tr>
                        <td><?=$course["course_code"]?></td>
                        <td><?=$areaArr[$course["spot_code"]]?></td>
                        <td><?=$course["course_name"]?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>

            </table>



        </div>


        <article class="article col-lg-9 shadow-sm table-responsive">



        </article>
        <!--/content-->
    </div>
</div>



</body>

</html>