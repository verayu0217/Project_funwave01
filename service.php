<?php

?>


<!doctype html>
<html lang="en">
<head>
    <title>服務管理</title>
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
        <div class="col-9 d-flex align-items-center button-group shadow-sm">


            <div class="ms-3">
                <a role="button" href="course-order-list.php" class="btn btn-secondary">課程訂單管理</a>
            </div>
            <div class="ms-3">
                <a role="button" href="course-list.php" class="btn btn-secondary">課程清單</a>
            </div>
            <div class="ms-3">
                <a role="button" href="course-schedule-list.php" class="btn btn-secondary">開課清單</a>
            </div>
            <div class="ms-3">
                <a role="button" href="spot-list.php" class="btn btn-secondary">浪點清單</a>
            </div>
            <div class="ms-3">
                <a role="button" href="student-list.php" class="btn btn-secondary">學生清單</a>
            </div>


        </div>
        <article class="article col-9 shadow-sm"> <!--content-->
            <table class="table table-info table-striped">
                ...<thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                </tr>
                </tbody>
            </table>
        </article> <!--/content-->
    </div>
</div>
</body>
</html>