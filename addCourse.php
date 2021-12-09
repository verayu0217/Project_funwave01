<?php

if(isset($_POST["action"])&&($_POST["action"]=="add")){
    require_once("method/pdo-connect.php");


    if (empty($_POST["course_code"])) {
        echo "沒有輸入資料<br>";

    }

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
                <!--                οnsubmit="submitFun()"-->
                <form  id="form" action="" method="post">
                    <div class="col-md-5 m-3">
                        <label for="course_code" class="form-label">課程代號</label>
                        <input type="text" class="form-control" id="course_code" name="course_code" placeholder="請輸入課程代號" required>
                        <div id="course_codeError" class="text-danger"></div>


                    </div>
                    <div class="col-md-5 m-3">
                        <label for="course_name" class="form-label">課程名稱</label>
                        <input type="text" class="form-control" id="course_name" name="course_name" placeholder="請輸入課程名稱" required>
                        <div id="course_nameError" class="text-danger"></div>

                    </div>
                    <div class="col-md-5 m-3">
                        <label for="course_level" class="form-label">課程級別</label>
                        <input type="text" class="form-control" id="course_level" name="course_level" placeholder="請輸入課程級別" required>
                        <div id="course_levelError" class="text-danger"></div>

                    </div>
                    <div class="col-md-5 m-3">
                        <label for="course_price" class="form-label">課程費用</label>
                        <input type="text" class="form-control" id="course_price" name="course_price" placeholder="請輸入課程費用" required>
                        <div id="course_priceError" class="text-danger"></div>

                    </div>
                    <div class="col-md-5 m-3">
                        <label for="spot_code" class="form-label">浪點代號</label>
                        <input type="text" class="form-control" id="spot_code" name="spot_code" placeholder="請輸入浪點代號" required>
                        <div id="spot_codeError" class="text-danger"></div>

                    </div>

                    <div class="col-md-5 m-3">
                        <input name="action" type="hidden" value="add">
                        <button class="btn btn-primary" id="submitBtn"  type="submit">新增課程資料</button>
                        <button class="btn btn-primary"  type="reset">重新填寫</button>
                    </div>
                </form>
            </div>

        </article> <!--/content-->
    </div>
</div>

<script>

    // 宣告變數綁定表單欄位id
    let form = document.querySelector("#form");
    let submitBtn = document.querySelector("#submitBtn");
    let course_code = document.querySelector("#course_code");
    let course_name = document.querySelector("#course_name");
    let course_level = document.querySelector("#course_level");
    let course_price = document.querySelector("#course_price");
    let spot_code = document.querySelector("#spot_code");

    //宣告變數綁定欄位底下的div顯示錯誤訊息
    let course_codeError = document.querySelector("#course_codeError");
    let course_nameError = document.querySelector("#course_nameError");
    let course_levelError = document.querySelector("#course_levelError");
    let course_priceError = document.querySelector("#course_priceError");
    let spot_codeError = document.querySelector("#spot_codeError");


    // 監聽按鈕
    submitBtn.addEventListener("click", function(e) {
        e.preventDefault();

        course_codeError.innerText = course_nameError.innerText = course_levelError.innerText = course_priceError.innerText = spot_codeError.innerText =  " "; //初始值都是空白
        if (course_code.value === "") {
            course_codeError.innerText = "請輸入課程代號";
        }
        if (course_name.value === "") {
            course_nameError.innerText = "請輸入課程名稱";
        }
        if (course_level.value === "") {
            course_levelError.innerText = "請輸入課程級別";
        }
        if (course_price.value === "") {
            course_priceError.innerText = "請輸入課程費用";
        }
        if (spot_code.value === "") {
            spot_codeError.innerText = "請輸入浪點代號";
        }

        if ( course_codeError.innerText === "" && course_nameError.innerText === "" && course_levelError.innerText === "" && course_priceError.innerText === "" && spot_codeError.innerText === "") {
            form.submit();
        }



    })

    // function submitFun() {
    //     alert("已新增完成 但沒有輸入資料也會跑出這個");
    // }
</script>
</body>
</html>