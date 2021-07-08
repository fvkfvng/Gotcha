<?php
    require('../config/connection.php');
    require('api/check_shop.php');

    $page_name = "บัตรสะสมแต้ม";

    if (isset($_POST['saveStyle'])) {
        $style        = stripslashes($_POST['style']); // removes backslashes
        $style        = mysqli_real_escape_string($conn, $style); //escapes special characters in a string

        $query    = "UPDATE tbl_shop SET s_card_style = '".$style."' WHERE s_id = ".$row_shop_ap['s_id'];
        $result   = mysqli_query($conn, $query);

        if ($result) {
            echo "<script>window.location.replace('index.php');</script>";
        } else {
            echo "<script>alert('มีข้อผิดพลาดกรุณาลองใหม่'); window.location.replace('card-style.php');</script>";
        }
    }
?>

<?php include 'include/header.php'; ?>
    
    <div class="main-container">
        <h1 class="site-title">GOTCHA!</h1>
        <br>
        <h2 class="main-title">
            แก้ไขรูปแบบบัตร
        </h2>
        <form method="post">
            <div class="card-item">
                <label class="el-radio">
                    <input type="radio" name="style" value="1" <?php if ($row_shop_ap['s_card_style'] == 1) { echo 'checked'; } ?>>
                    <span class="el-radio-style"></span>
                </label>
                <div class="card-content" style="background-image: url(../images/card/1.jpg)">
                    <div class="card-point-logo"></div>
                    <div class="card-point-detail"></div>
                </div>
            </div>
            <div class="card-item">
                <label class="el-radio">
                    <input type="radio" name="style" value="2" <?php if ($row_shop_ap['s_card_style'] == 2) { echo 'checked'; } ?>>
                    <span class="el-radio-style"></span>
                </label>
                <div class="card-content" style="background-image: url(../images/card/2.png)">
                    <div class="card-point-logo"></div>
                    <div class="card-point-detail"></div>
                </div>
            </div>
            <div class="card-item">
                <label class="el-radio">
                    <input type="radio" name="style" value="3" <?php if ($row_shop_ap['s_card_style'] == 3) { echo 'checked'; } ?>>
                    <span class="el-radio-style"></span>
                </label>
                <div class="card-content" style="background-image: url(../images/card/3.jpg)">
                    <div class="card-point-logo"></div>
                    <div class="card-point-detail"></div>
                </div>
            </div>
            <div class="card-item">
                <label class="el-radio">
                    <input type="radio" name="style" value="4" <?php if ($row_shop_ap['s_card_style'] == 4) { echo 'checked'; } ?>>
                    <span class="el-radio-style"></span>
                </label>
                <div class="card-content" style="background-image: url(../images/card/4.jpg)">
                    <div class="card-point-logo"></div>
                    <div class="card-point-detail"></div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" name="saveStyle">บันทึก</button>
            <a href="index.php" class="btn btn-white">ยกเลิก</a>
        </form>
    </div>

<?php include 'include/footer.php'; ?>