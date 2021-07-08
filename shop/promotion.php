<?php
    require('../config/connection.php');
    require('api/check_shop.php');

    $page_name = "โปรโมชั่น";
    
    if (isset($_POST['btnSave'])) {
        $detail         = stripslashes($_POST['detail']); // removes backslashes
        $detail         = mysqli_real_escape_string($conn, $detail); //escapes special characters in a string
        $date           = stripslashes($_POST['date']);
        $date           = mysqli_real_escape_string($conn, $date);
        $time           = stripslashes($_POST['time']);
        $time           = mysqli_real_escape_string($conn, $time);

        $image          = $_FILES['image'];

        $imgPath = '';

        if (isset($image)) {
            $img        = $image;
            $uploadDir  = '../uploads/promotion/';

            if (trim($img['tmp_name']) != '') {
                $ext = substr(strrchr($img['name'], "."), 1); 

                $imgPath = md5(rand() * time()) . ".$ext";

                if (!move_uploaded_file($img['tmp_name'], $uploadDir . $imgPath)) {
                    $imgPath = '';
                }
            }
        }

        $query = "INSERT INTO tbl_promotion (p_image, p_detail, p_date, p_time) VALUES ('$imgPath', '$detail', '$date', '$time')";
        $result   = mysqli_query($conn, $query);

        if ($result) {
            echo "<script>window.location.replace('promotion.php?success');</script>";
        } else {
            echo "<script>alert('มีข้อผิดพลาดกรุณาลองใหม่'); window.location.replace('register.php');</script>";
        }
    }

    $curr_year = date('Y') + 543;
?>

<?php include 'include/header.php'; ?>

    <h1 class="site-title">GOTCHA!</h1>
    <?php if (isset($_GET['success'])) { ?>
        <div id="page-success" class="form-container">
            <img src="../images/check.png">
            <div class="title-success">
                ทำรายการสำเร็จ!
            </div>
            <div class="text-success">
                .. โปรดรอระบบตรวจสอบข้อมูลของคุณ ..<br>
                ระบบจะโปรโมทสินค้าให้ไวที่สุดตามระยะเวลาที่คุณกำหนด<br>
                หากพบปัญหาโปรดติดต่อเรา<br>
                022-222-222
            </div>
            <a href="register.php" class="btn btn-primary">หน้าแรก</a>
        </div>
    <?php } else { ?>
        <form id="form-register" class="form-container" enctype="multipart/form-data" method="post">
            <fieldset id="profile">
                <h2 class="form-title">
                    “<?php echo $row_shop_ap['s_shop_name']; ?>”<br>
                    สร้างโปรโมชัน
                </h2>
                <div class="form-description">
                    สร้างโปรโมชันของคุณเพื่อกระจายข้อมูลให้ลูกค้าของคุณทราบ ลูกค้าจะเห็นข่าวสารผ่าน Line Official Account GOTCHA!
                </div>
                <div class="form-group">
                    <label for="image">รูปภาพโปรโมท</label>
                    <input type="file" class="form-control" name="image" id="image">
                    <div class="input-error input-name"></div>
                    <div class="input-note">**แนะนำเป็นภาพจัตุรัส ความกว้าง x ความสูง เท่ากัน</div>
                </div>
                <div class="form-group">
                    <label for="detail">ข้อความบรรยาย</label>
                    <textarea class="form-control" name="detail" id="detail" placeholder="ข้อความบรรยายไม่เกิน 500 ตัวอักษร" rows="5"></textarea>
                    <div class="input-error input-detail"></div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label>วันและเวลาปล่อยข่าวสาร</label>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="date" class="form-control" name="date" id="date">
                            <div class="input-error input-date"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="time" class="form-control" name="time" id="time">
                            <div class="input-error input-time"></div>
                        </div>
                    </div>
                </div>
                <div class="input-note">
                    เงื่อนไขการใช้งานระบบโปรโมทสินค้าและบริการมีดังนี้<br>
                    1.คุณสามารถใช้ระบบโปรโมทสินค้าได้เพียง 1 ครั้งต่ออาทิตย์ เมื่อคุณโปรโมทไปแล้ว ระบบจะนับเวลา 168 ชั่วโมง และกลับมาใช้งานได้อีกครั้ง<br>
                    2.เฉพาะลูกค้าที่เป็นสมาชิกกับบัตรสะสมแต้มร้านคุณเท่านั้นที่สามารถเห็นการ โปรโมทของคุณได้<br>
                    3.บริษัทฯ ขอสงวนสิทธิในการเปลี่ยนแปลงเงื่อนไขและสิทธิประโยชน์ต่างๆ โดยไมต้องแจ้งให้ทราบล่วงหน้า อ่านเงื่อนไขเพิ่ม
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" id="agree3"> ฉันยอมรับข้อตกลง</label>
                </div>
                <button type="submit" class="btn btn-primary" id="btn-submit" name="btnSave" disabled>ดำเนินการต่อ</button>
                <a href="index.php" class="next btn btn-danger">ยกเลิก</a>
            </fieldset>
        </form>
    <?php } ?>

<?php include 'include/footer.php'; ?>
